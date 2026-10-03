<?php

namespace Modules\Payment\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Payment\Modules\Payment;

class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition() : array
    {
        return [
            'total_in_cents' => random_int(100, 10000),
            'order_id'    => random_int(1,100),
            'user_id'    => random_int(1,10),
            'payment_id'    => random_int(1,10),
            'payment_gateway' => fake()->word(3),
            'status' => true
        ];
    }
}
