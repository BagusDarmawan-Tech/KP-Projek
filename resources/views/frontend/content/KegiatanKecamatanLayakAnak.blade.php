@extends('frontend.user-main')

@section('content')
<!-- Seksi Galeri -->
<div class="container mt-5 pt-4">
    <div class="card shadow-lg border-0 position-relative overflow-hidden mb-5">
        <!-- Card Pembatas Besar dengan Judul dan Galeri -->
        <div class="card shadow-lg border-0 rounded-4 p-4">
            <div class="card-header">
                <h2 class="fw-bold text-white m-0">KEGIATAN KECAMATAN KOTA LAYAK ANAK</h2>
            </div>

            <div class="card-body">
                <!-- Galeri Grid -->
                <div class="row g-4">
                    @foreach($gambars as $index => $gambar)
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="card-gallery">
                            <!-- Gambar -->
                            <img src="{{ asset($gambar->gambar) }}"
                                 class="gallery-image"
                                 alt="Gallery Image"
                                 data-img-src="{{ asset($gambar->gambar) }}"
                                 data-img-index="{{ $index }}"
                                 data-img-name="{{ $gambar->nama }}"
                                 data-img-description="{{ $gambar->keterangan }}"
                                 data-bs-toggle="modal"
                                 data-bs-target="#imageModal">

                            <!-- Deskripsi Gambar -->
                            <div class="text-center mt-2">
                                <p class="fw-bold text-wrap">{{ $gambar->nama }}</p>
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
<!-- Modal Bootstrap -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
    
      <!-- HEADER MODAL -->
      <div class="modal-header">
        <h5 id="imageModalLabel" class="modal-title modal-title-center fw-bold"></h5>
      </div>

      <!-- BODY MODAL -->
      <div class="modal-body text-center position-relative">
        
        <!-- Prev Button -->
        <button id="prevBtn" class="btn btn-light position-absolute">
          <i class="bi bi-chevron-left fs-2"></i>
        </button>

        <!-- Image -->
        <img id="modalImage" class="img-fluid rounded" src="" alt="Selected Image">

        <!-- Next Button -->
        <button id="nextBtn" class="btn btn-light position-absolute">
          <i class="bi bi-chevron-right fs-2"></i>
        </button>

        <!-- Description -->
        <div id="imageDescription" class="mt-3"></div>

        <!-- Counter -->
        <div id="imageCounter" class="mt-3"></div>
      </div>
    </div>
  </div>
</div>
@endsection
