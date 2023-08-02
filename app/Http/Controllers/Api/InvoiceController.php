<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Pemesanan::join('detail_pemesanan', 'pemesanan.id', '=', 'detail_pemesanan.id_pemesanan')
        ->join('status_belanjas', 'pemesanan.id', '=', 'status_belanjas.id_pemesanan')
        ->select('status_belanjas.id_pemesanan', 'status_belanjas.keterangan', 'pemesanan.no_nota', 'pemesanan.id_pelanggan', 'pemesanan.tgl', 'detail_pemesanan.id_produk', 'detail_pemesanan.qty', 'detail_pemesanan.harga')
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
        //SELECT status_belanjas.id_pemesanan, status_belanjas.keterangan, pemesanan.no_nota, pemesanan.id_pelanggan, pemesanan.tgl, detail_pemesanan.id_produk, detail_pemesanan.qty, detail_pemesanan.harga FROM pemesanan JOIN detail_pemesanan on pemesanan.id = detail_pemesanan.id_pemesanan JOIN status_belanjas ON pemesanan.id = status_belanjas.id_pemesanan;
      
        $data = Pemesanan::join('detail_pemesanan', 'pemesanan.id', '=', 'detail_pemesanan.id_pemesanan')
        ->join('status_belanjas', 'pemesanan.id', '=', 'status_belanjas.id_pemesanan')
        ->where('pemesanan.no_nota',$id)
        ->select('status_belanjas.id_pemesanan', 'status_belanjas.keterangan', 'pemesanan.no_nota', 'pemesanan.id_pelanggan', 'pemesanan.tgl', 'detail_pemesanan.id_produk', 'detail_pemesanan.qty', 'detail_pemesanan.harga')
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
