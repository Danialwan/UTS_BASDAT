<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengadaan extends Model
{
    use HasFactory;
    protected $table = "pengadaan";
    protected $fillable =
    [
        'iduser',
        'status',
        'idvendor',
        'subtotal_nilai',
        'ppn',
        'total_nilai'
    ];

    public function vendor(){
        return $this->hasOne(vendor::class, 'id', 'idvendor');
    }
    public function detail_pengadaan(){
        return $this->hasMany(detail_pengadaan::class);
    }
    public function penerimaan(){
        return $this->hasMany(penerimaan::class);
    }
}
