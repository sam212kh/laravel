<?php

namespace Modules\Order\Http\Controllers;

use Modules\Order\Http\Requests\CheckoutRequest;
use Modules\Payment\PayBuddy;
use Modules\Product\Modules\Product;
use mysql_xdevapi\Collection;

class CheckoutController
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke(CheckoutRequest $request)
    {
        dd( $request->all(), 'ok' );
        $products = array_map(function (array $productDetails) {
            return [
                'product' => Product::find($productDetails['id']),
                'quantity' => $productDetails['quantity'],
            ];
        }, $request->input('products'));


        dd($products);

        $paybuddy = PayBuddy::make();
    }

}
