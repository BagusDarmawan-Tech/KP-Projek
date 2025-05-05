@extends('frontend.user-main')

@section('content')
<!-- Seksi Galeri -->
<div class="container mt-5 pt-4">
    <div class="card shadow-lg border-0 position-relative overflow-hidden mb-5">
        <!-- Card Pembatas Besar dengan Judul dan Galeri -->
        <div class="card shadow-lg border-0 rounded-4 p-4">
            <div class="card-header">
                <h2 class="fw-bold text-white m-0">Kegiatan CFCI</h2>
            </div>
            
            <div class="card-body">
                <!-- Galeri Grid -->
                <div class="row g-4">
                    @foreach($datas as $index => $data)
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="card-gallery">
                            <!-- Gambar -->
                            <img src="{{ asset($data->gambar) }}" 
                                 class="gallery-image" 
                                 alt="Gallery Image" 
                                 data-img-src="{{ asset($data->gambar) }}" 
                                 data-img-index="{{ $index }}" 
                                 data-img-name="{{ $data->nama }}"
                                 data-img-description="{{ $data->deskripsi }}" 
                                 data-bs-toggle="modal" 
                                 data-bs-target="#imageModal">

                            <!-- Deskripsi Nama di Bawah Gambar -->
                            <div class="text-center mt-2">
                                <p class="fw-bold text-wrap">{{ $data->nama }}</p>
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
                <h5 id="imageModalLabel" class="modal-title modal-title-center fw-bold"></h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body text-center position-relative">
                <!-- Tombol Navigasi Kiri -->
                <button id="prevBtn" class="btn btn-light position-absolute" style="left: 0; top: 50%; transform: translateY(-50%); font-size: 30px; z-index: 100;">
                    <i class="bi bi-chevron-left fs-2"></i>
                </button>
                <!-- Gambar -->
                <img id="modalImage" class="img-fluid rounded" src="" alt="Selected Image" style="max-width: 100%; max-height: 80vh;">
                <!-- Tombol Navigasi Kanan -->
                <button id="nextBtn" class="btn btn-light position-absolute" style="right: 0; top: 50%; transform: translateY(-50%); font-size: 30px; z-index: 100;">
                    <i class="bi bi-chevron-right fs-2"></i>
                </button>
                <!-- Deskripsi Gambar -->
                <div id="imageDescription" class="mt-3"></div>
                <div id="imageCounter" class="mt-3"></div>
            </div>
        </div>
    </div>
</div>

@endsection
