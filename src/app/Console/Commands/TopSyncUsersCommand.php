<?php

namespace App\Console\Commands;

use App\Services\SyncService;
use App\User;
use Illuminate\Console\Command;

class TopSyncUsersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'top:sync:users {from} {to}';

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
        $fromId = (int) $this->argument('from');
        $toId = (int) $this->argument('to');

        if ($fromId < 1) {
            $this->error('User id must be positive integer');
            return;
        }

        $users = User::where('created_at', '<', 'updated_at')
            ->where('id', '>=', $fromId)
            ->where('id', '<=', $toId)
            ->where('confirmed', true)
            ->get();

        $count = count($users);

        if ($count == 0) {
            $this->warn("There are no users with id starting at $fromId");
            return;
        }

        $this->info("Starting to sync $count users from id $fromId ");

        $syncService->syncMany($users);
    }
}
