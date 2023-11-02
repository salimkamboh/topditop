<?php

namespace App\Services;

use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Log;

class EdenService
{
    protected $base_url;
    protected $token;
    protected $headers;
    protected $parameters;

    public function __construct()
    {
        $this->base_url = config('app.edenapi_baseurl');
        $this->token = config('app.edenapi_token');
        $this->headers = [
            'authorization' => 'Bearer ' . $this->token,
            'accept' => 'application/json',
            'content-type' => 'application/json',
        ];
        $this->parameters = [
            "providers" => "sentisight",
            "response_as_dict" => true,
            "attributes_as_list" => false,
            "show_original_response" => false
        ];
    }
    public function uploadImage($file_url)
    {
        $data = $this->parameters + [
            "file_url" => $file_url,
            "image_name" => basename($file_url),
        ];
        try {
            $response = Curl::to($this->base_url . 'upload_image')
                ->withHeaders($this->headers)
                ->withData(json_encode($data))
                ->returnResponseObject()
                ->post();
            // print_r($response);
            Log::debug(print_r($response, true));
            return $response->status == 200 ? true : false;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $e->getMessage();
        }
    }
    public function deleteImage($image_name)
    {
        $data = $this->parameters + [
            "image_name" => $image_name,
        ];
        try {
            $response = Curl::to($this->base_url . 'delete_image')
                ->withHeaders($this->headers)
                ->withData(json_encode($data))
                ->returnResponseObject()
                ->post();
            Log::debug(print_r($response, true));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $e->getMessage();
        }
    }
    public function listImages()
    {
        $data = $this->parameters;
        try {
            $response = Curl::to($this->base_url . 'get_images')
                ->withHeaders($this->headers)
                ->withData($data)
                ->returnResponseObject()
                ->get();
            // print_r($response->content);
            Log::debug(print_r($response, true));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $e->getMessage();
        }
    }
    public function searchImage($imagePath)
    {
        $data = $this->parameters + ["file_url" => $imagePath];
        try {
            $response = Curl::to($this->base_url . 'launch_similarity')
                ->withHeaders($this->headers)
                ->withData(json_encode($data))
                ->returnResponseObject()
                ->post();
            $response = json_decode($response->content);
            print_r ($response);
            return ["error" => false, "items" => $response->sentisight->items];
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ["error" => true, "message" => $e->getMessage()];
        }
    }
}
