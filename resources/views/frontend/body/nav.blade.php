<header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">
            <a href="/" class="logo d-flex align-items-center me-auto">
                <img class="logo-img" src="{{ asset('assets/img/logo.png') }}" alt="Logo">
            </a>

        <nav id="navmenu" class="navmenu">
            <ul>
              <li>
                    <a href="{{ route('content') }}">Home</a></li>  
                     

                <!-- Halaman Galeri -->
                <li class="dropdown">
                    <a href="#">Galeri<i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li class="dropdown">
                            <a href="{{route('galeri-kota-layakanak')}}">Galeri Kota Layak Anak</a>
                        </li>
                    </ul>
                </li>   
              
                <!-- Selesai Halaman Galeri -->

                <!-- Bagian Forum Anak -->
                <li class="dropdown">
                    <a href="#">Forum Anak <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li class="dropdown">
                            <a href="#">Forum Anak Kecamatan<i class="bi bi-chevron-down toggle-dropdown"></i></a>
                            <ul>
                                <li><a href="{{route('Skkecam')}}">SK Fas Kecamatan</a></li>
                                <li><a href="{{route('kegiatanforumanakkecamatan')}}">Kegiatan Forum Anak Kecamatan</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#">Forum Anak Kelurahan<i class="bi bi-chevron-down toggle-dropdown"></i></a>
                            <ul>
                                <li><a href="{{route('Skkel')}}">SK Fas Kelurahan</a></li>
                                <li><a href="{{route('kegiatanforumanakkelurahan')}}">Kegiatan Forum Anak Kelurahan</a></li>
                            </ul>
                        </li>
                        <li><a href="{{route('pemantauananak')}}">Pemantauan Usulan Anak</a></li>
                        <li><a href="{{route('kegareksby')}}">Kegiatan Forum Anak Surabaya</a></li>
                    </ul>
                </li>
                <!-- Selesai Bagian Forum Anak -->

                <!-- Bagian Klaster -->
                <li class="dropdown">
                    <a href="#">Klaster<i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li><a href="{{route('haksipil')}}">Hak Sipil dan Kebebasan</a></li>
                        <li><a href="{{route('kelembagaan')}}">Kelembagaan</a></li>
                        <li><a href="{{route('kesehatan-dasar')}}">Kesehatan Dasar dan Kesejahteraan</a></li>
                        <li><a href="{{route('lingkungan-keluarga')}}">Lingkungan Keluarga dan Pengasuhan Alternatif</a></li>
                        <li><a href="{{route('pendidikan-pemanfaatan')}}">Pendidikan, Pemanfaatan Waktu Luang dan Kegiatan Budaya</a></li>
                        <li><a href="{{route('perlindungan-khusus')}}">Perlindungan Khusus</a></li>
                    </ul>
                </li>
                <!-- Selesai Bagian Klaster -->

                <!-- Halaman Kota Layak Anak -->
                <li class="dropdown">
                    <a href="#">Kota Layak Anak<i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li class="dropdown">
                            <a href="#">Kegiatan<i class="bi bi-chevron-down toggle-dropdown"></i></a>
                            <ul>
                                <li><a href="{{route('kegiatankecamatanlayakanak')}}">Kegiatan Kecamatan</a></li>
                                <li><a href="{{route('kegiatankelurahanlayakanak')}}">Kegiatan Kelurahan</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <!-- Selesai Halaman Kota Layak Anak -->

                <!-- Bagian CFCI -->
                <li class="dropdown">
                    <a href="#">CFCI<i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li class="dropdown">
                            <a href="#">SK<i class="bi bi-chevron-down toggle-dropdown"></i></a>
                            <ul>
                                <li><a href="{{route('CFCIKecamatann')}}">SK Kecamatan</a></li>
                                <li><a href="{{route('SkKelurahan')}}">SK Kelurahan</a></li>
                            </ul>
                        </li>
                        <li><a href="{{route('HalamanArtikel')}}">Artikel Kegiatan</a></li>
                        <li><a href="{{route('CFCIKegiatan')}}">Kegiatan</a></li>
                        <li><a href="{{route('HalamanGaleri')}}">Kegiatan Arek Suroboyo</a></li>
                    </ul>
                </li>
                <!-- Selesai Bagian CFCI -->

                <!-- Halaman PISA -->
                <li class="dropdown">
                    <a href="#">PISA<i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li><a href="{{route('HalamanPisa')}}">Dokumen</a></li>
                        <li><a href="{{route('KegiatanPisa')}}">Kegiatan</a></li>
                    </ul>
                </li>
                <!-- Selesai Halaman PISA -->

                <!-- Bagian Suara Anak -->
                <li class="dropdown">
                    <a href="#">Suara Anak<i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li><a href="{{route('suaraanak')}}">Pantau Suara Anak</a></li>
                        <li><a href="{{route('KaryaAnak')}}">Karya Anak</a></li>
                    </ul>
                </li>
                <!-- Selesai Bagian Suara Anak -->

                <!-- Halaman Mitra Anak -->
                <li class="dropdown">
                    <a href="#">Mitra Anak<i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li><a href="{{route('HArtikelMitra')}}">Artikel Mitra Anak</a></li>
                        <li><a href="{{route('HKegiatanMitra')}}">Kegiatan Mitra Anak</a></li>
                    </ul>
                </li>
                <!-- Selesai Halaman Mitra Anak -->

                <li><a href="{{ route('login') }}">Login</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
    </div>
</header>
