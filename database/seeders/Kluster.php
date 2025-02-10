<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Kluster extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kluster')->insert([
            ['icon' => 'A','nama' => 'A','slug'=>'lorem100','gambar'=>'/test/test','dibuatOleh'=>'bagus','is_active'=>true],
            ['icon' => 'A','nama' => 'B','slug'=>'lorem100','gambar'=>'/test/test','dibuatOleh'=>'bagus','is_active'=>true],
            ['icon' => 'A','nama' => 'C','slug'=>'lorem100','gambar'=>'/test/test','dibuatOleh'=>'bagus','is_active'=>true],
        ]);
    }
}
