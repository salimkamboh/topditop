<?php

namespace App\Console\Commands;

use App\Services\EdenService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\GuessImage;

class EdenAIUpload extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'edenai:upload';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Upload images to eden ai';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $service = new EdenService();
        // $resp = $service->deleteImage("image_6532581d8f5e6.jpg");
        // $resp = $service->deleteImage("test_12.jpg");

        // $resp = $service->listImages();
        $json = json_decode(file_get_contents(storage_path('app/eden_images_list.json'), true));
        $images = array_column($json, 'image_name');
        $this->info("Images already uploaded: " . count($images));
        // exit;
        $adverts = GuessImage::select('id', 'reference_image_url')->inRandomOrder()->take(1000)->get();
        foreach ($adverts as $advert) {
            $basename = basename($advert->reference_image_url);
            if (in_array($basename, $images)) {
                $this->info("Skipping $basename; already uploaded");
                continue;
            }
            $image_url = "https://topditop.com/images/full_size/" . $basename;
            $resp = $service->uploadImage($image_url);
            if ($resp) {
                $json[] = ["image_name" => basename($image_url)];
            }
        }
        // echo json_encode($json);
        Storage::put('eden_images_list.json', json_encode($json));
    }
}
