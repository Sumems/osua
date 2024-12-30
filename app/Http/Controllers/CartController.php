<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index() {
        $carts = Cart::with('product.images')->where('id_user', \Auth::user()->id)->get();
        return view('pages.keranjang', ['carts' => $carts]);
    }

    public function addToCart(Request $request) {
        $productId = $request->input('product_id');

        $cart = new Cart();
        $cart->id_user = auth()->id();
        $cart->id_product = $productId;
        $cart->save();

        return response()->json(['success' => true]);
    }

    public function remove(Request $request)
    {
        $cartId = $request->input('cart_id');
        
        // Cari wishlist item berdasarkan ID dan hapus
        $cart = Cart::find($cartId);
        if ($cart) {
            $cart->delete();
            return response()->json(['success' => true]);
        }
        
        return response()->json(['success' => false, 'message' => 'Item tidak ditemukan.']);
    }
}
