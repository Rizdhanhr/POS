<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class LaporanPembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('lap_pembelian.index');
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

        $laporan = DB::table('detail_pembelian')
        ->join('barang','barang.id','detail_pembelian.id_barang')
        ->whereBetween('detail_pembelian.created_at', [$dari, $sampai])
        ->get(array(
            'detail_pembelian.*',
            'barang.nama as nama_barang'
        ));

        // DD($laporan);

        return view('lap_pembelian.show',compact('laporan','dari','sampai'));
    }
}
