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
        // $content = file_get_contents($imagePath);
        // $base64EncodedData = base64_encode($content);
        // $finfo = finfo_open(FILEINFO_MIME_TYPE);
        // $mime = finfo_file($finfo, $imagePath);
        // finfo_close($finfo);
        // $image_name = $imagePath->getClientOriginalName();

        // $dataUrl = "data:$mime;name=" . $image_name . ";base64,$base64EncodedData";
        $data = $this->parameters + ["file_url" => $imagePath]; // "https://topditop.com/images/full_size/image_61e833b645a30.jpg"];
        // print_r($data);exit;
        // Log::debug(print_r($data, true));
        try {
            $response = Curl::to($this->base_url . 'launch_similarity')
                ->withHeaders($this->headers)
                ->withData(json_encode($data))
                // ->withFile(basename($imagePath), $imagePath, $mime, basename($imagePath))
                ->returnResponseObject()
                ->post();
            print_r($response->content);
            Log::debug(print_r($response, true));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $e->getMessage();
        }
    }
}
