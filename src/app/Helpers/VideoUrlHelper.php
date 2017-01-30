<?php

namespace App\Helpers;
use Symfony\Component\DomCrawler\Crawler;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;


class VideoUrlHelper
{
    public static function parse($url) {
        $oembedUrl = VideoUrlHelper::getOmbedUrl($url);

        return VideoUrlHelper::getEmbedHtml($oembedUrl);
    }

    public static function getEmbedHtml($oembedUrl) {
        $client = new Client();

        try {
            $response = $client->get($oembedUrl);

            $data = json_decode($response->getBody());

            return $data->html;
        }
        catch(\Exception $e) {}
    }

    public static function getOmbedUrl($url) {
        $client = new Client();

        try {
            $response = $client->get($url);

            $crawler = new Crawler($response->getBody()->getContents());

            $oembedNode = $crawler->filter('link[type="application/json+oembed"]')->first();

            return $oembedNode->attr('href');
        }
        catch(\Exception $e) {}
    }
}