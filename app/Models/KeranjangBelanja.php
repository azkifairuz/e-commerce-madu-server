<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeranjangBelanja extends Model
{
    use HasFactory;
    protected $table = "keranjang_belanja";
    protected $fillable = [
        'id_pelanggan',
        'tgl',
    ];
}
