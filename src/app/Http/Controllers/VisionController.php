<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;

use App\BrandReference;
use App\Manufacturer;
use App\Product;
use App\Reference;
use App\Slide;

class VisionController extends BaseController
{
    public function index()
    {
        return view('front.vision-index');
    }
    public function search()
    {
        // Path to your service account JSON key file
        $serviceAccountPath = storage_path('app/cloud-vision-2d3741654c5c.json');

        // Create a new ImageAnnotatorClient with authentication
        $imageAnnotator = new ImageAnnotatorClient([
            'credentials' => $serviceAccountPath,
        ]);

        // // Detect labels in the image
        // $image = Storage::disk('local')->get('images/image-2023-10-25-16-35-00.jpg'); //999/original.png');
        // Get the uploaded file
        // $filename = 'image-' . date('Y-m-d-H-i-s') . '.jpg';
        // // Get the contents of the file
        // $file = request()->file('image');
        // $file->move(storage_path('app/images'), $filename);
        // $image = Storage::disk('local')->get('images/' . $filename);

        $image = file_get_contents('images/full_size/brandreferences/557/original.png');
        echo "<pre>";
        // // $this->label_detection($imageAnnotator, $image);
        $this->detect_web($imageAnnotator, $image);
        echo "</pre>";
        // // Close the ImageAnnotatorClient
        // $imageAnnotator->close();

        // Return the result of your search
        // $contents = Storage::disk('local')->get('cloud-vision-2d3741654c5c.json');
        // $vision = new VisionClient(['keyFile' => json_decode($contents, true)]);
        // // $photo = fopen(Storage::disk('local')->path('images/999/original.png'), 'r');
        // $photo = fopen(storage_path('app/images/shop-20.jpg'), 'r'); //999/original.png'), 'r');
        // $image = $vision->image($photo, ['WEB_DETECTION']); //, 'LANDMARK_DETECTION']);
        // $result = $vision->annotate($image);
        // print_r($result->webDetection);
        // echo json_encode($result->info);
    }
    public function web_detection($imageAnnotator, $image)
    {
        $response = $imageAnnotator->webDetection($image);
        $labels = $response->getWebAnnotations();

        // Process the labels (objects detected in the image)
        foreach ($labels as $label) {
            $objectDescription = $label->getDescription();
            print_r($objectDescription);
            echo "<br>";
            // Process $objectDescription (e.g., search in your ads collection)
        }
    }
    public function label_detection($imageAnnotator, $image)
    {
        $response = $imageAnnotator->labelDetection($image);
        $labels = $response->getLabelAnnotations();

        // Process the labels (objects detected in the image)
        foreach ($labels as $label) {
            $objectDescription = $label->getDescription();
            print_r($objectDescription);
            echo "<br>";
            // Process $objectDescription (e.g., search in your ads collection)
        }
    }
    /**$response = $imageAnnotator->webDetection($image, ['pageSize' => $pageSize]);
$web = $response->getWebDetection();

// Process the first page of results
processWebDetectionResults($web);

// Check if there are more results and fetch them using pagination
while ($web->getNextPageToken()) {
    $response = $imageAnnotator->webDetection($image, ['pageToken' => $web->getNextPageToken(), 'pageSize' => $pageSize]);
    $web = $response->getWebDetection();
    processWebDetectionResults($web);
}

// Function to process web detection results
function processWebDetectionResults($web) {
    // Process the results (e.g., printing URLs, entities, etc.)
    // ...
}
     * @param string $path Path to the image, e.g. "path/to/your/image.jpg"
     */
    function detect_web($imageAnnotator, $image)
    {
        $response = $imageAnnotator->webDetection($image, ['pageSize' => 20]);
        $web = $response->getWebDetection();

        // Print best guess labels
        printf(
            '%d best guess labels found' . PHP_EOL,
            count($web->getBestGuessLabels())
        );
        foreach ($web->getBestGuessLabels() as $label) {
            printf('Best guess label: %s' . PHP_EOL, $label->getLabel());
        }
        print(PHP_EOL);

        // Print pages with matching images
        printf(
            '%d pages with matching images found' . PHP_EOL,
            count($web->getPagesWithMatchingImages())
        );
        foreach ($web->getPagesWithMatchingImages() as $page) {
            printf('URL: %s' . PHP_EOL, $page->getUrl());
        }
        print(PHP_EOL);

        // Print full matching images
        printf(
            '%d full matching images found' . PHP_EOL,
            count($web->getFullMatchingImages())
        );
        foreach ($web->getFullMatchingImages() as $fullMatchingImage) {
            printf('URL: %s' . PHP_EOL, $fullMatchingImage->getUrl());
        }
        print(PHP_EOL);

        // Print partial matching images
        printf(
            '%d partial matching images found' . PHP_EOL,
            count($web->getPartialMatchingImages())
        );
        foreach ($web->getPartialMatchingImages() as $partialMatchingImage) {
            printf('URL: %s' . PHP_EOL, $partialMatchingImage->getUrl());
        }
        print(PHP_EOL);

        // Print visually similar images
        printf(
            '%d visually similar images found' . PHP_EOL,
            count($web->getVisuallySimilarImages())
        );
        foreach ($web->getVisuallySimilarImages() as $visuallySimilarImage) {
            printf('URL: %s' . PHP_EOL, $visuallySimilarImage->getUrl());
        }
        print(PHP_EOL);

        // Print web entities
        printf(
            '%d web entities found' . PHP_EOL,
            count($web->getWebEntities())
        );
        foreach ($web->getWebEntities() as $entity) {
            printf(
                'Description: %s, Score %s' . PHP_EOL,
                $entity->getDescription(),
                $entity->getScore()
            );
        }

        $imageAnnotator->close();
    }
}
