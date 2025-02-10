<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ConfigApp extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('config_app')->insert([
            ['nama' => 'limitartikel','detail'=>'6'],
            ['nama' => 'hitcounter','detail'=>'1266587'],
            ['nama' => 'logo-white','detail'=>' logo-white.png'],
            ['nama' => 'footer','detail'=>'Kota Layak Anak adalah Kota yang mempunyai sistem pembangunan berbasis hak anak melalui pengintegrasian komitmen dan sumber daya pemerintah.'],
            ['nama' => 'head_office','detail'=>'Jl. Jimerto No. 25-27, Ketabang, Kec. Genteng, Kota SBY, Jawa Timur 60272'],
            ['nama' => 'phone','detail'=>'(031) 5475600'],
            ['nama' => 'email','detail'=>'bagus'],
            ['nama' => 'front_theme','detail'=>'megaone'],
            ['nama' => 'version','detail'=>'1.0'],
            ['nama' => 'themes','detail'=>'metronic1'],
            ['nama' => 'logo','detail'=>'logo.png'],
            ['nama' => 'favicon','detail'=>'favicon.png'],
            ['nama' => 'description','detail'=>'Kota Layak Anak adalah Kota yang mempunyai sistem pembangunan berbasis hak anak melalui pengintegrasian komitmen dan sumber daya pemerintah.'],
            ['nama' => 'app_keyword','detail'=>'Kota Layak Anak'],
            ['nama' => 'app_name','detail'=>' SI TALAS'],
        ]);
    }
}
