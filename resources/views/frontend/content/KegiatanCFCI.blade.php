@extends('frontend.user-main')

@section('content')
<!-- Seksi Galeri -->
<div class="container mt-5 pt-4">
    <div class="card shadow-lg border-0 position-relative overflow-hidden mb-5"> 
        <!-- Card Pembatas Besar dengan Judul dan Galeri -->
        <div class="card shadow-lg border-0 rounded-4 p-4">
            <div class="card-header text-center" style="background: rgb(233, 36,103);">
                <h2 class="fw-bold text-white m-0">KEGIATAN CFCI</h2>
            </div>
            <div class="card-body">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4 justify-content-center">
                    @foreach($datas as $data)
                    <div class="col">
                        <!-- Card Galeri -->
                        <div class="card card-gallery">
                            <div class="card-image-wrapper position-relative">
                                <img src="{{ asset($data->gambar) }}" class="gallery-image card-img-top" alt="{{ $data->nama }}">
                                <div class="overlay" data-bs-toggle="modal" data-bs-target="#imageModal-{{ $data->id }}">
                                    <span class="plus-icon">+</span>
                                </div>
                            </div>
                            <!-- Caption di bawah gambar -->
                            <div class="card-body text-center">
                                <h5 class="fw-bold">{{ $data->nama }}</h5> <!-- Nama Gambar -->
                                <p class="text-muted">{{ $data->deskripsi }}</p> <!-- Caption (Deskripsi) -->
                            </div>
                        </div>
                    </div>

                    <!-- Modal Bootstrap untuk Gambar -->
                    <div class="modal fade" id="imageModal-{{ $data->id }}" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="imageModalLabel">{{ $data->nama }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <img src="{{ asset($data->gambar) }}" class="img-fluid rounded" alt="{{ $data->nama }}">
                                    <!-- Caption di dalam Modal -->
                                    <p class="mt-3 text-muted">{{ $data->deskripsi }}</p>
                                    <p class="mt-3 text-muted">{{ $data->caption }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer otomatis ditampilkan dari layout -->
@endsection

<style>
    /* Card Gallery */
    .card-gallery {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .card-gallery:hover {
        transform: scale(1.03);
        box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
    }

    .card-image-wrapper {
        position: relative;
        overflow: hidden;
        border-radius: 15px;
    }

    .gallery-image {
        width: 100%;
        height: 250px; /* Set tinggi seragam untuk semua gambar */
        object-fit: cover; /* Memastikan gambar tidak terpotong */
    }

    /* Overlay */
    .overlay {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: rgba(0, 0, 0, 0.5);
        border-radius: 50%;
        width: 50px;
        height: 50px;
        display: flex;
        justify-content: center;
        align-items: center;
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
    }

    .card-gallery:hover .overlay {
        opacity: 1;
    }

    .plus-icon {
        color: white;
        font-size: 26px;
        font-weight: bold;
    }

    /* Card body styling */
    .card-body h5 {
        font-size: 18px;
        margin-bottom: 10px;
        color: #333;
    }

    .card-body p {
        font-size: 14px;
        color: #666;
    }

    /* Responsif untuk ukuran layar kecil */
    @media (max-width: 768px) {
        .gallery-image {
            height: 200px; /* Sesuaikan tinggi gambar untuk layar lebih kecil */
        }

        .card-body h5 {
            font-size: 16px; /* Sesuaikan ukuran teks nama */
        }

        .card-body p {
            font-size: 13px; /* Sesuaikan ukuran deskripsi */
        }
    }

    @media (max-width: 576px) {
        .gallery-image {
            height: 180px; /* Sesuaikan tinggi gambar untuk ponsel */
        }

        .card-body h5 {
            font-size: 14px; /* Perkecil teks nama untuk ponsel */
        }

        .card-body p {
            font-size: 12px; /* Perkecil deskripsi untuk ponsel */
        }
    }
</style>
