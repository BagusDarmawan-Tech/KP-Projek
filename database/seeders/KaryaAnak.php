<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KaryaAnak extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('karya_anak')->insert([
            ['kreator' => 'lucario','tanggal' => Carbon::now()->format('Y-m-d'),'judul' => 'Dokumen A' ,'gambar'=>'/test/1','deskripsi' => 'lorem100' ,'pemohon'=>'bagus'],
            ['kreator' => 'lycario','tanggal' => Carbon::now()->format('Y-m-d'),'judul' => 'Dokumen B','gambar'=>'/test/1','deskripsi' => 'lorem100' ,'pemohon'=>'bagus'],
            ['kreator' => 'lycario','tanggal' => Carbon::now()->format('Y-m-d'),'judul' => 'Dokumen C','gambar'=>'/test/1','deskripsi' => 'lorem100' ,'pemohon'=>'bagus']
        ]);
    }
}
