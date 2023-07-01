<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Akun;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Akun::get();
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
        $dataAkun = new Akun();
        // insert ke sql
        $dataAkun->id_pelanggan = $request->id_pelanggan;
        $dataAkun->id_pegawai = $request->id_pegawai;
        $dataAkun->username = $request->username;
        $dataAkun->password = $request->password;
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
        $data = Akun::find($id);
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
        $dataAkun = Akun::find($id);
        if(empty($dataAkun)){
            return response()->json([
                'status'=>false,
                'pesan'=>'Data Tidak Ditemukan',
            ],404);
        }
        // falidasi
        $rules=[
            'judul' => 'required',
            'pengarang' => 'required',
            'tanggal_publikasi' => 'required|date',
        ];
        // insert ke sql
        $dataAkun->id_pelanggan = $request->id_pelanggan;
        $dataAkun->id_pegawai = $request->id_pegawai;
        $dataAkun->username = $request->username;
        $dataAkun->password = $request->password;
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
        //
    }
}
