<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class LaporanPenyesuaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('lap_penyesuaian.index');
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
    public function show($no_penyesuaian)
    {
        $penyesuaian = DB::table('detail_penyesuaian')
        ->join('barang','barang.id','detail_penyesuaian.id_barang')
        ->where('detail_penyesuaian.no_penyesuaian',$no_penyesuaian)
        ->where('detail_penyesuaian.status',1)
        ->get((array(
            'detail_penyesuaian.*',
            'barang.nama as nama_barang'
        )));
        return view('lap_penyesuaian.show',compact('penyesuaian','no_penyesuaian'));
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

        $laporan = DB::table('penyesuaian')
        ->join('users','users.id','penyesuaian.created_by')
        ->whereBetween('penyesuaian.created_at', [$dari, $sampai])
        ->get(array(
            'penyesuaian.*',
            'users.name as nama_user'
        ));

        // DD($laporan);

        return view('lap_penyesuaian.laporan',compact('laporan','dari','sampai'));
    }

    public function cetak($no_penyesuaian){

        $cetak = DB::table('detail_penyesuaian')
        ->join('barang','barang.id','detail_penyesuaian.id_barang')
        ->where('detail_penyesuaian.no_penyesuaian',$no_penyesuaian)
        ->get(array(
            'detail_penyesuaian.*',
            'barang.nama as nama_barang'
        ));

        $tgl= DB::table('detail_penyesuaian')
        ->join('users','users.id','detail_penyesuaian.created_by')
        ->where('detail_penyesuaian.no_penyesuaian',$no_penyesuaian)
        ->limit(1)
        ->get(array(
            'detail_penyesuaian.*',
            'users.name as nama_user'
        ));

        $catatan = DB::table('penyesuaian')
        ->where('penyesuaian.no_penyesuaian',$no_penyesuaian)
        ->select('penyesuaian.catatan')
        ->get();

        return view('lap_penyesuaian.cetak',compact('cetak','no_penyesuaian','tgl','catatan'));
    }

    public function cetakexcel(Request $request){

    }

}
