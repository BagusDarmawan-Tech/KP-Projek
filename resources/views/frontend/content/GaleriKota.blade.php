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
                {{-- @php
                    $images = [
                        ["url" => "https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(73).webp", "description" => "Foto kegiatan senam untuk anak-anak di lingkungan sekitar."],
                        ["url" => "https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(18).webp", "description" => "Foto kegiatan senam untuk anak-anak di lingkungan sekitar."],
                        ["url" => "https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(19).webp", "description" => "Foto kegiatan senam untuk anak-anak di lingkungan sekitar."],
                        ["url" => "https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(72).webp", "description" => "Foto kegiatan senam untuk anak-anak di lingkungan sekitar."],
                        ["url" => "https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(77).webp", "description" => "Foto kegiatan senam untuk anak-anak di lingkungan sekitar."],
                        ["url" => "https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(81).webp", "description" => "Foto kegiatan senam untuk anak-anak di lingkungan sekitar."]
                    ];
                @endphp --}}

                @foreach($gambars as $index => $gambar)
                <div class="col-lg-4 col-md-6">
                    <div class="card-gallery">
                        <img src="{{ asset($gambar->gambar) }}" class="gallery-image" alt="Gallery Image" data-img-src="{{ asset($gambar->gambar) }}" data-img-index="{{ $index }}" data-img-description="{{ $gambar->deskripsi }}" data-bs-toggle="modal" data-bs-target="#imageModal">
                        <div class="overlay" data-img-src="{{ asset($gambar->gambar) }}" data-description="{{ $gambar->deskripsi}}" data-bs-toggle="modal" data-bs-target="#imageModal">
                            <span class="plus-icon">+</span>
                        </div>
                    </div>
                    <!-- Deskripsi Gambar yang Ditampilkan di Luar Modal -->
                    <div class="text-center mt-2">
                        <p>{{ $gambar->deskripsi }}</p>
                    </div>
                </div>
                @endforeach
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

                <!-- Deskripsi Gambar di Modal -->
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
        height: 200px; /* Menurunkan ukuran gambar agar lebih kecil */
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2); /* Shadow untuk efek timbul */
        border: 2px solid #fff; /* Border putih untuk pemisah */
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .card-gallery:hover {
        transform: scale(1.05);
        box-shadow: 0px 12px 24px rgba(0, 0, 0, 0.4); /* Shadow lebih besar saat hover */
    }

    .gallery-image {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Agar gambar tetap proporsional dan menutupi area */
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

    /* Pembatas galeri */
    .card {
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2); /* Shadow besar untuk efek timbul */
    }

    /* Gaya khusus untuk card header */
    .card-header {
        background: #10bc69;
        border-radius: 15px 15px 0 0;
        padding: 1rem;
    }

    /* Menyesuaikan tampilan gambar di modal */
    #modalImage {
        width: auto; /* Lebar otomatis untuk menjaga proporsi */
        max-width: 90vw; /* Maksimal 90% dari viewport */
        max-height: 80vh; /* Maksimal 80% dari viewport */
    }

    /* Responsif untuk ukuran layar kecil */
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

<!-- Skrip -->
<script>
    let currentIndex = 0;
    let images = [
        {url: "https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(73).webp", description: "Foto kegiatan senam untuk anak-anak di lingkungan sekitar."},
        {url: "https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(18).webp", description: "Foto kegiatan senam untuk anak-anak di lingkungan sekitar."},
        {url: "https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(19).webp", description: "Foto kegiatan senam untuk anak-anak di lingkungan sekitar."},
        {url: "https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(72).webp", description: "Foto kegiatan senam untuk anak-anak di lingkungan sekitar."},
        {url: "https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(77).webp", description: "Foto kegiatan senam untuk anak-anak di lingkungan sekitar."},
        {url: "https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(81).webp", description: "Foto kegiatan senam untuk anak-anak di lingkungan sekitar."}
    ];

    // Membuka modal dan menampilkan gambar
    document.addEventListener("click", function (event) {
        if (event.target.classList.contains("overlay") || event.target.classList.contains("gallery-image")) {
            const imgSrc = event.target.getAttribute("data-img-src");
            currentIndex = event.target.getAttribute("data-img-index");
            const description = event.target.getAttribute("data-img-description");

            // Update modal image and description
            document.getElementById("modalImage").setAttribute("src", imgSrc);
            document.getElementById("imageDescription").textContent = description;
            updateImageCounter();
        }
    });

    // Memperbarui penomoran gambar di modal
    function updateImageCounter() {
        const counter = document.getElementById("imageCounter");
        counter.textContent = `Foto ${parseInt(currentIndex) + 1} dari ${images.length}`;
    }

    // Navigasi ke gambar sebelumnya
    document.getElementById("prevBtn").addEventListener("click", function () {
        if (currentIndex > 0) {
            currentIndex--;
            document.getElementById("modalImage").setAttribute("src", images[currentIndex].url);
            document.getElementById("imageDescription").textContent = images[currentIndex].description;
            updateImageCounter();
        }
    });

    // Navigasi ke gambar selanjutnya
    document.getElementById("nextBtn").addEventListener("click", function () {
        if (currentIndex < images.length - 1) {
            currentIndex++;
            document.getElementById("modalImage").setAttribute("src", images[currentIndex].url);
            document.getElementById("imageDescription").textContent = images[currentIndex].description;
            updateImageCounter();
        }
    });
</script>

@endsection
