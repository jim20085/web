<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

     public function up()
     {
         Schema::create('products', function (Blueprint $table) {
             $table->id(); // 自動遞增的 ID
             $table->string('name'); // 商品名稱
             $table->integer('price'); // 價格
             $table->string('image'); // 圖片檔案名稱或路徑
             $table->integer('quantity'); // 商品數量
             $table->string('classification'); // 商品分類
             $table->timestamps(); // created_at 和 updated_at 欄位
         });
     }
     

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
