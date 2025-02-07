<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KelurahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kelurahan')->insert([
            ['nama' => 'Kelurahan X', 'kecamatanid' => 1],
            ['nama' => 'Kelurahan Y', 'kecamatanid' => 2],
            ['nama' => 'Kelurahan Z', 'kecamatanid' => 3],
        ]);
    }
}
