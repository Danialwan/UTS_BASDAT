<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_penerimaan extends Model
{
    use HasFactory;
    protected $table = "detail_penerimaan";
    protected $fillable =
    [
        'jumlah',
        'iddetil_pengadaan',
        'idpenerimaan'
    ];

    public function detil_pengadaan(){
        return $this->hasOne(detail_pengadaan::class, 'id', 'iddetil_pengadaan');
    }

    public function detail_retur(){
        return $this->hasMany(detail_retur::class);
    }
}
