@extends('frontend.user-main')

@section('content')

    <!-- Hero Section -->
    <section id="hero" class="hero section">

      <div class="container">
        <div class="row gy-1">
          <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="fade-up">
           <center> <h1>SELAMAT DATANG DI WEBSITE SITALAS</h1></center>
          
          </div>
          <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="100">
            <img src="{{asset('assets/img/hero-img.jpg')}}" class="img-fluid animated" alt="">
          </div>
          <div>
        </div>
      </div>

    </section><!-- /Hero Section -->


    
    <!-- bagian Carosel -->
    <style>
  /* Atur ukuran gambar carousel */
  .carousel-inner img {
    width: 100%; /* Gambar akan menyesuaikan lebar container */
    height: 500px; /* Tinggi tetap */
    object-fit: cover; /* Memastikan gambar tidak terdistorsi */
  }
</style>




    <!-- batas selesesai -->  



    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
          <!-- <span>Testimonials</span>
          <h2>Testimonials</h2> -->
      </div><!-- End Section Title -->
      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="swiper init-swiper" data-speed="600" data-delay="5000" data-breakpoints="{ &quot;320&quot;: { &quot;slidesPerView&quot;: 1, &quot;spaceBetween&quot;: 40 }, &quot;1200&quot;: { &quot;slidesPerView&quot;: 3, &quot;spaceBetween&quot;: 40 } }">
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
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-item" "="">
            <p>
              <i class=" bi bi-quote quote-icon-left"></i>
                <span>Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.</span>
                <i class="bi bi-quote quote-icon-right"></i>
                </p>
                <img src="assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">
                <h3>Saul Goodman</h3>
                <h4>Ceo &amp; Founder</h4>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
                <img src="assets/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">
                <h3>Sara Wilsson</h3>
                <h4>Designer</h4>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
                <img src="assets/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt="">
                <h3>Jena Karlis</h3>
                <h4>Store Owner</h4>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
                <img src="assets/img/testimonials/testimonials-4.jpg" class="testimonial-img" alt="">
                <h3>Matt Brandon</h3>
                <h4>Freelancer</h4>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum quid.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
                <img src="assets/img/testimonials/testimonials-5.jpg" class="testimonial-img" alt="">
                <h3>John Larson</h3>
                <h4>Entrepreneur</h4>
              </div>
            </div><!-- End testimonial item -->

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>

    </section><!-- /Testimonials Section -->
 
    <!-- bagian kota layak anak -->
     
    <!-- About Section -->
    <section id="about" class="about section">
    <!-- Section Title -->
    <div class="container section-title text-dark" data-aos="fade-up">
          <span style="font-size: 36px;">KOTA LAYAK ANAK</span>
          <h2 style="font-size: 36px;">KOTA LAYAK ANAK</h2>
      </div>

    <!-- End Section Title -->
    <div class="container py-3">
    <div class="row align-items-center">
        <!-- Carousel Area -->
        <div class="col-lg-6 col-md-12 mb-4 mb-lg-0" data-aos="fade-right">
            <div id="carouselExampleIndicators" class="carousel slide shadow-lg rounded" data-bs-ride="carousel">
                <!-- Carousel Indicators -->
                <div class="carousel-indicators">
                    @foreach ($gambars as $key => $gambar)
                        <button type="button" 
                                data-bs-target="#carouselExampleIndicators" 
                                data-bs-slide-to="{{ $key }}" 
                                class="{{ $key == 0 ? 'active' : '' }}" 
                                aria-current="{{ $key == 0 ? 'true' : '' }}" 
                                aria-label="Slide {{ $key + 1 }}">
                        </button>
                    @endforeach
                </div>

                <!-- Carousel Items -->
                <div class="carousel-inner">
                    @if ($gambars->isNotEmpty())
                        @foreach ($gambars as $key => $gambar)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                <img src="{{ asset($gambar->gambar) }}" class="d-block w-100 rounded" alt="{{ $gambar->nama }}">
                                <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-3">
                                    <h5 class="text-white fw-bold">{{ $gambar->nama }}</h5>
                                    <p class="text-white">{{ $gambar->caption }}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="carousel-item active">
                            <img src="{{ asset('assets/img/default-image.jpg') }}" class="d-block w-100 rounded" alt="Default Slide">
                            <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-3">
                                <h5 class="text-white fw-bold">Default Slide</h5>
                                <p class="text-white">Tidak ada gambar yang aktif.</p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Carousel Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <!-- End Carousel Area -->

        <!-- Text Area -->
        <div class="col-lg-6 col-md-12" data-aos="fade-left">
    <div class="content">
        <!-- Query di Blade untuk Judul -->
        @php
            // Ambil data dari koleksi berdasarkan nama
            $judulKotaLayakAnak = $kotaLayakAnak->firstWhere('nama', 'Judul_kota_layak_anak');
            $deskripsiKotaLayakAnak = $kotaLayakAnak->firstWhere('nama', 'deskripsi_kota_layak_anak');
        @endphp

        <!-- Tampilkan Judul -->
        <h3 class="fw-bold text-center mb-4">
            {{ $judulKotaLayakAnak->detail ?? 'Judul Kota Layak Anak belum tersedia.' }}
        </h3>

        <!-- Tampilkan Deskripsi -->
        <p class="text-muted fst-italic">
            {{ $deskripsiKotaLayakAnak->detail ?? 'Deskripsi tentang Kota Layak Anak belum tersedia.' }}
        </p>
    </div>
