<?php

namespace Modules\Ekonomi\database\seeders;

use Illuminate\Database\Seeder;

class EkonomiDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Di sini panggilannya yang bener, Rid!
        $this->call(BapendaSimulasiSeeder::class);
    }
}