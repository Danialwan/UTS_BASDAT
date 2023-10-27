<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReturController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id_pengadaan, string $id_penerimaan)
    {
        $penerimaan = DB::table('penerimaan')->where('id', $id_penerimaan)->first();
        $pengadaan = DB::table('pengadaan')->where('id', $id_pengadaan)->first();

        $data_barang = DB::table('barang')->get();
        $detail_pengadaan = DB::table('detail_pengadaan')
                            ->join ('barang', 'detail_pengadaan.idbarang', '=', 'barang.id')
                            ->select('detail_pengadaan.*', 'barang.nama')
                            ->where('detail_pengadaan.idpengadaan', $pengadaan->id)
                            ->get();

        $data_pengadaan = DB::table('pengadaan')->where('id', $id_pengadaan)->get();

        $data = [
            'pengadaan' => $pengadaan,
            'penerimaan' => $penerimaan,
            'detail_pengadaan' => $detail_pengadaan,
            'data_barang' => $data_barang,
            'data_pengadaan' => $data_pengadaan
            ];

        return view('Pengadaan.retur')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id_pengadaan, string $id_penerimaan)
    {

        $penerimaan = DB::table('penerimaan')->where('id', $id_penerimaan)->first();

        $retur = [
            'created_at' => now(),
            'iduser' => Auth::user()->id,
            'idpenerimaan' => $penerimaan->id
        ];

        DB::table('retur')->insert($retur);

        $maxid = DB::table('retur')->max('id');
        $retur = DB::table('retur')->where('id', $maxid)->first();

        $arr_retur = count($request->retur);
        // $arr_retur = count($request->retur);

        for ($i=0; $i < $arr_retur ; $i++) {

            $detail_penerimaan = DB::table('detail_penerimaan')
                                ->where('idpenerimaan', $id_penerimaan)
                                ->get()[$i];

            $detail_retur = [
                'created_at' => now(),

                'jumlah' => $request->retur[$i],
                'alasan' => $request->alasan[$i],
                'iddetail_penerimaan' => $detail_penerimaan->id,
                'idretur' => $retur->id
            ];
            DB::table('detail_retur')->insert($detail_retur);
        }
        $pengadaan = DB::table('pengadaan')->where('id', $id_pengadaan)->first();

        // $data_barang = DB::table('barang')->get();
        // $detail_pengadaan = DB::table('detail_pengadaan')
        //                     ->join ('barang', 'detail_pengadaan.idbarang', '=', 'barang.id')
        //                     ->select('detail_pengadaan.*', 'barang.nama')
        //                     ->where('detail_pengadaan.idpengadaan', $pengadaan->id)
        //                     ->get();

        // $data_pengadaan = DB::table('pengadaan')->where('id', $id_pengadaan)->get();

        // $data = [
        //     'pengadaan' => $pengadaan,
        //     'detail_pengadaan' => $detail_pengadaan,
        //     'data_barang' => $data_barang,
        //     'data_pengadaan' => $data_pengadaan
        //     ];

        return redirect('/vendor')->with('success', 'Data retur berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }
}
