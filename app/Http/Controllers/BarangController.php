<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth; 
use DB;


class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = DB::table('barang')
        ->join('kategori','kategori.id','barang.id_kategori')
        ->join('brand','brand.id','barang.id_brand')
        ->join('satuan','satuan.id','barang.id_satuan')
        ->orderBy('updated_at','desc')
        ->get(array(
            'barang.*',
            'kategori.nama as nama_kategori',
            'brand.nama as nama_brand',
            'satuan.nama as nama_satuan'
        ));
        return view('barang.index',compact('barang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $q = DB::table('barang')->select(DB::raw('MAX(RIGHT(kode,4)) as kodebr'));
        $kd="";
        if($q->count()>0){
            foreach($q->get() as $k){
                $tmp = ((int)$k->kodebr)+1;
                $kd = sprintf("%04s",$tmp);
            }
        }
        else{
            // $kd = date('Y-m-d').'-'."0001";
            $kd = "0001";
        }

        $kategori = DB::table('kategori')->get();
        $satuan = DB::table('satuan')->get();
        $brand = DB::table('brand')->get();
        return view('barang.create',compact('kd','kategori','satuan','brand'));
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
            'nama' => 'required',
            'kategori' => 'required|gt:0',
            'brand' => 'required|gt:0',
            'satuan' => 'required|gt:0',
            'stok' => 'required|max:11',
            'stok_minim' => 'required|max:11',
            'harga_beli' => 'required|max:20',
            'harga_jual' => 'required|max:20',
            'gambar' => 'mimes:png,jpeg,jpg'
        ]);

        try{
            DB::transaction(function () use($request){
                $user = Auth::user();
                if($file = $request->file('gambar')){
                    $nama_file = time()."_".$file->getClientOriginalName();
                    $tujuan_upload = 'barang_gambar';
                    $file->move($tujuan_upload,$nama_file);
                    $barang = DB::table('barang')->insert([
                        'kode' => $request->kode,
                        'id_kategori' => $request->kategori,
                        'nama' => $request->nama,
                        'id_brand' => $request->brand,
                        'id_satuan' => $request->satuan,
                        'stok' => $request->stok,
                        'stok_minimal' => $request->stok_minim,
                        'spesifikasi' => $request->ket,
                        'lokasi' => $request->lokasi,
                        'harga_beli' => $request->harga_beli,
                        'harga_jual' => $request->harga_jual,
                        'stok' => $request->stok,
                        'gambar' => $tujuan_upload.'/'.$nama_file,
                        'created_by' => $user->id,
                        'updated_by' => $user->id,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                }else{
                    $barang = DB::table('barang')->insert([
                        'kode' => $request->kode,
                        'id_kategori' => $request->kategori,
                        'nama' => $request->nama,
                        'id_brand' => $request->brand,
                        'id_satuan' => $request->satuan,
                        'stok' => $request->stok,
                        'stok_minimal' => $request->stok_minim,
                        'spesifikasi' => $request->ket,
                        'lokasi' => $request->lokasi,
                        'harga_beli' => $request->harga_beli,
                        'harga_jual' => $request->harga_jual,
                        'stok' => $request->stok,
                        'created_by' => $user->id,
                        'updated_by' => $user->id,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                }
            });
            toastr()->success('Data berhasil disimpan!');
            return redirect('/barang');
        }catch(Exception $e){
            toastr()->error('Data gagal disimpan!');
            return redirect('/barang');
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
        $barang = DB::table('barang')
        ->join('kategori','kategori.id','barang.id_kategori')
        ->join('brand','brand.id','barang.id_brand')
        ->join('satuan','satuan.id','barang.id_satuan')
        ->select('barang.*','kategori.nama as nama_kategori','brand.nama as nama_brand','satuan.nama as nama_satuan')
        ->where('barang.id',$id)->get();
        return view('barang.show',compact('barang'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $barang = DB::table('barang')->where('id',$id)->get();
        $kategori = DB::table('kategori')->get();
        $satuan = DB::table('satuan')->get();
        $brand = DB::table('brand')->get();
        return view('barang.edit',compact('barang','kategori','brand','satuan'));
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
        $this->validate($request,[
            'nama' => 'required',
            'kategori' => 'required|gt:0',
            'brand' => 'required|gt:0',
            'satuan' => 'required|gt:0',
            'stok' => 'required|max:11',
            'stok_minim' => 'required|max:11',
            'harga_beli' => 'required|max:20',
            'harga_jual' => 'required|max:20',
            'gambar' => 'mimes:png,jpeg,jpg'
        ]);

        try{
            DB::transaction(function  () use ($request,$id) {
                $user = Auth::user();
                if($request->hasfile('gambar')){
                    $file = $request->file('gambar');
                    $nama_file = time()."_".$file->getClientOriginalName();
                    $tujuan_upload = 'barang_gambar';
                    $file->move($tujuan_upload,$nama_file);
                    $barang = DB::table('barang')->where('id',$id)->update([
                        'id_kategori' => $request->kategori,
                        'nama' => $request->nama,
                        'id_brand' => $request->brand,
                        'id_satuan' => $request->satuan,
                        'stok' => $request->stok,
                        'stok_minimal' => $request->stok_minim,
                        'spesifikasi' => $request->ket,
                        'lokasi' => $request->lokasi,
                        'harga_beli' => $request->harga_beli,
                        'harga_jual' => $request->harga_jual,
                        'stok' => $request->stok,
                        'gambar' => $tujuan_upload.'/'.$nama_file,
                        'updated_by' => $user->id,
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                  }else{
                    $barang = DB::table('barang')->where('id',$id)->update([
                        'id_kategori' => $request->kategori,
                        'nama' => $request->nama,
                        'id_brand' => $request->brand,
                        'id_satuan' => $request->satuan,
                        'stok' => $request->stok,
                        'stok_minimal' => $request->stok_minim,
                        'spesifikasi' => $request->ket,
                        'lokasi' => $request->lokasi,
                        'harga_beli' => $request->harga_beli,
                        'harga_jual' => $request->harga_jual,
                        'stok' => $request->stok,
                        'updated_by' => $user->id,
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                    
                  }
            });
            toastr()->success('Data berhasil diupdate!');
            return redirect('/barang');
           }catch(Exception $e){
            toastr()->error('Data gagal diupdate!');
            return redirect('/barang');
    
           }
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
                DB::table('barang')->where('id',$id)->delete();
            });
            toastr()->success('Data berhasil dihapus!');
            return redirect()->back();
        }catch(Exception $e){
            toastr()->error('Data gagal dihapus!');
            return redirect()->back();
        }
    }

   

}
