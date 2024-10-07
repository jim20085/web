<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'image', 'quantity', 'classification'];

    // 一個產品可以有多個購物車項目
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}