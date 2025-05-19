<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // カートに商品を追加
    public function add(Product $product)
    {
        Cart::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
        ]);

        return redirect()->route('cart.index')->with('success', 'カートに追加しました');
    }

    // カート表示
    public function index()
    {
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
        $totalPrice = $cartItems->sum(fn($item) => $item->product->price);

        return view('user.cart.index', compact('cartItems', 'totalPrice'));
    }

    public function remove(Cart $cart)
    {
        if ($cart->user_id === Auth::id()) {
            $cart->delete();
        }

        return redirect()->route('cart.index')->with('success', '商品をカートから削除しました');
    }
}

