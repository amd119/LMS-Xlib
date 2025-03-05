<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PetugasSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'Petugas',
            'password' => bcrypt('petugas'),
            'email' => 'petugas@gmail.com',
            'NamaLengkap' => 'Petugas',
            'Alamat' => 'Jl. Petugas no 1',
            'Role' => 'Petugas',
        ]);
    }
}
