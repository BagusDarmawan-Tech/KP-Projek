@extends('frontend.user-main')

@section('content')
<!-- Seksi Galeri -->
<div class="container mt-5 pt-4">
    <div class="card shadow-lg border-0 position-relative overflow-hidden mb-5">
        <!-- Card Pembatas Besar dengan Judul dan Galeri -->
        <div class="card shadow-lg border-0 rounded-4 p-4">
            <div class="card-header text-center" style="background: rgb(233, 36,103);">
                <h2 class="fw-bold text-white m-0">Halaman Kegiatan Mitra Anak</h2>
            </div>
            <div class="card-body">
                <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
                    @foreach($datas as $index => $data)
                    <div class="col-lg-4 col-md-6">
                        <!-- Kartu Galeri -->
                        <div class="card-gallery">
                            <img src="{{ asset($data->gambar) }}" class="gallery-image" alt="Gallery Image" 
                                 data-img-index="{{ $index }}" 
                                 data-img-src="{{ asset($data->gambar) }}" 
                                 data-img-description="{{ $data->deskripsi }}" 
                                 data-img-caption="{{ $data->caption }}"
                                 data-bs-toggle="modal" 
                                 data-bs-target="#imageModal">
                            <div class="overlay" data-img-src="{{ asset($data->gambar) }}" data-bs-toggle="modal" data-bs-target="#imageModal">
                                <span class="plus-icon">+</span>
                            </div>
                        </div>
                        <!-- Caption Gambar di Halaman Utama -->
                        <div class="text-center mt-2">
                            <p class="fw-bold">{{ $data->caption }}</p> <!-- Caption -->
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
                    <h5 class="modal-title" id="imageModalLabel">Detail Gambar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" class="img-fluid rounded" src="" alt="Selected Image" style="max-width: 100%; max-height: 80vh;">
                    <!-- Deskripsi Gambar di Modal -->
                    <div id="imageDescription" class="mt-3"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Gaya -->
<style>
    .card-gallery {
        position: relative;
        width: 100%;
        height: 200px;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2); /* Shadow */
        border: 2px solid #fff;
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .card-gallery:hover {
        transform: scale(1.05);
        box-shadow: 0px 12px 24px rgba(0, 0, 0, 0.4); /* Shadow lebih besar saat hover */
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

<!-- Skrip -->
<script>
    document.addEventListener("click", function (event) {
        if (event.target.classList.contains("gallery-image") || event.target.classList.contains("overlay")) {
            const imgSrc = event.target.getAttribute("data-img-src");
            const description = event.target.getAttribute("data-img-description");

            // Update modal image and description
            document.getElementById("modalImage").setAttribute("src", imgSrc);
            document.getElementById("imageDescription").textContent = description;
        }
    });
</script>

@endsection
