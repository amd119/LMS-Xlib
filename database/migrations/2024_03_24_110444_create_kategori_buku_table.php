<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kategoribuku', function (Blueprint $table) {
            $table->id('KategoriID');
            $table->string('NamaKategori', 255)->unique();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kategori_buku');
    }
};
