<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use App\Models\Article;
use Str;

class ArticleController extends Controller
{
    public function index()
    {
        return view('pages_admin.article.index');
    }

    public function datatables(Request $request)
    {
        $datatable = Datatables::of(Article::all());
        $datatable->addIndexColumn();
        $datatable->addColumn('actions', function ($value) {
            $template = '
            <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Ubah Article" class="btn btn-success btn-circle edit-modal" data-table="tableArticle" data-jenis="article" data-id="' . $value->id . '"><i class="fa fa-pencil"></i></a>
            <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Hapus Article" class="btn btn-danger btn-circle delete-modal" data-table="tableArticle" data-jenis="article" data-tbl="tableArticle" data-url="' . route('admin.article.crud') . '" data-id="' . $value->id . '"><i class="fa fa-trash"></i></a>
            ';
            return $template;
        });
        // $datatable->editColumn('image', function($value) {
        //     $url = asset('images/articles/'.$value->image);
        //     $img = '<img src="'.$url.'" alt="" class="img-fluid rounded">';
        //     return $img;
        // });
        $datatable->rawColumns(['actions', 'image', 'description']);
        return $datatable->make(true);
    }

    public function crud(Request $request)
    {
        // dd($request->metode);
        if ($request->isMethod('post')) {
            switch ($request->metode) {
                case 'tambah':
                    return Article::tambah($request);
                    break;
                case 'edit':
                    return Article::rubah($request);
                    break;
            }
        } else if ($request->isMethod('delete')) {
            return Article::hapus($request);
        }
    }
}
