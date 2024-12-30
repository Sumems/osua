<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Wishlist;

class WishlistController extends Controller
{
    public function index() {
        $wishlists = Wishlist::with('product.images')->where('id_user', \Auth::user()->id)->get();
        return view('pages.wishlist', ['wishlists' => $wishlists]);
    }

    public function addToWishlist(Request $request) {
        $productId = $request->input('product_id');

        // Logic to add product to wishlist
        // Example: Saving to database
        $wishlist = new Wishlist();
        $wishlist->id_user = auth()->id(); // You may adjust how you identify the user
        $wishlist->id_product = $productId;
        $wishlist->save();

        return response()->json(['success' => true]);
    }

    public function remove(Request $request)
    {
        $wishlistId = $request->input('wishlist_id');
        
        // Cari wishlist item berdasarkan ID dan hapus
        $wishlist = Wishlist::find($wishlistId);
        if ($wishlist) {
            $wishlist->delete();
            return response()->json(['success' => true]);
        }
        
        return response()->json(['success' => false, 'message' => 'Item tidak ditemukan.']);
    }

}
