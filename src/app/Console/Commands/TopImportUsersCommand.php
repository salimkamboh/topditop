<?php

namespace App\Console\Commands;

use App\Services\ImportService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class TopImportUsersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'top:import:users {filename}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import users from csv in src/storage/import/';

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
     * @param ImportService $importService
     * @return void
     */
    public function handle(ImportService $importService)
    {
        $filename = $this->argument('filename');

        $exists = Storage::disk('storage')->exists("import/$filename");

        if (!$exists) {
            $this->error("File $filename does not exists");
            return;
        }

        $importService->import($filename);

        $valid = count($importService->getValid());
        $invalid = count($importService->getInvalid());
        $total = count($importService->importData);

        $this->comment("Valid: $valid, Invalid: $invalid, Total: $total");
    }
}
