<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangModel extends Model
{
    use HasFactory;

    protected $table = 'barang';
    public $timestamps = false;
    protected $fillable = [
        'KODE', 'NAMA', 'KATEGORI', 'HARGA'
    ];


    public static function getID(){
        $data = BarangModel::orderBy('KODE', 'desc')->first();

        if (!$data) {
            $idNow = 'BRG_001';
        }else{
            $id = substr($data->KODE, 4);
            $idNow = 'BRG_' . str_pad(($id + 1), 3, '0', STR_PAD_LEFT);
        }

        return $idNow;
    }
}
