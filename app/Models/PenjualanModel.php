<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PenjualanModel extends Model
{
    use HasFactory;

    protected $table = 'penjualan';
    public $timestamps = false;
    protected $fillable = [
        'ID_NOTA', 'TGL', 'KODE_PELANGGAN', 'SUB_TOTAL'
    ];

    public static function getID(){
        $data = PenjualanModel::orderBy('ID_NOTA', 'desc')->first();

        if (!$data) {
            $idNow = 'NOTA_001';
        }else{
            $id = substr($data->ID_NOTA, 5);
            $idNow = 'NOTA_' . str_pad(($id + 1), 3, '0', STR_PAD_LEFT);
        }

        return $idNow;
    }

    public function itemPenjualan() {
        return $this->hasMany(ItemPenjualanModel::class, 'NOTA', 'ID_NOTA')->join('barang', 'item_penjualan.KODE_BARANG', '=', 'barang.KODE')->selectRaw('item_penjualan.*, item_penjualan.Qty AS QTY, barang.NAMA AS NAMA_BRG, barang.*, FORMAT((item_penjualan.Qty * barang.HARGA),0) AS SUBTOTAL');
    }
}
