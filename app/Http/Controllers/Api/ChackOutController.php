<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DetailPemesanan;
use App\Models\KeranjangBelanja;
use App\Models\Pemesanan;
use Illuminate\Http\Request;

class ChackOutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dataPemesanan = KeranjangBelanja::where('id_pelanggan',$id)
        ->select('id as no_nota', 'id_pelanggan', 'tgl' )
        ->first();
    
        $noNota = "user-0000".$dataPemesanan->no_nota;
        $pemesanan = new Pemesanan();
        // insert ke sql pemesanan
        $pemesanan->no_nota = $noNota;
        $pemesanan->id_pelanggan = $dataPemesanan->id_pelanggan;
        $pemesanan->tgl = $dataPemesanan->tgl;            
        $pemesanan->save();
        $lastId = $pemesanan->id;
        
        $dataBarang = KeranjangBelanja:: join('detail_keranjang_belanja', 'detail_keranjang_belanja.id_keranjang_belanja','=','keranjang_belanja.id')
        ->join('produk', 'detail_keranjang_belanja.id_produk','=','produk.id')
        ->where('keranjang_belanja.id_pelanggan',$id)
        ->select('detail_keranjang_belanja.id as idDetKeranjang', 'keranjang_belanja.id as idKeranjang', 'keranjang_belanja.id_pelanggan', 'keranjang_belanja.tgl', 'detail_keranjang_belanja.id_pelanggan', 'detail_keranjang_belanja.id_produk', 'produk.nm_produk', 'detail_keranjang_belanja.qty', 'detail_keranjang_belanja.harga' )
        ->get();
        
        foreach ($dataBarang as $item) {
            $detailPemesanan = new DetailPemesanan();
            $detailPemesanan->id_pemesanan = $lastId;
            $detailPemesanan->no_nota = $noNota;
            $detailPemesanan->id_pelanggan = $item->id_pelanggan;
            $detailPemesanan->id_produk = $item->id_produk;
            $detailPemesanan->qty = $item->qty;
            $detailPemesanan->harga = $item->harga;
            $detailPemesanan->save();
        }
        //buat hapus

        return response()->json([
            'data'=>$noNota,
            'pesan'=>'Data berhasil di simpan',
        ], 200);
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
