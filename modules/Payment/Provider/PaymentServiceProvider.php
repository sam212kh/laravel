<?php
namespace Modules\Payment\Provider;


use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;


class PaymentServiceProvider extends ServiceProvider {

    /**
     * Bootstarp Services.
     */

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->mergeConfigFrom(__DIR__ . '/../config.php', 'peyment');


        Route::middleware('api')
            ->prefix('api')
            ->group(__DIR__ . '/../Routes/api.php');

        Route::middleware('web')
            ->group(__DIR__ . '/../Routes/web.php');
    }
}
