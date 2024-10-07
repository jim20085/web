<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{   
    
    public function index()
    {
        return Product::all();
    }
    // 依據分類取得產品
    public function getProductsById()
    {
        $products = Product::whereIn('id', [5,9,11])->get();        //whereIn 可用來接收多個篩選資料
        return response()->json($products);
    }
}


/*存資料
    public function storeProducts()
    {
        // 定義飲料商品資料
        $products = [
            ['name' => '大吉嶺紅茶', 'price' => 35, 'image' => '/blacktea.jpg', 'quantity' => 1, 'classification' => 'tea'],
            ['name' => '茉莉綠茶', 'price' => 35, 'image' => '/greentea.jpg', 'quantity' => 1, 'classification' => 'tea'],
            ['name' => '凍頂烏龍茶', 'price' => 35, 'image' => '/oolong tea.jpg', 'quantity' => 1, 'classification' => 'tea'],
            ['name' => '鐵觀音', 'price' => 35, 'image' => '/tieguanyin.jpg', 'quantity' => 1, 'classification' => 'tea'],
            ['name' => '奶茶', 'price' => 50, 'image' => '/milktea.jpg', 'quantity' => 1, 'classification' => 'milktea'],
            ['name' => '奶綠', 'price' => 50, 'image' => '/greenmilk.jpg', 'quantity' => 1, 'classification' => 'milktea'],
            ['name' => '烏龍拿鐵', 'price' => 60, 'image' => '/oolongmilk.jpg', 'quantity' => 1, 'classification' => 'milktea'],
            ['name' => '紅茶拿鐵', 'price' => 60, 'image' => '/blackmilk.jpg', 'quantity' => 1, 'classification' => 'milktea'],
            ['name' => '綜合果汁', 'price' => 65, 'image' => '/fruittea.jpg', 'quantity' => 1, 'classification' => 'fruit-tea'],
            ['name' => '多多綠茶', 'price' => 45, 'image' => '/greenmilk.jpg', 'quantity' => 1, 'classification' => 'fruit-tea'],
            ['name' => '美式咖啡', 'price' => 65, 'image' => '/coffee.jpg', 'quantity' => 1, 'classification' => 'coffee'],
            ['name' => '拿鐵咖啡', 'price' => 75, 'image' => '/latte.jpg', 'quantity' => 1, 'classification' => 'coffee'],
            ['name' => '卡布奇諾', 'price' => 75, 'image' => '/cabuchno.jpg', 'quantity' => 1, 'classification' => 'coffee'],
            ['name' => '焦糖瑪奇朵', 'price' => 75, 'image' => '/machudu.jpg', 'quantity' => 1, 'classification' => 'coffee'],
            ['name' => '摩卡咖啡', 'price' => 70, 'image' => '/moca.jpg', 'quantity' => 1, 'classification' => 'coffee']
        ];

        // 將商品資料存入資料庫
        foreach ($products as $product) {
            Product::create($product);
        }

        return response()->json(['message' => '飲料商品資料已成功存入資料庫']);
    }
    */