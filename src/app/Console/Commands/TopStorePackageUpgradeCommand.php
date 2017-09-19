<?php

namespace App\Console\Commands;

use App\Package;
use App\Services\PackageService;
use App\Store;
use Illuminate\Console\Command;

class TopStorePackageUpgradeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'top:store:package:upgrade {store_id_or_email} {package_name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Upgrade a light store into a payed package';

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
     * @param PackageService $packageService
     * @return mixed
     */
    public function handle(PackageService $packageService)
    {
        $packageName = strtolower($this->argument('package_name'));

        $package = null;

        switch ($packageName) {
            case 'topditop':
                $package = Package::HIGHEST;
                break;
            case 'topstore':
                $package = Package::MIDDLE;
                break;
            case 'store':
                $package = Package::LOWEST;
                break;
            default:
                $this->error("Package must be one of these: topditop, topstore or store !");
                return;
        }

        $package = Package::where('name', $package)->firstOrfail();

        $storeIdOrEmail = $this->argument('store_id_or_email');

        $store = Store::where('id', $storeIdOrEmail)->orWhere('user_email', $storeIdOrEmail)->firstOrFail();

        $this->info("Updating Store $store->id by $store->user_email");

        $store = $packageService->upgrade($store, $package);

        $this->info("Complete! Store $store->id by $store->user_email is now " . $store->package_name() . "!");
    }
}
