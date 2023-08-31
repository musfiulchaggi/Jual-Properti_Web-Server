<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gambar;
use App\Models\Properti;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Validator;

class PropertiController extends Controller
{
    public function index()
    {
        $propertis = Properti::with(['get_gambar'])->orderBy('id','DESC')->take(5)->get();

        return response()->json([
                'success' => 1,
                'message' => 'Get produk berhasil',
                'propertis' => $propertis
            ]);
    }

    public function getProperti($id)
    {
        $properti = Properti::with(['get_gambar'])->where('user_id',$id)->orderBy('id','DESC')->first();

        if($properti){
            return response()->json([
                'success' => 1,
                'message' => 'Get produk berhasil',
                'properti' => $properti
            ]);
        }else{
            return $this->error("Data Properti Kosong.");
        }
        
    }

    // upload gambar
    public function upload(Request $request, $id){
        
        $properti = Properti::with(['get_gambar.properti','user'])->where('user_id',$id)->get()->all();
        
        // validasi jumlah gambar
        $count = 0;
         
        foreach($properti as $p){
            foreach ($p['get_gambar'] as $gmb){
                $count+=1;
            }
        }

        if($properti){

            $gambar = Gambar::where('properti_id', $properti[0]['id'])->get();

            // ada data properti maka update dan insert di gambar
            if($count <= 5){
                
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

                    $berhasilsimpan = $request->gambar->storeAs('public/gambar_properti', $fileName);

                };
                
                // $product= Produk::create([
                //             'nama' => $request->nama,
                //             'harga' => $request->harga,
                //             'kategori_id' => $request->kategori_id,
                //             'gambar' => $fileName,
                //             'deskripsi' => $request->deskripsi
                //         ]);

                if($berhasilsimpan){

                    //        insert data gambar
                    $gambar = Gambar::create([
                        'properti_id'=> $properti[0]['id'],
                        'gambar'=>  $fileName,
                        
                    ]);
                    
                    if($gambar){
                        $count += 1;
                    };

                    // //mengirim notif pembatalan ke android
                    // $this->pushNotif("Upload Bukti Transfer Berhasil.","Transaksi id='".$transaksi->id."', Pembayaran transaksi berhasil.",$transaksi->user->fcm); 
                    
                    //mengambil kembali gambar di database 
                    $properti = Properti::with(['get_gambar.properti','user'])->where('user_id',$id)->get();
                    

                    return response()->json([
                            'success' => 1,
                            'message' => 'Berhasil Upload Bukti Transfer.',
                            'propertis' => $properti,
                            'jumlahGambar' => $count
                        ]);
                
                } else{
                    return $this->error("Penyimpanan Gambar Properti di DataBase Gagal.");
                }
            }else{
                return $this->error("Upload gambar mencapai maxlimit.");
            }
        
            
           
        }else{
            // tidak ada data properti
            // maka insert data
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

                    $berhasilsimpan = $request->gambar->storeAs('public/gambar_properti', $fileName);

                };
                
                // $product= Produk::create([
                //             'nama' => $request->nama,
                //             'harga' => $request->harga,
                //             'kategori_id' => $request->kategori_id,
                //             'gambar' => $fileName,
                //             'deskripsi' => $request->deskripsi
                //         ]);

