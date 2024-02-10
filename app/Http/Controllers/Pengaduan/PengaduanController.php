<?php

namespace App\Http\Controllers\Pengaduan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengaduan;

class PengaduanController extends Controller
{
    public function index() {
        return view('Pengaduan.index');
    }

    public function getdata(request $req) {
        $limit = $req->length;
        $start = $req->start;
        $page  = $start + 1;

        $dataquery  = Pengaduan::with('getUser');

        $totalData = $dataquery->get()->count();

        $totalFiltered = $dataquery->get()->count();

        $dataquery->limit($limit);
        $data = $dataquery->get();
        foreach ($data as $key => $result) {
            $result->no                = $key + $page;
            $result->code              = $result->code;
            $result->nama              = $result->nama;
            $result->alamat            = $result->tower .'lt.'. $result->total_lantai.'room.'. $result->total_room;
            $result->judul             = $result->judul;
            $result->created_at        = $result->created_at;
            $result->status            = $result->status;
            $result->action            = '
                        <a href="' . route('gedung.dtl', $result->code) . '" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                        <a href="' . route('gedung.edit', $result->code) . '" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                        <a href="#" class="btn btn-sm btn-danger" onclick="deleteData(this, \'' . $result->code . '\')"><i class="fa fa-trash"></i></a>
            ';
        }

        $json_data = array(
            "draw"            => intval($req->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        return json_encode($json_data);
    }
}
