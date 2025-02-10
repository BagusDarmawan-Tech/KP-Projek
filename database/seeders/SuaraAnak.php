<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SuaraAnak extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('suara_anak')->insert([
            ['nomorSuara' => 'sk-1218-kec','tanggal' => Carbon::now()->format('Y-m-d'),'perihal' => 'Dokumen A' ,'deskripsi' => 'lorem100' ,'pemohon'=>'bagus'],
            ['nomorSuara' => 'sk-1218-kec','tanggal' => Carbon::now()->format('Y-m-d'),'perihal' => 'Dokumen B','deskripsi' => 'lorem100' ,'pemohon'=>'bagus'],
            ['nomorSuara' => 'sk-1218-kec','tanggal' => Carbon::now()->format('Y-m-d'),'perihal' => 'Dokumen C','deskripsi' => 'lorem100' ,'pemohon'=>'bagus']
        ]);
    }
}
