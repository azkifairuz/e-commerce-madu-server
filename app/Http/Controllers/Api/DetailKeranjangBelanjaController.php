<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\DetailKeranjangBelanja;
use App\Models\KeranjangBelanja;
use Illuminate\Http\Request;

class DetailKeranjangBelanjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = KeranjangBelanja::join('pelanggan', 'keranjang_belanja.id_pelanggan', '=', 'pelanggan.id')
        ->select('keranjang_belanja n.*','pelanggan.*')
        ->get();
        $data = DetailKeranjangBelanja::get();
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
        $dataDetailKeranjang = new DetailKeranjangBelanja();
        // insert ke sql
        $dataDetailKeranjang->id_keranjang_belanja = $request->id_keranjang_belanja;
        $dataDetailKeranjang->id_pelanggan = $request->id_pelanggan;
        $dataDetailKeranjang->id_produk = $request->id_produk;
        $dataDetailKeranjang->qty = $request->qty;
        $dataDetailKeranjang->harga = $request->harga;
            
        $post = $dataDetailKeranjang->save();
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
        $data = DetailKeranjangBelanja::find($id);
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
        $dataDetailKeranjang = DetailKeranjangBelanja::find($id);
        if(empty($dataDetailKeranjang)){
            return response()->json([
                'status'=>false,
                'pesan'=>'Data Tidak Ditemukan',
            ],404);
        }
   
        // insert ke sql
        $dataDetailKeranjang->id_keranjang_belanja = $request->id_keranjang_belanja;
        $dataDetailKeranjang->id_pelanggan = $request->id_pelanggan;
        $dataDetailKeranjang->id_produk = $request->id_produk;
        $dataDetailKeranjang->qty = $request->qty;
        $dataDetailKeranjang->harga = $request->harga;
            
        $post = $dataDetailKeranjang->save();
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
        $dataDetailKeranjang = DetailKeranjangBelanja::find($id);

        if(empty($dataDetailKeranjang)){
            return response()->json([
                'status'=>false,
                'pesan'=>'Data Tidak Ditemukan',
            ],404);
        }
        $post = $dataDetailKeranjang->delete();
        return response()->json([
            'status'=>true,
            'pesan'=>'Data Berhasil Dihapus',
        ]);
    }
}
