<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier = DB::table('supplier')->get();
        return view('supplier.index',compact('supplier'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supplier.create');
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
            'nama' => 'required|max:100',
            'no' => 'required|numeric|digits_between:5,20',
            'alamat' => 'required|max:200'
        ]);

        try{
            DB::transaction(function () use($request){
                $user = Auth::user();
                DB::table('supplier')->insert([
                'nama' => $request->nama,
                'no' => $request->no,
                'alamat' => $request->alamat,
                'created_by' => $user->id,
                'updated_by' => $user->id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
                ]);
            });
            toastr()->success('Data berhasil disimpan!');
            return redirect('supplier');
        }catch(Exception $e){
            toastr()->error('Data gagal disimpan!');
            return redirect('supplier');
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
        $supplier = DB::table('supplier')->where('id',$id)->get();
        return view('supplier.edit',compact('supplier'));
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
            'nama' => 'required|max:100',
            'no' => 'required|numeric|digits_between:5,20',
            'alamat' => 'required|max:200'
        ]);

        try{
            DB::transaction(function () use($request,$id){
                $user = Auth::user();
                DB::table('supplier')->where('id',$id)->update([
                'nama' => $request->nama,
                'no' => $request->no,
                'alamat' => $request->alamat,
                'updated_by' => $user->id,
                'updated_at' => date('Y-m-d H:i:s')
                ]);
            });
            toastr()->success('Data berhasil disimpan!');
            return redirect('supplier');
        }catch(Exception $e){
            toastr()->error('Data gagal disimpan!');
            return redirect('supplier');
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
                DB::table('supplier')->where('id',$id)->delete();
            });
            toastr()->success('Data berhasil dihapus!');
            return redirect()->back();
        }catch(Exception $e){
            toastr()->success('Data gagal dihapus!');
            return redirect()->back();
        }
    }
}
