<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailKeranjangBelanja extends Model
{
    use HasFactory;
    protected $table = "detail_keranjang_belanja";
    protected $fillable = [
        'id_keranjang_belanja',
        'id_pelanggan',
        'id_produk',
        'qty',
        'harga',
    ];
}
