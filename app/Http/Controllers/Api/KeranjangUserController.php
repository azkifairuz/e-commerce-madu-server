<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\KeranjangBelanja;
use Illuminate\Http\Request;

class KeranjangUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = KeranjangBelanja:: join('detail_keranjang_belanja', 'detail_keranjang_belanja.id_keranjang_belanja','=','keranjang_belanja.id')
        ->join('produk', 'detail_keranjang_belanja.id_produk','=','produk.id')
        ->select('detail_keranjang_belanja.id as idDetKeranjang', 'keranjang_belanja.id as idKeranjang', 'keranjang_belanja.id_pelanggan', 'keranjang_belanja.tgl', 'detail_keranjang_belanja.id_pelanggan', 'detail_keranjang_belanja.id_produk', 'produk.nm_produk', 'detail_keranjang_belanja.qty', 'detail_keranjang_belanja.harga')
        ->get();
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = KeranjangBelanja:: join('detail_keranjang_belanja', 'detail_keranjang_belanja.id_keranjang_belanja','=','keranjang_belanja.id')
        ->join('produk', 'detail_keranjang_belanja.id_produk','=','produk.id')
        ->where('keranjang_belanja.id_pelanggan',$id)
        ->select('detail_keranjang_belanja.id as idDetKeranjang', 'keranjang_belanja.id as idKeranjang', 'keranjang_belanja.id_pelanggan', 'keranjang_belanja.tgl', 'detail_keranjang_belanja.id_pelanggan', 'detail_keranjang_belanja.id_produk', 'produk.nm_produk', 'detail_keranjang_belanja.qty', 'detail_keranjang_belanja.harga','produk.image')
        ->get();

        return response()->json([
            'status'=>true,
            'pesan'=>'Data ditemukan',
            'data'=>$data,
        ],200);
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
