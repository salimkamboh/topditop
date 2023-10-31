<?php

namespace App\Console\Commands;

use App\GuessImage;
use App\Services\SyncService;
use App\User;
use Illuminate\Console\Command;

use Illuminate\Support\Facades\Storage;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;

use FuzzyWuzzy\Fuzz;
use FuzzyWuzzy\Process;
use App\Manufacturer;

class GuessBrands extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'guess:brands';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Path to your service account JSON key file
        $serviceAccountPath = storage_path('app/cloud-vision-2d3741654c5c.json');

        // Create a new ImageAnnotatorClient with authentication
        $imageAnnotator = new ImageAnnotatorClient([
            'credentials' => $serviceAccountPath,
        ]);
        $adverts = GuessImage::where('m_id', null)->inRandomOrder()->take(10)->get();
        foreach ($adverts as $advert) {
            echo "trying $advert->reference_image_url\n";
            $image = file_get_contents(base_path('images/' . $advert->reference_image_url));
            // $response = $imageAnnotator->logoDetection($image);
            // $my_logos = [];
            // $logos = $response->getLogoAnnotations();
            // foreach ($logos as $logo) {
            //     $my_logos[] = $logo->getDescription();
            // }
            // print_r($my_logos);
            // $response = $imageAnnotator->textDetection($image);
            // $texts = $response->getTextAnnotations();
            // $test_labels = [];
            // foreach ($texts as $text) {
            //     $test_labels[] = $text->getDescription();
            //     // echo $text->getDescription() . PHP_EOL;
            // }
            // echo $this->guessMe(implode(" ", $test_labels));
            // exit;

            $response = $imageAnnotator->webDetection($image);
            $web = $response->getWebDetection();
            // Process the current page of results
            $results = $this->processWebDetectionResults($web);
            if (isset($results['labels'][0])) {
                $guess = $this->guessMe($advert, $results['labels'][0], $results);
                if ($guess != 0) {
                    continue;
                }
            }
            if (count($results['entities']) > 0) {
                foreach ($results['entities'] as $entity) {
                    $guess = $this->guessMe($advert, $entity['description'], $results);
                    if ($guess != 0) {
                        break 2; // break the forreach loop for entities
                    }
                }
            }
            Log::debug("No match found for $advert->reference_image_url");
        }
        $imageAnnotator->close();
    }

    private function guessMe($advert, $label, $results)
    {
        $fuzz = new Fuzz();
        $process = new Process($fuzz);
        $choices = Manufacturer::all()->pluck('name', 'id')->toArray();
        $c = $process->extractOne($label, $choices, null, [$fuzz, 'tokenSetRatio']);
        Log::debug("$label ::: " . print_r($c, true));
        //        echo("getCategoryUsingProcess looking {$ad->title} score: {$c[1]}  {$c[0]}\n");
        $guess = ($c && $c[1] > 50) ? array_search($c[0], $choices) : 0;
        if ($guess != 0) {
            $this->info("Found match $guess for $label");
            Log::info("Found match $guess for $label");
            $advert->m_id = $guess;
            $advert->details = $results;
            $advert->save();
        }
        return $guess;
    }
    private function processWebDetectionResults($web)
    {
        $labels = [];
        $pages = [];
        $entities = [];
        // Print best guess labels
        Log::debug(sprintf('%d best guess labels found', count($web->getBestGuessLabels())));
        foreach ($web->getBestGuessLabels() as $label) {
            $labels[] = $label->getLabel();
            Log::debug(sprintf('Best guess label: %s', $label->getLabel()));
        }

        // Print pages with matching images
        Log::debug(sprintf(
            '%d pages with matching images found',
            count($web->getPagesWithMatchingImages())
        ));
        foreach ($web->getPagesWithMatchingImages() as $page) {
            $pages[] = $page->getUrl();
            Log::debug(sprintf('URL: %s', $page->getUrl()));
        }

        // Print web entities
        Log::debug(sprintf(
            '%d web entities found',
            count($web->getWebEntities())
        ));
        foreach ($web->getWebEntities() as $entity) {
            $entities[] = ['description' => $entity->getDescription(), 'score' => $entity->getScore()];
            Log::debug(sprintf(
                'Description: %s, Score %s',
                $entity->getDescription(),
                $entity->getScore()
            ));
        }
        Log::debug("------------------------------------------------------------");
        return compact('labels', 'pages', 'entities');
    }
}
