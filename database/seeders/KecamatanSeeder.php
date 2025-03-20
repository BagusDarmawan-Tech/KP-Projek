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
            ['nama' => 'Asemrowo'],
            ['nama' => 'Benowo'],
            ['nama' => 'Bubutan'],
            ['nama' => 'Bulak'],
            ['nama' => 'Dukuh Pakis'],
            ['nama' => 'Gayungan'],
            ['nama' => 'Genteng'],
            ['nama' => 'Gubeng'],
            ['nama' => 'Gunung Anyar'],
            ['nama' => 'Jambangan'],
            ['nama' => 'Karang Pilang'],
            ['nama' => 'Kenjeran'],
            ['nama' => 'Krembangan'],
            ['nama' => 'Lakarsantri'],
            ['nama' => 'Mulyorejo'],
            ['nama' => 'Pabean Cantian'],
            ['nama' => 'Pakal'],
            ['nama' => 'Rungkut'],
            ['nama' => 'Sambikerep'],
            ['nama' => 'Sawahan'],
            ['nama' => 'Semampir'],
            ['nama' => 'Simokerto'],
            ['nama' => 'Sukolilo'],
            ['nama' => 'Sukomanunggal'],
            ['nama' => 'Tambaksari'],
            ['nama' => 'Tandes'],
            ['nama' => 'Tegalsari'],
            ['nama' => 'Tenggilis Mejoyo'],
            ['nama' => 'Wiyung'],
            ['nama' => 'Wonocolo'],
            ['nama' => 'Wonokromo'],
        ]);
    }
}
