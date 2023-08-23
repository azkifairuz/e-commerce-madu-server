<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\StatusBelanja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StatusController extends Controller
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
        $status = new StatusBelanja();
        // insert ke sql
        $status->id_pemesanan = $request->id_pemesanan;
        $status->keterangan = $request->keterangan;
        // $status->image = "";

        $post = $status->save();
        return response()->json([
            'status' => true,
            'pesan' => 'Data Berhasil Ditambahkan',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $status = StatusBelanja::find($id);
        if (empty($status)) {
            return response()->json([
                'status' => false,
                'pesan' => 'Data Tidak Ditemukan',
            ], 404);
        }
        $status->id_pemesanan = $id;
        $status->keterangan = "Sedang Dikemas";

        $post = $status->save();
        return response()->json([
            'status' => true,
            'pesan' => 'Data Berhasil Ditambahkan',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $status = StatusBelanja::find($id);
        
        if (empty($status)) {
            return response()->json([
                'status' => false,
                'pesan' => 'Data Tidak Ditemukan',
            ], 404);
        }

        if ($request->hasFile('image')) {
        //upload image
        $image = $request->file('image');
        $image->storeAs('public/produk', $image->hashName());


        //update post with new image
        $status->id_pemesanan = $request->id_pemesanan;
        $status->keterangan = "$request->keterangan";
        $status->image = $request->image;
        $post = $status->save();
        } else {
        //update post without image
        $status->id_pemesanan = $request->id_pemesanan;
        $status->keterangan = "$request->keterangan";
        $status->image = $request->image;
        $post = $status->save();

        }
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
        //
    }
}