<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $table = "produk";
    protected $fillable = [
        'id_Keranjang_bejanja',
        'tgl_bayar',
        'upload_bukti_pembayaran',
    ];
}
