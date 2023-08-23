<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserCotroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::get();
        return response()->json([
            'status'=>true,
            'pesan'=>'Data ditemukan',
            'data'=>$data,
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $user = User::create([
        //     'id_pelanggan'=>request('id_pelanggan'),
        //     'id_pegawai'=>request('id_pegawai'),
        //     'name'=>request('name'),
        //     'email'=>request('email'),
        //     'password'=> Hash::make(request('password')),
        //     'level'=> request('password'),
        // ]);
        // if($user){
        //     return response()->json(['message' => 'Successfully Akun Create']);
        // }else{
        //     return response()->json(['message' => 'Akun Gagal Dibuat']);
        // }

        $dataAkun = new User();
        // insert ke sql
        $dataAkun->id_pelanggan = $request->id_pelanggan;
        $dataAkun->id_pegawai = $request->id_pegawai;
        $dataAkun->name = $request->name;
        $dataAkun->email = $request->email;
        $dataAkun->password = Hash::make($request->password);
        $dataAkun->level = $request->level;
     
        $post = $dataAkun->save();
        return response()->json([
            'status'=>true,
            'pesan'=>'Data Berhasil Ditambahkan',
        ]);


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = User::find($id);
        if($data){
            return response()->json([
                'status'=>true,
                'pesan'=>'Data ditemukan',
                'data'=>$data,
            ], 200);
        }else{
            return response()->json([
                'status'=>false,
                'pesan'=>'Data tidak ditemukan',
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dataAkun = User::find($id);
        if(empty($dataAkun)){
            return response()->json([
                'status'=>false,
                'pesan'=>'Data Tidak Ditemukan',
            ],404);
        }
        // falidasi
        // $rules=[
        //     'judul' => 'required',
        //     'pengarang' => 'required',
        //     'tanggal_publikasi' => 'required|date',
        // ];
        // insert ke sql
        $dataAkun->id_pelanggan = $request->id_pelanggan;
        $dataAkun->id_pegawai = $request->id_pegawai;
        $dataAkun->name = $request->name;
        $dataAkun->email = $request->email;
        $dataAkun->password = Hash::make($request->password);
        $dataAkun->level = $request->level;
     
        $post = $dataAkun->save();
        return response()->json([
            'status'=>true,
            'pesan'=>'Data Berhasil Ditambahkan',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dataAkun = User::find($id);

        if(empty($dataAkun)){
            return response()->json([
                'status'=>false,
                'pesan'=>'Data Tidak Ditemukan',
            ],404);
        }
        $post = $dataAkun->delete();
        return response()->json([
            'status'=>true,
            'pesan'=>'Data Berhasil Dihapus',
        ]);
    }
}
