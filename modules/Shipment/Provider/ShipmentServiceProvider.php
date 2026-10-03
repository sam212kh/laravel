<?php
namespace Modules\Shipment\Provider;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ShipmentServiceProvider extends ServiceProvider
{

    /**
     * Bootstarp Services.
     */

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->mergeConfigFrom(__DIR__ . '/../config.php', 'shipment');


        Route::middleware('api')
            ->prefix('api')
            ->group(__DIR__ . '/../Routes/api.php');

        Route::middleware('web')
            ->group(__DIR__ . '/../Routes/web.php');
    }

}
