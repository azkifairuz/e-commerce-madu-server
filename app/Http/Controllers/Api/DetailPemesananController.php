<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\DetailPemesanan;
use Illuminate\Http\Request;

class DetailPemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DetailPemesanan::get();
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
        $dataDetailKeranjang = new DetailPemesanan();
        // insert ke sql
        $dataDetailKeranjang->id_pemesanan = $request->id_pemesanan;
        $dataDetailKeranjang->no_nota = $request->no_nota;
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
