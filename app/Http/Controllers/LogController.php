<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogController extends Controller
{
    public function index()
    {
        $log_Barang = DB::table('kartu_stok')
                    ->join('barang', 'kartu_stok.idbarang','=','barang.id')
                    ->select('kartu_stok.*', 'barang.nama' , 'barang.harga')->get();
        return view('Content.Log')->with('data', $log_Barang);
    }
}
