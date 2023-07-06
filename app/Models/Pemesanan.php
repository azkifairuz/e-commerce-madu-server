<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;
    protected $table = "pemesanan";
    protected $fillable = [
        'no_nota',
        'id_pelanggan',
        'tgl',
    ];
}
