<?php

namespace App\Http\Controllers\Gedung;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gedung;
use Auth;
use DB;

class GedungController extends Controller
{
    public function index() {
        return view('Gedung.index');
    }

    public function getdata(request $req) {
        $limit = $req->length;
        $start = $req->start;
        $page  = $start + 1;

        $dataquery  = Gedung::select("gedung.*");

        $totalData = $dataquery->get()->count();

        $totalFiltered = $dataquery->get()->count();

        $dataquery->limit($limit);
        $data = $dataquery->get();
        foreach ($data as $key => $result) {
            $result->no                = $key + $page;
            $result->code              = $result->code;
            $result->nama              = $result->nama;
            $result->alamat            = $result->tower .'lt.'. $result->total_lantai.'room.'. $result->total_room;
            $result->created_at        = $result->created_at;
            $result->status            = $result->status;
            $result->action            = '<button class="btn btn-sm btn-danger">Hapus</button>';
        }

        $json_data = array(
            "draw"            => intval($req->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        return json_encode($json_data);
    }

    public function add(request $req) {
        try {
            DB::beginTransaction();
            $gedung = new Gedung;
            $gedung->code = $req->code;
            $gedung->nama = $req->nama;
            $gedung->total_lantai = $req->lantai;
            $gedung->total_room = $req->room;
            $gedung->save();
            
            DB::commit();
            $json_data = array(
                "success"         => TRUE,
                "message"         => 'Data berhasil disimpan.'
            );
        } catch (\Throwable $th) {
            DB::rollback();
            $json_data = array(
                "success"         => FALSE,
                "message"         => 'Gagal.'. $th->getMessage()
            );
        }
        return json_encode($json_data);
    }
}
