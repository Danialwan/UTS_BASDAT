<?php

namespace App\Http\Controllers;

use App\Models\retur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    public function index(){
        return view('Content.Login');
    }
    public function login(Request $request){
        Session::flash('username', $request->username);
        Session::flash('password', $request->password);

        $request -> validate([
            'username' => 'required',
            'password' => 'required'
        ],[
            'username.required' => 'Username wajib di isi',
            'password.required' => 'Password wajib di isi'
        ]);

        $infologin = [
            'username' => $request->input('username'),
            'password' => $request->input('password')
        ];

        if (Auth::attempt($infologin)) {
            return redirect('/')->with('success', 'Anda Berhasil Login');
        }
        else {
            return redirect('/Login')->withErrors('Data yang anda masukan tidak sesuai');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/Login')->with('success', 'Berhasil Logout');
    }
}
