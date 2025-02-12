@extends('frontend.user-main')

@section('content')

<!-- Main Content -->
<div class="container mt-5 pt-4">
    <div class="card shadow-lg border-0 rounded-4 text-center p-3" style="background: rgb(233, 36,103);">
        <h2 class="fw-bold text-white m-0">Artikel Kegiatan</h2>
    </div>
</div>

<section id="gallery">
    <div class="container">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <!-- First Activity -->
            <div class="col">
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden hover-shadow">
                    <img src="https://suarapubliknews.net/wp-content/uploads/2024/08/YNU_7150-1.jpg" alt="Sosialisasi dan Simulasi Kebakaran" class="card-img-top">
                    
                    <div class="card-body">
                        <h5 class="card-title text-danger">Sosialisasi dan Simulasi Kebakaran</h5>
                        <p class="card-text text-secondary">Pelajari langkah-langkah dalam sosialisasi dan simulasi kebakaran di Surabaya...</p>
                        <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal1">Selengkapnya</button>
                    </div>
                </div>
            </div>

            <!-- Modal for First Activity -->
            <div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="modalLabel1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-danger">Sosialisasi dan Simulasi Kebakaran</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <img src="https://suarapubliknews.net/wp-content/uploads/2024/08/YNU_7150-1.jpg" alt="Sosialisasi dan Simulasi Kebakaran" class="img-fluid rounded mb-3">
                            <p class="text-secondary">Kegiatan ini bertujuan untuk memberikan pemahaman kepada masyarakat tentang cara menghadapi situasi darurat kebakaran, termasuk teknik pemadaman api awal dan evakuasi.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Second Activity -->
            <div class="col">
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden hover-shadow">
                    <img src="https://asset.kompas.com/crops/u2_wc8ieb_2BzqsnPtkeCoZkolk=/0x0:1278x852/1200x800/data/photo/2023/07/02/64a15afcb55ce.jpeg" alt="Simulasi Bencana Gempa Bumi" class="card-img-top">
                    
                    <div class="card-body">
                        <h5 class="card-title text-danger">Simulasi Bencana Gempa Bumi</h5>
                        <p class="card-text text-secondary">Bagaimana cara aman menghadapi gempa bumi? Yuk, simak panduannya...</p>
                        <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal2">Selengkapnya</button>
                    </div>
                </div>
            </div>

            <!-- Modal for Second Activity -->
            <div class="modal fade" id="modal2" tabindex="-1" aria-labelledby="modalLabel2" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-danger">Simulasi Bencana Gempa Bumi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <img src="https://asset.kompas.com/crops/u2_wc8ieb_2BzqsnPtkeCoZkolk=/0x0:1278x852/1200x800/data/photo/2023/07/02/64a15afcb55ce.jpeg" alt="Simulasi Bencana Gempa Bumi" class="img-fluid rounded mb-3">
                            <p class="text-secondary">Kegiatan ini mengajarkan langkah-langkah penyelamatan saat gempa bumi terjadi, termasuk teknik "Drop, Cover, and Hold" serta jalur evakuasi yang aman.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Third Activity -->
            <div class="col">
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden hover-shadow">
                    <img src="https://cdn.antaranews.com/cache/1200x800/2023/09/15/eri-dan-RAP-Sonokwijenan-Surabaya-9.jpg.webp" alt="Pencegahan Pekerja Anak" class="card-img-top">
                    
                    <div class="card-body">
                        <h5 class="card-title text-danger">Pencegahan Pekerja Anak</h5>
                        <p class="card-text text-secondary">Pemerintah Surabaya berkomitmen untuk mengurangi pekerja anak melalui Aplikasi ASSIK...</p>
                        <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal3">Selengkapnya</button>
                    </div>
                </div>
            </div>

            <!-- Modal for Third Activity -->
            <div class="modal fade" id="modal3" tabindex="-1" aria-labelledby="modalLabel3" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-danger">Pencegahan Pekerja Anak</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <img src="https://cdn.antaranews.com/cache/1200x800/2023/09/15/eri-dan-RAP-Sonokwijenan-Surabaya-9.jpg.webp" alt="Pencegahan Pekerja Anak" class="img-fluid rounded mb-3">
                            <p class="text-secondary">Melalui Aplikasi ASSIK (Arek Suroboyo Siap Kerjo), Pemerintah Kota Surabaya berupaya mencegah eksploitasi anak dengan menyediakan akses pendidikan dan pelatihan kerja yang lebih baik.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection
