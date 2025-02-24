@extends('frontend.user-main')

@section('content')
<!-- Seksi Galeri -->
<div class="container mt-5 pt-4">
    <div class="card shadow-lg border-0 position-relative overflow-hidden mb-5">
        <!-- Card Pembatas Besar dengan Judul dan Galeri -->
        <div class="card shadow-lg border-0 rounded-4 p-4">
            <div class="card-header text-center" style="background: rgb(233, 36,103);">
                <h2 class="fw-bold text-white m-0">GALERI KOTA LAYAK ANAK</h2>
            </div>
            <div class="card-body">
                <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
                    @foreach($gambars as $index => $gambar)
                    <div class="col-lg-4 col-md-6">
                        <div class="card-gallery">
                            <!-- Gambar -->
                            <img src="{{ asset($gambar->gambar) }}" 
                                 class="gallery-image" 
                                 alt="Gallery Image" 
                                 data-img-src="{{ asset($gambar->gambar) }}" 
                                 data-img-index="{{ $index }}" 
                                 data-img-description="{{ $gambar->deskripsi }}" 
                                 data-bs-toggle="modal" 
                                 data-bs-target="#imageModal">
                            <!-- Overlay -->
                            <div class="overlay" data-img-src="{{ asset($gambar->gambar) }}" 
                                 data-description="{{ $gambar->deskripsi }}" 
                                 data-bs-toggle="modal" 
                                 data-bs-target="#imageModal">
                                <span class="plus-icon">+</span>
                            </div>
                        </div>
                        <!-- Deskripsi Gambar -->
                        <div class="text-center mt-2">
                            <p class="text-muted">{{ $gambar->deskripsi }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Bootstrap -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Lihat Gambar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <!-- Tombol Navigasi Kiri -->
                <button id="prevBtn" class="btn btn-light position-absolute" style="left: 0; top: 50%; transform: translateY(-50%); font-size: 30px; z-index: 100;">
                    &lt;
                </button>
                <img id="modalImage" class="img-fluid rounded" src="" alt="Selected Image" style="max-width: 100%; max-height: 80vh;">
                <!-- Tombol Navigasi Kanan -->
                <button id="nextBtn" class="btn btn-light position-absolute" style="right: 0; top: 50%; transform: translateY(-50%); font-size: 30px; z-index: 100;">
                    &gt;
                </button>
                <!-- Deskripsi Gambar -->
                <div id="imageDescription" class="mt-3 text-center"></div>
                <div id="imageCounter" class="mt-3"></div>
            </div>
        </div>
    </div>
</div>

<!-- Gaya -->
<style>
    .card-gallery {
        position: relative;
        width: 100%;
        height: 250px; /* Tinggi card */
        border-radius: 15px;
        overflow: hidden;
        border: 2px solid #fff;
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2); /* Shadow */
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .card-gallery:hover {
        transform: scale(1.05); /* Efek hover */
        box-shadow: 0px 12px 24px rgba(0, 0, 0, 0.4); /* Shadow lebih besar */
    }

    .gallery-image {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Gambar proporsional */
    }

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

    /* Responsif */
    @media (max-width: 768px) {
        .col-md-6 {
            flex: 0 0 50%;
            max-width: 50%;
        }
    }

    @media (max-width: 576px) {
        .col-sm-6 {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }

    /* Modal */
    #modalImage {
        width: auto;
        max-width: 90vw;
        max-height: 80vh;
    }
</style>

<!-- Skrip -->
<script>
    let currentIndex = 0;

    document.addEventListener("DOMContentLoaded", function () {
        // Event listener untuk klik gambar atau overlay
        document.addEventListener("click", function (event) {
            if (event.target.classList.contains("overlay") || event.target.classList.contains("gallery-image")) {
                const imgSrc = event.target.getAttribute("data-img-src");
                currentIndex = event.target.getAttribute("data-img-index");
                const description = event.target.getAttribute("data-img-description");

                // Update modal dengan gambar dan deskripsi
                document.getElementById("modalImage").setAttribute("src", imgSrc);
                document.getElementById("imageDescription").textContent = description;
                updateImageCounter();
            }
        });

        // Navigasi ke gambar sebelumnya
        document.getElementById("prevBtn").addEventListener("click", function () {
            if (currentIndex > 0) {
                currentIndex--;
                const img = document.querySelector(`[data-img-index="${currentIndex}"]`);
                document.getElementById("modalImage").setAttribute("src", img.getAttribute("data-img-src"));
                document.getElementById("imageDescription").textContent = img.getAttribute("data-img-description");
                updateImageCounter();
            }
        });

        // Navigasi ke gambar berikutnya
        document.getElementById("nextBtn").addEventListener("click", function () {
            const nextIndex = parseInt(currentIndex) + 1;
            const img = document.querySelector(`[data-img-index="${nextIndex}"]`);
            if (img) {
                currentIndex = nextIndex;
                document.getElementById("modalImage").setAttribute("src", img.getAttribute("data-img-src"));
                document.getElementById("imageDescription").textContent = img.getAttribute("data-img-description");
                updateImageCounter();
            }
        });

        // Update counter gambar di modal
        function updateImageCounter() {
            const totalImages = document.querySelectorAll(".gallery-image").length;
            document.getElementById("imageCounter").textContent = `Foto ${parseInt(currentIndex) + 1} dari ${totalImages}`;
        }
    });
</script>

@endsection
