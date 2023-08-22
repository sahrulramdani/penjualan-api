<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PelangganModel;
use Illuminate\Database\QueryException;

class PelangganController extends Controller
{
    public function index(){
        $pelanggan = PelangganModel::all();
        return response()->json(['data' => $pelanggan], 200);
    }

    public static function savePelanggan(Request $req){
        $pelanggan = new PelangganModel();
        $pelanggan->ID_PELANGGAN = $pelanggan::getID();
        $pelanggan->NAMA = $req->nama;
        $pelanggan->DOMISILI = $req->domisili;
        $pelanggan->JENIS_KELAMIN = $req->jenis_kelamin;

        $result = $pelanggan->save();
        if ($result) {
            return ['status'=>'true', 'message'=>'Data Berhasil Disimpan'];
        }else{
            return ['status'=>'false', 'message'=>'Data Gagal Disimpan'];
        }
    }

    public function detail($id){
        $pelanggan = PelangganModel::where('ID_PELANGGAN', $id)->firstOrFail();

        if ($pelanggan) {
            return response()->json(['data' => $pelanggan], 200);
        }else{
            return ['status'=>'false', 'message'=>'Data tidak ditemukan'];
        }
    }

    public static function updatePelanggan(Request $req){
        try {
            PelangganModel::where('ID_PELANGGAN', $req->id)->update([
                'NAMA' => $req->nama,
                'DOMISILI' => $req->domisili,
                'JENIS_KELAMIN' => $req->jenis_kelamin,
            ]);

            return ['status'=>'true', 'message'=>'Data Berhasil Disimpan'];
        } catch (QueryException $e) {
            return ['status'=>'false', 'message'=>'Data Gagal Disimpan', 'error' => $e];
        }
    }

    public function deletePelanggan($id){
        $result = PelangganModel::where('ID_PELANGGAN', $id)->delete();

        if ($result) {
            return ['status'=>'true', 'message'=>'Data Berhasil Dihapus'];
        }else{
            return ['status'=>'false', 'message'=>'Data tidak Terhapus'];
        }
    }
}
