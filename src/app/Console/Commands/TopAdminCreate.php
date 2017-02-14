<?php

namespace App\Console\Commands;

use App\Services\AuthService;
use App\User;
use Illuminate\Console\Command;

class TopAdminCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'top:admin:create {email} {password}';

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
     * @param AuthService $authService
     */
    public function handle(AuthService $authService)
    {
        $email = $this->argument('email');
        $password = $this->argument('password');

        $user = User::where('email', $email)->first();

        if ($user instanceof User && !$user->isAdmin()) {
            $this->error('Email is already taken by a normal user!');
            return;
        }

        if (! $user instanceof User) {
            $newAdmin = $authService->createAdmin($email, $password);
            $this->line("Created admin: " . $newAdmin->email);
            return;
        }

        $updatedAdmin = $authService->updateAdmin($email, $password);
        $this->line("Updated admin: " . $updatedAdmin->email);
    }
}
