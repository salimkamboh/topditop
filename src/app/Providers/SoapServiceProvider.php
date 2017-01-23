<?php

namespace App\Providers;

use App\Helpers\MagentoService;
use Illuminate\Support\ServiceProvider;

class SoapServiceProvider extends ServiceProvider
{
    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Helpers\Contracts\MagentoActionsContract', function(){
            return new MagentoService();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['App\Helpers\Contracts\MagentoActionsContract'];
    }
}
