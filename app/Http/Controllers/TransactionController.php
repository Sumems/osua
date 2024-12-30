<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Product;
use DB;

class TransactionController extends Controller
{
    public function checkoutSingle(Request $request)
    {
        // dd($request->all());
        // Cari produk berdasarkan ID
        $product = Product::find($request->product_id);
        // Validasi jika jumlah pesanan melebihi stok produk
        if ($request->quantity > $product->stock) {
            return response()->json(['error' => 'Jumlah pesanan melebihi stok produk'], 400);
        }

        // Buat transaksi baru jika validasi berhasil
        $transaction = new Transaction();
        $transaction->id_product = $request->product_id;
        $transaction->id_user = auth()->id();
        $transaction->qty = $request->quantity;
        $transaction->total_price = $product->price * $request->quantity;
        $transaction->status = $request->status;
        $transaction->address = $request->address;
        $transaction->telephone = $request->telephone;
        $transaction->note = $request->note;
        $transaction->status = 'Sedang Diproses';
        $transaction->payment_method = $request->payment_method;
        $transaction->save();

        return response()->json(['success' => true]);
    }

    public function checkoutArray(Request $request)
    {
        // Validasi request
        $request->validate([
            'address' => 'required|string',
            'telephone' => 'required|string',
            'note' => 'required|string',
            'selected_carts' => 'required|string',
            'qty_prod' => 'required|string',
            'total_price' => 'required|numeric',
        ]);

        $selected_carts = explode(',', $request->input('selected_carts'));
        $quantities = explode(',', $request->input('qty_prod'));

        // Pastikan jumlah cart dan quantity sama
        if (count($selected_carts) !== count($quantities)) {
            return response()->json(['error' => 'Invalid cart and quantity data'], 400);
        }

        DB::beginTransaction();

        try {
            foreach ($selected_carts as $index => $cartId) {
                $cart = Cart::find($cartId);

                if (!$cart) {
                    throw new \Exception("Cart not found: {$cartId}");
                }

                $quantity = (int) $quantities[$index];
                $product = $cart->product;

                // Validasi stok produk
                if ($quantity > $product->stock) {
                    throw new \Exception("Quantity exceeds stock for product: {$product->name}");
                }

                $transaction = new Transaction();
                $transaction->id_product = $product->id;
                $transaction->id_user = auth()->id();
                $transaction->qty = $quantity;
                $transaction->total_price = $product->price * $quantity;
                $transaction->status = 'Pesanan Baru';
                $transaction->address = $request->input('address');
                $transaction->telephone = $request->input('telephone');
                $transaction->note = $request->input('note');
                $transaction->save();

                // Kurangi stok produk
                $product->stock -= $quantity;
                $product->save();
            }
            $db = DB::table('carts')->whereIn('id', $selected_carts)->delete();

            DB::commit();

            return response()->json(['success' => 'Checkout completed successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
