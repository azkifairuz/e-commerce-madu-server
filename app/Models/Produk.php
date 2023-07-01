<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = "produk";
    protected $fillable = [
        'id_jns_produk',
        'nm_produk',
        'qty_produk',
        'harga_jual',
        'harga_beli',
        'image',
    ];
}
