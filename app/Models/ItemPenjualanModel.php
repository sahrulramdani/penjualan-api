<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPenjualanModel extends Model
{
    use HasFactory;

    protected $table = 'item_penjualan';
    public $timestamps = false;
    protected $fillable = [
        'NOTA', 'KODE_BARANG', 'Qty'
    ];
}
