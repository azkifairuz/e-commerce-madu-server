<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Pelanggan::join('users', 'pelanggan.id','=','users.id_pelanggan')
        ->select('pelanggan.*', 'users.password','users.level')
        ->get();
        // $data = Pelanggan::get();
        
        
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
        $dataPelanggan = new Pelanggan();
        // insert ke sql
        $dataPelanggan->nik = $request->nik;
        $dataPelanggan->nm_pelanggan = $request->nm_pelanggan;
        $dataPelanggan->alamat_pelanggan = $request->alamat_pelanggan;
        $dataPelanggan->tgl_lahir = $request->tgl_lahir;
        $dataPelanggan->tmp_lahir = $request->tmp_lahir;
        $dataPelanggan->jns_kelamin = $request->jns_kelamin;
        $dataPelanggan->email = $request->email;
        $dataPelanggan->no_telp = $request->no_telp;
            
        $post = $dataPelanggan->save();
        $lastId = $dataPelanggan->id;
        return response()->json([
            'status'=>true,
            'pesan'=>'Data Berhasil Ditambahkan',
            'lastId'=>$lastId,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Pelanggan::join('users', 'pelanggan.id','=','users.id_pelanggan')
        ->select('pelanggan.*', 'users.username', 'users.password','users.level')
        ->find($id);
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
        $dataPelanggan = Pelanggan::find($id);
        if(empty($dataPelanggan)){
            return response()->json([
                'status'=>false,
                'pesan'=>'Data Tidak Ditemukan',
            ],404);
        }
      
        // insert ke sql
        $dataPelanggan->nik = $request->nik;
        $dataPelanggan->nm_pelanggan = $request->nm_pelanggan;
        $dataPelanggan->alamat_pelanggan = $request->alamat_pelanggan;
        $dataPelanggan->tgl_lahir = $request->tgl_lahir;
        $dataPelanggan->tmp_lahir = $request->tmp_lahir;
        $dataPelanggan->jns_kelamin = $request->jns_kelamin;
        $dataPelanggan->email = $request->email;
        $dataPelanggan->no_telp = $request->no_telp;
            
        $post = $dataPelanggan->save();
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
        $dataPelanggan = Pelanggan::find($id);

        if(empty($dataPelanggan)){
            return response()->json([
                'status'=>false,
                'pesan'=>'Data Tidak Ditemukan',
            ],404);
        }
        $post = $dataPelanggan->delete();
        return response()->json([
            'status'=>true,
            'pesan'=>'Data Berhasil Dihapus',
        ]);
    }
}
