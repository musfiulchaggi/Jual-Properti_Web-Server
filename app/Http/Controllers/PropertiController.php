<?php

namespace App\Http\Controllers;

use App\Models\Gambar;
use Illuminate\Http\Request;
use App\Models\Properti;

class PropertiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $properti['listProperti'] = Properti::all();
        $properti['listGambar'] = Gambar::all();
        return view('admin.main.properti', [
            "title" => "Properti"
        ])->with($properti);
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
    //    dd($request->all());
        $this->validate($request, [
            // check validtion for image or file
                  'gambar' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
              ]);

        $file="";
        if($request->gambar->getClientOriginalName()){
            // mengubah terlebih dahulu untuk menghilangkan tanda spasi
            $file = str_replace(' ','',$request->gambar->getClientOriginalName());
            
            $fileName = date('mYdHs').rand(800,999).'_'.$file;

            $request->gambar->storeAs('public/gambar_properti', $fileName);

        };
        
        $product= Properti::create([
                    'user_id' => $request->user_id,
                    'harga' => $request->harga,
                    'lattitude' => $request->lattitude,
                    'longitude' => $request->longitude,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'provinsi' => $request->provinsi,
                    'kabupaten' => $request->kabupaten,
                    'kecamatan' => $request->kecamatan,
                    'deskripsi' => $request->deskripsi
                ]);

        if($product){
            Gambar::create([
                'properti_id' => $product->id,
                'gambar'=> $fileName
            ]);
        }

        return redirect('/properti');
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
}
