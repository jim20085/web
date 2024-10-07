<?php

namespace App\Http\Controllers;
use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    
    public function index()
    {
        return Categories::all();
    }
}
//
    
    // 存儲資料
    /*
    public function storeCategories()
    {
        // 定義飲料商品資料
        $categories = [
            ['name'=> '純茶系列', 'image' => '/tea.jpg', 'classification' => 'tea'],
            ['name'=> '鮮奶茶系列', 'image' => '/milktea.jpg', 'classification' => 'milktea'],
            ['name'=> '特製系列', 'image' => '/fruit-tea.jpg', 'classification' => 'fruit-tea'],
            ['name'=> '咖啡系列', 'image' => '/coffee.jpg', 'classification' => 'coffee']
        ];

        // 將商品資料存入資料庫
        foreach ($categories as $category) {
            Categories::create($category);
        }

        return response()->json(['message' => '飲料商品資料已成功存入資料庫']);
    }*/