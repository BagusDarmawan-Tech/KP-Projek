@extends('frontend.user-main')

@section('content')
<!-- Gallery Section -->

    <!-- Title Section -->
    <div class="mb-5 position-relative text-center">
        <h2 class="p-3 text-white rounded-pill d-inline-block position-relative" style="background-color: rgb(233, 36, 103); z-index: 2;">
            Pemantauan Usulan Anak 
        </h2>
        <div class="position-absolute top-50 start-50 translate-middle w-100" style="z-index: 1;">
            <svg width="100%" height="100" viewBox="0 0 500 100" preserveAspectRatio="none">
                <path d="M0,0 C150,100 350,0 500,100 L500,00 L0,0 Z" style="fill:rgb(233, 36, 103);"></path>
            </svg>
        </div>
    </div>

    <div class="row">
        <!-- First Column -->
        <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
            <img src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(73).webp" 
                 class="w-100 shadow rounded-3 mb-4 img-hover-effect" alt="Boat on Calm Water" />

            <img src="https://mdbcdn.b-cdn.net/img/Photos/Vertical/mountain1.webp" 
                 class="w-100 shadow rounded-3 mb-4 img-hover-effect" alt="Wintry Mountain Landscape" />
        </div>

        <!-- Second Column -->
        <div class="col-lg-4 mb-4 mb-lg-0">
            <img src="https://mdbcdn.b-cdn.net/img/Photos/Vertical/mountain2.webp" 
                 class="w-100 shadow rounded-3 mb-4 img-hover-effect" alt="Mountains in the Clouds" />

            <img src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(73).webp" 
                 class="w-100 shadow rounded-3 mb-4 img-hover-effect" alt="Boat on Calm Water" />
        </div>

        <!-- Third Column -->
        <div class="col-lg-4 mb-4 mb-lg-0">
            <img src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(18).webp" 
                 class="w-100 shadow rounded-3 mb-4 img-hover-effect" alt="Waves at Sea" />

            <img src="https://mdbcdn.b-cdn.net/img/Photos/Vertical/mountain3.webp" 
                 class="w-100 shadow rounded-3 mb-4 img-hover-effect" alt="Yosemite National Park" />
        </div>
    </div>
</div>

<style>
.img-hover-effect {
    transition: transform 0.3s ease-out;
    border: 5px solid white; 
    max-height: 250px;
    object-fit: cover;
    will-change: transform;
}

.img-hover-effect:hover {
    transform: scale(1.05);
}
</style>

@endsection
