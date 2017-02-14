<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class TopAdminList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'top:admin:list';

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
        $users = User::admin()->get();

        if (count($users) == 0) {
            $this->line("There are no users");
            return;
        }
        foreach ($users as $user) {
            $this->line($user->email);
        }
    }
}
