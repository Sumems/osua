<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HikingTrail extends Model
{
    use HasFactory;

    public static function tambah($request)
    {
        DB::beginTransaction();
        try {
            $db = new HikingTrail();
            $db->name = $request->name;
            $db->longitude = $request->longitude;
            $db->latitude = $request->latitude;
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
            $db = HikingTrail::find($request->id);
            $db->name = $request->name;
            $db->longitude = $request->longitude;
            $db->latitude = $request->latitude;
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
            $db = HikingTrail::find($request->id);
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
