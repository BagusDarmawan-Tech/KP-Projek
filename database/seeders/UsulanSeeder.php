<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsulanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1.Dinas Kesehatan
        // 2.Dinas Kependudukan dan Pencatatan Sipil
        // 3.Dinas Pemberdayaan Perempuan dan Perlindungan Anak
        // 4.Dinas Perhubungan
        // 5.Dinas Sosial
        // 6.Dinas Kesejahteraan Rakyat
        // 7.Dinas Kebersihan dan Ruang
        // Terbuka Hijau
        // 8.Dinas Kebudayaan dan Pariwisata
        // 9.Bagian Pemerintahan dan Kesejahteraan Rakyat
        // 10.Dinas Tenaga Kerja
        // 11.Dinas Pendidikan
        // 12.Dinas Lingkungan Hidup
        DB::table('usulan')->insert([
            [
                //18
                'opdId' => 5,
                'namaUsulan' => 'pemerintah bisa menyediakan sebuah solusi berupa program atau fasilitas yang dapat membantu setidaknya sebagian anak jalanan.' ,
                'tindakLanjut' => ',DITNDAK LANJUTI' ,
                'keterangan'=>'sudah ditindaklanjuti dengan tersedianya Kampung Anak Negeri',
                'userid'=>24,
                'is_active'=>true
            ],
            [
                'opdId' => 5,
                'namaUsulan' => 'isu anak jalanan yang terlantar di jalan menyebabkan banyak sekali dampak di berbagai aspek. Dampak tersebut meliputi Anak jalanan dapat berpotensi menjadi pekerja anak, anak jalanan juga tidak mendapatkan pendidikan yang layak, bahkan anak jalanan tidak memiliki tempat tinggal yang layak, sehat dan bersih. Padahal mereka juga memiliki hak untuk memperoleh pendidikan dan bertumbuh kembang dengan fasilitas memadai seperti air yang bersih dan makanan yang cukup' ,
                'tindakLanjut' => 'ditindak lanjuti' ,
                'keterangan'=>'Sudah ditindaklanjuti dengan adanya Kampung Anak Negeri',
                'userid'=>24,
                'is_active'=>true
            ],
            //20
            [
                'opdId' => 1,
                'namaUsulan' => '' ,
                'tindakLanjut' => '' ,
                'keterangan'=>'',
                'userid'=>24,
                'is_active'=>true
            ],
            [
                'opdId' => 1,
                'namaUsulan' => '' ,
                'tindakLanjut' => '' ,
                'keterangan'=>'',
                'userid'=>24,
                'is_active'=>true
            ],
            //22
            [
                'opdId' => 1,
                'namaUsulan' => '' ,
                'tindakLanjut' => '' ,
                'keterangan'=>'',
                'userid'=>24,
                'is_active'=>true
            ],
        ]);
    }
}
