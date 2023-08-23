<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\DetailPemesanan;
use App\Models\Pemesanan;
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
        
        $data = Pemesanan::join('detail_pemesanan', 'pemesanan.id', '=', 'detail_pemesanan.id_pemesanan')
        ->join('status_belanjas', 'pemesanan.id', '=', 'status_belanjas.id_pemesanan')
        ->join('produk', 'detail_pemesanan.id_produk', '=', 'produk.id')
        ->join('pelanggan', 'pemesanan.id_pelanggan', '=', 'pelanggan.id')
        ->where('pemesanan.no_nota',$id)
        ->select('status_belanjas.id_pemesanan', 'status_belanjas.keterangan', 'pemesanan.no_nota', 'pemesanan.id_pelanggan', 'pemesanan.tgl', 'detail_pemesanan.id_produk', 'detail_pemesanan.qty', 'detail_pemesanan.harga','produk.nm_produk', 'pelanggan.alamat_pelanggan', 'pelanggan.no_telp', 'pelanggan.email','produk.image')
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
