<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            KecamatanSeeder::class,
            KelurahanSeeder::class,
            DokumenKecamatan::class,
            DokumenKelurahan::class,
            JenisSurat::class,
            KegiatanKecamatan::class,
            KegiatanKelurahan::class,
            KegiatanPisa::class,
            DokumenPisa ::class,
            KaryaAnak::class,
            KegiatanArekSuroboyo::class,
            KategoriArtikel::class,
            KegiatanMitraAnak::class,
            Kluster::class,
            Slider::class,
            SuaraAnak::class,
            Halaman::class,
            ForumAnak::class,
            GaleriAnak::class,
            Usulan::class,
            SubKegiatan::class,
            Artikel::class,
            ArtikelMitraAnak::class,
            KegiatanCfci::class,
            KegiatanForumAnakSurabaya::class,
            ConfigApp::class

            
        ]);
    }
}
