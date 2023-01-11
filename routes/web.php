<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\DataStokController;
use App\Http\Controllers\LaporanPenjualanController;
use App\Http\Controllers\LaporanPembelianController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::resource('/dashboard', DashboardController::class);
    Route::resource('/kategori', KategoriController::class);
    Route::resource('/satuan', SatuanController::class);
    Route::resource('/brand', BrandController::class);
    Route::resource('/supplier', SupplierController::class);
    Route::resource('/barang', BarangController::class);
    Route::resource('/penjualan', PenjualanController::class);
    Route::resource('/pembelian', PembelianController::class);
    Route::resource('/datastok', DataStokController::class);
    Route::resource('/lap-penjualan', LaporanPenjualanController::class);
    Route::resource('/lap-pembelian', LaporanPembelianController::class);
    Route::get('/getbarang/{id}', [PembelianController::class,'getbarang']);
    Route::get('/getbarangout/{id}', [PenjualanController::class,'getbarang']);
    Route::get('/clear/{id}', [PembelianController::class,'clear']);
    Route::post('/proses-pembelian', [PembelianController::class,'prosespembelian']);
    Route::post('/proses-penjualan', [PenjualanController::class,'prosespenjualan']);
    Route::get('/cetak/{no_trx}',[PembelianController::class, 'cetak']);
    Route::get('/cetak-penjualan/{no_trx}',[PenjualanController::class,'cetak'])->name('cetak-penjualan');
    Route::get('/lap-pembelian-cari',[LaporanPembelianController::class,'cari'])->name('cari-pembelian');
    Route::get('/lap-penjualan-cari',[LaporanPenjualanController::class,'cari'])->name('cari-penjualan');
});