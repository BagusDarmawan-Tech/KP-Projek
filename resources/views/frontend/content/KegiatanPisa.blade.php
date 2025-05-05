@extends('frontend.user-main')

@section('content')
<!-- Seksi Galeri -->
<div class="container mt-5 pt-4">
    <div class="card shadow-lg border-0 position-relative overflow-hidden mb-5">
        <!-- Card dengan Header -->
        <div class="card shadow-lg border-0 rounded-4 p-4">
            <div class="card-header">
                <h2 class="fw-bold text-white m-0">Kegiatan PISA</h2>
            </div>
            <div class="card-body">
                <!-- Galeri Grid -->
                <div class="row g-4">
                    @foreach($details as $index => $detail)
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="card-gallery">
                            <!-- Gambar -->
                            <img 
                                src="{{ asset('/' . $detail->gambar) }}" 
                                class="gallery-image" 
                                alt="{{ $detail->caption }}" 
                                data-img-src="{{ asset($detail->gambar) }}" 
                                data-img-index="{{ $index }}" 
                                data-img-name="{{ $detail->caption }}"
                                data-img-description="{{ $detail->deskripsi }}" 
                                data-bs-toggle="modal" 
                                data-bs-target="#imageModal"
                            >
                            <!-- Deskripsi -->
                            <div class="text-center mt-2">
                                <p class="fw-bold text-wrap">{{ $detail->caption }}</p>
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
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="imageModalLabel" class="modal-title modal-title-center fw-bold"></h5>
            </div>
            <div class="modal-body text-center position-relative">
                <!-- Tombol Navigasi Kiri -->
                <button id="prevBtn" class="btn btn-light position-absolute"><i class="bi bi-chevron-left fs-2"></i></button>
                <!-- Gambar -->
                <img id="modalImage" class="img-fluid rounded" src="" alt="Selected Image">
                <!-- Tombol Navigasi Kanan -->
                <button id="nextBtn" class="btn btn-light position-absolute"><i class="bi bi-chevron-right fs-2"></i></button>
                <!-- Deskripsi -->
                <div id="imageDescription" class="mt-3 text-center"></div>
                <div id="imageCounter" class="mt-3 text-muted"></div>
            </div>
        </div>
    </div>
</div>
@endsection
