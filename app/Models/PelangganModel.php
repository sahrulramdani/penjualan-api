<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelangganModel extends Model
{
    use HasFactory;

    protected $table = 'pelanggan';
    public $timestamps = false;
    protected $fillable = [
        'ID_PELANGGAN', 'NAMA', 'DOMISILI', 'JENIS_KELAMIN'
    ];

    public static function getID(){
        $data = PelangganModel::orderBy('ID_PELANGGAN', 'desc')->first();

        if (!$data) {
            $idNow = 'PELANGGAN_1';
        }else{
            $id = substr($data->ID_PELANGGAN, 10);
            $idNow = 'PELANGGAN_' . str_pad(($id + 1), 3, '0', STR_PAD_LEFT);
        }

        return $idNow;
    }
}
