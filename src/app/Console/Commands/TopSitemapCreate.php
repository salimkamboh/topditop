<?php

namespace App\Console\Commands;

use App\Services\SitemapService;
use Illuminate\Console\Command;

class TopSitemapCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'top:sitemap:create';

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
     * @param SitemapService $sitemapService
     * @return mixed
     */
    public function handle(SitemapService $sitemapService)
    {
        $sitemapService->create();
        $this->line("Sitemap created, visit " . url('sitemap.xml'));
    }
}
