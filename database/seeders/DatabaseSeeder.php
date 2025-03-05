<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            PeminjamSeeder::class,
            AdminSeeder::class,
            PetugasSeeder::class,
        ]);
    }
}
