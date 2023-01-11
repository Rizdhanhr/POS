<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(){
        $tgl = Carbon::now()->subDays(7);
        $bulan = Carbon::now()->subDays(30);
        $barang = DB::table('barang')->count();

        $thisweek = DB::table('penjualan')
        ->where('created_at','>=', $tgl)
        ->sum('harga');

        $thisday = DB::table('penjualan')->select(DB::raw('*'))
        ->whereRaw('Date(created_at) = CURDATE()')
        ->sum('harga');

        $sold = DB::table('penjualan')
        ->where('created_at','>=',$bulan)
        ->sum('jumlah');



 
      
        return view('dashboard.index',compact('barang','thisweek','thisday','sold'));
    }
}
