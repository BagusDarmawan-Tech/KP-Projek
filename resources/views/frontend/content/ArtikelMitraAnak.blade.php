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
        <span>ARTIKEL MITRA ANAK</span>
        <h2>ARTIKEL MITRA ANAK</h2>
        <p>Kumpulan karya inspiratif dari anak-anak yang kreatif dan inovatif.</p>
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
                @foreach ($datas as $data)
                <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-{{ $data->kategori ? Str::slug($data->kategori->nama) : 'default' }}">
                    <div class="card shadow-sm">
                        <!-- Gambar Artikel -->
                        <img src="{{ asset($data->gambar) }}" class="card-img-top img-fluid" alt="{{ $data->judul }}">
                        
                        <!-- Konten Artikel -->
                        <div class="card-body">
                            <h5 class="card-title">{{ $data->judul }}</h5>
                            <p class="card-text">{{ Str::limit($data->konten, 100) }}</p>
                            
                            <!-- Tombol Lihat -->
                            <a href="{{ asset($data->gambar) }}" 
                               class="glightbox" 
                               data-gallery="portfolio-gallery" 
                               data-title="{{ $data->judul }}" 
                               data-description="{{ $data->konten }}">
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

    // Filter functionality
    const filterButtons = document.querySelectorAll('.portfolio-filters li');
    const portfolioItems = document.querySelectorAll('.portfolio-item');

    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Set active class
            document.querySelector('.portfolio-filters .filter-active').classList.remove('filter-active');
            button.classList.add('filter-active');

            const filter = button.getAttribute('data-filter');

            portfolioItems.forEach(item => {
                if (filter === '*' || item.classList.contains(filter.slice(1))) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
});
</script>

@endsection
