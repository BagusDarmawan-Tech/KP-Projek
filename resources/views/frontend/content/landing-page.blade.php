@extends('frontend.user-main')

@section('content')

    <!-- Hero Section -->
    <!-- <section id="hero" class="hero section">
  <div class="container">
    <div class="row gy-1">
      <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="fade-up">
        <center>
          <h1 class="custom-font gradient-text">SELAMAT DATANG DI WEBSITE SITALAS</h1>
        </center>
      </div>
      <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="100">
        <img src="{{asset('assets/img/hero-img.jpg')}}" class="img-fluid animated" alt="">
      </div>
    </div>
  </div>
</section> -->


<section id="hero-carousel" class="position-relative w-100 hero-carousel ">
        <div id="carouselExampleIndicators" class="carousel slide h-100" data-bs-ride="carousel">
            
            <!-- Indicators -->
            <div class="carousel-indicators">
                @foreach ($gambars as $key => $gambar)
                    <button type="button" 
                            data-bs-target="#carouselExampleIndicators" 
                            data-bs-slide-to="{{ $key }}" 
                            class="{{ $key == 0 ? 'active' : '' }}" 
                            @if($key == 0) aria-current="true" @endif
                            aria-label="Slide {{ $key + 1 }}">
                    </button>
                @endforeach
            </div>

            <!-- Carousel Items -->
            <div class="carousel-inner h-100">
                @if ($gambars->isNotEmpty())
                    @foreach ($gambars as $key => $gambar)
                        <div class="carousel-item h-100 {{ $key == 0 ? 'active' : '' }}">
                            <img src="{{ asset($gambar->gambar) }}" alt="{{ $gambar->nama }}">
                            <div class="carousel-caption d-block bg-dark bg-opacity-50 p-3 rounded">
                            <h1 class="text-white fw-bold fs-4 ">{{ $gambar->nama }}</h1>
                                <p class="text-white fs-5">{{ $gambar->caption }}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="carousel-item active h-100">
                        <img src="{{ asset('assets/img/default-image.jpg') }}" alt="Default Slide">
                        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 p-3 rounded">
                            <h1 class="text-white fw-bold">Default Slide</h1>
                            <p class="text-white fs-5">Tidak ada gambar yang aktif.</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    
   <!-- Testimonials Section -->
<section id="testimonials" class="testimonials section1">
  <div class="container section-title" data-aos="fade-up"></div>
  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="swiper init-swiper">
      <script type="application/json" class="swiper-config">
        {
          "loop": true,
          "speed": 600,
          "autoplay": {
            "delay": 5000
          },
          "slidesPerView": "auto",
          "pagination": {
            "el": ".swiper-pagination",
            "type": "bullets",
            "clickable": true
          },
          "breakpoints": {
            "320": {
              "slidesPerView": 1,
              "spaceBetween": 40
            },
            "1200": {
              "slidesPerView": 3,
              "spaceBetween": 20
            }
          }
        }
      </script>

      <div class="swiper-wrapper ">
        <!-- Perlindungan Khusus -->
        <div class="swiper-slide">
          <a href="{{ route('perlindungan-khusus') }}" class="card-link">
          <div class="testimonial-item ">
              <div class="icon-wrapper">
                <i class="bi bi-shield-fill"></i> <!-- Ikon -->
              </div>
              <h3 style="color: black;">Perlindungan Khusus</h3><br>
              <!-- <h4 style="color: black;">Subkegiatan Khusus</h4> -->
              <p style="color: black;">Melindungi anak-anak dalam kondisi tertentu.</p>
            </div>
          </a>
        </div>

        <!-- Hak Sipil dan Kebebasan -->
        <div class="swiper-slide">
          <a href="{{ route('haksipil') }}" class="card-link">
            <div class="testimonial-item">
              <div class="icon-wrapper">
                <i class="bi bi-person-fill"></i> <!-- Ikon -->
              </div>
              <h3 style="color: black;">Hak Sipil dan Kebebasan</h3><br>
              <!-- <h4 style="color: black;">Subkegiatan Sipil</h4> -->
              <p style="color: black;">Hak sipil dan kebebasan untuk mendukung hak fundamental.</p>
            </div>
          </a>
        </div>

        <!-- Kelembagaan -->
        <div class="swiper-slide">
          <a href="{{ route('kelembagaan') }}"class="card-link">
            <div class="testimonial-item">
              <div class="icon-wrapper">
                <i class="bi bi-building"></i> <!-- Ikon -->
              </div>
              <h3 style="color: black;">Kelembagaan </h3><br>
              <!-- <h4 style="color: black;">Subkegiatan Organisasi</h4> -->
              <p style="color: black;">Penguatan organisasi masyarakat.</p>
            </div>
          </a>
        </div>

        <!-- Lingkungan Keluarga -->
        <div class="swiper-slide">
          <a href="{{ route('lingkungan-keluarga') }}" class="card-link">
            <div class="testimonial-item card-yellow highlight-card">
              <div class="icon-wrapper">
                <i class="bi bi-house-door-fill"></i> <!-- Ikon -->
              </div>
              <h3 style="color: black;">Lingkungan Keluarga</h3><br>
              <!-- <h4 style="color: black;">Subkegiatan Keluarga</h4> -->
              <p style="color: black;">Lingkungan keluarga untuk pengasuhan alternatif.</p>
            </div>
          </a>
        </div>

        <div class="swiper-slide">
          <a href="{{ route('kesehatan-dasar') }}" class="card-link">
            <div class="testimonial-item ">
              <div class="icon-wrapper">
                <i class="bi bi-person-fill"></i> 
              </div>
              <h3 style="color: black;">Kesehatan Dasar dan Kesejahteraan</h3><br>
              <!-- <h4 style="color: black;">Subkegiatan Sipil</h4> -->
              <div class="highlight-pink">
              <p>Kesehatan bagi Hak Anak anak </p>
                </div>
            </div>
          </a>
        </div>

        <!-- Pendidikan dan Pemanfaatan -->
        <div class="swiper-slide">
          <a href="{{ route('pendidikan-pemanfaatan') }}" class="card-link">
            <div class="testimonial-item">
              <div class="icon-wrapper">
                <i class="bi bi-book-fill"></i> <!-- Ikon -->
              </div>
              <h3 style="color: black;">Pendidikan dan Pemanfaatan</h3><br>
              <!-- <h4 style="color: black;">Subkegiatan Pendidikan</h4> -->
              <p style="color: black;">Pendidikan dan kegiatan budaya untuk kesejahteraan anak.</p>
            </div>
          </a>
        </div>
      </div>
      <div class="swiper-pagination"></div>
    </div>
  </div>
