<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Validator;

class UserController extends Controller
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
    public function login(Request $request )
    {
        // mengambil data dari model user hanya yang pertama(first)
        $user = User::where('email',$request->email)->first();

        if($user){
            // selalu update fcm dari user android menyesuaikan dari hp yang digunakan
  
            // $user->fcm = $request->fcm;
            // $user->update();

            if(password_verify($request->password,$user['password'])){
               return response()->json([
                    'success' => 1,
                    'message' => 'Selamat datang ' . $user['name'],
                    'user' => $user
                ]); 
            }else{
                return $this->error('Password Salah.');
            }
        }else{
            return $this->error('Email tidak ditemukan.');
        }

    }

    public function register(Request $request)
    {
        // field yang akan digunakan adalah nama email dan password
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:30',
            'phone' => 'required|unique:users',
            // 'fcm' => 'required'
        ]);



        if ($validator->fails()) {
            $val = $validator->errors()->all();
            return $this->error($val[0]);
        }


        $validated = $validator->validated();

        $validated['password'] = bcrypt($validated['password']);
        $validated['username'] = 'pengguna';

        $inputUser = User::create($validated);
        if ($inputUser) {
            return response()->json([
                'success' => 1,
                'message' => 'Selamat datang register berhasil',
                'user' => $inputUser
            ]);
        } else {
            return $this->error('User Gagal Disimpan.');
        }
    }

    public function error($pesan)
    {
        return response()->json([
                    'success' => 0,
                    'message' => $pesan,
                ]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
