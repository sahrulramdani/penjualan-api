<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Http\Resources\BarangResource;
use PHPUnit\Framework\MockObject\Rule\Parameters;

class BarangController extends Controller
{
    public function index(){
        $barang = BarangModel::all();
        // return response()->json($barang, 200);
        return BarangResource::collection($barang);
    }

    public static function saveBarang(Request $req){
        $barang = new BarangModel();
        $barang->KODE = $barang::getID();
        $barang->NAMA = $req->nama;
        $barang->KATEGORI = $req->kategori;
        $barang->HARGA = $req->harga;

        $result = $barang->save();
        if ($result) {
            return ['status'=>'true', 'message'=>'Data Berhasil Disimpan'];
        }else{
            return ['status'=>'false', 'message'=>'Data Gagal Disimpan'];
        }
    }

    public function detail($id){
        $barang = BarangModel::where('KODE', $id)->firstOrFail();

        if ($barang) {
            return response()->json(['data' => $barang], 200);
        }else{
            return ['status'=>'false', 'message'=>'Data tidak ditemukan'];
        }
    }

    public static function updateBarang(Request $req){
        try {
            BarangModel::where('KODE', $req->id)->update([
                'NAMA' => $req->nama,
                'KATEGORI' => $req->kategori,
                'HARGA' => $req->harga,
            ]);

            return ['status'=>'true', 'message'=>'Data Berhasil Disimpan'];
        } catch (QueryException $e) {
            return ['status'=>'false', 'message'=>'Data Gagal Disimpan', 'error' => $e];
        }
    }

    public function deleteBarang($id){
        $result = BarangModel::where('KODE', $id)->delete();

        if ($result) {
            return ['status'=>'true', 'message'=>'Data Berhasil Dihapus'];
        }else{
            return ['status'=>'false', 'message'=>'Data tidak Terhapus'];
        }
    }
}
