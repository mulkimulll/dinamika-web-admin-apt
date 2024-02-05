<?php

namespace App\Http\Controllers\Penghuni;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Penghuni;
use App\Models\Gedung;
use App\User;
use Auth;
use DB;
use Carbon\Carbon;

class PenghuniController extends Controller
{
    public function index() {
        $tower = Gedung::select('id','nama','code')->get();

        return view('Penghuni.index', compact('tower'));
    }

    public function getdata(request $req) {
        $limit = $req->length;
        $start = $req->start;
        $page  = $start + 1;

        $dataquery  = Penghuni::select("penghuni.*");

        $totalData = $dataquery->get()->count();

        $totalFiltered = $dataquery->get()->count();

        $dataquery->limit($limit);
        $data = $dataquery->get();

        foreach ($data as $key => $result) {
            $result->no                = $key + $page;
            $result->code              = $result->code;
            $result->nama              = $result->nama;
            $result->alamat            = $result->tower .'lt.'. $result->lantai.'room.'. $result->room;
            $result->created_at        = $result->created_at;
            $result->status            = $this->statusLabel($result->status_pemilik);
            $result->action            = '
            <a href="' . route('penghuni.dtl', $result->code) . '" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
            <a href="#" class="btn btn-sm btn-danger" onclick="deleteData(this, \'' . $result->code . '\')"><i class="fa fa-trash"></i></a>
            ';
        }

        $json_data = array(
            "draw"            => intval($req->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        return json_encode($json_data, true);
    }

    public function add(request $req) {
        $username = explode(" ", $req->nama)[0];
        $last = Penghuni::max('code') ?? 0;

        try {
            DB::beginTransaction();
            $user = new User;
            $user->name = $req->nama;
            $user->username = $username;
            $user->email = $req->email;
            $user->password = Hash::make('YourPass');
            $user->save();
            
            $penghuni = new Penghuni;
            $penghuni->code = 'ST-'.date('d-m-y').'-'.$this->code($last + 1);
            $penghuni->user_id = $user->id;
            $penghuni->nama = $req->nama;
            $penghuni->tmpt_lahir = $req->tmpt_lahir;
            $penghuni->tgl_lahir = $req->tgl_lahir;
            $penghuni->no_telp = $req->telp;
            $penghuni->agama = $req->agama;
            $penghuni->status_pemilik = $req->statu_pemilik;
            $penghuni->status = $req->status;
            $penghuni->tower = $req->tower;
            $penghuni->lantai = $req->lantai;
            $penghuni->room = $req->room;
            $penghuni->ktp = $req->ktp;

            $image = $req->file('file');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Save image to the 'public/images' directory
            $image->move(public_path('images/ktp/'), $imageName);
            $penghuni->foto_ktp = $imageName;
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

        return json_encode($json_data); 
    }

    public function dtl($code) {
        $penghuni = Penghuni::with('getUser')->where('code', $code)->first();

        return view('Penghuni.dtl', compact('penghuni'));
    }

    public function delete(request $req, $code)
    {
        try {
            $penghuni        = Penghuni::where('code', $code)->first();
            $penghuni->delete();

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

    private function code($code) {
        $data = str_pad($code, 4, '0', STR_PAD_LEFT);
        return $data;
    }

    private function statusLabel($status) {
        if ($status == 1) {
            $data = '<span class="badge badge-success">Pemilik</span>';
        } elseif ($status == 2) {
            $data = '<span class="badge badge-info">Penyewa</span>';
        } else {
            $data = '<span class="badge badge-info">-</span>';
        }
        
        return $data;
    }
}
