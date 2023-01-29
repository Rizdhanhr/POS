<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pembelian = DB::table('pembelian')
        ->orderBy('created_at','desc')
        ->get();
        return view('pembelian.index',compact('pembelian'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $kode = 'TRX';
        $barang = DB::select('SELECT SUM(total) as jumlah FROM ( SELECT COUNT(DISTINCT(no_trx)) as total FROM detail_pembelian where status = 1 GROUP BY no_trx ) hasil');

        // DD((int)$barang[0]->jumlah+1);
        if($barang[0]->jumlah < 10){
            $sku = $kode.'00'.((int)$barang[0]->jumlah+1);
        }else if($barang[0]->jumlah > 10 && $barang[0]->jumlah < 100){
            $sku = $kode.'0'.((int)$barang[0]->jumlah+1);
        }else{
            $sku = $kode.((int)$barang[0]->jumlah+1);
        }

        $user = Auth::user();
        $barang = DB::table('barang')->get();
        $supplier = DB::table('supplier')->get();
        $pembelian = DB::table('detail_pembelian')
        ->join('barang','barang.id','detail_pembelian.id_barang')
        ->where('detail_pembelian.status',0)
        ->where('detail_pembelian.id_user',$user->id)
        ->get(array(
            'detail_pembelian.*',
            'barang.nama as nama_barang'
        ));
        $total = DB::table('detail_pembelian')
        ->where('status',0)
        ->where('id_user',$user->id)
        ->sum('subtotal');
        return view('pembelian.create',compact('pembelian','barang','supplier','total','user','sku'));
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
                $sub_total = DB::table('detail_pembelian')
                ->where('id_barang',$request->barang)
                ->where('status',0)
                ->sum('subtotal');
                $cek = DB::table('detail_pembelian')
                ->where('id_barang',$request->barang)
                ->where('status',0)
                ->count();
                if($cek > 0){

                    $cekqty = DB::table('detail_pembelian')
                    ->where('id_barang',$request->barang)
                    ->where('status',0)
                    ->get();
                    DB::table('detail_pembelian')
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
                    DB::table('detail_pembelian')->insert(
                        [
                            'id_barang' => $request->barang,
                            'jumlah' => $request->jumlah,
                            'id_user' => $user->id,
                            'harga' => $request->harga,
                            'subtotal' => $request->harga * $request->jumlah
                        ]
                    );
                }
            });
            toastr()->success('Barang berhasil dimasukkan cart!');
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
        $detail = DB::table('detail_pembelian')
        ->join('barang','barang.id','detail_pembelian.id_barang')
        ->select('detail_pembelian.*','barang.nama as nama_barang')
        ->where('detail_pembelian.no_trx',$no_trx)
        ->get();
        return view('pembelian.show',compact('detail'));
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
                DB::table('detail_pembelian')
                ->where('id',$id)
                ->delete();
            });
            toastr()->success('success','Cart berhasil dihapus!');
            return redirect()->back();
        }catch(Exception $e){
            toastr()->success('error','Cart gagal dihapus!');
            return redirect()->back();
        }

    }

    public function getbarang($id){
        $barang = DB::table('barang')->where('id',$id)->get();
        return $barang[0];
    }

    public function clear($id){
        try{
            DB::transaction(function () use($id){
                DB::table('detail_pembelian')
                ->where('id_user',$id)
                ->delete();
            });
            toastr()->success('success','Cart berhasil dibersihkan!');
            return redirect()->back();
        }catch(Exception $e){
            toastr()->success('error','Cart gagal dibersihkan!');
            return redirect()->back();
        }

    }

    public function prosespembelian(Request $request ){

            $this->validate($request,[
             'supplier' => 'required|gt:0'
            ]);

        try{
            DB::transaction(function () use($request){
                $user = Auth::user();
                $kode = 'TRX';
                $barang = DB::select('SELECT SUM(total) as jumlah FROM ( SELECT COUNT(DISTINCT(no_trx)) as total FROM detail_pembelian where status = 1 GROUP BY no_trx ) hasil');

                // DD((int)$barang[0]->jumlah+1);
                if($barang[0]->jumlah < 10){
                    $sku = $kode.'00'.((int)$barang[0]->jumlah+1);
                }else if($barang[0]->jumlah > 10 && $barang[0]->jumlah < 100){
                    $sku = $kode.'0'.((int)$barang[0]->jumlah+1);
                }else{
                    $sku = $kode.((int)$barang[0]->jumlah+1);
                }

                $cek = DB::table('detail_pembelian')
                ->where('status',0)
                ->count();

                if($cek == 0 ){
                        toastr()->error('error','Cart Kosong!');
                }else{
                    DB::table('detail_pembelian')->where('status',0)->update(
                        [
                            'no_trx' => $sku,
                            'id_supplier' => $request->supplier,
                            'status' => 1,
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s'),
                            'created_by' => $user->id,
                            'updated_by' => $user->id
                        ]
                    );

                $updatebarang = DB::table('detail_pembelian')
                ->join('barang','barang.id','detail_pembelian.id_barang')
                ->where('no_trx',$sku)
                ->get(array(
                    'detail_pembelian.*',
                    'barang.stok as barang_stok',
                ));

                foreach($updatebarang as $row){
                    DB::table('barang')->where('id',$row->id_barang)->update(
                        [
                            'stok' => $row->barang_stok + $row->jumlah

                        ]
                    );
                }

                $jumlah = DB::table('detail_pembelian')
                ->where('no_trx',$sku)->sum('jumlah');
                $harga = DB::table('detail_pembelian')
                ->where('no_trx',$sku)->sum('subtotal');
                DB::table('pembelian')->insert([
                    'no_trx' => $sku,
                    'jumlah' => $jumlah,
                    'harga' => $harga,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'created_by' => $user->id,
                    'updated_by' => $user->id
                ]);
                toastr()->success('success','Transaksi berhasil!');
                }
            });


            return redirect()->back();
        }catch(Exception $e){
            return redirect()->back();
        }




    }

    public function cetak($no_trx){

        $tgl = DB::table('detail_pembelian')
        ->where('no_trx',$no_trx)
        ->limit(1)
        ->get();

        $supplier = DB::table('detail_pembelian')
        ->join('supplier','supplier.id','detail_pembelian.id_supplier')
        ->where('no_trx',$no_trx)
        ->select('detail_pembelian.id_supplier','supplier.nama as nama_supplier')
        ->groupBy('detail_pembelian.id_supplier','supplier.nama')
        ->get();

        $invoice = DB::table('detail_pembelian')
        ->join('barang','barang.id','detail_pembelian.id_barang')
        ->where('no_trx',$no_trx)
        ->where('status',1)
        ->get(array(
            'detail_pembelian.*',
            'barang.nama as nama_barang'
        ));

        $total = DB::table('detail_pembelian')
        ->where('no_trx',$no_trx)
        ->where('status','1')
        ->sum('detail_pembelian.subtotal');

        $admin = DB::table('detail_pembelian')
        ->join('users','users.id','detail_pembelian.id_user')
        ->where('detail_pembelian.no_trx',$no_trx)
        ->select('detail_pembelian.id_user','users.name as nama_user')
        ->groupBy('detail_pembelian.id_user','users.name')
        ->get();
        return view('pembelian.cetak',compact('no_trx','tgl','invoice','supplier','total','admin'));
    }
}
