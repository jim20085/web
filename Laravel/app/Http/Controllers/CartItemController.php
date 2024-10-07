<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CartItem;

class CartItemController extends Controller
{
    public function store(Request $request)
    {
        // 驗證輸入
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'required|string|max:255',
            'quantity' => 'required|numeric',
            'classification' => 'required|string|max:255',
        ]);

        // 檢查是否有相同名稱和分類的商品
        $existingProduct = CartItem::where('name', $validatedData['name'])
                                    //->where('classification', $validatedData['classification'])
                                    ->first();

        if ($existingProduct) {
            // 如果商品存在，則更新數量
            $existingProduct->quantity += $validatedData['quantity'];
            $existingProduct->save();

            return response()->json([
                'message' => 'Product quantity updated successfully!',
                'product' => $existingProduct
            ], 200);
        } else {
            // 如果商品不存在，則創建新商品
            $product = CartItem::create([
                'name' => $validatedData['name'],
                'price' => $validatedData['price'],
                'image' => $validatedData['image'],
                'quantity' => $validatedData['quantity'],
                'classification' => $validatedData['classification']
            ]);

            return response()->json([
                'message' => 'Product created successfully!',
                'product' => $product
            ], 201);
        }
    }

    public function index()
    {
        return CartItem::all();
    }
    public function updateQuantity(Request $request, $id)
    {
        // 驗證請求數據
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // 查找產品
        $data = CartItem::findOrFail($id);

        // 更新產品數量
        $data->quantity = $validated['quantity'];
        $data->save();

        // 返回更新後的數據
        return response()->json($data);
    }
    public function delete($id)
    {
        $product = CartItem::find($id);
        if($product){
            $product ->delete();
            // 檢查資料表是否為空
            if (CartItem::count() === 0) {
                // 使用 truncate 重置自增主鍵
                CartItem::truncate();
            }
            return response() -> json(['message' => 'successfully'], 200);
        }
        else{
            return response() -> json(['message' => 'product no found'],404);
        }
    }
    

    public function clearCart()
    {
        try {
            // 清空資料表
            DB::table('cart_item')->truncate();

            return response()->json([
                'message' => 'Cart has been cleared successfully!'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to clear the cart',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
