<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Product;

class ProductTest extends TestCase
{
    public function test_calculates_correct_price()
    {
        $product = new Product([
            'price' => 100,
        ]);

        $this->assertEquals(100, $product->price);
    }
}
