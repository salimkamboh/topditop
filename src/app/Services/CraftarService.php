<?php

namespace App\Services;

use App\Advert;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class CraftarService
{
    use WritesOutputToConsole;

    public $http;

    private $apiVersion;
    private $apiKey;
    private $host;
    private $collection;

    /**
     * CraftarService constructor.
     */
    public function __construct()
    {
        $this->apiVersion = 'v0';
        $this->apiKey = config('craftar.api_key');
        $this->collection = config('craftar.collection_uuid');

        if ($this->apiKey == null || $this->collection == null) {
            throw new \Exception("Api key and collection must be set in .env, read by config/craftar.php");
        }

        $this->host = 'https://my.craftar.net';
        $this->http = new Client();
    }

    public function syncOne(Advert $advert)
    {
        if ($advert->craftar_item_uuid) {
            $this->output("Skipping Advert $advert->id, craftar_item_uuid is already set $advert->craftar_item_uuid");
            return $advert;
        }

        if ($advert->craftar_image_uuid) {
            $this->output("Skipping Advert $advert->id, craftar_image_uuid is already set $advert->craftar_image_uuid");
            return $advert;
        }

        //validate that this reference image is set
        if (!$advert->reference_image_url) {
            $this->output("Skipping Advert $advert->id, reference_image_url is not set $advert->reference_image_url");
            return $advert;
        }

        //validate that image exists on disk
        $imageExists = Storage::disk('images')->exists($advert->reference_image_url);

        if (!$imageExists) {
            $this->output("Skipping Advert $advert->id,reference_image_url is in database but image file not found $advert->reference_image_url");
            return $advert;
        }

        $itemName = str_slug($advert->manufacturer->name) . ' ' . $advert->id;
        $itemUrl = route('advert_page', $advert->id);

        $itemResponse = $this->createItem($itemName, [
            'url' => $itemUrl,
        ]);

        $itemResponseStatusCode = $itemResponse->getStatusCode();

        if ($itemResponseStatusCode !== Response::HTTP_CREATED) {
            // item was not created, abort
            $this->output("Aborting Failed to create Item for Advert $advert->id, expected 201 got $itemResponseStatusCode");
            return $advert;
        }

        $createdItem = json_decode($itemResponse->getBody(), true);
        $itemUuid = $createdItem['uuid'];

        // create image for that item_uuid
        $imageResponse = $this->createImage($itemUuid, $advert->reference_image_url);
        $imageResponseStatusCode = $imageResponse->getStatusCode();

        if ($imageResponse->getStatusCode() !== Response::HTTP_CREATED) {
            //delete item that was created
            //return
            $this->output("Aborting Failed to create Image for Item $itemUuid for Advert $advert->id, expected 201 got $imageResponseStatusCode");
            $this->output("deleting created Item $itemUuid ");

            $deleteItemResponse = $this->deleteItem($itemUuid);

            if ($deleteItemResponse->getStatusCode() !== Response::HTTP_NO_CONTENT) {
                $this->output("Failed to delete item $itemUuid");
            } else {
                $this->output("Deleted item $itemUuid");
            }
            return $advert;
        }

        $createdImage = json_decode($imageResponse->getBody(), true);
        $imageUuid = $createdImage['uuid'];

        $advert->craftar_item_uuid = $itemUuid;
        $advert->craftar_image_uuid = $imageUuid;

        $advert->save();

        $this->output("Synced Advert $advert->id, item $advert->craftar_item_uuid, image $advert->craftar_image_uuid");
        
        return $advert;
    }

    public function syncAll()
    {
        $adverts = $this->getNotSyncedAdverts();

        foreach ($adverts as $advert) {
            try {
                $this->syncOne($advert);
            } catch (\Exception $e) {
                $this->output($e->getMessage());
            }
        }
    }

    public function createImage($itemUuid, $relativeImagePath)
    {
        return $this->createObjectMultipart(
            "image",
            [
                [
                    'name' => 'item',
                    'contents' => $this->buildResourceUri("item", $itemUuid),
                ],
                [
                    'name' => 'file',
                    'contents' => fopen(base_path('images' . $relativeImagePath), 'r')
                ]
            ]
        );
    }


    public function createItem($name, $optionalData)
    {
        $data = array(
            "collection" => $this->buildResourceUri("collection", $this->collection),
            "name" => $name
        );
        return $this->createObject("item", array_merge($data, $optionalData));
    }

    private function createObjectMultipart($objectType, $data)
    {
        $url = $this->buildUrl($objectType);
        return $this->http->post($url, ['multipart' => $data]);
    }


    private function buildUrl($objectType, $uuid = null)
    {
        $url = $this->host;
        $url .= $this->buildResourceUri($objectType, $uuid);
        $url .= "?api_key={$this->apiKey}";
        return $url;
    }

    private function buildResourceUri($objectType, $uuid = null)
    {
        $url = "/api/{$this->apiVersion}/$objectType/";

        if ($uuid != null)
            $url .= "$uuid/";

        return $url;
    }

    private function createObject($objectType, $data)
    {
        $url = $this->buildUrl($objectType);
        return $this->http->post($url, ['json' => $data]);
    }

    private function getNotSyncedAdverts()
    {
        $adverts = Advert::whereRaw('LENGTH(reference_image_url) > 0')
            ->where('id', '>=', 17)
            ->where('craftar_item_uuid', '')
            ->where('craftar_image_uuid', '')
            ->get();

        return $adverts;
    }

    public function deleteItem($uuid)
    {
        return $this->deleteObject("item", $uuid);
    }

    private function deleteObject($objectType, $uuid)
    {
        $url = $this->buildUrl($objectType, $uuid);
        return $this->http->delete($url);
    }

}