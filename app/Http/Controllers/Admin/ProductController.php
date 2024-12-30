<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

// Define Models
use App\Models\Product;
use Str;

class ProductController extends Controller
{
    public function index()
    {
        return view('pages_admin.product.index');
    }

    public function datatables(Request $request)
    {
        $datatable = Datatables::of(Product::all());
        $datatable->addIndexColumn();
        $datatable->addColumn('actions', function ($value) {
            $template = '
            <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Ubah Product" class="btn btn-success btn-circle edit-modal" data-table="tableProduct" data-jenis="product" data-id="' . $value->id . '"><i class="fa fa-pencil"></i></a>
            <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Hapus Product" class="btn btn-danger btn-circle delete-modal" data-table="tableProduct" data-jenis="product" data-tbl="tableProduct" data-url="' . route('admin.product.crud') . '" data-id="' . $value->id . '"><i class="fa fa-trash"></i></a>
            ';
            return $template;
        });
        $datatable->rawColumns(['actions', 'description']);
        return $datatable->make(true);
    }

    public function crud(Request $request)
    {
        // dd($request->metode);
        if ($request->isMethod('post')) {
            switch ($request->metode) {
                case 'tambah':
                    return Product::tambah($request);
                    break;
                case 'edit':
                    return Product::rubah($request);
                    break;
            }
        } else if ($request->isMethod('delete')) {
            return Product::hapus($request);
        }
    }
}
