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
use App\Http\Controllers\LaporanPenyesuaianController;
use App\Http\Controllers\PenyesuaianController;
use App\Http\Controllers\ManajemenUserController;
use App\Http\Controllers\StokMenipisController;
use App\Http\Controllers\FeedbackController;

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
Route::post('/feedback',[FeedbackController::class,'store']);

Route::middleware(['auth','CekLevel'])->group(function (){
    Route::resource('/manajemen-user', ManajemenUserController::class);
});

Route::middleware(['auth'])->group(function () {
    //Dashboard
    Route::get('/get-data',[DashboardController::class,'getdata']);
    Route::resource('/dashboard', DashboardController::class);
    //Atribut & Barang
    Route::resource('/kategori', KategoriController::class);
    Route::resource('/satuan', SatuanController::class);
    Route::resource('/brand', BrandController::class);
    Route::resource('/supplier', SupplierController::class);
    Route::resource('/barang', BarangController::class);
    //Penjualan
    Route::get('/getbarangout/{id}', [PenjualanController::class,'getbarang']);
    Route::post('/proses-penjualan', [PenjualanController::class,'prosespenjualan']);
    Route::get('/cetak-penjualan/{no_trx}',[PenjualanController::class,'cetak'])->name('cetak-penjualan');
    Route::resource('/penjualan', PenjualanController::class);
    //Pembelian
    Route::get('/getbarang/{id}', [PembelianController::class,'getbarang']);
    Route::get('/clear/{id}', [PembelianController::class,'clear']);
    Route::post('/proses-pembelian', [PembelianController::class,'prosespembelian']);
    Route::get('/cetak/{no_trx}',[PembelianController::class, 'cetak']);
    Route::resource('/pembelian', PembelianController::class);
    //Data Stok
    Route::resource('/datastok', DataStokController::class);
    //Laporan Penjualan
    Route::get('/export-excel-penjualan',[LaporanPenjualanController::class,'cetakexcel'])->name('excel-penjualan');
    Route::get('/lap-penjualan-cari',[LaporanPenjualanController::class,'cari'])->name('cari-penjualan');
    Route::resource('/lap-penjualan', LaporanPenjualanController::class);
    //Laporan Pembelian
    Route::get('/lap-pembelian-cari',[LaporanPembelianController::class,'cari'])->name('cari-pembelian');
    Route::get('/export-excel-pembelian',[LaporanPembelianController::class,'cetakexcel'])->name('excel-pembelian');
    Route::resource('/lap-pembelian', LaporanPembelianController::class);
    //Penyesuaian
    Route::post('/proses-penyesuaian',[PenyesuaianController::class,'proses'])->name('proses-penyesuaian');
    Route::resource('/penyesuaian', PenyesuaianController::class);
    //Laporan Penyesuaian
    Route::get('/lap-penyesuaian-cari',[LaporanPenyesuaianController::class,'cari'])->name('cari-penyesuaian');
    Route::get('/lap-penyesuaian-cetak/{no_penyesuaian}',[LaporanPenyesuaianController::class,'cetak'])->name('lap-penyesuaian-cetak');
    Route::get('/export-excel-penyesuaian',[LaporanPenyesuaianController::class,'cetakexcel'])->name('excel-penyesuaian');
    Route::resource('/lap-penyesuaian',LaporanPenyesuaianController::class);
    //Stok Menipis
    Route::resource('/stok-menipis', StokMenipisController::class);



});
