<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Pegawai::join('users', 'pegawai.id','=','users.id_pegawai')
        ->select('pegawai.*', 'users.name', 'users.password','users.level')
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
        $dataPegawai = new Pegawai();
        // insert ke sql
        $dataPegawai->nik = $request->nik;
        $dataPegawai->nm_pegawai = $request->nm_pegawai;
        $dataPegawai->jns_kelamin = $request->jns_kelamin;
        $dataPegawai->alamat_pegawai = $request->alamat_pegawai;
        $dataPegawai->tgl_lahir = $request->tgl_lahir;
        $dataPegawai->tmp_lahir = $request->tmp_lahir;
        $dataPegawai->email = $request->email;
        $dataPegawai->no_telp = $request->no_telp;
            
        $post = $dataPegawai->save();
        $lastId = $dataPegawai->id;
        return response()->json([
            'status'=>true,
            'pesan'=>'Data Berhasil Ditambahkan',
            'lastId'=>$lastId,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Pegawai::join('users', 'pegawai.id','=','users.id_pegawai')
        ->select('pegawai.*', 'users.name', 'users.password','users.level')
        ->find($id);
        if($data){
            return response()->json([
                'status'=>true,
                'pesan'=>'Data ditemukan',
                'data'=>$data,
            ], 200);
        }else{
            return response()->json([
                'status'=>false,
                'pesan'=>'Data tidak ditemukan',
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dataPegawai = Pegawai::find($id);
        if(empty($dataPegawai)){
            return response()->json([
                'status'=>false,
                'pesan'=>'Data Tidak Ditemukan',
            ],404);
        }
   
        // insert ke sql
        $dataPegawai->nik = $request->nik;
        $dataPegawai->nm_pegawai = $request->nm_pegawai;
        $dataPegawai->jns_kelamin = $request->jns_kelamin;
        $dataPegawai->alamat_pegawai = $request->alamat_pegawai;
        $dataPegawai->tgl_lahir = $request->tgl_lahir;
        $dataPegawai->tmp_lahir = $request->tmp_lahir;
        $dataPegawai->email = $request->email;
        $dataPegawai->no_telp = $request->no_telp;
            
        $post = $dataPegawai->save();
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
        $dataPegawai = Pegawai::find($id);

        if(empty($dataPegawai)){
            return response()->json([
                'status'=>false,
                'pesan'=>'Data Tidak Ditemukan',
            ],404);
        }
        $post = $dataPegawai->delete();
        return response()->json([
            'status'=>true,
            'pesan'=>'Data Berhasil Dihapus',
        ]);
    }
}
