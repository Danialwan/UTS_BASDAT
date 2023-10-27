<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_pengadaan extends Model
{
    use HasFactory;
    protected $table = "detail_pengadaan";
    protected $fillable =
    [
        'harga_satuan',
        'jumlah',
        'sub_total',
        'idbarang',
        'idpengadaan'
    ];
    public function barang(){
        return $this->hasOne(barang::class, 'id', 'idbarang');
    }
    public function pengadaan(){
        return $this->hasOne(pengadaan::class, 'id', 'idpengadaan');
    }
    public function detail_penerimaan(){
        return $this->hasMany(detail_penerimaan::class);
    }
}
