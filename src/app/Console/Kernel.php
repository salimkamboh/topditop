<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // Commands\Inspire::class,
        Commands\TopAdminList::class,
        Commands\TopAdminCreate::class,
        Commands\TopSitemapCreate::class,
        Commands\TopImportUsersCommand::class,
        Commands\TopGeocodeExistingLocationsCommand::class,
        Commands\TopExportUsersForNewsletterCommand::class,
        Commands\TopSyncOneUserCommand::class,
        Commands\TopSyncUsersCommand::class,
        Commands\TopSyncOneAdvertCommand::class,
        Commands\TopSyncAllAdvertsCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
    }
}
