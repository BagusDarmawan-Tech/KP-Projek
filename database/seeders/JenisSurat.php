<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JenisSurat extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jenis_surat')->insert([
            ['nama' => 'Surat a' ],
            ['nama' => 'Surat b' ],
            ['nama' => 'Surat b' ],
        ]);
    }
}
