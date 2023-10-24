<?php

namespace App\Http\Controllers;

use App\BrandReference;
use App\Manufacturer;
use App\Product;
use App\Reference;
use App\Slide;
use Illuminate\View\View;
use Google\Cloud\Vision\VisionClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;


class HomeController extends BaseController
{
    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return View
     */
    public function contactPage()
    {
        return view('front.pages.contact');
    }

    /**
     * @return View
     */
    public function termsPage()
    {
        return view('front.pages.terms');
    }

    /**
     * @return View
     */
    public function privacyPage()
    {
        return view('front.pages.privacy');
    }

    /**
     * @return View
     */
    public function impressumPage()
    {
        return view('front.pages.impressum');
    }

    /**
     * @return View
     */
    public function homepage()
    {
        $references_newest = Reference::active()->limit(6)->offset(0)->orderBy('id', 'desc')->get();
        $references_most = Reference::active()->limit(6)->offset(0)->orderBy('views', 'desc')->get();

        $products_most = Product::limit(6)->offset(0)->orderBy('views', 'desc')->get();
        $products_newest = Product::where('store_id', '!=', null)->where('manufacturer_id', '!=', null)->limit(6)->offset(0)->orderBy('id', 'desc')->get();

        $manufacturers = Manufacturer::where('featured', 1)->limit(6)->get();
        $brandreferences = BrandReference::inRandomOrder()->take(12)->get();

        $slides = Slide::all();
        return view('front.index')
            ->with('references_most', $references_most)
            ->with('references_newest', $references_newest)
            ->with('products_newest', $products_newest)
            ->with('products_most', $products_most)
            ->with('manufacturers', $manufacturers)
            ->with('brandreferences', $brandreferences)
            ->with('slides', $slides);
    }

    public function advertisementPage()
    {
        return view('front.pages.advertisement');
    }
    public function vision()
    {
        // Path to your service account JSON key file
        $serviceAccountPath = storage_path('app/cloud-vision-2d3741654c5c.json');

        // Create a new ImageAnnotatorClient with authentication
        $imageAnnotator = new ImageAnnotatorClient([
            'credentials' => $serviceAccountPath,
        ]);

        // // Detect labels in the image
        $image = Storage::disk('local')->get('images/shop-20.jpg'); //999/original.png');

        // // $this->label_detection($imageAnnotator, $image);
        $this->detect_web($imageAnnotator, $image);

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
    /**
     * @param string $path Path to the image, e.g. "path/to/your/image.jpg"
     */
    function detect_web($imageAnnotator, $image)
    {
        $response = $imageAnnotator->webDetection($image);
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
