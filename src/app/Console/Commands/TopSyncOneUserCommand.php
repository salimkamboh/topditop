<?php

namespace App\Console\Commands;

use App\Services\ImportService;
use App\Services\SyncService;
use App\User;
use Illuminate\Console\Command;

class TopSyncOneUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'top:sync:one {idOrEmail}';

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
     * @param SyncService $syncService
     * @return mixed
     */
    public function handle(SyncService $syncService)
    {
        $idOrEmail = $this->argument('idOrEmail');

        $user = null;

        if (is_int($idOrEmail)) {
            $user = User::find($idOrEmail);
        }
        if (is_string($idOrEmail)) {
            $user = User::where('email', '=', $idOrEmail)->first();
        }
        if (! $user instanceof User) {
            $this->error('User not found!');
            return;
        }

        $syncService->syncDashboardFromOrigin($user);
    }
}
