<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Satuan;
use Auth;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $satuan = Satuan::all();
        return view('satuan.index',compact('satuan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('satuan.create');
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
                Satuan::create([
                    'nama' => $request->nama,
                    'created_by' => $user->id,
                    'updated_by' => $user->id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            });
            toastr()->success('Data berhasil disimpan!');
            return redirect('satuan');
        }catch(Exception $e){
            toastr()->error('Data berhasil disimpan!');
            return redirect('satuan');
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
        $satuan = DB::table('satuan')->where('id',$id)->get();
        return view('satuan.edit',compact('satuan'));
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
                $satuan = Satuan::find($id);
                $satuan->nama = $request->nama;
                $satuan->updated_by = $user->id;
                $satuan->updated_at = date('Y-m-d H:i:s');
                $satuan->save();
            });

            toastr()->success('Data berhasil disimpan!');
            return redirect('satuan');
        }catch(Exception $e){}
        toastr()->error('Data berhasil disimpan!');
        return redirect('satuan');
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
                $satuan = Satuan::find($id);
                $satuan->delete();
            });
            toastr()->success('Data berhasil dihapus!');
            return redirect()->back();
        }catch(Exception $e){
            toastr()->error('Data gagal dihapus!');
            return redirect()->back();
        }



    }
}
