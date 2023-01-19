<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

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

        $todolist = DB::table('todolist')
        ->orderBy('created_at','desc')
        ->limit(5)
        ->get();

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

        //Pemasukan Per Bulan
        $pm_jan = DB::table('penjualan')->whereMonth('created_at','=','01')->whereYear('created_at','=',$year)->sum('harga');
        $pm_feb = DB::table('penjualan')->whereMonth('created_at','=','02')->whereYear('created_at','=',$year)->sum('harga');
        $pm_mar = DB::table('penjualan')->whereMonth('created_at','=','03')->whereYear('created_at','=',$year)->sum('harga');
        $pm_apr = DB::table('penjualan')->whereMonth('created_at','=','04')->whereYear('created_at','=',$year)->sum('harga');
        $pm_mei = DB::table('penjualan')->whereMonth('created_at','=','05')->whereYear('created_at','=',$year)->sum('harga');
        $pm_jun = DB::table('penjualan')->whereMonth('created_at','=','06')->whereYear('created_at','=',$year)->sum('harga');
        $pm_jul = DB::table('penjualan')->whereMonth('created_at','=','07')->whereYear('created_at','=',$year)->sum('harga');
        $pm_agu = DB::table('penjualan')->whereMonth('created_at','=','08')->whereYear('created_at','=',$year)->sum('harga');
        $pm_sep = DB::table('penjualan')->whereMonth('created_at','=','09')->whereYear('created_at','=',$year)->sum('harga');
        $pm_okt = DB::table('penjualan')->whereMonth('created_at','=','10')->whereYear('created_at','=',$year)->sum('harga');
        $pm_nov = DB::table('penjualan')->whereMonth('created_at','=','11')->whereYear('created_at','=',$year)->sum('harga');
        $pm_des = DB::table('penjualan')->whereMonth('created_at','=','12')->whereYear('created_at','=',$year)->sum('harga');

        //Pengeluaran Per Bulan
         //Pemasukan Per Bulan
         $pr_jan = DB::table('pembelian')->whereMonth('created_at','=','01')->whereYear('created_at','=',$year)->sum('harga');
         $pr_feb = DB::table('pembelian')->whereMonth('created_at','=','02')->whereYear('created_at','=',$year)->sum('harga');
         $pr_mar = DB::table('pembelian')->whereMonth('created_at','=','03')->whereYear('created_at','=',$year)->sum('harga');
         $pr_apr = DB::table('pembelian')->whereMonth('created_at','=','04')->whereYear('created_at','=',$year)->sum('harga');
         $pr_mei = DB::table('pembelian')->whereMonth('created_at','=','05')->whereYear('created_at','=',$year)->sum('harga');
         $pr_jun = DB::table('pembelian')->whereMonth('created_at','=','06')->whereYear('created_at','=',$year)->sum('harga');
         $pr_jul = DB::table('pembelian')->whereMonth('created_at','=','07')->whereYear('created_at','=',$year)->sum('harga');
         $pr_agu = DB::table('pembelian')->whereMonth('created_at','=','08')->whereYear('created_at','=',$year)->sum('harga');
         $pr_sep = DB::table('pembelian')->whereMonth('created_at','=','09')->whereYear('created_at','=',$year)->sum('harga');
         $pr_okt = DB::table('pembelian')->whereMonth('created_at','=','10')->whereYear('created_at','=',$year)->sum('harga');
         $pr_nov = DB::table('pembelian')->whereMonth('created_at','=','11')->whereYear('created_at','=',$year)->sum('harga');
         $pr_des = DB::table('pembelian')->whereMonth('created_at','=','12')->whereYear('created_at','=',$year)->sum('harga');

        return view('dashboard.index',
        compact('barang','thisweek','thisday','sold','pj_jan','pj_feb','pj_mar','pj_apr','pj_mei','pj_jun'
        ,'pj_jul','pj_agu','pj_sep','pj_okt','pj_nov','pj_des','pb_jan','pb_feb','pb_mar','pb_apr','pb_mei','pb_jun','pb_jul'
        ,'pb_agu','pb_sep','pb_okt','pb_nov','pb_des','pm_jan','pm_feb','pm_mar','pm_apr','pm_mei','pm_jun','pm_jul'
        ,'pm_agu','pm_sep','pm_okt','pm_nov','pm_des','pr_jan','pr_feb','pr_mar','pr_apr','pr_mei','pr_jun','pr_jul'
        ,'pr_agu','pr_sep','pr_okt','pr_nov','pr_des','todolist'));
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'nama'     => 'required',

        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $post = DB::table('todolist')->insert([
            'nama'     => $request->nama,
            'created_at'   => date('Y-m-d H:i:s')
        ]);

        //return response
        $message = array('message' => 'Success!', 'title' => 'Updated');
        return response()->json($message);
    }

    public function getdata(){
        $todolist = DB::table('todolist')
        ->orderBy('created_at','desc')
        ->limit(5)
        ->get();
    }
}
