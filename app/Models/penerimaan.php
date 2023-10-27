<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penerimaan extends Model
{
    use HasFactory;
    protected $table = "penerimaan";
    protected $fillable =
    [
        'status',
        'idpengadaan',
        'iduser'
    ];
    public function user(){
        return $this->hasOne(User::class, 'id', 'iduser');
    }
    public function pengadaan(){
        return $this->hasOne(pengadaan::class, 'id', 'idpengadaan');
    }
    public function detail_penerimaan(){
        return $this->hasMany(detail_penerimaan::class);
    }
    public function retur(){
        return $this->hasMany(retur::class);
    }
}
