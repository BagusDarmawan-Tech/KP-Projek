<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KelurahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kelurahan')->insert(array_map(fn($nama) => ['nama' => $nama, 'kecamatanid' => 4], [	
            'Asemrowo' ,'Genting Kalianak', 'Tambak Sarioso'
        ]));
        DB::table('kelurahan')->insert(array_map(fn($nama) => ['nama' => $nama, 'kecamatanid' => 5], [	
            'Kandangan' ,'Romokalisari', 'Sememi', 'Tambak Osowilangun'
        ]));
        DB::table('kelurahan')->insert(array_map(fn($nama) => ['nama' => $nama, 'kecamatanid' => 6], [	
            'Alun-Alun Contong' ,'Bubutan', 'Gundih', 'Jepara', 'Tembok Dukuh'
        ]));
        DB::table('kelurahan')->insert(array_map(fn($nama) => ['nama' => $nama, 'kecamatanid' => 7], [	
            'Bulak' ,'Kedungcowek', 'Kenjeran' ,'Sukolilo Baru'
        ]));
        DB::table('kelurahan')->insert(array_map(fn($nama) => ['nama' => $nama, 'kecamatanid' => 8], [	
            'Dukuh Kupang' ,'Dukuh Pakis', 'Gunung Sari' ,'Pradah Kalikendal'
        ]));
        DB::table('kelurahan')->insert(array_map(fn($nama) => ['nama' => $nama, 'kecamatanid' => 9], [	
            'Dukuh Menanggal' ,'Gayungan', 'Ketintang','Menanggal'
        ]));
        DB::table('kelurahan')->insert(array_map(fn($nama) => ['nama' => $nama, 'kecamatanid' => 10], [	
              'Embong Kaliasin' ,'Genteng', 'Kapasari','Ketabang','Peneleh'
        ]));
        DB::table('kelurahan')->insert(array_map(fn($nama) => ['nama' => $nama, 'kecamatanid' => 11], [		
            'Airlangga' ,'Barata Jaya', 'Gubeng' , 'Kertajaya','Mojo','Pucangsewu'
        ]));
        DB::table('kelurahan')->insert(array_map(fn($nama) => ['nama' => $nama, 'kecamatanid' => 12], [		
            'Gunung Anyar' ,'Gunung Anyar Tambak', 'Rungkut Menanggal' , 'Rungkut Tengah'
        ]));
        DB::table('kelurahan')->insert(array_map(fn($nama) => ['nama' => $nama, 'kecamatanid' => 13], [		 	
            'Jambangan' ,'Karah', 'Kebonsari','Pagesangan'
        ]));
        DB::table('kelurahan')->insert(array_map(fn($nama) => ['nama' => $nama, 'kecamatanid' => 14], [		
            'Karang Pilang' ,'Kebraon', 'Kedurus' , 'Warugunung'
        ]));
        DB::table('kelurahan')->insert(array_map(fn($nama) => ['nama' => $nama, 'kecamatanid' => 15], [		
             'Bulakbanteng' ,'Tambakwedi', 'Tanah Kalikedinding' , 'Sidotopo Wetan'
        ]));
        DB::table('kelurahan')->insert(array_map(fn($nama) => ['nama' => $nama, 'kecamatanid' => 16], [		
             'Dupak' ,'Kemayoran', 'Krembangan Selatan' , 'Morokrembangan','Mojo','Perak Barat'
        ]));
        DB::table('kelurahan')->insert(array_map(fn($nama) => ['nama' => $nama, 'kecamatanid' => 17], [		
            'Bangkingan' ,'Jeruk', 'Lakarsantri' , 'Lidah Kulon','Lidah Wetan','Sumur Welut'
        ]));
        DB::table('kelurahan')->insert(array_map(fn($nama) => ['nama' => $nama, 'kecamatanid' => 18], [		
            'Dukuh Sutorejo' ,'Kalijudan', 'Kalisari' , 'Kejawan Putih Tambak','Manyar Sabrangan','Mulyorejo'
        ]));
        DB::table('kelurahan')->insert(array_map(fn($nama) => ['nama' => $nama, 'kecamatanid' => 19], [		
            'Bongkaran' ,'Krembangan Utara', 'Nyamplungan' , 'Tanjung Perak'
        ]));
        DB::table('kelurahan')->insert(array_map(fn($nama) => ['nama' => $nama, 'kecamatanid' => 20], [		
            'Babat Jerawat' ,'Benowo', 'Gubeng' , 'Pakal','Sumberejo'
        ]));
        DB::table('kelurahan')->insert(array_map(fn($nama) => ['nama' => $nama, 'kecamatanid' => 21], [		
            'Kali Rungkut' ,'Kedung Baruk', 'Medokan Ayu' , 'Penjaringan Sari','Rungkut Kidul','Wonorejo'
        ]));
        DB::table('kelurahan')->insert(array_map(fn($nama) => ['nama' => $nama, 'kecamatanid' => 22], [		
               'Bringin' ,'Made', 'Lontar' , 'Sambikerep'
        ]));
        DB::table('kelurahan')->insert(array_map(fn($nama) => ['nama' => $nama, 'kecamatanid' => 23], [		
               'Banyu Urip' ,'Kupang Krajan', 'Pakis' , 'Patemon','Putat Jaya','Sawahan'
        ]));
        DB::table('kelurahan')->insert(array_map(fn($nama) => ['nama' => $nama, 'kecamatanid' => 24], [		
            'Ampel' ,'Pegirian', 'Sidotopo' , 'Ujung','Wonokusumo'
        ]));
        DB::table('kelurahan')->insert(array_map(fn($nama) => ['nama' => $nama, 'kecamatanid' => 25], [		
            'Kapasan' ,'Sidodadi', 'Simokerto' , 'Simolawang','Tambakrejo'
        ]));
        DB::table('kelurahan')->insert(array_map(fn($nama) => ['nama' => $nama, 'kecamatanid' => 26], [		
            'Gebang Putih' ,'Keputih', 'Klampisngasem' , 'Medokan Semampir ','Menur Pumpungan','Nginden Jangkungan','Semolowaru'
        ]));
        DB::table('kelurahan')->insert(array_map(fn($nama) => ['nama' => $nama, 'kecamatanid' => 27], [		
            'Putatgede' ,'Simomulyo', 'Simomulyo Baru' , 'Sonokwijenan','Sukomanunggal','Tanjungsari'
        ]));
        DB::table('kelurahan')->insert(array_map(fn($nama) => ['nama' => $nama, 'kecamatanid' => 28], [		
            'Dukuh Setro' ,'Gading', 'Kapas Madya' , 'Pacar Kembang','Pacar Keling','Ploso','Rangkah','Tambaksari'
        ]));
        DB::table('kelurahan')->insert(array_map(fn($nama) => ['nama' => $nama, 'kecamatanid' => 29], [		
            'Balongsari' ,'Banjar Sugihan', 'Karang Poh' , 'Manukan Kulon','Manukan Wetan','Tandes'
        ]));
        DB::table('kelurahan')->insert(array_map(fn($nama) => ['nama' => $nama, 'kecamatanid' => 30], [		
  	
          'Dr. Sutomo' ,'Kedungdoro', 'Keputran' , 'Tegalsari','Wonorejo'
        ]));
        DB::table('kelurahan')->insert(array_map(fn($nama) => ['nama' => $nama, 'kecamatanid' => 31], [		
            'Kendangsari' ,'Kutisari', 'Panjang Jiwo' , 'Tenggilis Mejoyo '
        ]));
        DB::table('kelurahan')->insert(array_map(fn($nama) => ['nama' => $nama, 'kecamatanid' => 32], [		
           'Babatan' ,'Balasklumprik', 'Jajar Tunggal' , 'Wiyung'
        ]));
        DB::table('kelurahan')->insert(array_map(fn($nama) => ['nama' => $nama, 'kecamatanid' => 33], [		
            'Bendul Merisi' ,'Jemur Wonosari', 'Margorejo' , 'Sidosermo','Siwalan Kerto'
        ]));
        DB::table('kelurahan')->insert(array_map(fn($nama) => ['nama' => $nama, 'kecamatanid' => 34], [		
            'Darmo' ,'Jagir', 'Ngagel' , 'Ngagelrejo','Sawunggaling','Wonokromo '
        ]));
    }
}
