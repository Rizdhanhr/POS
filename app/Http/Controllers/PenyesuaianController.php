<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;


class PenyesuaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $kode = "PEN";
        $kd = DB::select('SELECT SUM(total) as jumlah FROM ( SELECT COUNT(DISTINCT(no_penyesuaian)) as total FROM detail_penyesuaian where status = 1 GROUP BY no_penyesuaian ) hasil');

        // DD((int)$barang[0]->jumlah+1);
        if($kd[0]->jumlah < 10){
            $sku = $kode.'-'.'00'.((int)$kd[0]->jumlah+1);
        }else if($kd[0]->jumlah > 10 && $kd[0]->jumlah < 100){
            $sku = $kode.'-'.'0'.((int)$kd[0]->jumlah+1);
        }else{
            $sku = $kode.'-'.((int)$kd[0]->jumlah+1);
        }

        $detail = DB::table('detail_penyesuaian')
        ->join('barang','barang.id','detail_penyesuaian.id_barang')
        ->where('detail_penyesuaian.status',0)
        ->where('detail_penyesuaian.created_by',$user->id)
        ->get(array(
            'detail_penyesuaian.*',
            'barang.nama as nama_barang',
            'barang.kode as kode_barang'
        ));

        // $selisih = $detail->stok_tercatat - $detail->stok_aktual;

        // DD($selisih);
        // DD($sku);

        $barang = DB::table('barang')->get();
        return view('penyesuaian.create',compact('barang','sku','detail'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[

            'stok_aktual' => 'required|numeric|different:stok_tercatat',
            'keterangan' => 'required',
            'barang' => 'gt:0'
        ],
        [
            'barang.gt' => 'Barang harus dipilih!',
            'stok_aktual.required' => 'Masukkan stok aktual!',
            'stok_aktual.different' => 'Stok tidak boleh sama!',
            'keterangan.required' => 'Masukkan keterangan!'
        ]);

        try{
            DB::transaction(function () use($request) {
                $user = Auth::user();
                $kode = "PEN";
                $kd = DB::select('SELECT SUM(total) as jumlah FROM ( SELECT COUNT(DISTINCT(no_penyesuaian)) as total FROM detail_penyesuaian where status = 1 GROUP BY no_penyesuaian ) hasil');

                // DD((int)$barang[0]->jumlah+1);
                if($kd[0]->jumlah < 10){
                    $sku = $kode.'-'.'00'.((int)$kd[0]->jumlah+1);
                }else if($kd[0]->jumlah > 10 && $kd[0]->jumlah < 100){
                    $sku = $kode.'-'.'0'.((int)$kd[0]->jumlah+1);
                }else{
                    $sku = $kode.'-'.((int)$kd[0]->jumlah+1);
                }

                $cek = DB::table('detail_penyesuaian')
                ->where('id_barang',$request->barang)
                ->where('status',0)
                ->count();

                if($cek > 0){
                    toastr()->error('barang sedang dalam proses!');
                    return redirect()->back();
                }else{
                    DB::table('detail_penyesuaian')->insert([
                        'id_barang' => $request->barang,
                        'stok_tercatat' => $request->stok_tercatat,
                        'stok_aktual' => $request->stok_aktual,
                        'keterangan' => $request->keterangan,
                        'created_at' => date('Y-m-d H:i:s'),
                        'created_by' => $user->id
                    ]);
                    toastr()->success('barang berhasil disesuaikan!');
                }
            });
            return redirect()->back();
        }catch(Exception $e){

        }
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

    public function proses(Request $request){
        $this->validate($request,[
            'catatan' => 'required|max:255'
        ]);

        try{
            DB::transaction(function () use($request) {
                $kode = "PEN";
                $kd = DB::select('SELECT SUM(total) as jumlah FROM ( SELECT COUNT(DISTINCT(no_penyesuaian)) as total FROM detail_penyesuaian where status = 1 GROUP BY no_penyesuaian ) hasil');
                // DD((int)$barang[0]->jumlah+1);
                if($kd[0]->jumlah < 10){
                    $sku = $kode.'-'.'00'.((int)$kd[0]->jumlah+1);
                }else if($kd[0]->jumlah > 10 && $kd[0]->jumlah < 100){
                    $sku = $kode.'-'.'0'.((int)$kd[0]->jumlah+1);
                }else{
                    $sku = $kode.'-'.((int)$kd[0]->jumlah+1);
                }

                $user = Auth::user();
                DB::table('detail_penyesuaian')
                ->where('status',0)
                ->where('created_by',$user->id)
                ->update([
                    'no_penyesuaian' => $sku,
                    'status' => 1
                ]);

                $updatebarang = DB::table('detail_penyesuaian')
                ->join('barang','barang.id','detail_penyesuaian.id_barang')
                ->where('no_penyesuaian',$sku)
                ->get(array(
                    'detail_penyesuaian.*',
                    'barang.stok as barang_stok',
                ));

                foreach($updatebarang as $row){
                    DB::table('barang')->where('id',$row->id_barang)->update(
                        [
                            'stok' => $row->stok_aktual

                        ]
                    );
                }
                DB::table('penyesuaian')->insert([
                    'no_penyesuaian' => $sku,
                    'created_at' => date('Y-m-d H:i:s'),
                    'catatan' => $request->catatan,
                    'created_by' => $user->id,
                ]);
            });
            toastr()->success('success','Penyesuaian berhasil!');
            return redirect()->back();
        }catch(Exception $e){

        }
    }

}
