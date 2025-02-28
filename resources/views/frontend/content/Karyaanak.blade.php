@extends('frontend.user-main')
@section('content')
<section id="portfolio" class="portfolio section">
<div class="container section-title" data-aos="fade-up">
        <span>KARYA ANAK SURABAYA</span>
        <h2>KARYA ANAK SURABAYA</h2>
        <p>Temukan artikel kegiatan terbaru yang bermanfaat dan menarik untuk dibaca.</p>
    </div>

  <div class="container">
    <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

      <!-- Portfolio Filters -->
      <ul class="portfolio-filters isotope-filters d-flex justify-content-center gap-3" data-aos="fade-up" data-aos-delay="100" style="margin-bottom: 30px;">
        <li data-filter="*" class="filter-active">All</li>
        <li data-filter=".filter-kota">Kota</li>
        <li data-filter=".filter-kecamatan">Kecamatan</li>
        <li data-filter=".filter-kelurahan">Kelurahan</li>
      </ul>
      <!-- End Portfolio Filters -->

      <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
        <!-- Loop through $datas -->
        @foreach ($datas as $data)
        <div class="col-lg-4 col-md-6 col-sm-12 portfolio-item isotope-item filter-{{ strtolower($data->tingkatKarya) }}">
          <div class="card border-0 shadow-sm h-100">
            <div class="card-img">
              <img src="{{ asset($data->gambar) }}" class="img-fluid rounded-top" alt="{{ $data->judul }}" style="height: 250px; object-fit: cover;">
            </div>
            <div class="card-body text-center">
              <h5 class="card-title font-weight-bold">{{ $data->judul }}</h5>
              <a href="{{ asset($data->gambar) }}" 
                 title="{{ $data->judul }}" 
                 data-description="{{ $data->deskripsi }}" 
                 data-gallery="portfolio-gallery-{{ strtolower($data->tingkatKarya) }}" 
                 class="glightbox btn btn-outline-primary btn-sm">
                <i class="bi bi-zoom-in"></i> Lihat Detail
              </a>
            </div>
          </div>
        </div>
        @endforeach
        <!-- End Loop -->
      </div><!-- End Portfolio Container -->

    </div>
  </div>
</section>

<!-- CSS for styling -->
<style>
  /* CSS untuk menyamakan ukuran card */
  .portfolio-item .card {
    height: 100%; /* Pastikan card mengambil ketinggian penuh */
    display: flex;
    flex-direction: column;
  }

  .portfolio-item img {
    height: 250px; /* Tinggi gambar */
    object-fit: cover; /* Gambar selalu memenuhi area */
    width: 100%; /* Pastikan gambar memenuhi lebar */
  }

  /* CSS untuk menyempurnakan filter */
  .portfolio-filters li {
    cursor: pointer;
    font-size: 1rem;
    padding: 8px 15px;
    border: none; /* Menghapus border */
    color: #000; /* Teks hitam */
    text-transform: uppercase;
    transition: all 0.3s ease;
  }

  .portfolio-filters .filter-active {
    font-weight: bold; /* Teks bold untuk filter aktif */
    color: #000; /* Teks aktif tetap hitam */
    background: none; /* Menghapus background */
  }

  .portfolio-filters li:hover {
    color: #007bff; /* Teks biru saat hover */
  }
</style>

<!-- JavaScript for Glightbox -->
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const lightbox = GLightbox({
      touchNavigation: true,
      loop: true,
      closeOnOutsideClick: true,
      selector: '.glightbox',
      description: true, // Memunculkan deskripsi dalam lightbox
    });
  });
</script>

<!-- Link Glightbox CSS -->
<link href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" rel="stylesheet">
@endsection
