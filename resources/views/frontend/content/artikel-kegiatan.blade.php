@extends('frontend.user-main')
@section('content')

<!-- Tambahkan Glightbox CSS -->
<link href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" rel="stylesheet">

<style>
    /* Gaya untuk Filter Kategori */
    .portfolio-filters li {
        cursor: pointer;
        font-weight: normal; /* Font normal untuk yang tidak aktif */
        color: black; /* Warna teks default */
        text-transform: uppercase; /* Huruf besar semua */
        list-style: none;
    }

    .portfolio-filters li.filter-active {
        color: #ff0077; /* Warna pink untuk yang aktif */
        font-weight: bold; /* Font tebal untuk yang aktif */
    }

    .portfolio-filters li:hover {
        color: #ff0077; /* Warna pink saat hover */
    }

    /* CSS untuk ukuran card */
    .card {
        height: 100%;
    }
    .card-img-top {
        height: 200px; /* Tinggi tetap untuk gambar */
        object-fit: cover; /* Gambar di-crop untuk memenuhi ukuran */
    }
    .card-body {
        text-align: center;
    }

    /* Tambahan styling untuk Glightbox */
    .glightbox-container {
        background-color: rgba(0, 0, 0, 0.85); /* Warna latar modal */
    }
    .gtitle {
        font-size: 20px; /* Ukuran font untuk judul */
        font-weight: bold;
        color: #fff; /* Warna teks judul */
    }
    .gdesc {
        font-size: 16px; /* Ukuran font untuk deskripsi */
        color: #fff; /* Warna teks deskripsi */
        text-align: center;
        margin-top: 10px;
    }
</style>

<section id="portfolio" class="portfolio section">
    <div class="container section-title" data-aos="fade-up">
        <span>ARTIKEL KEGIATAN SITALAS</span>
        <h2>ARTIKEL KEGIATAN SITALAS</h2>
        <p>Temukan artikel kegiatan terbaru yang bermanfaat dan menarik untuk dibaca.</p>
    </div><!-- End Section Title -->

    <div class="container">
        <!-- Filter Kategori -->
        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
            <ul class="portfolio-filters isotope-filters d-flex justify-content-center gap-3 mb-4" data-aos="fade-up" data-aos-delay="100">
                <li data-filter="*" class="filter-active">All</li>
                @foreach ($categories as $category)
                    <li data-filter=".filter-{{ Str::slug($category->nama) }}">{{ $category->nama }}</li>
                @endforeach
            </ul><!-- End Portfolio Filters -->

            <!-- Artikel -->
            <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
                @foreach ($articles as $article)
                <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-{{ $article->kategori ? Str::slug($article->kategori->nama) : 'default' }}">
                    <div class="card shadow-sm">
                        <!-- Gambar Artikel -->
                        <img src="{{ asset($article->gambar) }}" class="card-img-top img-fluid" alt="{{ $article->judul }}">
                        
                        <!-- Konten Artikel -->
                        <div class="card-body">
                            <h5 class="card-title">{{ $article->judul }}</h5>
                            <p class="card-text">{{ Str::limit($article->konten, 100) }}</p>
                            
                            <!-- Tombol Lihat -->
                            <a href="{{ asset($article->gambar) }}" 
                               class="glightbox" 
                               data-gallery="portfolio-gallery" 
                               data-title="{{ $article->judul }}" 
                               data-description="{{ $article->konten }}">
                                <button class="btn btn-sm btn-outline-secondary">
                                    <i class="bi bi-zoom-in"></i> Lihat
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div><!-- End Artikel -->
        </div>
    </div>
</section>

<!-- Tambahkan Glightbox JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const lightbox = GLightbox({
        touchNavigation: true,
        loop: true,
        closeOnOutsideClick: true,
        selector: '.glightbox',
    });
});
</script>

@endsection
