@extends('frontend.user-main')

@section('content')
<!-- Gallery Section -->
<div class="container mt-5 pt-4">
    <div class="card shadow-lg border-0 rounded-4 text-center p-3" style="background: rgb(233, 36, 103);">
        <h2 class="fw-bold text-white m-0">HALALMAN GALERI CFCI</h2>
    </div>
</div>

<section id="gallery">
    <div class="container">
        <div class="row row-cols-1 row-cols-md-3 g-4 row g-4 justify-content-center">
            @php
                $images = [
                    "https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(73).webp",
                    "https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(18).webp",
                    "https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(19).webp",
                    "https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(72).webp",
                    "https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(77).webp",
                    "https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(81).webp"
                ];
            @endphp

            @foreach($images as $image)
            <div class="col-lg-4 col-md-6">
                <div class="card-gallery">
                    <img src="{{ $image }}" class="gallery-image" alt="Gallery Image" data-img-src="{{ $image }}" data-bs-toggle="modal" data-bs-target="#imageModal">
                    <div class="overlay" data-img-src="{{ $image }}" data-bs-toggle="modal" data-bs-target="#imageModal">
                        <span class="plus-icon">+</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Bootstrap Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Lihat Gambar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" class="img-fluid rounded" src="" alt="Selected Image">
            </div>
        </div>
    </div>
</div>

<!-- Styles -->
<style>
    .card-gallery {
        position: relative;
        width: 100%;
        height: 250px;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease-in-out;
    }

    .card-gallery:hover {
        transform: scale(1.05);
    }

    .gallery-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Tombol overlay "+" */
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
</style>

<!-- Scripts -->
<script>
    document.addEventListener("click", function (event) {
        if (event.target.classList.contains("overlay") || event.target.classList.contains("gallery-image")) {
            const imgSrc = event.target.getAttribute("data-img-src");
            document.getElementById("modalImage").setAttribute("src", imgSrc);
        }
    });
</script>
@endsection
