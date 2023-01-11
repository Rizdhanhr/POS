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

        $year = Carbon::now()->format('Y');

        //Penjualan
        $pj_jan = DB::table('penjualan')->whereMonth('created_at','=','01')->whereYear('created_at','=',$year)->sum('jumlah');
        $pj_feb = DB::table('penjualan')->whereMonth('created_at','=','02')->whereYear('created_at','=',$year)->sum('jumlah');
        $pj_mar = DB::table('penjualan')->whereMonth('created_at','=','03')->whereYear('created_at','=',$year)->sum('jumlah');
        $pj_apr = DB::table('penjualan')->whereMonth('created_at','=','04')->whereYear('created_at','=',$year)->sum('jumlah');
        $pj_mei = DB::table('penjualan')->whereMonth('created_at','=','05')->whereYear('created_at','=',$year)->sum('jumlah');
        $pj_jun = DB::table('penjualan')->whereMonth('created_at','=','06')->whereYear('created_at','=',$year)->sum('jumlah');
        $pj_jul = DB::table('penjualan')->whereMonth('created_at','=','07')->whereYear('created_at','=',$year)->sum('jumlah');
        $pj_agu = DB::table('penjualan')->whereMonth('created_at','=','08')->whereYear('created_at','=',$year)->sum('jumlah');
        $pj_sep = DB::table('penjualan')->whereMonth('created_at','=','09')->whereYear('created_at','=',$year)->sum('jumlah');
        $pj_okt = DB::table('penjualan')->whereMonth('created_at','=','10')->whereYear('created_at','=',$year)->sum('jumlah');
        $pj_nov = DB::table('penjualan')->whereMonth('created_at','=','11')->whereYear('created_at','=',$year)->sum('jumlah');
        $pj_des = DB::table('penjualan')->whereMonth('created_at','=','12')->whereYear('created_at','=',$year)->sum('jumlah');

        //Pembelian
        $pb_jan = DB::table('pembelian')->whereMonth('created_at','=','01')->whereYear('created_at','=',$year)->sum('jumlah');
        $pb_feb = DB::table('pembelian')->whereMonth('created_at','=','02')->whereYear('created_at','=',$year)->sum('jumlah');
        $pb_mar = DB::table('pembelian')->whereMonth('created_at','=','03')->whereYear('created_at','=',$year)->sum('jumlah');
        $pb_apr = DB::table('pembelian')->whereMonth('created_at','=','04')->whereYear('created_at','=',$year)->sum('jumlah');
        $pb_mei = DB::table('pembelian')->whereMonth('created_at','=','05')->whereYear('created_at','=',$year)->sum('jumlah');
        $pb_jun = DB::table('pembelian')->whereMonth('created_at','=','06')->whereYear('created_at','=',$year)->sum('jumlah');
        $pb_jul = DB::table('pembelian')->whereMonth('created_at','=','07')->whereYear('created_at','=',$year)->sum('jumlah');
        $pb_agu = DB::table('pembelian')->whereMonth('created_at','=','08')->whereYear('created_at','=',$year)->sum('jumlah');
        $pb_sep = DB::table('pembelian')->whereMonth('created_at','=','09')->whereYear('created_at','=',$year)->sum('jumlah');
        $pb_okt = DB::table('pembelian')->whereMonth('created_at','=','10')->whereYear('created_at','=',$year)->sum('jumlah');
        $pb_nov = DB::table('pembelian')->whereMonth('created_at','=','11')->whereYear('created_at','=',$year)->sum('jumlah');
        $pb_des = DB::table('pembelian')->whereMonth('created_at','=','12')->whereYear('created_at','=',$year)->sum('jumlah');


        return view('dashboard.index',
        compact('barang','thisweek','thisday','sold','pj_jan','pj_feb','pj_mar','pj_apr','pj_mei','pj_jun'
        ,'pj_jul','pj_agu','pj_sep','pj_okt','pj_nov','pj_des','pb_jan','pb_feb','pb_mar','pb_apr','pb_mei','pb_jun','pb_jul'
        ,'pb_agu','pb_sep','pb_okt','pb_nov','pb_des'));
    }
}
