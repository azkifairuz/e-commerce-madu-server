<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JnsProduk;
use Illuminate\Http\Request;

class JnsProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = JnsProduk::get();
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
        $dataJnsProduk = new JnsProduk();
        // insert ke sql
        $dataJnsProduk->nm_jns_produk = $request->nm_jns_produk;
        $dataJnsProduk->ket_jns_produk = $request->ket_jns_produk;
       
        $post = $dataJnsProduk->save();
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
        $data = JnsProduk::find($id);
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
        $dataJnsProduk = JnsProduk::find($id);
        if(empty($dataJnsProduk)){
            return response()->json([
                'status'=>false,
                'pesan'=>'Data Tidak Ditemukan',
            ],404);
        }
        
        // insert ke sql
        $dataJnsProduk->nm_jns_produk = $request->nm_jns_produk;
        $dataJnsProduk->ket_jns_produk = $request->ket_jns_produk;
       
        $post = $dataJnsProduk->save();
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
        $dataJnsProduk = JnsProduk::find($id);

        if(empty($dataJnsProduk)){
            return response()->json([
                'status'=>false,
                'pesan'=>'Data Tidak Ditemukan',
            ],404);
        }
        $post = $dataJnsProduk->delete();
        return response()->json([
            'status'=>true,
            'pesan'=>'Data Berhasil Dihapus',
        ]);
    }
}
