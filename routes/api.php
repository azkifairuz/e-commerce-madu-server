<?php

use App\Http\Controllers\api\DetailKeranjangBelanjaController;
use App\Http\Controllers\api\DetailPemesananController;
use App\Http\Controllers\Api\JnsProdukController;
use App\Http\Controllers\api\KeranjangBelanjaController;
use App\Http\Controllers\Api\PegawaiController;
use App\Http\Controllers\Api\PelangganController;
use App\Http\Controllers\api\PemesananController;
use App\Http\Controllers\Api\ProdukController;
use App\Http\Controllers\Api\KatProdukController;
use App\Http\Controllers\api\UserCotroller;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//
Route::post('register',[UserCotroller::class,'store']);
Route::get('user',[UserCotroller::class,'index']);
Route::put('user/{id}',[UserCotroller::class,'update']);
Route::get('user/{id}',[UserCotroller::class,'show']);

// route akun
// Route::get('akun',[AkunController::class,'index']);
// Route::get('akun/{id}',[AkunController::class,'show']);
// Route::post('akun',[AkunController::class,'store']);
// Route::put('akun/{id}',[AkunController::class,'update']);
// Route::delete('akun/{id}',[AkunController::class,'destroy']);

//  route pegawai
Route::get('pegawai',[PegawaiController::class,'index']);
Route::get('pegawai/{id}',[PegawaiController::class,'show']);
Route::post('pegawai',[PegawaiController::class,'store']);
Route::put('pegawai/{id}',[PegawaiController::class,'update']);
Route::delete('pegawai/{id}',[PegawaiController::class,'destroy']);

// route pelanggan
Route::get('pelanggan',[PelangganController::class,'index']);
Route::get('pelanggan/{id}',[PelangganController::class,'show']);
Route::post('pelanggan',[PelangganController::class,'store']);
Route::put('pelanggan/{id}',[PelangganController::class,'update']);
Route::delete('pegawai/{id}',[PelangganController::class,'destroy']);

// route jnsproduk
Route::get('jnsproduk',[JnsProdukController::class,'index']);
Route::get('jnsproduk/{id}',[JnsProdukController::class,'show']);
Route::post('jnsproduk',[JnsProdukController::class,'store']);
Route::put('jnsproduk/{id}',[JnsProdukController::class,'update']);
Route::delete('jnsproduk/{id}',[JnsProdukController::class,'destroy']);

// route produk
Route::get('produk',[ProdukController::class,'index']);
Route::get('produk/{id}',[ProdukController::class,'show']);
Route::post('produk',[ProdukController::class,'store']);
Route::post('produk/{id}',[ProdukController::class,'update']);
Route::delete('produk/{id}',[ProdukController::class,'destroy']);

// kategori produk
Route::get('katproduk/{id}',[KatProdukController::class,'show']);


// route keranjang belanja 
Route::get('keranjangbelanja',[KeranjangBelanjaController::class,'index']);
Route::get('keranjangbelanja/{id}',[KeranjangBelanjaController::class,'show']);
Route::post('keranjangbelanja',[KeranjangBelanjaController::class,'store']);
Route::post('keranjangbelanja/{id}',[KeranjangBelanjaController::class,'update']);
Route::delete('keranjangbelanja/{id}',[KeranjangBelanjaController::class,'destroy']);

// route detail keranjang belanja 
Route::get('detailkeranjangbelanja',[DetailKeranjangBelanjaController::class,'index']);
Route::get('detailkeranjangbelanja/{id}',[DetailKeranjangBelanjaController::class,'show']);
Route::post('detailkeranjangbelanja',[DetailKeranjangBelanjaController::class,'store']);
Route::post('detailkeranjangbelanja/{id}',[DetailKeranjangBelanjaController::class,'update']);
Route::delete('detailkeranjangbelanja/{id}',[DetailKeranjangBelanjaController::class,'destroy']);

// route pemesanan 
Route::get('pemesanan',[PemesananController::class,'index']);
Route::get('pemesanan/{id}',[PemesananController::class,'show']);
Route::post('pemesanan',[PemesananController::class,'store']);
Route::post('pemesanan/{id}',[PemesananController::class,'update']);
Route::delete('pemesanan/{id}',[PemesananController::class,'destroy']);

// route pemesanan 
Route::get('detailpemesanan',[DetailPemesananController::class,'index']);
Route::get('detailpemesanan/{id}',[DetailPemesananController::class,'show']);
Route::post('detailpemesanan',[DetailPemesananController::class,'store']);
Route::post('detailpemesanan/{id}',[DetailPemesananController::class,'update']);
Route::delete('detailpemesanan/{id}',[DetailPemesananController::class,'destroy']);


Route::group([

    'middleware' => 'api',
    'prefix' => 'auth',

], function ($router) {

    Route::post('regeister', [AuthController::class,'register']);
    Route::post('login', [AuthController::class,'login']);
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh',[AuthController::class,'refresh']);
    Route::post('me', [AuthController::class,'me']);

});