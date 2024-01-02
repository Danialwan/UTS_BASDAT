<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_users = DB::table('users')->where('users.delete',0)->get();
        $roles = DB::table('role')->where('delete',0)->get();
        $data_akun = DB::table('users')
                    ->join('role', 'users.role', '=', 'role.id')
                    ->select('users.*','role.nama_role')
                    ->where('users.id',(Auth::user()->id))->first();
        $data = [
            'data_users' => $data_users,
            'roles' => $roles,
            'data_akun' => $data_akun
        ];
        return view('Content.Karyawan')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function show_restore(){
        return 1;
        $data =  DB::table('users')->where('delete',1)->get();
        return view('Karyawan.restore')->with('data_users',$data);
    }

    public function create()
    {
        $data = DB::table('role')->get();
        return view('Karyawan.Create')->with('data',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('username', $request->username);
        Session::flash('role', $request->role);
        Session::flash('harga', $request->harga);

        $request -> validate([
            'username' => 'required',
            'password' => 'required|confirmed',
            'role' => 'required',
        ],[
            'username.required' => 'Nama wajib di isi',
            'password.required' => 'Password wajib di isi',
            'role.required' => 'Role wajib di isi',
            'password.confirmed' => 'Password yang anda masukan tidak sesuai'
        ]);
        $data = [
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->input('role'),
            'created_at' => now(),
            'updated_at' => now()
        ];

        DB::table('users')->insert($data);
        return redirect('/Karyawan')->with('success','Berhasil memasukan data');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $data =  DB::table('users')->where('delete',1)->get();
        return view('Karyawan.restore')->with('data_users',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $data_user = DB::table('users')->get();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $profile = DB::table('users')->where('id', $id);
        $data = [
            'username' => $request->username,
            'role' => $request->role
        ];
        DB::table('users')->where('id', $id)->update($data);
        return Redirect('Karyawan')->with('success','Berhasil melakukan update');
    }

    public function restore(string $id){
        $data = [
            'delete' => 0
        ];
        DB::table('users')->where('id', $id)->update($data);
        return redirect('/Karyawan')->with('success','Berhasil merestore data');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = [
            'delete' => 1
        ];

        DB::table('users')->where('id',$id)->update($data);
        return redirect('/Karyawan')->with('success','Berhasil menghapus data');
    }

    public function delete(string $id){
        DB::table('users')->where('id',$id)->delete();
        return redirect('/Karyawan')->with('success','Berhasil menghapus permanen data');
    }
}
