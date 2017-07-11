<?php

namespace App\Services;

use App\Origin;
use Illuminate\Support\Facades\Storage;
use League\Csv\Writer;

class ExportService
{

    /**
     * @var string
     */
    private $defaultPath = 'storage/export/';

    /**
     * @var Writer
     */
    private $writer;


    public function __construct()
    {
        $this->ensureDirectoryExists();
        $filename = date('Y_m_d_His') . '_newsletter.csv';
        $this->writer = Writer::createFromPath($this->defaultPath . $filename, 'w');
    }

    /**
     * Exports imported users from by combining Origin and User data CSV
     */
    public function exportForNewsletter()
    {
        $origins = Origin::with('user.store')->get();

        $rows = [];

        foreach ($origins as $origin) {
            if ($origin instanceof Origin) {
                $row = [];

                $row [] = $origin->title;
                $row [] = $origin->last_name;
                $row [] = $origin->user->email;
                $row [] = route('front_show_store', $origin->user->store->id);
                $row [] = $origin->user->email;
                $row [] = 'topditop';

                $rows [] = $row;
            }
        }

        $this->writer->insertOne([
            'salutation',
            'last_name',
            'email',
            'link_to_profile',
            'username',
            'password',
        ]);

        $this->writer->insertAll($rows);
    }

    /**
     * Make sure storage/exports directory exists
     */
    private function ensureDirectoryExists()
    {
        Storage::disk('storage')->makeDirectory('export');
    }
}