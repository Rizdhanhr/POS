<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Exports\ExportLapPenjualan;
use Maatwebsite\Excel\Facades\Excel;

class LaporanPenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('lap_penjualan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function cari(Request $request){
        $this->validate($request,[
            'dari' => 'required|before_or_equal:sampai',
            'sampai' => 'required'
        ],
        [
            'dari.required' => 'Masukkan tanggal mulai!',
            'dari.before_or_equal' => 'Tgl mulai tidak boleh lebih besar!'
        ]
    );
        $dari = $request->dari;
        $sampai = $request->sampai;

        $laporan = DB::table('detail_penjualan')
        ->join('barang','barang.id','detail_penjualan.id_barang')
        ->whereBetween('detail_penjualan.created_at', [$dari, $sampai])
        ->get(array(
            'detail_penjualan.*',
            'barang.nama as nama_barang'
        ));

        // DD($laporan);

        return view('lap_penjualan.show',compact('laporan','dari','sampai'));

    }

    public function cetakexcel(Request $request){
        $dari = $request->dari;
        $sampai = $request->sampai;

        return Excel::download(new ExportLapPenjualan($dari, $sampai), 'penjualan.xlsx');
    }

}
