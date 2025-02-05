@extends('frontend.user-main')

@section('content')
<!-- Gallery Section -->
<div class="mb-5 position-relative text-center">
    <h2 class="p-3 text-white rounded-pill d-inline-block position-relative" style="background-color: rgb(233, 36, 103); z-index: 2;">
        Galeri Kegiatan
    </h2>
    <div class="position-absolute top-50 start-50 translate-middle w-100" style="z-index: 1;">
        <svg width="100%" height="100" viewBox="0 0 500 100" preserveAspectRatio="none">
            <path d="M0,0 C150,100 350,0 500,100 L500,00 L0,0 Z" style="fill:rgb(233, 36, 103);"></path>
        </svg>
    </div>
</div>

<div class="row">
    @php
        $images = [
            "https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(73).webp",
            "https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(73).webp",
            "https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(73).webp",
            "https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(73).webp",
            "https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(18).webp",
            "https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(18).webp"
        ];
    @endphp

    @foreach(array_chunk($images, 2) as $column)
    <div class="col-lg-4 col-md-6 mb-4">
        @foreach($column as $image)
        <div class="img-container" data-bs-toggle="modal" data-bs-target="#imageModal" data-img-src="{{ $image }}">
            <img src="{{ $image }}" class="w-100 shadow rounded-3 mb-4 img-hover-effect" alt="Gallery Image" />
            <div class="overlay">
                <span class="plus-icon">+</span>
            </div>
        </div>
        @endforeach
    </div>
    @endforeach
</div>

<!-- Bootstrap Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Lihat Gambar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" class="img-fluid" src="" alt="Selected Image">
            </div>
        </div>
    </div>
</div>

<!-- Styles -->
<style>
.img-container {
    position: relative;
    display: inline-block;
    cursor: pointer;
    width: 100%; 
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

.img-container:hover .overlay {
    opacity: 1;
}

.plus-icon {
    color: white;
    font-size: 24px;
    font-weight: bold;
}

.img-hover-effect {
    transition: transform 0.3s ease-out;
    border: 5px solid white;
    width: 100%; 
    max-height: 250px; 
    object-fit: cover; 
    will-change: transform;
}

.img-hover-effect:hover {
    transform: scale(1.05);
}

@media (max-width: 768px) {
    .col-md-6 {
        flex: 0 0 100%;
        max-width: 100%;
    }
}
</style>

<!-- Scripts -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const imgContainers = document.querySelectorAll(".img-container");

    imgContainers.forEach(container => {
        container.addEventListener("click", function () {
            const imgSrc = container.getAttribute("data-img-src");
            document.getElementById("modalImage").setAttribute("src", imgSrc);
        });
    });
});
</script>
<!-- End of Gallery Section -->
@endsection
