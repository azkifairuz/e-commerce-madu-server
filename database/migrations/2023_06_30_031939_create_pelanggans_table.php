<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->id();
            $table->string('nik',20);
            $table->string('nm_pelanggan',50);
            $table->text('alamat_pelanggan');
            $table->date('tgl_lahir');
            $table->string('tmp_lahir',50);
            $table->string('jns_kelamin',2);
            $table->string('email',100);
            $table->string('no_telp',100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggans');
    }
};
