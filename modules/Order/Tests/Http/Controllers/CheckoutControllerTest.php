<?php

namespace Modules\Order\Tests\Http\Controllers;


use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Routing\Route;
use Modules\Order\Modules\Order;
use Modules\Order\Tests\OrderTestCase;
use Modules\Payment\PayBuddy;
use Modules\Product\Database\Factories\ProductFactory;
use PHPUnit\Framework\Constraint\StringEqualsStringIgnoringLineEndings;
use PHPUnit\Framework\Attributes\Test;

class CheckoutControllerTest extends OrderTestCase
{
    use RefreshDatabase;
    public function test_it_runs_checkout_controller(): void
    {
        $product = ProductFactory::new()->create();

        $this->post(route('order::checkout'), [
            [
                'id' => $product->id,
                'quantity' => 1,
            ],
        ]);
    }

   #[Test]
   public function it_successfully_creates_an_order()
   {



      $user = UserFactory::new()->create();

       $products = ProductFactory::new()->count(2)->create(
         new Sequence(
            ['name' => 'Very expensive air fryer', 'price_in_cents' => 10000, 'stock' => 10],
            ['name' => 'Macbook Pro M3', 'price_in_cents' => 50000, 'stock' => 10]
         )
      );

      $paymentToken = PayBuddy::validToken();


      $response = $this->actingAs($user)
          ->post(route('order::checkout'), [
              'payment_token' => PayBuddy::validToken(),

              'products' => [
                  [
                      'id' => $products[0]->id,
                      'quantity' => 1,
                  ],
                  [
                      'id' => $products[1]->id,
                      'quantity' => 3,
                  ],
              ],
          ]);

      $response->assertStatus(201);

      $order = Order::query()->latest('id')->first();


       // Order
       $this->assertTrue($order->user->is($user));
       $this->assertEquals(60000, $order->total_in_cents);
       $this->assertEquals('paid', $order->status);
       $this->assertEquals('PayBuddy', $order->payment_gateway);
       $this->assertEquals(36, strlen($order->payment_id));

       // Order Lines
       $this->assertCount(2, $order->lines);

       foreach ($products as $product) {
           $orderLine = $order->lines->where('product_id', $product->id)->first();

           $this->assertEquals($product->price_in_cents, $orderLine->product_price_in_cents);
           $this->assertEquals(1, $orderLine->quantity);
       }
   }

}
