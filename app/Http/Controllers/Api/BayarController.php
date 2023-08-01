<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DetailPemesanan;
use App\Models\KeranjangBelanja;
use App\Models\Pelanggan;
use App\Models\Pemesanan;
use Illuminate\Http\Request;

class BayarController extends Controller
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
    public function store(string $id)
    {
        $dataPemesanan = KeranjangBelanja::where('id_pelanggan',$id)
        ->select('id as no_nota', 'id_pelanggan', 'tgl' )
        ->first();

        $noNota = "user-0000".$dataPemesanan->no_nota;
        // $pemesanan = new Pemesanan();
        // // insert ke sql pemesanan
        // $pemesanan->no_nota = $$noNota;
        // $pemesanan->id_pelanggan = $dataPemesanan->id_pelanggan;
        // $pemesanan->tgl = $dataPemesanan->tgl;            
        // $pemesanan->save();
        // $lastId = $pemesanan->id;
        
        $dataBarang = KeranjangBelanja:: join('detail_keranjang_belanja', 'detail_keranjang_belanja.id_keranjang_belanja','=','keranjang_belanja.id')
        ->join('produk', 'detail_keranjang_belanja.id_produk','=','produk.id')
        ->where('keranjang_belanja.id_pelanggan',$id)
        ->select('detail_keranjang_belanja.id as idDetKeranjang', 'keranjang_belanja.id as idKeranjang', 'keranjang_belanja.id_pelanggan', 'keranjang_belanja.tgl', 'detail_keranjang_belanja.id_pelanggan', 'detail_keranjang_belanja.id_produk', 'produk.nm_produk', 'detail_keranjang_belanja.qty', 'detail_keranjang_belanja.harga' )
        ->get();
        $totalTagihan=0;
        foreach ($dataBarang as $item) {
        //     $detailPemesanan = new DetailPemesanan();
        //     $detailPemesanan->id_pemesanan = $lastId;
        //     $detailPemesanan->no_nota = $item->idKeranjang;
        //     $detailPemesanan->id_pelanggan = $item->id_pelanggan;
        //     $detailPemesanan->id_produk = $item->id_produk;
        //     $detailPemesanan->qty = $item->qty;
        //     $detailPemesanan->harga = $item->harga;
        //     $detailPemesanan->save();
            $totalTagihan = ($item->harga * $item->qty)+$totalTagihan;
        }
        $dataPelanggan = Pelanggan::find($id);


        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $noNota,
                'gross_amount' => $totalTagihan,
            ),
            'customer_details' => array(
                'first_name' => $dataPelanggan->nm_pelanggan,
                // 'last_name' => 'pratama',
                'email' => $dataPelanggan->email,
                'phone' => $dataPelanggan->no_telp,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return response()->json([
            'data'=>$snapToken,
            'pesan'=>'Data berhasil di simpan',
        ], 200);

        // if($data){
        //     return response()->json([
        //         'status'=>true,
        //         'pesan'=>'Data ditemukan',
        //         'data'=>$data,
        //     ], 200);
        // }else{
        //     return response()->json([
        //         'status'=>false,
        //         'pesan'=>'Data tidak ditemukan',
        //     ], 400);
        // }
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
