<?php

namespace App\Http\Controllers;

use App\Models\retur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_penjualan = DB::table('penjualan')
                    ->join('users', 'penjualan.iduser','=','users.id')
                    ->select('penjualan.*', 'users.username')->get();

        $data_barang = DB::table('barang')->get();
        $data = [
            'data_penjualan' => $data_penjualan,
            'data_barang' => $data_barang
        ];
        return view('Content.Dashboard')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data_barang = DB::table('barang')->get();
        return view('Penjualan.Create')->with('data_barang', $data_barang);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store_barang(Request $request, string $id_barang){
        $penjualan = [
            'created_at' => now(),
            'subtotal_nilai' => 0,
            'ppn' => 10,
            'total_nilai' => 0,
            'iduser' => Auth::user()->id,
        ];
        DB::table('penjualan')->insert($penjualan);

        $maxid = DB::table('penjualan')->max('id');
        $penjualan = DB::table('penjualan')->where('id',$maxid)->first();
        $barang = DB::table('barang')->where('id', $id_barang)->first();

        $detail_penjualan = [
            'created_at' => now(),
            'harga_satuan' => $barang->harga,
            'jumlah' => $request->jumlah,
            'subtotal' => $barang->harga*$request->jumlah,
            'idpenjualan' => $penjualan->id,
            'idbarang' => $barang->id
        ];
        DB::table('detail_penjualan')->insert($detail_penjualan);

        $update_penjualan = [
            'subtotal_nilai' => $penjualan->subtotal_nilai + $barang->harga*$request->jumlah,
        ];
        DB::table('penjualan')->where('id', $penjualan->id)->update($update_penjualan);


        $update_penjualan = [
            'total_nilai' => (DB::table('detail_penjualan')
                                ->where('idpenjualan',$penjualan->id )
                                ->sum('subtotal')) + ((DB::table('detail_penjualan')
                                ->where('idpenjualan',$penjualan->id )
                                ->sum('subtotal'))*($penjualan->ppn / 100)),
        ];
        DB::table('penjualan')->where('id', $penjualan->id)->update($update_penjualan);

        $data_barang = DB::table('barang')->get();
        $detail_penjualan = DB::table('detail_penjualan')
                            ->join ('barang', 'detail_penjualan.idbarang', '=', 'barang.id')
                            ->select('detail_penjualan.*', 'barang.nama')
                            ->where('detail_penjualan.idpenjualan', $penjualan->id)
                            ->get();
        $data = [
            'data_barang' => $data_barang,
            'detail_penjualan' => $detail_penjualan,
            'penjualan' => $penjualan
        ];

        return view('Penjualan.Create_detail')->with($data);

    }

    public function store(Request $request, string $id_barang, $id_penjualan)
    {
        $penjualan = DB::table('penjualan')->where('id',$id_penjualan)->first();
        $barang = DB::table('barang')->where('id', $id_barang)->first();

        $detail_penjualan = [
            'created_at' => now(),
            'harga_satuan' => $barang->harga,
            'jumlah' => $request->jumlah,
            'subtotal' => $barang->harga*$request->jumlah,
            'idpenjualan' => $penjualan->id,
            'idbarang' => $barang->id
        ];
        DB::table('detail_penjualan')->insert($detail_penjualan);

        $update_penjualan = [
            'subtotal_nilai' => $penjualan->subtotal_nilai + $barang->harga*$request->jumlah
        ];
        DB::table('penjualan')->where('id', $penjualan->id)->update($update_penjualan);

        $update_penjualan = [
            'total_nilai' => (DB::table('detail_penjualan')
                                ->where('idpenjualan',$penjualan->id )
                                ->sum('subtotal')) + ((DB::table('detail_penjualan')
                                ->where('idpenjualan',$penjualan->id )
                                ->sum('subtotal'))*($penjualan->ppn / 100)),
        ];
        DB::table('penjualan')->where('id', $penjualan->id)->update($update_penjualan);

        $data_barang = DB::table('barang')->get();
        $detail_penjualan = DB::table('detail_penjualan')
                            ->join ('barang', 'detail_penjualan.idbarang', '=', 'barang.id')
                            ->select('detail_penjualan.*', 'barang.nama')
                            ->where('detail_penjualan.idpenjualan', $penjualan->id)
                            ->get();
        $data = [
            'data_barang' => $data_barang,
            'detail_penjualan' => $detail_penjualan,
            'penjualan' => $penjualan
        ];

        return view('Penjualan.Create_detail')->with($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $penjualan = DB::table('penjualan')->where('id',$id)->first();
        $data_barang = DB::table('barang')->get();
        $detail_penjualan = DB::table('detail_penjualan')
                            ->join ('barang', 'detail_penjualan.idbarang', '=', 'barang.id')
                            ->select('detail_penjualan.*', 'barang.nama')
                            ->where('detail_penjualan.idpenjualan', $penjualan->id)
                            ->get();
        $data = [
            'data_barang' => $data_barang,
            'detail_penjualan' => $detail_penjualan,
            'penjualan' => $penjualan
        ];

        return view('Penjualan.Create_detail')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('penjualan')->where('id',$id)->delete();
        return redirect('/')->with('success','Berhasil menghapus data');
    }

    public function destroy_detail (string $id, string $id_penjualan){

        $detail_penjualan = DB::table('detail_penjualan')->where('id', $id)->first();
        $penjualan = DB::table('penjualan')->where('id',$id_penjualan)->first();

        $update_penjualan = [
            'subtotal_nilai' => $penjualan->subtotal_nilai - $detail_penjualan->subtotal
        ];
        DB::table('penjualan')->where('id', $penjualan->id)->update($update_penjualan);
        DB::table('detail_penjualan')->where('id', $id)->delete();

        $update_penjualan = [
            'total_nilai' => (DB::table('detail_penjualan')
                                ->where('idpenjualan',$penjualan->id )
                                ->sum('subtotal')) + ((DB::table('detail_penjualan')
                                ->where('idpenjualan',$penjualan->id )
                                ->sum('subtotal'))*($penjualan->ppn / 100)),
        ];
        DB::table('penjualan')->where('id', $penjualan->id)->update($update_penjualan);

        $data_barang = DB::table('barang')->get();
        $detail_penjualan = DB::table('detail_penjualan')
                            ->join ('barang', 'detail_penjualan.idbarang', '=', 'barang.id')
                            ->select('detail_penjualan.*', 'barang.nama')
                            ->where('detail_penjualan.idpenjualan', $penjualan->id)
                            ->get();
        $data = [
            'data_barang' => $data_barang,
            'detail_penjualan' => $detail_penjualan,
            'penjualan' => $penjualan
        ];

        return view('Penjualan.Create_detail')->with($data);
    }
}
