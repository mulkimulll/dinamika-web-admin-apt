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

class PenghuniController extends Controller
{
    public function index() {
        $tower = Gedung::select('id','nama','code')->get();

        return view('penghuni.index',compact('tower'));
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
        $username = explode("", $req->nama)[0];

        try {
            DB::beginTransaction();
            $user = new User;
            $user->name = $req->nama;
            $user->username = $username;
            $user->email = $req->email;
            $user->password = Hash::make('YourPass');
            $user->save();
            
            $penghuni = new Penghuni;
            $penghuni->user_id = $user->id;
            $penghuni->nama = $req->nama;
            $penghuni->tmpt_lahir = $req->tmpt_lahir;
            $penghuni->tgl_lahir = $req->tgl_lahir;
            $penghuni->no_telp = $req->telp;
            $penghuni->agama = $req->agama;
            $penghuni->status = $req->status;
            $penghuni->tower = $req->tower;
            $penghuni->lantai = $req->lantai;
            $penghuni->room = $req->room;
            $penghuni->ktp = $req->ktp;

            $image = $request->file('foto_ktp');
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
    }
}