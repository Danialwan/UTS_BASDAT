<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class satuan extends Model
{
    use HasFactory;
    protected $table = "satuan";
    protected $fillable =
    [
        'nama_satuan',
        'status'
    ];

    public function barang(){
        return $this->hasMany(barang::class);
    }
}
