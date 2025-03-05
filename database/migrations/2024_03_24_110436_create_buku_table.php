<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('buku', function (Blueprint $table) {
            $table->id('BukuID');
            $table->string('Cover', 255);
            $table->string('Judul', 255);
            $table->text('Deskripsi');
            $table->string('Penulis', 255);
            $table->string('Penerbit', 255);
            $table->year('TahunTerbit');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};
