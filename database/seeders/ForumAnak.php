<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ForumAnak extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('forum_anak')->insert([
            ['nama' => 'A','caption'=>'semangat','deskripsi'=>'lorem100','gambar'=>'/test/test','dibuatOleh'=>'bagus','is_active'=>true],
            ['nama' => 'B','caption'=>'semangat','deskripsi'=>'lorem100','gambar'=>'/test/test','dibuatOleh'=>'bagus','is_active'=>true],
            ['nama' => 'C','caption'=>'semangat','deskripsi'=>'lorem100','gambar'=>'/test/test','dibuatOleh'=>'bagus','is_active'=>true],
        ]);
    }
}
