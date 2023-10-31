<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;
use Illuminate\Support\Facades\Log;

class RawVisionController extends BaseController
{
    public function curl()
    {
        $apiKey = 'AIzaSyDnh9gEVIyph_6f-6f3l_DlhP3cHXeVpXk';
        $imageData = base64_encode(file_get_contents('images/full_size/brandreferences/557/original.png'));
        $data = [
            'requests' => [
                [
                    'image' => [
                        'content' => $imageData,
                    ],
                    'features' => [
                        [
                            'type' => 'WEB_DETECTION',
                        ],
                    ],
                ],
            ],
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://vision.googleapis.com/v1/images:annotate?key=' . $apiKey);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($response, true);

        // Now, $result contains the response from the Vision API
        print_r($result);
    }
    public function search()
    {
        // Path to your service account JSON key file
        $serviceAccountPath = storage_path('app/cloud-vision-2d3741654c5c.json');

        // Create a new ImageAnnotatorClient with authentication
        $imageAnnotator = new ImageAnnotatorClient([
            'credentials' => $serviceAccountPath,
        ]);
        $image = file_get_contents('images/full_size/brandreferences/557/original.png');
        echo "<pre>";
        $this->detect_web1($imageAnnotator, $image);
        echo "</pre>";
    }
    private function processWebDetectionResults($web)
    {
        // Print best guess labels
        Log::debug(sprintf('%d best guess labels found', count($web->getBestGuessLabels())));
        foreach ($web->getBestGuessLabels() as $label) {
            Log::debug(sprintf('Best guess label: %s', $label->getLabel()));
        }

        // Print pages with matching images
        Log::debug(sprintf(
            '%d pages with matching images found',
            count($web->getPagesWithMatchingImages())
        ));
        foreach ($web->getPagesWithMatchingImages() as $page) {
            Log::debug(sprintf('URL: %s', $page->getUrl()));
        }


        // Print full matching images
        Log::debug(sprintf('%d full matching images found', count($web->getFullMatchingImages())));
        foreach ($web->getFullMatchingImages() as $fullMatchingImage) {
            Log::debug(sprintf('URL: %s', $fullMatchingImage->getUrl()));
        }


        // Print partial matching images
        Log::debug(sprintf(
            '%d partial matching images found',
            count($web->getPartialMatchingImages())
        ));
        foreach ($web->getPartialMatchingImages() as $partialMatchingImage) {
            Log::debug(sprintf('URL: %s', $partialMatchingImage->getUrl()));
        }


        // Print visually similar images
        Log::debug(sprintf(
            '%d visually similar images found',
            count($web->getVisuallySimilarImages())
        ));
        foreach ($web->getVisuallySimilarImages() as $visuallySimilarImage) {
            Log::debug(sprintf('URL: %s', $visuallySimilarImage->getUrl()));
        }


        // Print web entities
        Log::debug(sprintf(
            '%d web entities found',
            count($web->getWebEntities())
        ));
        foreach ($web->getWebEntities() as $entity) {
            Log::debug(sprintf(
                'Description: %s, Score %s',
                $entity->getDescription(),
                $entity->getScore()
            ));
        }
        Log::debug("------------------------------------------------------------");
    }
    private function detect_web1($imageAnnotator, $image)
    {
        $pageSize = 20;
        $pageToken = null;

        do {
            // Make a request with the current page token
            $options = ['pageSize' => $pageSize];
            if ($pageToken) {
                $options['pageToken'] = $pageToken;
            }

            $response = $imageAnnotator->webDetection($image, $options);
            $web = $response->getWebDetection();

            // Process the current page of results
            $this->processWebDetectionResults($web);

            // Get the next page token for the next iteration
            $pageToken = $web->getPageToken();
        } while ($pageToken);
        $imageAnnotator->close();
    }
}
