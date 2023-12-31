<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPemesanan extends Model
{
    use HasFactory;
    protected $table = "detail_pemesanan";
    protected $fillable = [
        'id_pemesanan',
        'no_nota',
        'id_pelanggan',
        'id_produk',
        'qty',
        'harga',
    ];
}
