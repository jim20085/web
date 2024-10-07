<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;

class ProductTest extends TestCase
{
    use RefreshDatabase; // 每次測試後刷新數據庫

    public function test_can_retrieve_products()
    {
        // 創建一個假產品
        Product::factory()->create([
            'name' => '測試產品',
            'price' => 100,
        ]);

        // 發送 GET 請求到產品 API
        $response = $this->get('/api/products');

        // 斷言請求成功並檢查回應數據
        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => '測試產品']);
    }

    public function test_can_create_product()
    {
        $productData = [
            'name' => '新產品',
            'price' => 150,
        ];

        // 發送 POST 請求創建新產品
        $response = $this->postJson('/api/products', $productData);

        // 斷言請求成功並檢查數據庫中是否存在這個產品
        $response->assertStatus(201);
        $this->assertDatabaseHas('products', $productData);
    }
}
