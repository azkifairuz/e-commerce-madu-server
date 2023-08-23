<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\StatusBelanja;
use Illuminate\Http\Request;

class StatusByNotaController extends Controller
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
        $data = StatusBelanja::where('id_pemesanan',$id)
        ->get();
        return response()->json([
            'data'=>$data,
            'status'=>true,
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