</div>


</section>

    </section><!-- /About Section -->
    </section><!-- /Stats Section -->

    <!-- Services Section -->
     <section id="services" class="services section py-5" style="background-color: #f9f9f9;">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <span>GALERI</span>
        <h2>GALERI</h2>
      </div><!-- End Section Title -->

    <div class="container">
        <div class="row gy-4">
            @foreach ($galeri as $gambar)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 + 100 }}">
                    <div class="service-item position-relative overflow-hidden shadow rounded bg-white" style="border: 1px solid #ddd;">
                        <!-- Thumbnail Image -->
                        <img src="{{ asset($gambar->gambar) }}" alt="Galeri Image" 
                            class="img-fluid w-100 rounded-top" 
                            style="height: 250px; object-fit: cover; cursor: pointer;" 
                            data-bs-toggle="modal" data-bs-target="#modal{{ $loop->index }}">

                        <!-- Title -->
                        <div style="padding: 15px; text-align: center;">
                            <h3 class="text-primary" style="font-size: 18px; font-weight: 600;">{{ $gambar->judul }}</h3>
                        </div>
                    </div>
                </div>

                <!-- Modal for Image -->
                <div class="modal fade" id="modal{{ $loop->index }}" tabindex="-1" aria-labelledby="modalLabel{{ $loop->index }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
                        <div class="modal-content" style="border-radius: 10px; overflow: hidden;">
                            <div class="modal-body p-0">
                                <div class="d-flex justify-content-center align-items-center" style="height: 300px; background-color: white;">
                                    <img src="{{ asset($gambar->gambar) }}" alt="Galeri Image" 
                                        class="img-fluid" 
                                        style="max-height: 100%; max-width: 100%; object-fit: contain;">
                                </div>
                                <div style="padding: 15px;">
                                    <h5 class="text-primary" style="font-size: 16px; font-weight: 600;">{{ $gambar->judul }}</h5>
                                    <p style="font-size: 14px; color: #555; text-align: center;">{{ $gambar->keterangan }}</p>
                                </div>
                            </div>
                            <div class="modal-footer" style="border-top: none; justify-content: center;">
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" style="padding: 5px 20px;">Tutup</button>
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
</div><!-- End Section Title -->

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
                        <img src="{{ asset($artikel->gambar) }}" class="card-img-top img-fluid" alt="{{ $artikel->judul }}" style="height: 200px; object-fit: cover; border-radius: 10px;">
                        
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


    <!-- BAGIAN KUNJUNGAN WEB -->
    <!-- Stats Section -->
    <section id="stats" class="stats section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="1" class="purecounter"></span>
              <p>Pengujung</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1" class="purecounter"></span>
              <p>Projects</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="1453" data-purecounter-duration="1" class="purecounter"></span>
              <p>Hours Of Support</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="32" data-purecounter-duration="1" class="purecounter"></span>
              <p>Workers</p>
            </div>
          </div><!-- End Stats Item -->
            <!-- BAGIAN KUNJUNGAN WEB -->

     <!-- bagian halaman kontak -->
              
    </section><!-- /Contact Section -->


    
@endsection