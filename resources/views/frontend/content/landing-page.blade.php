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


<style>
/* ==== SWIPER SLIDE ==== */
/* ==== SWIPER SLIDE ==== */
.swiper-slide {
  display: flex;
  height: 100%;
  align-items: stretch;
}

/* ==== CARD ==== */
.card {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  width: 100%;
  min-height: 320px;
  height: 100%;
}

/* ==== CARD BODY ==== */
.card-body {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  flex: 1;
  text-align: center;
}

/* ==== ICON ==== */
.icon-wrapper {
  margin-bottom: 1rem;
}

/* ICON DEFAULT (belum diklik) = PINK */
.icon-wrapper i {
  color: #4F7097 !important; /* pink */
  opacity: 1;
  filter: none;
  transition: all 0.3s ease;
}

/* ICON SAAT HOVER = BIRU GELAP */
.swiper-slide:hover .icon-wrapper i {
  color: #152744 !important; /* biru gelap */
  transform: scale(1.1);
}

/* ==== BUTTON SELENGKAPNYA ==== */
.btn-selengkapnya {
  margin-top: auto;
  background-color: #4F7097; /* pink */
  color: #fff;
  border: none;
  padding: 10px 20px;
  border-radius: 6px;
  font-weight: 500;
  opacity: 0.95;
  transition: all 0.3s ease;
  text-decoration: none;
}

