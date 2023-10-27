<?php
namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\retur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $data_barang = barang::all();
        // $data_satuan = barang::all();
        $data_barang = DB::table('barang')->where('delete',0)->get();
        $data_satuan = DB::table('satuan')->where('delete',0)->get();
        $data = [
            'data_barang' => $data_barang,
            'data_satuan' => $data_satuan
        ];
        return view('Content.Barang')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = DB::table('satuan')->get();
        return view('Barang.Create')->with('data',$data);
    }

    public function show_restore(){
        $data =  DB::table('barang')->where('delete',1)->get();
        return view('Barang.restore')->with('data',$data);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('nama_barang', $request->nama_barang);
        Session::flash('jenis_barang', $request->jenis_barang);
        Session::flash('harga', $request->harga);

        $request -> validate([
            'nama_barang' => 'required',
            'jenis_barang' => 'required',
            'idsatuan' => 'required',
            'harga' => 'required',
            'harga' => 'numeric',
        ],[
            'nama_barang.required' => 'Nama Barang wajib di isi',
            'jenis_barang.required' => 'Jenis Barang wajib di isi',
            'idsatuan.required' => 'Satuan wajib di isi',
            'harga.required' => 'Harga wajib di isi',
            'harga.numeric' => 'Harga hanya dapat di isi angka',
        ]);
        $data = [
            'nama' => $request->input('nama_barang'),
            'jenis' => $request->input('jenis_barang'),
            'idsatuan' => $request->input('idsatuan'),
            'harga' => $request->input('harga'),
            'status' => 1
        ];

        DB::table('barang')->insert($data);
        // vendor::Create($data);
        return redirect('Barang')->with('success','Berhasil memasukan data');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data =  DB::table('barang')->where('delete',1)->get();
        return view('Barang.restore')->with('data',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data_satuan = DB::table('satuan')->get();
        $data_barang = DB::table('barang')
                        ->join('satuan', 'barang.idsatuan', '=', 'satuan.id')
                        ->select('barang.*', 'satuan.nama_satuan')
                        ->where('barang.id', $id)->first();
        $data = [
            'data_satuan' => $data_satuan,
            'data_barang' => $data_barang
        ];
        return view('Barang.Edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request -> validate([
            'nama_barang' => 'required',
            'jenis_barang' => 'required',
            'idsatuan' => 'required',
            'status' => 'required',
            'harga' => 'required',
            'harga' => 'numeric',
        ],[
            'nama_barang.required' => 'Nama Barang wajib di isi',
            'jenis_barang.required' => 'Jenis Barang wajib di isi',
            'idsatuan.required' => 'Satuan wajib di isi',
            'status.required' => 'Status wajib di isi',
            'harga.required' => 'Harga wajib di isi',
            'harga.numeric' => 'Harga hanya dapat di isi angka',
        ]);
        $data = [
            'nama' => $request->input('nama_barang'),
            'jenis' => $request->input('jenis_barang'),
            'idsatuan' => $request->input('idsatuan'),
            'harga' => $request->input('harga'),
            'status' => $request->input('status')
        ];

        DB::table('barang')->where('id',$id)->update($data);
        // vendor::Create($data);
        return redirect('Barang')->with('success','Berhasil memasukan data');
    }

    public function restore(string $id){
        $data = [
            'delete' => 0
        ];
        DB::table('barang')->where('id', $id)->update($data);
        return redirect('/Barang')->with('success','Berhasil merestore data');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = [
            'delete' => 1
        ];
        DB::table('barang')->where('id',$id)->update($data);
        return redirect('/Barang')->with('success','Berhasil menghapus data');
    }

    public function delete(string $id){
        DB::table('barang')->where('id',$id)->delete();
        return redirect('/Barang')->with('success','Berhasil menghapus permanen data');
    }
}
