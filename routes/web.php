<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\PenerimaanController;
use App\Http\Controllers\PengadaanController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ReturController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['guest'])->group(function(){
    Route::GET('/Login', [SessionController::class,'index'])->name('login');
    Route::POST('/Login', [SessionController::class,'login']);
});

Route::get('/home', function () {
    return redirect('/');
});

Route::middleware(['auth'])->group(function(){

    Route::GET('/Logout', [SessionController::class,'logout']);
    Route::resource('Barang', BarangController::class);
    Route::resource('Satuan', SatuanController::class);
    Route::resource('Karyawan', UserController::class);
    Route::resource('Role', RoleController::class);
    Route::resource('Pengadaan', PengadaanController::class);
    Route::resource('vendor', VendorController::class);
    Route::resource('Penerimaan', PenerimaanController::class);
    Route::resource('/', PenjualanController::class);

    Route::GET('Pengadaan/create/{Vendor}', [PengadaanController::class, 'create']);
    Route::POST('Pengadaan/create/{vendor}/{barang}', [PengadaanController::class, 'store_barang']);
    Route::POST('Pengadaan/create/{vendor}/{barang}/{pengadaan}', [PengadaanController::class, 'store']);
    Route::DELETE ('Pengadaan/create/{vendor}/{barang}/{pengadaan}', [PengadaanController::class, 'destroy_detail']);
    Route::GET('Pengadaan/{pengadaan}/{vendor}', [PengadaanController::class, 'show']);
    Route::GET ('Penerimaan/{vendor}/{pengadaan}', [PenerimaanController::class, 'create']);
    Route::POST('Penerimaan/{vendor}/{pengadaan}', [PenerimaanController::class, 'store']);

    Route::GET('/Retur/{pengadaan}/{penerimaan}', [ReturController::class, 'create']);
    Route::POST('Retur/{pengadaan}/{penerimaan}', [ReturController::class, 'store']);

    Route::POST('/{barang}', [PenjualanController::class, 'store_barang']);
    Route::POST('/{barang}/{penjualan}', [PenjualanController::class, 'store']);
    Route::DELETE ('/{detail_penjualan}/{penjualan}', [PenjualanController::class, 'destroy_detail']);
    Route::DELETE ('/{penjualan}', [PenjualanController::class, 'destroy']);
    Route::GET ('/{penjualan}', [PenjualanController::class, 'show']);

    Route::match(['put', 'patch'],'Karyawan/restore/{item}', [UserController::class, 'restore']);
    Route::match(['put', 'patch'],'Satuan/restore/{item}', [SatuanController::class, 'restore']);
    Route::match(['put', 'patch'],'Role/restore/{role}', [RoleController::class, 'restore']);
    Route::match(['put', 'patch'],'Barang/restore/{item}', [BarangController::class, 'restore']);
    Route::match(['put', 'patch'],'vendor/restore/{item}', [VendorController::class, 'restore']);

    Route::DELETE('Karyawan/destroy/{item}', [UserController::class, 'delete']);
    Route::DELETE('Satuan/destroy/{item}', [SatuanController::class, 'delete']);
    Route::DELETE('Role/destroy/{item}', [RoleController::class, 'delete']);
    Route::DELETE('Barang/destroy/{item}', [BarangController::class, 'delete']);
    Route::DELETE('vendor/destroy/{item}', [VendorController::class, 'delete']);
});
