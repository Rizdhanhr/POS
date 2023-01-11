<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Kategori;
use Auth;
class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = Kategori::all();
        return view('kategori.index',compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('kategori.create');
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
            'nama' => 'required|max:100'
        ]);

        try{
            DB::transaction(function () use($request){
                $user = Auth::user();
               Kategori::create([
                    'nama' => $request->nama,
                    'created_by' => $user->id,
                    'updated_by' => $user->id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            });

                toastr()->success('Data berhasil disimpan!');
                return redirect('kategori');

        }catch(Exception $e){
            toastr()->error('Data gagal disimpan!');
            return redirect('kategori');
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
        $kategori = DB::table('kategori')->where('id',$id)->get();
        return view('kategori.edit',compact('kategori'));
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
            'nama' => 'required|max:100'
        ]);

        try{
            DB::transaction(function () use($request,$id) {
                $user = Auth::user();
                $kategori = Kategori::find($id);
                $kategori->nama = $request->nama;
                $kategori->updated_by = $user->id;
                $kategori->updated_at = date('Y-m-d H:i:s');
                $kategori->save();
            });
            toastr()->success('Data berhasil disimpan!');
            return redirect('kategori');
        }catch(Exception $e){
            toastr()->error('Data gagal disimpan!');
            return redirect('kategori');
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
                $kategori = Kategori::find($id);
                $kategori->delete();
            });
            toastr()->success('Data berhasil dihapus!');
            return redirect()->back();
        }catch(Exception $e){
            toastr()->error('Data gagal dihapus!');
            return redirect()->back();
        }
   
    }
}
