@extends('frontend.user-main')

@section('content')

<div class="container mt-5 pt-4">
    <div class="card shadow-lg border-0 rounded-4 text-center p-3" style="background: rgb(233, 36,103);">
        <h2 class="fw-bold text-white m-0">KEGIATAN AREK SUROBOYO</h2>
    </div>
</div>

<section id="gallery">
    <div class="container">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($dataAktif as $index => $kegiatan)
            <div class="col">
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden hover-shadow">
                    <!-- Gambar -->
                    <img src="{{ asset($kegiatan->gambar) }}" 
                         alt="{{ $kegiatan->nama }}" 
                         class="card-img-top" 
                         style="height: 200px; object-fit: cover;">

                    <!-- Konten Card -->
                    <div class="card-body text-center">
                        <h5 class="card-title text-danger">{{ $kegiatan->judul }}</h5> <!-- Judul -->
                        <p class="card-text text-secondary">{{ Str::limit($kegiatan->konten, 100) }}</p> <!-- Konten -->
                        <button class="btn btn-outline-danger btn-sm" 
                                data-bs-toggle="modal" 
                                data-bs-target="#modal{{ $index }}">Selengkapnya</button>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="modal{{ $index }}" tabindex="-1" aria-labelledby="modalLabel{{ $index }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header text-center">
                        <div class="w-100">
                            <h5 class="text-danger">{{ $kegiatan->judul }}</h5> 
                            <h5 class="modal-title text-danger" id="modalLabel{{ $index }}">{{ $kegiatan->nama }}</h5>
                        </div>
                        </div>
                        <div class="modal-body">
                            <!-- Gambar dalam Modal -->
                            <img src="{{ asset($kegiatan->gambar) }}" 
                                 alt="{{ $kegiatan->nama }}" 
                                 class="img-fluid rounded mb-3 w-100">
                            <!-- Konten dalam Modal -->
                            
                            <p class="text-dark text-center">{{ $kegiatan->konten }}</p> <!-- Konten Penuh -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
