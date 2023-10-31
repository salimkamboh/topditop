<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;

use FuzzyWuzzy\Fuzz;
use FuzzyWuzzy\Process;
use App\Manufacturer;

class VisionController extends BaseController
{
    public function index()
    {
        // $this->getCategoryUsingProcess();
        return view('front.vision-index');
    }
    function getCategoryUsingProcess()
    {
        $fuzz = new Fuzz();
        $process = new Process($fuzz);
        $choices = Manufacturer::all()->pluck('name', 'id')->toArray();
        $best_label = "ohlinda bretz";


        $description = "Bretz, Sofa, Ohlinda upholstered group (Corner sofa)";
        $c = $process->extractOne($best_label, $choices, null, [$fuzz, 'tokenSetRatio']);
        $d = $process->extractOne($description, $choices, null, [$fuzz, 'tokenSetRatio']);
        Log::debug("$best_label ::: " . print_r($c, true));
        Log::debug("$description ::: " . print_r($d, true));
        dd($c, $d);
        //        echo("getCategoryUsingProcess looking {$ad->title} score: {$c[1]}  {$c[0]}\n");
        return ($c && $c[1] > 50) ? array_search($c[0], $choices) : 0;
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
        $file = request()->file('image');
        // $file->move(storage_path('app/images'), $filename);
        // $image = Storage::disk('local')->get('images/' . $filename);
        // $image = file_get_contents('images/full_size/brandreferences/557/original.png');
        $image = file_get_contents($file);

        echo "<pre>";
        // // $this->label_detection($imageAnnotator, $image);
        $this->detect_web1($imageAnnotator, $image);
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
     */
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
        $response = $imageAnnotator->webDetection($image);
        $web = $response->getWebDetection();
        // Process the current page of results
        $this->processWebDetectionResults($web);

        $imageAnnotator->close();
    }
}
