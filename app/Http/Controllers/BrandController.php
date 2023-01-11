<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brand = Brand::all();
        return view('brand.index',compact('brand'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brand.create');
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
                Brand::create([
                    'nama' => $request->nama,
                    'created_by' => $user->id,
                    'updated_by' => $user->id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            });

            toastr()->success('Data berhasil disimpan!');
            return redirect('brand');
        }catch(Exception $e){}
        toastr()->error('Data gagal disimpan!');
        return redirect('brand');
        
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
        $brand = DB::table('brand')->where('id',$id)->get();
        return view('brand.edit',compact('brand'));
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
            DB::transaction(function () use($request,$id){
                $user = Auth::user();
                $brand = Brand::find($id);
                $brand->nama = $request->nama;
                $brand->updated_by = $user->id;
                $brand->updated_at = date('Y-m-d H:i:s');
                $brand->save();
            });
            toastr()->success('Data berhasil disimpan!');
            return redirect('brand');
        }catch(Exception $e){}
            toastr()->error('Data berhasil disimpan!');
            return redirect('brand');
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
            DB::transaction(function () use($id) {
                $brand = Brand::find($id);
                $brand->delete(); 
            });
            toastr()->success('Data berhasil dihapus!');
            return redirect('brand');
        }catch(Exception $e){
            toastr()->error('Data berhasil dihapus!');
            return redirect('brand');
        }

   
        
    }
}
