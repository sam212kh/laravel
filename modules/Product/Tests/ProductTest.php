<?php
namespace Modules\Product\Tests;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Product\Models\Product;
use Tests\TestCase;

class ProductTest extends TestCase {

    use RefreshDatabase;

    public function test_it_create_product(): void
    {
        $product = Product::factory()->create();

        $this->assertNotEmpty($product->name);

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => $product->name,
        ]);


    }
}
