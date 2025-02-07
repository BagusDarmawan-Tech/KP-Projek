<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kecamatan')->insert([
            ['id' => 1, 'nama' => 'Kecamatan A'],
            ['id' => 2, 'nama' => 'Kecamatan B'],
            ['id' => 3, 'nama' => 'Kecamatan C'],
        ]);
    }
}
