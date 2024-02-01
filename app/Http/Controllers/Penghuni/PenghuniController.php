<?php

namespace App\Http\Controllers\Penghuni;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penghuni;
use Auth;
use DB;

class PenghuniController extends Controller
{
    public function index() {
        return view('penghuni.index');
    }

    public function getdata(request $req) {
        $limit = $req->length;
        $start = $req->start;
        $page  = $start + 1;
        $search = $req->search['value'];

        $dataquery  = Penghuni::with('getUser');
        // return $dataquery->get();

        $totalData = $dataquery->get()->count();

        $totalFiltered = $dataquery->get()->count();

        $dataquery->limit($limit);
        $dataquery->offset($start);
        $data = $dataquery->get();
        foreach ($data as $key => $result) {
            $result->no                = $key + $page;
            $result->code              = $result->code;
            $result->nama              = $result->nama;
            $result->alamat            = $result->tower .'lt.'. $result->lantai.'room.'. $result->room;
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
            $penghuni = new User;
            $penghuni->name = $req->nama;
            $penghuni->save();
            
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
    }
}
