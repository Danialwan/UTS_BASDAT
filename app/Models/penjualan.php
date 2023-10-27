<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penjualan extends Model
{
    use HasFactory;
    protected $table = "penjualan";
    protected $fillable =
    [
        'subtotal_nilai',
        'ppn',
        'total_nilai',
        'iduser',
        'idmargin_penjualan'
    ];
    public function user(){
        return $this->hasOne(User::class, 'id', 'iduser');
    }
    public function margin_penjualan(){
        return $this->hasOne(margin_penjualan::class, 'id', 'idmargin_penjualan');
    }
    public function detail_penjualan(){
        return $this->hasMany(detail_penjualan::class);
    }
}
