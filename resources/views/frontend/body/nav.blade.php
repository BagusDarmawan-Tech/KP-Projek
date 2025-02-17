
<style>
.header {
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Shadow lembut */
}
</style>

<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="/asset/img/logo.png" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img class=" img-fluid w-10" src="{{asset('assets/img/logo.png')}}" alt="Logo" width="120" height="300">
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="{{ route('content') }}">Home</a></li>


          <!-- Halaman Galari  -->
          <li class="dropdown"><a href="#"><span>Galeri</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="{{route('galeri-kota-layakanak')}}">Galeri Kota Layak Anak</a></li>
              <li><a href="{{route('GaleriAnak')}}">Galeri Anak</a></li>
    </ul>
          <!-- selesai Bagian Galeri -->

          <!-- bagian Forum Anak -->
          <li class="dropdown"><a href="#"><span>Forum Anak</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li class="dropdown"><a href="#"><span>Forum Anak Kecamatan</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="{{route('Skkecam')}}">SK Fas Kecamatan</a></li>
                  <li><a href="{{route('kegiatanforumanakkecamatan')}}">Kegiatan Forum Anak Kecamatan</a></li>
                </ul>
              </li>

              <li class="dropdown"><a href="#"><span>Forum Anak Kelurahan</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="{{route('Skkel')}}">SK Fas Kelurahan</a></li>
                  <li><a href="{{route('kegiatanforumanakkelurahan')}}">Kegiatan Forum Anak Kelurahan</a></li>
                </ul>
              </li>
              <li><a href="{{route('pemantauananak')}}">Pemantauan Usulan Anak</a></li>
              <li><a href="{{route('kegareksby')}}">Kegiatan forum Anak Surabaya</a></li>
            </ul>
          </li>
          <!-- selesai bagian Forum Anak -->

          <!-- Bagian Halaman Klaster -->
           
          <li class="dropdown"><a href="#"><span>Klaster</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="{{route('haksipil')}}">Hak Sipil dan Kebebabasan</a>
              <li><a href="{{route('kelembagaan')}}">Kelembagaan</a> 
              <li><a href="{{route('kesehatan-dasar')}}">Kesehatan Dasar dan kesejahteraan</a>
              <li><a href="{{route('lingkungan-keluarga')}}">Lingkungan Kelurga dan Pengasuhan Alternatif</a>
              <li><a href="{{route('pendidikan-pemanfaatan')}}">Pendidikan, Pemanfaatan Waktu Luang dan Kegiatan Budaya</a>
              <li><a href="{{route('perlindungan-khusus')}}">Perlindungan Khusus</a>
            </ul>

           <!-- selesai bagian Halaman Klaster  -->

            <!-- Halaman kota Layak Anak -->
            <li class="dropdown"><a href="#"><span>Kota Layak Anak</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li class="dropdown"><a href="#"><span>Kegiatan</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="{{route('kegiatankecamatanlayakanak')}}">Kegiatan Kecamatan</a></li>
                  <li><a href="{{route('kegiatankelurahanlayakanak')}}">Kegiatan Kelurahan</a></li>
                </ul>
              </li>
              <li><a href="{{route('Kasrpa')}}">Kas RPA</a></li>
            </ul>
          </li>

             <!-- Selesai Bagian Kota Layak -->


           <!-- Halaman bagian CFCI  -->

           <li class="dropdown"><a href="#"><span>CFCI</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li class="dropdown"><a href="{{route('CFCISK')}}"><span>SK</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="{{route('CFCIKecamatann')}}">SK Kecamatan</a></li>
                  <li><a href="{{route('SkKelurahan')}}">SK Kelurahan</a></li>
                </ul>
              </li>
              <li><a href="{{route('HalamanArtikel')}}">Artikel Kegiatan</a></li>
              <li><a href="{{route('CFCIKegiatan') }}">Kegiatan</a></li>
              <li><a href="{{route('HalamanGaleri')}}">Galeri CFCI</a></li>
            </ul>
          </li>

           <!-- Selesai Halaman bagian CFCI  -->
           
           <!-- HALAMAN PISA  -->
          <li class="dropdown"><a href="#"><span>PISA</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="{{route('HalamanPisa')}}">Dokumen</a></li>
              <li><a href="{{route('KegiatanPisa')}}">Kegiatan</a></li>
</ul>
          <!-- SELESAI BAGIAN PISA -->
        
          <!-- Bagian halaman Suara Anak -->

          <li class="dropdown"><a href="#"><span>Suara  Anak</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="{{route('suaraanak')}}">Pantau Suara Anak</a></li>
              <li><a href="{{route('KaryaAnak')}}">Karya Anak</a></li>
</ul>
           <!-- selesai bagian menu anyar -->

           <!-- Halaman Mitra Anak  -->
           <li class="dropdown"><a href="#"><span>Mitra Anak</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="{{route('HArtikelMitra')}}">Artikel Mitra Anak</a></li>
              <li><a href="{{route('HKegiatanMitra')}}">Kegiatan Mitra Anak</a></li>
          </ul>
         
            <!-- Selesai Mitra Anak -->

          <li><a href="{{ route('login') }}">Login</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
    </div>
  </header>