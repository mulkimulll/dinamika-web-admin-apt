<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penghuni;
use App\Models\Kendaraan;
use App\Models\Gedung;
use App\Models\Transaction;
use DB;

class DashboardController extends Controller
{
    public function index() {
        $tp = Penghuni::select('penghuni.id')->get()->count();
        $tparkir = Kendaraan::select('kendaraan.id')->get()->count();

        return view('Dashboard.index', compact('tp', 'tparkir'));
    }

    public function getDataRiwayat(request $req) {
        $limit = $req->length;
        $start = $req->start;
        $page  = $start + 1;

        $dataquery  = Transaction::with('getUser');

        $totalData = $dataquery->get()->count();

        $totalFiltered = $dataquery->get()->count();

        $dataquery->limit($limit);
        $data = $dataquery->get();

        foreach ($data as $key => $result) {
            $result->no                = $key + $page;
            $result->code              = $result->getUser->code;
            $result->nama              = $result->getUser->nama;
            $result->alamat            = $result->tower .'lt.'. $result->total_lantai.'room.'. $result->total_room;
            $result->description       = $result->description;
            $result->created_at        = $result->created_at;
            $result->status            = $result->status;
        }

        $json_data = array(
            "draw"            => intval($req->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        return json_encode($json_data);
    }

    public function chartdatapenghuni()
    {
        $data = Gedung::withCount(['getPenghuni as total_penghuni'])->get();

        return response()->json($data);
    }
    
    public function chartdataparkir()
    {
        $data = Kendaraan::leftjoin('penghuni', 'kendaraan.user_id', 'penghuni.user_id')
        ->leftjoin('gedung', 'penghuni.tower', 'gedung.id')
        ->get();

        $data = DB::select("SELECT 
            c.nama, COUNT(c.nama) AS value
        FROM
            kendaraan a
                LEFT JOIN
            penghuni b ON a.user_id = b.user_id
                LEFT JOIN
            gedung c ON b.tower = c.id
        GROUP BY c.nama");

        return response()->json($data);
    }
}
