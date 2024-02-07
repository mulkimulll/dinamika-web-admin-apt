<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penghuni;
use App\Models\Kendaraan;
use App\Models\Gedung;
use DB;

class DashboardController extends Controller
{
    public function index() {
        $tp = Penghuni::select('penghuni.id')->get()->count();
        $tparkir = Kendaraan::select('kendaraan.id')->get()->count();

        $datajs = Gedung::select('nama')->get();
        $resultjs = Gedung::withCount(['getPenghuni as total_penghuni'])->get();

        return view('Dashboard.index', compact('tp', 'tparkir','datajs'));
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
