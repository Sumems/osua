<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use File;

class Product extends Model
{
    use HasFactory;

    public static function tambah($request)
    {
        DB::beginTransaction();
        try {
            $db = new Product();
            $db->name =  $request->name;
            $db->price =  $request->price;
            $db->stock =  $request->stock;
            $db->description =  $request->description;
            $db->save();

            if ($request->hasFile('images')) {
                $productName = $request->name;
                $prefix = strtoupper(substr($productName, 0, 3)); 
    
                foreach ($request->file('images') as $index => $image) {
                    $extension = $image->getClientOriginalExtension();
                    $randomNumber = $index + 1; 
                    $imageName = $prefix . '-' . $randomNumber . '.' . $extension;
                    $imagePath = $image->move(public_path('images/products/'), $imageName);
                    $db->images()->create(['image' => $imageName]);
                }
            }

            // if ($request->hasFile('images')) {
            //     foreach ($request->file('images') as $image) {
            //         $images = $image->getClientOriginalExtension();
            //         $image_name = Str::random(9) . '.' . $images;
            //         $image_path = $image->move(public_path('images/products/'), $image_name);
            //         $db->images()->create(['image' => $image_name]);
            //     }
            // }

            DB::commit();
            $responseData = 'Data berhasil disimpan';
            return response()->json(['message' => $responseData, 'data' => $responseData], 201);
        } catch (\Exception $ex) {
            DB::rollback();
            $responseData = $ex->getMessage();
            return response()->json(['message' => 'failed', 'data' => $responseData], 400);
        }
    }

    public static function rubah($request)
    {
        DB::beginTransaction();
        try {
            $db = Product::find($request->id);
            $db->name =  $request->name;
            $db->price =  $request->price;
            $db->stock =  $request->stock;
            $db->description =  $request->description;
            $db->save();

            if ($request->hasFile('images')) {
                // Ambil semua gambar lama yang terkait dengan produk
                $old_images = ProductImage::where('id_product', '=', $request->id)->get();
                // Buat array untuk menyimpan path gambar yang akan dihapus
                $image_paths = [];
                // Isi array dengan path gambar dari hasil query
                foreach ($old_images as $old) {
                    $image_paths[] = public_path('images/products/' . $old->image);
                }

                // Hapus file gambar dari public path
                File::delete($image_paths);
                $productName = $request->name;
                $prefix = strtoupper(substr($productName, 0, 3)); 
                foreach ($request->file('images') as $index => $image) {                
                    // Hapus semua record gambar terkait dari database
                    ProductImage::whereIn('id', $old_images->pluck('id'))->delete();

                    $extension = $image->getClientOriginalExtension();
                    $randomNumber = $index + 1; 
                    $imageName = $prefix . '-' . $randomNumber . '.' . $extension;
                    $imagePath = $image->move(public_path('images/products/'), $imageName);
                    $db->images()->create(['image' => $imageName]);
                }
            }

            DB::commit();
            $responseData = 'Data berhasil diubah';
            return response()->json(['message' => $responseData, 'data' => $responseData], 201);
        } catch (\Exception $ex) {
            DB::rollback();
            $responseData = $ex->getMessage();
            return response()->json(['message' => 'failed', 'data' => $responseData], 400);
        }
    }

    public static function hapus($request)
    {
        DB::beginTransaction();
        try {
            $db = Product::find($request->id);
            $db->delete();
            DB::commit();
            $responseData = 'Data berhasil dihapus';
            return response()->json(['message' => $responseData, 'data' => $responseData], 201);
        } catch (\Exception $ex) {
            DB::rollback();
            $responseData = $ex->getMessage();
            return response()->json(['message' => 'failed', 'data' => $responseData], 400);
        }
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'id_product');
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class, 'id_product');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class, 'id_product');
    }
}
