<?php

namespace FelipeMateus\IPTVCustomers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use FelipeMateus\IPTVCustomers\Middleware\CustomerMiddleware;
use FelipeMateus\IPTVCore\Class\IPTVProviderBase;
use FelipeMateus\IPTVCustomers\Dashs\Customers;
use FelipeMateus\IPTVCustomers\Dashs\Plans;

class IPTVProvider extends IPTVProviderBase
{


    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerMidleware();
        $this->loadMigrationsFrom(__DIR__.'/database/migrations/');
		$this->loadViewsFrom(__DIR__.'/resources/views', 'IPTV');
		$this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadJSONTranslationsFrom(__DIR__.'/resources/translations');
        $this->loadMenusFrom(__DIR__.'/resources/menu');
        $this->registerDashboard();
    }



    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Register Midleware
     *
     * @return void
     */
    private function registerMidleware(){
        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('client', CustomerMiddleware::class);
    }

    /**
     * Regoster Dashboard card
     *
     * @return void
     */
    private function registerDashboard(){
        $this->loadDashFrom(Customers::class);
        $this->loadDashFrom(Plans::class);
    }


}