                if($berhasilsimpan){

                    $properti = Properti::create([
                        'user_id'=>$id
                        
                    ]);


                    // //mengirim notif pembatalan ke android
                    // $this->pushNotif("Upload Bukti Transfer Berhasil.","Transaksi id='".$transaksi->id."', Pembayaran transaksi berhasil.",$transaksi->user->fcm); 
                    
                    
                    
                    //        insert data gambar
                    $gambar = Gambar::create([
                        'properti_id'=> $properti['id'],
                        'gambar'=>  $fileName,
                        
                    ]); 
                    
                    //mengambil kembali gambar di database 
                    $properti = Properti::with(['get_gambar.properti','user'])->where('user_id',$id)->get();
                    foreach($properti as $p){
                        foreach ($p['get_gambar'] as $gmb){
                            $count+=1;
                        }
                    }

                    return response()->json([
                            'success' => 1,
                            'message' => 'Berhasil Upload Bukti Transfer.',
                            'propertis' => $properti,
                            'jumlahGambar' => $count
                        ]);
                
                } else{
                    return $this->error("Penyimpanan Gambar Properti di DataBase Gagal.");
                }


            }
        }

        // upload gambar
    public function uploadLokasi(Request $request){

       

        $validator = Validator::make($request->all(),[
            'lattitude' => 'required|max:255',
            'longitude' =>  'required|max:255',
            'provinsi' =>  'required|max:255',
            'kabupaten' => 'required|max:255',
            'kecamatan' =>'required|max:255',
            'user_id' =>'required|max:255',
        ]);

        $id = $request->id;

         if ($validator->fails()) {
            $val = $validator->errors()->all();
            return $this->error($val[0]);
        }

        $validated = $validator->validated();

        
        $properti = Properti::where('id',$id)->get()->all();
        

        if($properti){

            $properti = Properti::find($id);
            $properti->update( $validated );

            //mengambil kembali gambar di database 
            $properti = Properti::with(['get_gambar.properti','user'])->where('id',$id)->get();
                    

            if($properti){
                return response()->json([
                            'success' => 1,
                            'message' => 'Berhasil Upload Lokasi Properti.',
                            'propertis' => $properti
                        ]);
            }else{
                return $this->error("Update data gagal.");
                
            }
           
        }else{

                $properti = Properti::create($validated);

                //mengambil kembali gambar di database 
                $properti = Properti::with(['get_gambar.properti','user'])->where('id',$properti['id'])->get();
                        

                if($properti){
                    return response()->json([
                                'success' => 1,
                                'message' => 'Berhasil Upload Lokasi Properti.',
                                'propertis' => $properti
                            ]);
                }else{
                    return $this->error("Update data gagal.");
                    
                }
            
            }
        }

            // upload gambar
    public function uploadData(Request $request){

       

        $validator = Validator::make($request->all(),[
            'nama_properti' => 'required|max:255',
            'harga' =>  'required|max:255',
            'phone' =>  'required|max:255',
            'email' => 'required|max:255',
            'deskripsi' =>'required|max:255',
            'user_id' =>'required|max:255',
        ]);

        $id = $request->id;

         if ($validator->fails()) {
            $val = $validator->errors()->all();
            return $this->error($val[0]);
        }

        $validated = $validator->validated();

        
        $properti = Properti::where('id',$id)->get()->all();
        

        if($properti){

            $properti = Properti::find($id);
            $properti->update( $validated );

            //mengambil kembali gambar di database 
            $properti = Properti::with(['get_gambar.properti','user'])->where('id',$id)->get();
                    

            if($properti){
                return response()->json([
                            'success' => 1,
                            'message' => 'Berhasil Upload Lokasi Properti.',
                            'propertis' => $properti
                        ]);
            }else{
                return $this->error("Update data gagal.");
                
            }
           
        }else{

                $properti = Properti::create($validated);

                //mengambil kembali gambar di database 
                $properti = Properti::with(['get_gambar.properti','user'])->where('id',$properti['id'])->get();
                        

                if($properti){
                    return response()->json([
                                'success' => 1,
                                'message' => 'Berhasil Upload Lokasi Properti.',
                                'propertis' => $properti
                            ]);
                }else{
                    return $this->error("Update data gagal.");
                    
                }
            
            }
        }

        function delete($id,$user_id){
            $gambar = Gambar::where('gambar',$id)->first();

            if($gambar){
                    //        delete data gambar
                    $gambar->delete();
                    $count=0;

                    if($gambar){
                        //mengambil kembali gambar di database 
                        $properti = Properti::with(['get_gambar.properti','user'])->where('user_id',$user_id)->get();
                        foreach($properti as $p){
                            foreach ($p['get_gambar'] as $gmb){
                                $count+=1;
                            }
                        }

                       return response()->json([
                            'success' => 1,
                            'message' => 'Berhasil Delete Gambar.',
                            'propertis' => $properti,
                            'jumlahGambar' => $count
                        ]);
                    }else{
                        return $this->error("Delete Gambar Gagal.");
                    }

            }else{
                return $this->error("Gambar Tidak Ditemukan.");
            }
        }   


        function deleteProperti($id,$user_id){
            $properti = Properti::where('id',$id)->first();

            if($properti){
                    //        delete data gambar
                    $properti->delete();

                    if($properti){
                        //mengambil kembali gambar di database 
                        $properti = Properti::with(['get_gambar.properti','user'])->where('user_id',$user_id)->get();
                       

                       return response()->json([
                            'success' => 1,
                            'message' => 'Berhasil Delete Gambar.',
                            'propertis' => $properti,
                        ]);
                    }else{
                        return $this->error("Delete Gambar Gagal.");
                    }

            }else{
                return $this->error("Gambar Tidak Ditemukan.");
            }
        }   

       
    

    //  // upload gambar
    // public function test($id){
        
    //     $properti = Properti::with(['get_gambar.properti','user'])->where('user_id',$id)->get()->all();
    //     $gambar = Gambar::where('properti_id', $properti[0]['id'])->get()->all();
    //     $count = 0;
         
    //    foreach($properti as $p){
    //      foreach ($p['get_gambar'] as $gmb){
    //         $count+=1;
    //      }
    //    }

    //     if($properti){
        


    //         // //mengirim notif pembatalan ke android
    //         // $this->pushNotif("Upload Bukti Transfer Berhasil.","Transaksi id='".$transaksi->id."', Pembayaran transaksi berhasil.",$transaksi->user->fcm); 


    //         return response()->json([
    //                 'success' => 1,
    //                 'message' => 'Berhasil Upload Bukti Transfer.',
    //                 'propertis' => $properti,
    //                 'gambars' => $gambar,
    //                 'jumlahGambar'=>$count
    //         ]);
               
           
           
    //     }else{
    //         // return error
    //         return $this->error("Transaksi Gagal");
    //     }


       
    // }


    public function error($pesan)
    {
        return response()->json([
                    'success' => 0,
                    'message' => $pesan,
                ]); 
    }
}
