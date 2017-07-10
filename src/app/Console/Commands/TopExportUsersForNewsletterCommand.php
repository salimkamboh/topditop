<?php

namespace App\Console\Commands;

use App\Services\ExportService;
use Illuminate\Console\Command;

class TopExportUsersForNewsletterCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'top:newsletter:csv';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export imported users as csv for newsletter';

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
     * @param ExportService $exportService
     * @return mixed
     */
    public function handle(ExportService $exportService)
    {
        $exportService->exportForNewsletter();
    }
}
