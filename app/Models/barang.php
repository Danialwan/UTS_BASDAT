<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    use HasFactory;
    protected $table = "barang";
    protected $fillable =
    [
        'jenis',
        'nama',
        'idsatuan',
        'status',
        'harga'
    ];
    public function satuan(){
        return $this->hasOne(satuan::class, 'id', 'idsatuan');
    }
    public function kartu_stok(){
        return $this->hasMany(kartu_stok::class);
    }
    public function detail_pengadaan(){
        return $this->hasMany(detail_pengadaan::class);
    }
    public function detail_penjualan(){
        return $this->hasMany(detail_penjualan::class);
    }
}
