<?php
namespace Modules\Payment\Tests;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Payment\Database\Factories\PaymentFactory;
use Tests\TestCase;
use Modules\Payment\Modules\Payment;

class PaymentTest extends TestCase
{

    //use RefreshDatabase;
    use DatabaseMigrations;

    public function test_id_create_payments()
    {
        $payment = PaymentFactory::new()->create();

        $this->assertNotEmpty($payment->status);

        $this->assertDatabaseHas('payments', [
            'id' => $payment->id,
            'status' => $payment->status,
        ]);

    }
}
