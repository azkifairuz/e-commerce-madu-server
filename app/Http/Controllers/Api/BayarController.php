<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DetailPemesanan;
use App\Models\KeranjangBelanja;
use App\Models\Pelanggan;
use App\Models\Pemesanan;
use App\Models\StatusBelanja;
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
        $data = Pemesanan::join('detail_pemesanan', 'pemesanan.id', '=', 'detail_pemesanan.id_pemesanan')
            ->join('status_belanjas', 'pemesanan.id', '=', 'status_belanjas.id_pemesanan')
            ->where('pemesanan.no_nota', $id)
            ->select('status_belanjas.id_pemesanan', 'status_belanjas.keterangan', 'pemesanan.no_nota', 'pemesanan.id_pelanggan', 'pemesanan.tgl', 'detail_pemesanan.id_produk', 'detail_pemesanan.qty', 'detail_pemesanan.harga')
            ->get();
        $totalTagihan = 0;
        foreach ($data as $item) {
            //     $detailPemesanan = new DetailPemesanan();
            //     $detailPemesanan->id_pemesanan = $lastId;
            //     $detailPemesanan->no_nota = $item->idKeranjang;
            //     $detailPemesanan->id_pelanggan = $item->id_pelanggan;
            //     $detailPemesanan->id_produk = $item->id_produk;
            //     $detailPemesanan->qty = $item->qty;
            //     $detailPemesanan->harga = $item->harga;
            //     $detailPemesanan->save();
            $totalTagihan = ($item->harga * $item->qty) + $totalTagihan;
            $idPelanggan = $item->id_pelanggan;
        }
        $dataPelanggan = Pelanggan::find($idPelanggan);


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
                'order_id' => $id,
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
            'data' => $snapToken,
            'pesan' => 'Data berhasil di simpan',
            "redirect_url" => "https://app.sandbox.midtrans.com/snap/v2/vtweb/$snapToken"
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
    public function update(Request $request)
    {
            if ($request->transaction_status == 'capture') {
                $orderId = Pemesanan::join('status_belanjas', 'pemesanan.id', '=', 'status_belanjas.id_pemesanan')
                    ->where('pemesanan.no_nota', $request->order_id)
                    ->select('status_belanjas.id')
                    ->first();
                    // var_dump($orderId->id);
                $order = StatusBelanja::find($orderId->id);
                $order->update(['keterangan' => 'Sudah Dibayar']);
                $order->save();
                return response()->json([
                    'status'=>true,
                    'pesan'=>'Data Berhasil Ditambahkan',
                    'order'=> $order
                ]);
            }
        return response()->json([
            'status'=>false,
            'pesan'=>'transaksi gagal',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}