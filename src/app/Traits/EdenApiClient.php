<?php

namespace App\Traits;

use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Log;

trait EdenApiClient
{

    protected $base_url;
    protected $token;
    protected $headers;

    public function init()
    {
        $this->base_url = config('app.edenapi_baseurl');
        $this->token = config('app.edenapi_token');
        $this->headers = [
            'authorization' => 'Bearer ' . $this->token,
            'accept' => 'application/json',
            'content-type' => 'application/json',
        ];
    }
    public function uploadImage($file_url)
    {
        $data = [
            "providers" => "sentisight",
            "file_url" => $file_url,
            "image_name" => basename($file_url),
            "response_as_dict" => true,
            "attributes_as_list" => false,
            "show_original_response" => false
        ];
        // print_r($data);exit;
        try {
            $response = Curl::to($this->base_url . 'upload_image')
                ->withHeaders($this->headers)
                ->withData(json_encode($data))
                ->returnResponseObject()
                ->post();
            print_r($response);
            Log::debug(print_r($response, true));
            return $response->status == 200 ? true : false;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $e->getMessage();
        }
    }
    public function deleteImage($image_name)
    {
        $data = [
            "providers" => "sentisight",
            "image_name" => $image_name,
            "response_as_dict" => true,
            "attributes_as_list" => false,
            "show_original_response" => false
        ];
        try {
            $response = Curl::to($this->base_url . 'delete_image')
                ->withHeaders($this->headers)
                ->withData($data)
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
        $data = [
            "providers" => "sentisight",
            "response_as_dict" => true,
            "attributes_as_list" => false,
            "show_original_response" => false
        ];
        try {
            $response = Curl::to($this->base_url . 'get_images')
                ->withHeaders($this->headers)
                ->withData($data)
                ->returnResponseObject()
                ->get();
            print_r($response->content);
            Log::debug(print_r($response, true));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $e->getMessage();
        }
    }
    /**
     * @param $url
     * @param $data
     * @return \Illuminate\Http\Client\Response
     */

    public function _get($url, $data = null)
    {
        return Http::acceptJson()->get($this->base_url . $url, $data);
    }

    /**
     * @param $url
     * @param $data
     * @return \Illuminate\Http\Client\Response
     */

    public function _post($url, $data = [])
    {
        return Http::acceptJson()->post($this->base_url . $url, $data);
    }

    public function _put($url, $data = [])
    {
        return Http::acceptJson()->put($this->base_url . $url, $data);
    }

    public function _patch($url, $data = [])
    {
        return Http::acceptJson()->patch($this->base_url . $url, $data);
    }

    public function _response($response)
    {
        if ($response->successful()) {
            // dd($response->getBody()->getContents());
            return [
                'success' => true,
                'payload' => $response->json() ? $response->json()['payload'] : '',
            ];
        } else {
            // dd($response->getBody()->getContents());
            return [
                'success' => false,
                'payload' => $response->json(),
            ];
        }
    }
}
