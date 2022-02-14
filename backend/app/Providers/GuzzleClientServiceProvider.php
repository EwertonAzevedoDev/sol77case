<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\GeocodingService;
use App\Services\BudgetService;

class GuzzleClientServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(GeocodingService::class, function(){
            return new GeocodingService;
        });

        $this->app->bind(BudgetService::class, function(){
            return new BudgetService;
        });
    }
}