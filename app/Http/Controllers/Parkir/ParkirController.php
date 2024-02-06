<?php

namespace App\Http\Controllers\Parkir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kendaraan;
use App\Models\Penghuni;
use DB;

class ParkirController extends Controller
{
    public function index() {
        $penghuni = Penghuni::select('user_id','nama', 'code')->get();

        return view('Parkir.index', compact('penghuni'));
    }

    public function getdata(request $req) {
        $limit = $req->length;
        $start = $req->start;
        $page  = $start + 1;

        $dataquery  = Kendaraan::with(['getUser', 'getPenghuni']);

        $totalData = $dataquery->get()->count();

        $totalFiltered = $dataquery->get()->count();

        $dataquery->limit($limit);
        $data = $dataquery->get();

        foreach ($data as $key => $result) {
            $result->no                = $key + $page;
            $result->code              = '<strong>'.$result->getUser->name.'</strong> <br>'. $result->getPenghuni->code;
            $result->alamat            = $result->getPenghuni->tower .'lt.'. $result->getPenghuni->lantai.'room.'. $result->getPenghuni->room;
            $result->jns_kendaraan     = $result->jns_kendaraan;
            $result->merk              = $result->merk.'<br> <button class="btn btn-default waves-effect">'.$result->plat_nomor.'</button>';
            $result->aktif             = date('d-m-Y', strtotime($result->tgl_nonaktif));
            $result->status            = $this->statusLabel($result->status);
            $result->action            = '
            <a href="' . route('parkir.dtl', $result->getPenghuni->code) . '" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
            <a href="#" class="btn btn-sm btn-danger" onclick="deleteData(this, \'' . $result->id . '\')"><i class="fa fa-trash"></i></a>
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

    public function add(request $req) {

        try {
            DB::beginTransaction();
            $kendaraan = new Kendaraan;
            $kendaraan->user_id = $req->user_id;
            $kendaraan->plat_nomor = $req->plat_nomor;
            $kendaraan->status = '1';
            $kendaraan->jns_kendaraan = $req->jns_kendaraan;
            $kendaraan->merk = $req->merk;
            $kendaraan->tgl_aktif = date('Y-m-d');
            $kendaraan->tgl_nonaktif = $req->tgl_nonaktif;

            $image = $req->file('file');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Save image to the 'public/images' directory
            $image->move(public_path('images/foto_stnk/'), $imageName);
            $kendaraan->foto_stnk = $imageName;
            $kendaraan->save();
            
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

    public function delete(request $req, $code)
    {
        try {
            $kendaraan        = Kendaraan::where('id', $code)->first();
            $kendaraan->delete();

            $json_data = array(
                "status"         => 'success',
                "message"         => 'Data berhasil dihapus.'
            );
        } catch (\Throwable $th) {
            $json_data = array(
                "success"         => 'gagal',
                "message"         => $th->getMessage()
            );
        }
        return response()->json($json_data);
    }

    private function statusLabel($status) {
        if ($status == 1) {
            $data = '<span class="badge badge-success">Aktif</span>';
        } else {
            $data = '<span class="badge badge-danger">Non Aktif</span>';
        }
        
        return $data;
    }
}
