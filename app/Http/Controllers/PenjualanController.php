<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penjualan = DB::table('penjualan')
        ->orderBy('created_at','desc')
        ->get();
        return view('penjualan.index',compact('penjualan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $barang = DB::table('barang')->get();
        $penjualan = DB::table('detail_penjualan')
        ->join('barang','barang.id','detail_penjualan.id_barang')
        ->where('detail_penjualan.status',0)
        ->where('detail_penjualan.id_user',$user->id)
        ->get(array(
            'detail_penjualan.*',
            'barang.nama as nama_barang'
        ));
        $total = DB::table('detail_penjualan')
        ->where('status',0)
        ->where('id_user',$user->id)
        ->sum('subtotal');
        return view('penjualan.create',compact('penjualan','barang','total','user'));
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
            'jumlah' => 'required|numeric',
            'barang' => 'required|gt:0'
        ]);

        try{
            DB::transaction(function () use($request){
                $user = Auth::user();
                $total = $request->harga * $request->jumlah;
                $sub_total = DB::table('detail_penjualan')
                ->where('id_barang',$request->barang)
                ->where('status',0)
                ->sum('subtotal');
                $cek = DB::table('detail_penjualan')
                ->where('id_barang',$request->barang)
                ->where('status',0)
                ->count();
                
                $cekstok = DB::table('barang')->where('id',$request->barang)->first();

                if ($cekstok->stok < $request->jumlah){
                    toastr()->error('jumlah melebihi stok!');
                    return redirect()->back();
                }else{
                    if($cek > 0){
                        $cekqty = DB::table('detail_penjualan')
                        ->where('id_barang',$request->barang)
                        ->where('status',0)
                        ->get();
                        DB::table('detail_penjualan')
                        ->where('id_barang',$request->barang)
                        ->where('status',0)
                        ->update(
                            [
                                'id_barang' => $request->barang,
                                'jumlah' => $request->jumlah + $cekqty[0]->jumlah,
                                'id_user' => $user->id,
                                'subtotal' => $total + $sub_total
                            ]
                        );
                    }else{
                        DB::table('detail_penjualan')->insert(
                            [
                                'id_barang' => $request->barang,
                                'jumlah' => $request->jumlah,
                                'id_user' => $user->id,
                                'harga' => $request->harga,
                                'subtotal' => $request->harga * $request->jumlah
                            ]
                        );
                    }
                    toastr()->success('Barang berhasil dimasukkan cart!');
                }

                
                
            });
            
            return redirect()->back();
        }catch(Exception $e){
            toastr()->error('Barang gagal dimasukkan cart!');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($no_trx)
    {
        $detail = DB::table('detail_penjualan')
        ->join('barang','barang.id','detail_penjualan.id_barang')
        ->select('detail_penjualan.*','barang.nama as nama_barang')
        ->where('detail_penjualan.no_trx',$no_trx)
        ->get();
        return view('penjualan.show',compact('detail'));
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
        try{
            DB::transaction(function () use($id){
                DB::table('detail_penjualan')->where('id',$id)->delete();
            });
            toastr()->success('success','Cart berhasil dihapus!');
            return redirect()->back();
        }catch(Exception $e){
            toastr()->error('Barang gagal dimasukkan cart!');
            return redirect()->back();
        }
    }

    public function getbarang($id){
        $barang = DB::table('barang')->where('id',$id)->get();
        return $barang[0];
    }

    public function prosespenjualan(Request $request){
        $this->validate($request,[
            'total' => 'required_with:bayar|integer',
            'bayar' => 'required_with:total|gte:total|integer'
           ],
           [
            'bayar.gte' => 'Uang yang anda masukkan kurang!'
           ]
        );

        try{
            DB::transaction(function () use($request){
                $user = Auth::user();
                $kode = 'TRX';
                $barang = DB::select('SELECT SUM(total) as jumlah FROM ( SELECT COUNT(DISTINCT(no_trx)) as total FROM detail_penjualan where status = 1 GROUP BY no_trx ) hasil');
               
                // DD((int)$barang[0]->jumlah+1);
                if($barang[0]->jumlah < 10){
                    $sku = $kode.'00'.((int)$barang[0]->jumlah+1);
                }else if($barang[0]->jumlah > 10 && $barang[0]->jumlah < 100){
                    $sku = $kode.'0'.((int)$barang[0]->jumlah+1);
                }else{
                    $sku = $kode.((int)$barang[0]->jumlah+1);
                }
    
                DB::table('detail_penjualan')->where('status',0)->update(
                    [
                        'no_trx' => $sku,
                        'status' => 1,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                        'created_by' => $user->id,
                        'updated_by' => $user->id
                    ]
                );

            $updatebarang = DB::table('detail_penjualan')
            ->join('barang','barang.id','detail_penjualan.id_barang')
            ->where('no_trx',$sku)
            ->get(array(
                'detail_penjualan.*',
                'barang.stok as barang_stok',
            ));
            
            foreach($updatebarang as $row){
                DB::table('barang')->where('id',$row->id_barang)->update(
                    [
                        'stok' => $row->barang_stok - $row->jumlah
                    ]
                );
            }
          
            $jumlah = DB::table('detail_penjualan')
            ->where('no_trx',$sku)->sum('jumlah');
            $harga = DB::table('detail_penjualan')
            ->where('no_trx',$sku)->sum('subtotal');
            DB::table('penjualan')->insert([
                'no_trx' => $sku,
                'jumlah' => $jumlah,
                'harga' => $harga,
                'bayar' => $request->bayar,
                'kembali' => $request->kembali,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'created_by' => $user->id,
                'updated_by' => $user->id
            ]);
            });
            toastr()->success('success','Transaksi berhasil!');
            return redirect('penjualan');
        }catch(Exception $e){
            return redirect()->back();
        }
    }

    public function cetak($no_trx){

        $invoice = DB::table('detail_penjualan')
        ->join('barang','barang.id','detail_penjualan.id_barang')
        ->where('detail_penjualan.no_trx',$no_trx)
        ->get(array(
            'detail_penjualan.*',
            'barang.nama as nama_barang'
        ));

        $total = DB::table('penjualan')
        ->where('no_trx',$no_trx)
        ->get();

        $tgl = DB::table('detail_penjualan')
        ->join('users','users.id','detail_penjualan.id_user')
        ->select('detail_penjualan.id_user','detail_penjualan.created_at as tgl_buat','users.name as nama_user')
        ->limit(1)
        ->get();

        return view('penjualan.cetak',compact('no_trx','invoice','total','tgl'));
    }
}
