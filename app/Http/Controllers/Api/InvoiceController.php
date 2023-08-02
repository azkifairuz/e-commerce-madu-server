<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvoiceController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //SELECT status_belanjas.id_pemesanan, status_belanjas.keterangan, pemesanan.no_nota, pemesanan.id_pelanggan, pemesanan.tgl, detail_pemesanan.id_produk, detail_pemesanan.qty, detail_pemesanan.harga FROM pemesanan JOIN detail_pemesanan on pemesanan.id = detail_pemesanan.id_pemesanan JOIN status_belanjas ON pemesanan.id = status_belanjas.id_pemesanan;

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
