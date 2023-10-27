<?php

namespace App\Http\Controllers;

use App\Models\pengadaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PengadaanController extends Controller
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
    public function create(string $id)
    {
        // $data = DB::table('barang')->where('id', $id)->first();
        $vendor = DB::table('vendor')->where('id', $id)->first();
        $data_barang = DB::table('barang')->get();

        $data = [
            // 'pengadaan' => $pengadaan,
            'data_barang' => $data_barang,
            'vendor' => $vendor,
        ];
        return view('Pengadaan.Create')->with($data);
    }

    public function store_barang(Request $request, string $id_vendor, string $id_barang)
    {
        // $data = DB::table('barang')->where('id', $id)->first();

        // Membuat Array data pengadaan untuk di inputkan kedalam table pengadaan
        // fungsinya menyiapkan wadah untuk barang2 yang akan dipesan

        $pengadaan =[
            'iduser' => Auth::user()->id,
            'created_at' => now(),
            'idvendor' => $id_vendor,
            'status' => 0
        ];
        DB::table('pengadaan')->insert($pengadaan);

        // Memanggil wadah dari table pengadaan dengan cara mencari id maximum (id terbaru)
        // yang ada di table tersebut

        $maxid = DB::table('pengadaan')->max('id');
        $pengadaan = DB::table('pengadaan')->where('id', $maxid)->first();

        //  Menyiapkan data barang yang ingin dipesan untuk dimasukan dedalam table detail pengadaan
        $barang = DB::table('barang')->where('id', $id_barang)->first();

        //  Mengisi table detail Pengadaan dengan data yang telah tersedia
        $detail_pengadaan = [
          'created_at' => now(),
          'idbarang' => $barang->id,
          'harga_satuan' => $barang->harga,
          'jumlah'=> $request->input('jumlah'),
          'subtotal' => $barang->harga*$request->input('jumlah'),
          'idpengadaan' => $pengadaan->id
        ];
        DB::table('detail_pengadaan')->insert($detail_pengadaan);

        // Tidak lupa melakukan update kepada table pengadaan
        $update_pengadaan = [
            'subtotal_nilai' => $pengadaan->subtotal_nilai + $barang->harga*$request->input('jumlah')
        ];
        DB::table('pengadaan')->where('id', $pengadaan->id)->update($update_pengadaan);

        // Menyiapkan data yang akan dipakai untuk page selanjutnya
        $vendor = DB::table('vendor')->where('id', $id_vendor)->first();
        $data_barang = DB::table('barang')->get();
        $detail_pengadaan = DB::table('detail_pengadaan')
                            ->join ('barang', 'detail_pengadaan.idbarang', '=', 'barang.id')
                            ->select('detail_pengadaan.*', 'barang.nama')
                            ->where('detail_pengadaan.idpengadaan', $pengadaan->id)
                            ->get();

        $data_pengadaan = DB::table('pengadaan')->where('id', $maxid)->get();

        $data = [
            'pengadaan' => $pengadaan,
            'detail_pengadaan' => $detail_pengadaan,
            'vendor' =>  $vendor,
            'data_barang' => $data_barang,
            'data_pengadaan' => $data_pengadaan
        ];

        return view('Pengadaan.Create_detail')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,string $id_vendor, string $id_barang, string $id_pengadaan  )
    {
        $vendor = DB::table('vendor')->where('id', $id_vendor)->first();
        $barang = DB::table('barang')->where('id', $id_barang)->first();
        $pengadaan = DB::table('pengadaan')->where('id', $id_pengadaan)->first();

        $detail_pengadaan = [
            'created_at' => now(),
            'idbarang' => $barang->id,
            'harga_satuan' => $barang->harga,
            'jumlah'=> $request->input('jumlah'),
            'subtotal' => $barang->harga*$request->input('jumlah'),
            'idpengadaan' => $pengadaan->id
          ];
          DB::table('detail_pengadaan')->insert($detail_pengadaan);

          $update_pengadaan = [
            'subtotal_nilai' => $pengadaan->subtotal_nilai + $barang->harga*$request->input('jumlah')
        ];
        DB::table('pengadaan')->where('id', $pengadaan->id)->update($update_pengadaan);

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

        return view('Pengadaan.Create_detail')->with($data);
    }

    /**
     * Display the specified resource.
     */
    public function show( string $id_pengadaan, string $id_vendor)
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

        return view('Pengadaan.Create_detail')->with($data);
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
        DB::table('pengadaan')->where('id',$id)->delete();
        return redirect('/vendor')->with('success','Berhasil menghapus data');

    }
    public function destroy_detail(string $id_vendor, string $iddetail_pengadaan, string $id_pengadaan){

        $vendor = DB::table('vendor')->where('id', $id_vendor)->first();
        $pengadaan = DB::table('pengadaan')->where('id', $id_pengadaan)->first();
        $detail_pengadaan = DB::table('detail_pengadaan')->where('id', $iddetail_pengadaan)->first();

        $update_pengadaan = [
            'subtotal_nilai' => $pengadaan->subtotal_nilai - $detail_pengadaan->subtotal
        ];
        DB::table('pengadaan')->where('id', $pengadaan->id)->update($update_pengadaan);

        DB::table('detail_pengadaan')->where('id',$iddetail_pengadaan)->delete();

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
        return view('Pengadaan.Create_detail')->with($data);
    }
}
