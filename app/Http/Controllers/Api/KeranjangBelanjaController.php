<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\KeranjangBelanja;
use Illuminate\Http\Request;

class KeranjangBelanjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = KeranjangBelanja::get();
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
        $dataKeranjang = new KeranjangBelanja();
        // insert ke sql
        $dataKeranjang->id_pelanggan = $request->id_pelanggan;
        $dataKeranjang->tgl = $request->tgl;
            
        $post = $dataKeranjang->save();
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
        $data = KeranjangBelanja::find($id);
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
        $dataKeranjang = KeranjangBelanja::find($id);
        if(empty($dataKeranjang)){
            return response()->json([
                'status'=>false,
                'pesan'=>'Data Tidak Ditemukan',
            ],404);
        }
   
        // insert ke sql
        $dataKeranjang->id_pelanggan = $request->id_pelanggan;
        $dataKeranjang->tgl = $request->tgl;
            
        $post = $dataKeranjang->save();
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
        $dataKeranjang = KeranjangBelanja::find($id);

        if(empty($dataKeranjang)){
            return response()->json([
                'status'=>false,
                'pesan'=>'Data Tidak Ditemukan',
            ],404);
        }
        $post = $dataKeranjang->delete();
        return response()->json([
            'status'=>true,
            'pesan'=>'Data Berhasil Dihapus',
        ]);
    }
}
