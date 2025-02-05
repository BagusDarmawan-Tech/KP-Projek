<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="/asset/img/logo.png" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">SITALAS</h1>
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
                  <li><a href="">Kegiatan Forum Anak Kecamatan</a></li>
                </ul>
              </li>

              <li class="dropdown"><a href="#"><span>Forum Anak Kelurahan</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="{{route('Skkel')}}">SK Fas Kelurahan</a></li>
                  <li><a href="#">Kegiatan Forum Anak Kelurahan</a></li>
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
              <li class="dropdown"><a href=""><span>Hak Sipil dan Kebebabasan</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
              <li class="dropdown"><a href="#"><span>Kelembagaan</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a> 
              <li class="dropdown"><a href="#"><span>Kesehatan Dasar dan kesejahteraan</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
              <li class="dropdown"><a href="#"><span>Lingkungan Kelurga dan Pengasuhan Alternatif</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
              <li class="dropdown"><a href="#"><span>Pendidikan, Pemanfaatan Waktu Luang dan Kegiatan Budaya</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
              <li class="dropdown"><a href="#"><span>Perlindungan Khusus</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            </ul>

           <!-- selesai bagian Halaman Klaster  -->

            <!-- Halaman kota Layak Anak -->
            <li class="dropdown"><a href="#"><span>Kota Layak Anak</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li class="dropdown"><a href="#"><span>Kegiatan</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="#">Kegiatan Kecamatan</a></li>
                  <li><a href="#">Kegiatan Kelurahan</a></li>
                </ul>
              </li>
              <li><a href="#">Kas RPA</a></li>
            </ul>
          </li>

             <!-- Selesai Bagian Kota Layak -->


           <!-- Halaman bagian CFCI  -->

           <li class="dropdown"><a href="#"><span>CFCI</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li class="dropdown"><a href="{{route('CFCISK')}}"><span>SK</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="{{route('Ckecamatan')}}">SK Kecamatan</a></li>
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
              <li><a href="#">Dokumen</a></li>
              <li><a href="#">Kegiatan</a></li>
</ul>
          <!-- SELESAI BAGIAN PISA -->
        
          <!-- Bagian halaman Suara Anak -->

          <li class="dropdown"><a href="#"><span>Suara  Anak</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="#">Pantau Suara Anak</a></li>
              <li><a href="#">Karya Anak</a></li>
</ul>
           <!-- selesai bagian menu anyar -->

           <!-- Halaman Mitra Anak  -->
           <li class="dropdown"><a href="#"><span>Mitra Anak</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="#">Artikel</a></li>
          </ul>
            <!-- Selesai Mitra Anak -->

          <li><a href="{{ route('login') }}">Login</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
    </div>
  </header>