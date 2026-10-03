<?php

namespace Modules\Product\Provider;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class ProductServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config.php', 'product');
    }

    /**
     * Bootstrap Services.
     */

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');


        # Load API Route (with / api prefix and middleware
        Route::middleware('api')
            ->prefix('api')
            ->group(__DIR__ . '/../Routes/api.php');

        # Load Web Route (with web middleware)
        Route::middleware('web')
            ->group(__DIR__ . '/../Routes/web.php');
    }
}
