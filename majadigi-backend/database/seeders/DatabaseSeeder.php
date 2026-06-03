<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// Import seeder utama dari masing-masing modul
use Modules\InformasiPublik\Database\Seeders\InformasiPublikDatabaseSeeder;
use Modules\Ekonomi\Database\Seeders\BapendaSimulasiSeeder; // sesuaikan nama class seeder ekonomi kamu
use Modules\Pariwisata\Database\Seeders\PariwisataDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Hapus atau komentari kode User Factory bawaan Laravel yang bikin error duplicate entry 'test@example.com' kemarin
        // \App\Models\User::factory(10)->create();

        // 2. Daftarkan semua seeder modul ke dalam antrean eksekusi global
        $this->call([
            InformasiPublikDatabaseSeeder::class,
            BapendaSimulasiSeeder::class,
            PariwisataDatabaseSeeder::class,
        ]);
    }
}