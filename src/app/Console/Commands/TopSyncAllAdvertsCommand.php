<?php

namespace App\Console\Commands;

use App\Services\CraftarService;
use Illuminate\Console\Command;

class TopSyncAllAdvertsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'top:sync:adverts';

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
     * @param CraftarService $craftarService
     * @return mixed
     */
    public function handle(CraftarService $craftarService)
    {
        $craftarService->outputEnabled = true;
        $craftarService->syncAll();
    }
}
