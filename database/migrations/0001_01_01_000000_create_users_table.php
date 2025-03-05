<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('UserID');
            $table->string('google_id')->nullable();
            $table->string('google_token')->nullable();
            $table->string('google_refresh_token')->nullable();
            $table->string('username', 255)->unique();
            $table->string('password', 255);
            $table->string('email', 255);
            $table->string('NamaLengkap', 255);
            $table->text('Alamat')->nullable();
            $table->enum('Role', ['Administrator', 'Petugas', 'Peminjam']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
