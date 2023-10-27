<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class margin_penjualan extends Model
{
    use HasFactory;
    protected $table = "margin_penjualan";
    protected $fillable =
    [
        'persen',
        'status',
        'iduser',
    ];
    public function user(){
        return $this->hasOne(User::class, 'id', 'iduser');
    }
    public function penjualan(){
        return $this->hasMany(penjualan::class);
    }
}
