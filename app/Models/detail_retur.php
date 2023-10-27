<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_retur extends Model
{
    use HasFactory;
    protected $table = "detail_retur";
    protected $fillable =
    [
        'jumlah',
        'alasan',
        'idretur',
        'iddetail_penerimaan'
    ];
    public function retur(){
        return $this->hasOne(retur::class, 'id', 'idretur');
    }
    public function detail_penerimaan(){
        return $this->hasOne(detail_penerimaan::class, 'id', 'iddetail_penerimaan');
    }
}
