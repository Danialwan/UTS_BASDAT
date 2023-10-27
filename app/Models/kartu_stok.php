<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kartu_stok extends Model
{
    use HasFactory;
    protected $table = "kartu_stok";
    protected $fillable =
    [
        'jenis_transaksi',
        'masuk',
        'keluar',
        'stock',
        'idtransaksi',
        'idbarang'
    ];
    public function barang(){
        return $this->hasOne(barang::class, 'id', 'idbarang');
    }
}
