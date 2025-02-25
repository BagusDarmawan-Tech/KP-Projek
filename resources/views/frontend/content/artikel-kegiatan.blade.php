@extends('frontend.user-main')
@section('content')

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

    /* CSS untuk modal */
    .modal-dialog {
        max-width: 700px; /* Maksimal lebar modal */
        width: 90%; /* Pastikan modal fleksibel pada layar kecil */
    }
    .modal-body img {
        max-height: 350px; /* Batas tinggi gambar dalam modal */
        object-fit: cover;
        width: 100%; /* Pastikan gambar dalam modal responsif */
    }

    /* Tambahan responsivitas */
    @media (max-width: 768px) {
        .card-img-top {
            height: 150px; /* Gambar lebih kecil pada layar kecil */
        }
        .modal-dialog {
            max-width: 90%; /* Modal lebih kecil pada layar kecil */
        }
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
                            <button type="button" 
                                    class="btn btn-sm btn-outline-secondary" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modalArtikel{{ $article->id }}">
                                <i class="bi bi-zoom-in"></i> Lihat
                            </button>
                        </div>
                    </div>
                </div><!-- End Portfolio Item -->

                <!-- Modal untuk Artikel -->
                <div class="modal fade" id="modalArtikel{{ $article->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $article->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center w-100 text-dark fw-bold" id="modalLabel{{ $article->id }}">{{ $article->judul }}</h5>
                            <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                        </div>

                            <div class="modal-body text-center text-dark fs-4">
                                <!-- Gambar -->
                                <img src="{{ asset($article->gambar) }}" class="img-fluid mb-3" alt="{{ $article->judul }}">
                                <!-- Deskripsi -->
                                <p>{{ $article->konten }}</p>
                                <!-- Kategori -->
                                <p><strong>Kategori :</strong> 
                                    @if ($article->kategori)
                                        {{ $article->kategori->nama }}
                                    @else
                                        Tidak ada kategori
                                    @endif
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal -->
                @endforeach
            </div><!-- End Artikel -->
        </div>
    </div>
</section>

@endsection
