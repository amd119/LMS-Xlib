<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeminjamSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'username' => 'peminjam',
            'password' => bcrypt('peminjam'),
            'email' => 'peminjam@gmail.com',
            'NamaLengkap' => 'Peminjam',
            'Alamat' => 'Jl. Peminjam no 1',
            'Role' => 'Peminjam',
        ]);
    }
}
