<?php

namespace App\Http\Controllers;

use App\Models\retur;
use App\Models\vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use function Ramsey\Uuid\v1;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_vendor = DB::table('vendor')->where('delete',0)->get();
        $data_barang = DB::table('barang')->where('delete',0)->get();
        $data_pengadaan = DB::table('pengadaan')->get();
        $data_penerimaan = DB::table('penerimaan')->get();
        $data = [
            'data_vendor' => $data_vendor,
            'data_barang' => $data_barang,
            'data_pengadaan' => $data_pengadaan,
            'data_penerimaan' => $data_penerimaan
        ];
        return view('Content.Vendor')->with($data);
    }

    public function show_restore(){
        $data =  DB::table('vendor')->where('delete',1)->get();
        return view('Vendor.restore')->with('data',$data);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Vendor.Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('nama_vendor', $request->nama_vendor);

        $request -> validate([
            'nama_vendor' => 'required',
        ],[
            'nama_vendor.required' => 'Nama Vendor wajib di isi',
        ]);
        $data = [
            'nama_vendor' => $request->input('nama_vendor'),
            'status' => 1
        ];

        DB::table('vendor')->insert($data);
        // vendor::Create($data);
        return redirect('vendor')->with('success','Berhasil memasukan data');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data =  DB::table('vendor')->where('delete',1)->get();
        return view('Vendor.restore')->with('data',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $data = vendor::where('id', $id)->first();
        $data = DB::table('vendor')->where('id', $id)->first();
        return view('Vendor.Edit')->with('data',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Session::flash('nama_vendor', $request->nama_vendor);

        $request -> validate([
            'nama_vendor' => 'required',
            'status' => 'required'
        ],[
            'nama_vendor.required' => 'Nama Vendor wajib di isi',
            'status.required' => 'Nama Vendor wajib di isi'
        ]);
        $data = [
            'nama_vendor' => $request->input('nama_vendor'),
            'status' => $request->input('status')
        ];
        DB::table('vendor')->where('id',$id)->update($data);
        // vendor::where('id', $id)->update($data);
        return redirect('vendor')->with('success','Berhasil melakukan perubahan data');
    }

    public function restore(string $id){
        $data = [
            'delete' => 0
        ];
        DB::table('vendor')->where('id', $id)->update($data);
        return redirect('/vendor')->with('success','Berhasil merestore data');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = [
            'delete' => 1
        ];
        DB::table('vendor')->where('id',$id)->update($data);
        return redirect('/vendor')->with('success','Berhasil menghapus data');
    }

    public function delete(string $id){
        DB::table('vendor')->where('id',$id)->delete();
        return redirect('/vendor')->with('success','Berhasil menghapus data');
    }
}
