<?php

namespace App\Http\Controllers;

use App\Models\ItemPenjualanModel;
use Illuminate\Http\Request;
use App\Models\PenjualanModel;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    public function index(){
        $penjualan = DB::table('penjualan')
        ->select('penjualan.ID_NOTA', 'penjualan.TGL', 'penjualan.SUB_TOTAL', 'penjualan.KODE_PELANGGAN' , 'pelanggan.NAMA')
        ->distinct()
        ->join('pelanggan', 'penjualan.KODE_PELANGGAN', '=', 'pelanggan.ID_PELANGGAN')
        ->get();

        return response()->json(['data' => $penjualan], 200);
    }

    public function detail($id){
        $penjualan = PenjualanModel::with('itemPenjualan')->join('pelanggan', 'penjualan.KODE_PELANGGAN', '=', 'pelanggan.ID_PELANGGAN')->where('ID_NOTA', $id)->firstOrFail();

        return response()->json(['data' => $penjualan], 200);
    }

    public function savePenjualan(Request $req){
        try {
            $penjualan = new PenjualanModel();
            $itemPenjualan = new ItemPenjualanModel();

            $id_nota = $penjualan::getID();

            $penjualan->ID_NOTA = $id_nota;
            $penjualan->TGL = $req->tanggal;
            $penjualan->KODE_PELANGGAN = $req->nama;
            $penjualan->SUB_TOTAL = $req->subtotal;

            $result = $penjualan->save();

            foreach ($req->listItem as $item) {
                $detailData = [
                    'NOTA' => $id_nota,
                    'KODE_BARANG' => $item['KODE'],
                    'Qty' => $item['QTY'],
                ];

                $itemPenjualan::create($detailData);
            }

            if ($result && $itemPenjualan) {
                return ['status'=>'true', 'message'=>'Data Berhasil Disimpan'];
            }else{
                return ['status'=>'false', 'message'=>'Data Gagal Disimpan'];
            }
        } catch (QueryException $e) {
            return ['status'=>'false', 'message'=>'Data Gagal Disimpan', 'err'=>$e];
        }
    }

    public function updatePenjualan(Request $req){
        try {
            PenjualanModel::where('ID_NOTA', $req->id)->update([
                'TGL' => $req->tanggal,
                'KODE_PELANGGAN' => $req->nama,
                'SUB_TOTAL' => $req->subtotal,
            ]);

            ItemPenjualanModel::where('NOTA', $req->id)->delete();
            foreach ($req->listItem as $item) {
                $detailData = [
                    'NOTA' => $req->id,
                    'KODE_BARANG' => $item['KODE'],
                    'Qty' => $item['QTY'],
                ];

                ItemPenjualanModel::create($detailData);
            }

            return ['status'=>'true', 'message'=>'Data Berhasil Disimpan'];
        } catch (QueryException $e) {
            return ['status'=>'false', 'message'=>'Data Gagal Disimpan', 'error' => $e];
        }
    }

    public function deletePenjualan($id){
        try {
            ItemPenjualanModel::where('NOTA', $id)->delete();
            PenjualanModel::where('ID_NOTA', $id)->delete();

            return ['status'=>'true', 'message'=>'Data Berhasil Dihapus'];
        } catch (QueryException $e) {
            return ['status'=>'false', 'message'=>'Data tidak Terhapus', 'err'=>$e];
        }
    }
}
