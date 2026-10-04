<?php

namespace Modules\Order\Tests;

use Modules\Order\Models\Order;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
    public function test_it_creates_order()
    {
        $order = new Order();
        if( $order ) $this->assertTrue(true);

    }
}
