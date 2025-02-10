<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KegiatanForumAnakSurabaya extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kegiatan_forum_anak_surabaya')->insert([
            ['nama' => 'lucario','tanggal' => Carbon::now()->format('Y-m-d') ,'gambar'=>'/test/1','keterangan' => 'lorem100' ,],
            ['nama' => 'kegiatan coding','tanggal' => Carbon::now()->format('Y-m-d'),'gambar'=>'/test/1','keterangan' => 'lorem100' ,],
            ['nama' => 'kegiatan coding','tanggal' => Carbon::now()->format('Y-m-d'),'gambar'=>'/test/1','keterangan' => 'lorem100' ,]
        ]);
    }
}
