<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vendor extends Model
{
    use HasFactory;
    protected $table = "vendor";
    protected $fillable =
    [
        'nama_vendor',
        'badan_hukum',
        'status'
    ];
    public function pengadaan(){
        return $this->hasMany(pengadaan::class);
    }
}
