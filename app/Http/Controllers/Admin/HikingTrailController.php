<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\HikingTrail;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

use Illuminate\Http\Request;

class HikingTrailController extends Controller
{
    public function index()
    {
        return view('pages_admin.hiking_trail.index');
    }

    public function datatables(Request $request)
    {
        $datatable = Datatables::of(HikingTrail::all());
        $datatable->addIndexColumn();
        $datatable->addColumn('actions', function ($value) {
            $template = '
            <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Ubah Hiking Trails" class="btn btn-success btn-circle edit-modal" data-table="tableHikingTrail" data-jenis="hikingTrail" data-id="' . $value->id . '"><i class="fa fa-pencil"></i></a>
            <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Hapus Hiking Trails" class="btn btn-danger btn-circle delete-modal" data-table="tableHikingTrail" data-jenis="hikingTrail" data-tbl="tableHikingTrail" data-url="' . route('admin.hiking-trail.crud') . '" data-id="' . $value->id . '"><i class="fa fa-trash"></i></a>
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
                    return HikingTrail::tambah($request);
                    break;
                case 'edit':
                    return HikingTrail::rubah($request);
                    break;
            }
        } else if ($request->isMethod('delete')) {
            return HikingTrail::hapus($request);
        }
    }
}
