<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // 自動遞增的 ID
            $table->string('name'); // 系列名稱
            $table->string('image'); // 圖片檔案名稱或路徑
            $table->string('classification'); // 商品分類
            $table->timestamps(); // created_at 和 updated_at 欄位
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
