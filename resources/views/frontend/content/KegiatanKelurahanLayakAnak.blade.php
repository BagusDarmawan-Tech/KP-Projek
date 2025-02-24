@extends('frontend.user-main')

@section('content')
<!-- Seksi Galeri -->
<div class="container mt-5 pt-4">
    <div class="card shadow-lg border-0 position-relative overflow-hidden mb-5">
        <!-- Header Card -->
        <div class="card shadow-lg border-0 rounded-4 p-4">
            <div class="card-header text-center" style="background: rgb(233, 36,103);">
                <h2 class="fw-bold text-white m-0">KEGIATAN KELURAHAN KOTA LAYAK ANAK</h2>
            </div>
            <div class="card-body">
                <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
                    <!-- Looping Data dari Database -->
                    @foreach($gambars as $index => $gambar)
                    <div class="col-lg-4 col-md-6">
                        <div class="card gallery-card border-0 shadow-sm">
                            <!-- Gambar -->
                            <div class="card-gallery position-relative overflow-hidden">
                                <img src="{{ asset($gambar->gambar) }}" 
                                    class="gallery-image" 
                                    alt="{{ $gambar->nama }}" 
                                    data-img-src="{{ asset($gambar->gambar) }}" 
                                    data-img-index="{{ $index }}" 
                                    data-img-description="{{ $gambar->keterangan }}" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#imageModal">
                                <div class="overlay" 
                                    data-img-src="{{ asset($gambar->gambar) }}" 
                                    data-description="{{ $gambar->keterangan }}" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#imageModal">
                                    <span class="plus-icon">+</span>
                                </div>
                            </div>
                            <!-- Deskripsi -->
                            <div class="card-body text-center p-3">
                                <h6 class="card-title fw-bold text-truncate">{{ $gambar->nama }}</h6>
                                <p class="mb-0 text-muted text-truncate">{{ $gambar->keterangan }}</p>
                            </div>
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

                <!-- Gambar Modal -->
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
    .gallery-card {
        border-radius: 15px;
        overflow: hidden;
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .gallery-card:hover {
        transform: scale(1.03);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    .card-gallery {
        position: relative;
        width: 100%;
        height: 220px; /* Tinggi card gallery */
        overflow: hidden;
        border-radius: 15px 15px 0 0;
    }

    .gallery-image {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Menyesuaikan gambar */
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

    .text-truncate {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    /* Modal Styling */
    #modalImage {
        width: auto;
        max-width: 90vw;
        max-height: 80vh;
    }

    /* Responsif untuk layar kecil */
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
</style>

<!-- JavaScript -->
<script>
    let currentIndex = 0;

    // Membuka modal dan menampilkan gambar
    document.addEventListener("click", function (event) {
        if (event.target.classList.contains("overlay") || event.target.classList.contains("gallery-image")) {
            const imgSrc = event.target.getAttribute("data-img-src");
            currentIndex = parseInt(event.target.getAttribute("data-img-index"));
            const description = event.target.getAttribute("data-img-description");

            // Update modal
            document.getElementById("modalImage").setAttribute("src", imgSrc);
            document.getElementById("imageDescription").textContent = description;
            updateImageCounter();
        }
    });

    // Perbarui counter di modal
    function updateImageCounter() {
        const totalImages = document.querySelectorAll(".gallery-image").length;
        const counter = document.getElementById("imageCounter");
        counter.textContent = `Foto ${currentIndex + 1} dari ${totalImages}`;
    }

    // Navigasi ke gambar sebelumnya
    document.getElementById("prevBtn").addEventListener("click", function () {
        const images = document.querySelectorAll(".gallery-image");
        if (currentIndex > 0) {
            currentIndex--;
            const img = images[currentIndex];
            document.getElementById("modalImage").setAttribute("src", img.getAttribute("data-img-src"));
            document.getElementById("imageDescription").textContent = img.getAttribute("data-img-description");
            updateImageCounter();
        }
    });

    // Navigasi ke gambar berikutnya
    document.getElementById("nextBtn").addEventListener("click", function () {
        const images = document.querySelectorAll(".gallery-image");
        if (currentIndex < images.length - 1) {
            currentIndex++;
            const img = images[currentIndex];
            document.getElementById("modalImage").setAttribute("src", img.getAttribute("data-img-src"));
            document.getElementById("imageDescription").textContent = img.getAttribute("data-img-description");
            updateImageCounter();
        }
    });
</script>
@endsection
