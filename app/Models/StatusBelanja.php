<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusBelanja extends Model
{
    use HasFactory;
    protected $table = "status_belanjas";
    protected $fillable = [
        'id_keranjang_belanja',
        'keterangan',
    ];
}
