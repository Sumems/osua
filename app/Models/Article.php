<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Str;
use File;

class Article extends Model
{
    use HasFactory;

    public static function tambah($request)
    {
        DB::beginTransaction();
        try {
            $db = new Article();
            $db->title =  $request->title;
            if ($request->file('image')) {
                $myimage = $request->file('image')->getClientOriginalExtension();
                $image_name = Str::random(9) . '.' . $myimage;
                $image_path = $request->file('image')->move(public_path('images/articles/'), $image_name);
                $db->image =  $image_name;
            }
            $db->user_create = \Auth::user()->name;
            $db->description =  $request->description;
            $db->save();

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
            $db = Article::find($request->id);
            $db->title =  $request->title;
            if ($request->file('image')) {
                File::delete(public_path('images/articles/' . $db->image));
                $myimage = $request->file('image')->getClientOriginalExtension();
                $image_name = Str::random(9) . '.' . $myimage;
                $image_path = $request->file('image')->move(public_path('images/articles/'), $image_name);
                $db->image =  $image_name;
            }
            $db->description =  $request->description;
            $db->user_create = \Auth::user()->name;
            $db->save();

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
            $db = Article::find($request->id);
            File::delete(public_path('images/career/' . $db->image));
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
}