</section>


 


    <!-- bagian kota layak anak -->
    <!-- About Section -->
    <section id="about" class="about section hero section">
      <div class="container py-3">
          <div class="row align-items-center">
          <!-- Gambar di Kiri -->
          <div class="col-lg-6 col-md-12 order-1 order-lg-1 hero-img" data-aos="zoom-out" data-aos-delay="100">
          <img src="{{ asset('assets/img/hero-img.jpg') }}" class="img-fluid animated" alt="">
      </div>

      <!-- Teks di Kanan -->
      <div class="col-lg-6 col-md-12 order-2 order-lg-2" data-aos="fade-left">
        <div class="content text-center">
          <!-- Query di Blade untuk Judul dan Deskripsi -->
          @php
              $judulKotaLayakAnak = $kotaLayakAnak->firstWhere('nama', 'Judul_kota_layak_anak');
              $deskripsiKotaLayakAnak = $kotaLayakAnak->firstWhere('nama', 'deskripsi_kota_layak_anak');
          @endphp

          <!-- Tampilkan Judul -->
            <h2 class="fw-bold mb-4" style="font-size: 36px;">
              {{ $judulKotaLayakAnak->detail ?? 'Judul Kota Layak Anak belum tersedia.' }}
            </h2>

          <!-- Tampilkan Deskripsi -->
              <p class="text-muted fst-italic">
                {{ $deskripsiKotaLayakAnak->detail ?? 'Deskripsi tentang Kota Layak Anak belum tersedia.' }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>



    <!-- Services Section -->
    <section id="services" class="services section1 py-5 galeri-section">
      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up"style="color: red;">
        <span>GALERI</span>
        <h2>GALERI</h2>
      </div>
      <div class="container">
        <div class="row gy-4">
          @foreach ($galeri as $gambar)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 + 100 }}">
              <div class="service-item">
                <!-- Thumbnail Image -->
                <img src="{{ asset($gambar->gambar) }}" alt="Galeri Image" 
                    class="img-fluid w-100"
                    data-bs-toggle="modal" data-bs-target="#modal{{ $loop->index }}">

                <!-- Title -->
                  <div>
                  <h3 >{{ $gambar->judul }}</h3>
                </div>
              </div>
            </div>

            <!-- Modal for Image -->
            <div class="modal fade" id="modal{{ $loop->index }}" tabindex="-1" aria-labelledby="modalLabel{{ $loop->index }}" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-body">
                    <div class="d-flex justify-content-center align-items-center">
                      <img src="{{ asset($gambar->gambar) }}" alt="Galeri Image" class="img-fluid">
                    </div>
                    <div>
                      <h5>{{ $gambar->judul }}</h5>
                      <p  style="color: black;">{{ $gambar->keterangan }}</p>
                    </div>
                  </div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-sm custom-btn-color" data-bs-dismiss="modal">Tutup</button>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>



    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <span>BERITA DAN ARTIKEL</span>
        <h2>BERITA DAN ARTIKEL</h2>
    </div>
    <!-- End Section Title -->

    <div class="container">
        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
    <!-- Filter Kategori -->
        <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
            <li data-filter="*" class="filter-active">All</li>
            @foreach ($kategoriArtikel as $kategori)
                <li data-filter=".filter-{{ $kategori->id }}">{{ $kategori->nama }}</li>
            @endforeach
        </ul><!-- End Portfolio Filters -->

        <!-- Portfolio Items -->
        <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
            @foreach ($karyaAnak as $artikel)
                <div class="col-lg-4 col-md-6 col-sm-12 portfolio-item isotope-item filter-{{ $artikel->kategoriartikelid }}">
                    <div class="card h-100 text-center d-flex flex-column justify-content-between align-items-center p-3">
                        <!-- Gambar Artikel -->
                        <img src="{{ asset($artikel->gambar) }}" class="card-img-top img-fluid" alt="{{ $artikel->judul }}">
                        
                        <!-- Judul Artikel -->
                        <h4 class="card-title mt-3">{{ $artikel->judul }}</h4>
                        
                        <!-- Tombol Preview -->
                        <div class="mt-4">
                            <a href="{{ asset($artikel->gambar) }}" 
                               title="{{ $artikel->judul }}" 
                               data-gallery="portfolio-gallery-{{ $artikel->kategoriartikelid }}" 
                               class="glightbox preview-link btn btn-primary btn-sm" 
                               data-description="{{ $artikel->judul }}">
                               <i class="bi bi-zoom-in"></i> Preview
                            </a>
                        </div>
                    </div>
                </div><!-- End Portfolio Item -->
            @endforeach
        </div><!-- End Portfolio Container -->

    </div>
  </div>
</section>
@endsection