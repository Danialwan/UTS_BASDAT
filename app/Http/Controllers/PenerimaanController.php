<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\penerimaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PenerimaanController extends Controller
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
    public function create(string $id_vendor, string $id_pengadaan)
    {
        $vendor = DB::table('vendor')->where('id', $id_vendor)->first();
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
            'detail_pengadaan' => $detail_pengadaan,
            'vendor' =>  $vendor,
            'data_barang' => $data_barang,
            'data_pengadaan' => $data_pengadaan
            ];

        // Session::push('destroy', 'Berhasil menghapus data');
        return view('Pengadaan.Penerimaan')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id_vendor, string $id_pengadaan)
    {
        // Session::flash('penerimaan[]', $request->penerimaan[]);
        // Session::flash('retur[]', $request->retur[]);

        $penerimaan = [
            'idpengadaan' => $id_pengadaan,
            'iduser' => Auth::user()->id,
            'status' => 1,
            'created_at' => now()
        ];

        DB::table('penerimaan')->insert($penerimaan);

        $maxid = DB::table('penerimaan')->max('id');
        $penerimaan = DB::table('penerimaan')->where('id', $maxid)->first();

        // $retur = [
        //     'created_at' => now(),
        //     'id_user' => 1,
        //     'idpenerimaan' => $penerimaan->id
        // ];
        // DB::table('retur')->insert($retur);

        // $maxid = DB::table('retur')->max('id');
        // $retur = DB::table('retur')->where('id', $maxid)->first();

        $arr_penerimaan = count($request->penerimaan);
        // $arr_retur = count($request->retur);

        for ($i=0; $i < $arr_penerimaan ; $i++) {

            $detail_pengadaan = DB::table('detail_pengadaan')
                                ->where('idpengadaan', $id_pengadaan)
                                ->get()[$i];

            $detail_penerimaan = [
                'created_at' => now(),
                'jumlah' => $request->penerimaan[$i],
                'iddetail_pengadaan' => $detail_pengadaan->id,
                'idpenerimaan' => $penerimaan->id
            ];
            DB::table('detail_penerimaan')->insert($detail_penerimaan);

            // $detail_return = [
            //     'created_at' => now(),
            //     'jumlah' => $request->retur[$i],
            //     'iddetail_pengadaan' => $detail_pengadaan->id,
            //     'idpenerimaan' => $penerimaan->id
            // ];
            // DB::table('detail_retur')->insert($detail_penerimaan);
        }
        $vendor = DB::table('vendor')->where('id', $id_vendor)->first();
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
            'detail_pengadaan' => $detail_pengadaan,
            'vendor' =>  $vendor,
            'data_barang' => $data_barang,
            'data_pengadaan' => $data_pengadaan
            ];

        // Session::push('destroy', 'Berhasil menghapus data');
        return redirect('/vendor')->with('success', 'Berhasil menambahkan data penerimaan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $detail_retur = DB::table('detail_retur')
                        ->join('detail_penerimaan', 'detail_retur.iddetail_penerimaan', '=', 'detail_penerimaan.id')
                        ->join ('detail_pengadaan', 'detail_pengadaan.id', '=', 'detail_penerimaan.iddetail_pengadaan')
                        ->join ('barang', 'barang.id', '=', 'detail_pengadaan.idbarang')
                        ->select('detail_retur.id', 'detail_retur.created_at','detail_retur.jumlah','detail_retur.alasan', 'barang.nama')
                        ->where('idretur',$id)->get();
        $retur = DB::table('retur')->where('id', $id)->first();

        $data = [
            'retur' => $retur ,
            'detail_retur' => $detail_retur
        ];
        return view('Pengadaan.DetailsRetur')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $vendor = DB::table('vendor')->where('id', $id_vendor)->first();
        // $pengadaan = DB::table('pengadaan')->where('id', $id_pengadaan)->first();
        $data_barang = DB::table('barang')->get();
        $penerimaan = DB::table('penerimaan')->where('id', $id)->first();
        $retur = DB::table('retur')
                ->join ('users', 'retur.iduser', '=', 'users.id')
                ->select('retur.*','users.username')
                ->where('idpenerimaan', $id)->get();

        $pengadaan = DB::table('pengadaan')->where('id', $penerimaan->idpengadaan)->first();

        $detail_penerimaan = DB::table('detail_penerimaan')
                            ->join ('detail_pengadaan', 'detail_penerimaan.iddetail_pengadaan', '=', 'detail_pengadaan.id')
                            ->join ('barang', 'barang.id', '=', 'detail_pengadaan.idbarang')
                            ->select('detail_penerimaan.*' ,'barang.nama', 'barang.harga')
                            ->where('detail_penerimaan.idpenerimaan', $id)
                            ->get();

        $data_pengadaan = DB::table('pengadaan')->where('id', $pengadaan->id )->get();

        $data = [
            'pengadaan' => $pengadaan,
            'detail_penerimaan' => $detail_penerimaan,
            'data_barang' => $data_barang,
            'data_pengadaan' => $data_pengadaan,
            'data_retur' => $retur
            ];

        // Session::push('destroy', 'Berhasil menghapus data');
        return view('Pengadaan.ViewPenerimaan')->with($data);
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
        DB::table('penerimaan')->where('id',$id)->delete();
        return redirect('/vendor')->with('success','Berhasil menghapus data');
    }

    public function destroy_detail(string $id)
    {
        DB::table('detail_penerimaan')->where('id',$id)->delete();
        return redirect('/vendor')->with('success','Berhasil menghapus data');
    }

}