/* HOVER BUTTON = BIRU GELAP */
.swiper-slide:hover .btn-selengkapnya {
  background-color: #152744;
  color: #fff;
  transform: scale(1.05);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

/* ==== TEKS ==== */
.card-title {
  color: #333;
  font-weight: 600;
}

/* .card-text {
  color: #666;
} */




</style>


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
  <!-- <div class="container section-title" data-aos="fade-up"> -->
    <!-- <h2 class="text-center mb-5">Testimoni</h2> -->
  </div>
  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="swiper init-swiper">
      <script type="application/json" class="swiper-config">
        {
          "loop": true,
          "speed": 600,
          "autoplay": {
            "delay": 5000
          },
        
          "breakpoints": {
            "320": {
              "slidesPerView": 1,
              "spaceBetween": 20
            },
            "768": {
              "slidesPerView": 2,
              "spaceBetween": 30
            },
            "1200": {
              "slidesPerView": 3,
              "spaceBetween": 40
            }
          }
        }
      </script>

      <!-- Swiper Wrapper -->
      <div class="swiper-wrapper">
        <!-- Card Perlindungan Khusus -->
        <div class="swiper-slide">
          <div class="card h-100 shadow-sm border-0">
            <div class="card-body text-center">
              <div class="icon-wrapper mb-3">
                <i class="bi bi-shield-fill fs-1 "></i>
              </div>
              <h5 class="card-title text-dark">Perlindungan Khusus</h5>
              <p class="card-text text-muted">Melindungi anak-anak dalam kondisi tertentu.</p>
              <a href="{{ route('perlindungan-khusus') }}" class="btn btn-selengkapnya">Selengkapnya</a>
            </div>
          </div>
        </div>

        <!-- Card Hak Sipil dan Kebebasan -->
        <div class="swiper-slide">
          <div class="card h-100 shadow-sm border-0">
            <div class="card-body text-center">
              <div class="icon-wrapper mb-3">
                <i class="bi bi-person-fill fs-1"></i>
              </div>
              <h5 class="card-title text-dark">Hak Sipil dan Kebebasan</h5>
              <p class="card-text text-muted">Hak sipil dan kebebasan untuk mendukung hak fundamental.</p>
              <a href="{{ route('haksipil') }}" class="btn btn-selengkapnya">Selengkapnya</a>
            </div>
          </div>
        </div>

        <!-- Card Kelembagaan -->
        <div class="swiper-slide">
          <div class="card h-100 shadow-sm border-0">
            <div class="card-body text-center">
              <div class="icon-wrapper mb-3">
                <i class="bi bi-building fs-1 "></i>
              </div>
              <h5 class="card-title text-dark">Kelembagaan</h5>
              <p class="card-text text-muted">Penguatan organisasi masyarakat.</p>
              <a href="{{ route('kelembagaan') }}" class="btn btn-selengkapnya">Selengkapnya</a>
            </div>
          </div>
        </div>

        <!-- Card Lingkungan Keluarga -->
        <div class="swiper-slide">
          <div class="card h-100 shadow-sm border-0">
            <div class="card-body text-center">
              <div class="icon-wrapper mb-3">
                <i class="bi bi-house-door-fill fs-1 "></i>
              </div>
              <h5 class="card-title text-dark">Lingkungan Keluarga</h5>
              <p class="card-text text-muted">Lingkungan keluarga untuk pengasuhan alternatif.</p>
              <a href="{{ route('lingkungan-keluarga') }}" class="btn btn-selengkapnya">Selengkapnya</a>
            </div>
          </div>
        </div>

        <!-- Card Kesehatan Dasar -->
        <div class="swiper-slide">
          <div class="card h-100 shadow-sm border-0">
            <div class="card-body text-center">
              <div class="icon-wrapper mb-3">
                <i class="bi bi-person-fill fs-1"></i>
              </div>
              <h5 class="card-title text-dark">Kesehatan Dasar</h5>
              <p class="card-text text-muted">Kesehatan bagi Hak Anak-anak.</p>
              <a href="{{ route('kesehatan-dasar') }}" class="btn btn-selengkapnya">Selengkapnya</a>
            </div>
          </div>
        </div>

        <!-- Card Pendidikan dan Pemanfaatan -->
        <div class="swiper-slide">
          <div class="card h-100 shadow-sm border-0">
            <div class="card-body text-center">
              <div class="icon-wrapper mb-3">
                <i class="bi bi-book-fill fs-1 "></i>
              </div>
              <h5 class="card-title text-dark">Pendidikan dan Pemanfaatan</h5>
              <p class="card-text text-muted">Pendidikan dan kegiatan budaya untuk kesejahteraan anak.</p>
              <a href="{{ route('pendidikan-pemanfaatan') }}" class="btn btn-selengkapnya">Selengkapnya</a>
            </div>
          </div>
        </div>
      </div>

      <!-- Swiper Pagination -->
       <!-- <div class="swiper-pagination mt-4"></div> -->
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
  <div class="container section-title" data-aos="fade-up" style="color: red;">
    <span>GALERI</span>
    <h2>GALERI</h2>
  </div>

  <div class="container">
    <div class="row gy-4">
      @foreach ($galeri as $gambar)
        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 + 100 }}">
          <div class="card h-100 shadow-sm border-0" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#modal{{ $loop->index }}">
            <!-- Gambar Thumbnail -->
            <img src="{{ asset($gambar->gambar) }}" alt="Galeri Image" class="card-img-top img-fluid" style="height: 200px; object-fit: cover;">

            <!-- Judul -->
            <div class="card-body text-center">
              <h5 style="color: black;" class="mb-0">{{ $gambar->nama }}</h5>
            </div>
          </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modal{{ $loop->index }}" tabindex="-1" aria-labelledby="modalLabel{{ $loop->index }}" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" style="max-width: 600px;">
            <div class="modal-content">
              <!-- Modal Header -->
              <div class="modal-header">
                <h5 style="color: black;"class="modal-title" id="modalLabel{{ $loop->index }}">{{ $gambar->nama }}</h5>
              </div>

              <!-- Modal Body -->
              <div class="modal-body text-center">
                <img src="{{ asset($gambar->gambar) }}" alt="Galeri Image" class="img-fluid mb-3">
                <p class="text-start" style="color: black;">{{ $gambar->keterangan }}</p>
              </div>

              <!-- Modal Footer -->
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
@endsection