<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;
    protected $table = "pegawai";
    protected $fillable = [
        'nik',
        'nm_pegawai',
        'jns_kelamin',
        'alamat_pegawai',
        'tgl_lahir',
        'tmp_lahir',
        'email',
        'no_telp',
    ];
}
