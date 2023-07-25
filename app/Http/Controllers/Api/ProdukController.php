<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Produk::join('jns_produk', 'produk.id_jns_produk', '=', 'jns_produk.id')
                ->select('produk.*','jns_produk.nm_jns_produk','jns_produk.ket_jns_produk')
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
        $dataProduk = new Produk();
        // pindah file ke direktori public/produk
        $image = $request->file('image');
        $image->storeAs('public/produk', $image->hashName());

        // insert ke sql
        $dataProduk->id_jns_produk = $request->id_jns_produk;
        $dataProduk->nm_produk = $request->nm_produk;
        $dataProduk->qty_produk = $request->qty_produk;
        $dataProduk->harga_jual = $request->harga_jual;
        $dataProduk->harga_beli = $request->harga_beli;
        $dataProduk->keterangan = $request->keterangan;
        $dataProduk->image = $image->hashName();
        
        $post = $dataProduk->save();
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
        // $data = Produk::find($id);
        $data = Produk::join('jns_produk', 'produk.id_jns_produk', '=', 'jns_produk.id')
        ->where('produk.id',$id)
        ->select('produk.*','jns_produk.nm_jns_produk','jns_produk.ket_jns_produk')
        ->get();
        return response()->json([
            'status'=>true,
            'pesan'=>'Data ditemukan',
            'data'=>$data,
        ],200);
    }

    public function showByKat(string $id)
    {
        // $data = Produk::find($id);
        $data = Produk::join('jns_produk', 'produk.id_jns_produk', '=', 'jns_produk.id')
        ->select('produk.*','jns_produk.nm_jns_produk','jns_produk.ket_jns_produk')
        ->where('jns_produk.id',$id)
        ->first();
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
        //find post by ID
        $dataProduk = Produk::find($id);
        if(empty($dataProduk)){
            return response()->json([
                'status'=>false,
                'pesan'=>'Data Tidak Ditemukan',
            ],404);
        }
            
        if ($request->hasFile('image')) {

            //upload image
            $image = $request->file('image');
            $image->storeAs('public/produk', $image->hashName());

            //delete old image
            Storage::delete('public/produk/'.basename($dataProduk->image));

            //update post with new image
            $dataProduk->id_jns_produk = $request->id_jns_produk;
            $dataProduk->nm_produk = $request->nm_produk;
            $dataProduk->qty_produk = $request->qty_produk;
            $dataProduk->harga_jual = $request->harga_jual;
            $dataProduk->harga_beli = $request->harga_beli;
            $dataProduk->keterangan = $request->keterangan;
            $dataProduk->image = $image->hashName();
            $post = $dataProduk->save();
        } else {
            //update post without image
            $dataProduk->id_jns_produk = $request->id_jns_produk;
            $dataProduk->nm_produk = $request->nm_produk;
            $dataProduk->qty_produk = $request->qty_produk;
            $dataProduk->harga_jual = $request->harga_jual;
            $dataProduk->harga_beli = $request->harga_beli;
            $dataProduk->keterangan = $request->keterangan;
            $post = $dataProduk->save();
      
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
        $dataProduk = Produk::find($id);

        if(empty($dataProduk)){
            return response()->json([
                'status'=>false,
                'pesan'=>'Data Tidak Ditemukan',
            ],404);
        }
        $post = $dataProduk->delete();
        return response()->json([
            'status'=>true,
            'pesan'=>'Data Berhasil Dihapus',
        ]);
    }
}
