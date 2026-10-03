<?php

use App\Providers\AppServiceProvider;
use Modules\Payment\Provider\PaymentServiceProvider;
use Modules\Order\Providers\OrderServiceProvider;
use \Modules\Product\Provider\ProductServiceProvider;

return [
    AppServiceProvider::class,
    OrderServiceProvider::class,
    PaymentServiceProvider::class,
    ProductServiceProvider::class,
];
