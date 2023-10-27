<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_penjualan extends Model
{
    use HasFactory;
    protected $table = "detail_penjualan";
    protected $fillable =
    [
        'harga_satuan',
        'jumlah',
        'subtotal',
        'idpenjualan',
        'idbarang'
    ];

    public function penjualan(){
        return $this->hasOne(penjualan::class, 'id', 'idpenjualan');
    }
    public function barang(){
        return $this->hasOne(barang::class, 'id', 'idbarang');
    }

}
