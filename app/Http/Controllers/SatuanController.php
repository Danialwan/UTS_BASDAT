<?php

namespace App\Http\Controllers;

use App\Models\retur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Content.Barang');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function show_restore(){
        $data =  DB::table('satuan')->where('delete',1)->get();
        return view('Satuan.restore')->with('data',$data);
    }

    public function create()
    {
        return view('Satuan.Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('nama_satuan', $request->nama_satuan);

        $request -> validate([
            'nama_satuan' => 'required',
        ],[
            'nama_satuan.required' => 'Nama Satuan wajib di isi',
        ]);
        $data = [
            'nama_satuan' => $request->input('nama_satuan'),
            'status' => 1
        ];

        DB::table('satuan')->insert($data);
        return redirect('Barang')->with('success','Berhasil memasukan data');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data =  DB::table('satuan')->where('delete',1)->get();
        return view('Satuan.restore')->with('data',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = DB::table('satuan')->where('id', $id)->first();
        return view('Satuan.Edit')->with('data',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Session::flash('nama_satuan', $request->nama_satuan);

        $request -> validate([
            'nama_satuan' => 'required',
            'status' => 'required'
        ],[
            'nama_satuan.required' => 'Nama Vendor wajib di isi',
            'status.required' => 'Nama Vendor wajib di isi'
        ]);
        $data = [
            'nama_satuan' => $request->input('nama_satuan'),
            'status' => $request->input('status')
        ];
        DB::table('satuan')->where('id',$id)->update($data);
        // vendor::where('id', $id)->update($data);
        return redirect('/Barang')->with('success','Berhasil melakukan perubahan data');
    }

    public function restore(string $id){
        $data = [
            'delete' => 0
        ];
        DB::table('satuan')->where('id', $id)->update($data);
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

        DB::table('satuan')->where('id',$id)->update($data);
        return redirect('/Barang')->with('success','Berhasil menghapus data');
    }
    public function delete(string $id){
        DB::table('satuan')->where('id',$id)->delete();
        return redirect('/Barang')->with('success','Berhasil menghapus permanen data');
    }
}
