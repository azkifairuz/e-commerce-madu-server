<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;
    protected $table = "pelanggan";
    protected $fillable = [
        'nik',
        'nm_pelanggan',
        'alamat_pelanggan',
        'tgl_lahir',
        'tmp_lahir',
        'jns_kelamin',
        'email',
        'no_telp',
    ];
}
