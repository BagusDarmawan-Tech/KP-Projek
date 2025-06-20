@extends('admin.admin-master')
@section('main')
<link href="{{ asset('assets/css/tabel.css') }}" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- <script src="{{ asset('assets/js/hapus.js') }}"></script> -->

<style>
    .text-wrap {
        word-wrap: break-word;
        white-space: normal;
    }
</style>

<div class="container mt-5">
    @if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger text-center p-1 px-2 small">  
                    {{ $error }}
        </div>
    @endforeach
    @endif
    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success')}}
        
        </div>
    @endif
    <div class="card shadow-lg border-0 position-relative overflow-hidden mb-5">
        <div class="card-body mt-4">
            <div class="text-center mb-4">
                <h4 class="fw-bold">Kegiatan Arek Suroboyo</h4>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div></div> <!-- Spacer -->
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#halamanModal">+ Kegiatan Arek Suroboyo</button> 
            </div>
            
            <!-- Tombol Tambah Artikel di atas -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle text-center"  id="myTable">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Gambar</th>
                            <th class="text-center">Judul</th>
                            <!-- <th class="text-center">Tag</th> -->
                            <th class="text-center">Dibuat Oleh</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kegiatans as $index => $kegiatan)
                        <tr class="text-start">
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td><img src="{{ asset($kegiatan->gambar) }}" alt="Slider Image" width="80"></td>
                            <td>{{ Str::limit($kegiatan->judul, 20, '...') }}</td>
                            <!-- <td>{{ Str::limit($kegiatan->tag, 20, '...')}}</td> -->
                            <td>{{ $kegiatan->user ? $kegiatan->user->name : 'Tidak ada pengguna' }}</td>
                            <td>
                                @if($kegiatan->is_active == 0)
                                    <span class="badge bg-warning">Non Aktif</span>
                                @else
                                    <span class="badge bg-success">Aktif</span>
                                @endif
                            </td>                               
                            <td>
                                <button class="btn btn-sm btn-primary edit-arekSuroboyo" data-bs-toggle="modal" data-bs-target="#halamanEditModal"
                                    data-id="{{ $kegiatan->id }}" 
                                    data-judul="{{ $kegiatan->judul }}" 
                                    data-tag="{{ $kegiatan->tag }}" 
                                    data-konten="{{ $kegiatan->konten }}" 
                                    data-gambar="{{ asset($kegiatan->gambar) }}" 
                                    data-status="{{ $kegiatan->is_active }}"
                                    ><i class="bi bi-pencil-square"></i>
                                </button>
                                <!-- Button Delete Modal -->
                                <button class="btn btn-sm btn-danger delete-btn" 
                                    data-id  ="{{ $kegiatan->id }}"
                                    data-nama ="{{ $kegiatan->judul }}"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteMenuModal"><i class="bi bi-trash"></i>
                                </button>  
                                
                                  <a href="#" 
                                class="lihat-keterangan btn btn-sm rounded-circle edit-verifikasi" style="background-color: #FFC107; width: 36px; height: 36px;" 
                                data-bs-toggle="modal" 
                                data-bs-target="#keteranganModal"
                                data-judul="{{ $kegiatan->judul }}" 
                                data-konten="{{ $kegiatan->konten }}" 
                                data-tag="{{ $kegiatan->tag }}"
                                data-gambar="{{ asset($kegiatan->gambar) }}">
                                <i class="bi bi-list-task text-white fs-6"></i>
                            </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="halamanModal" tabindex="-1" aria-labelledby="halamanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex flex-column align-items-center">
                <h5 class="modal-title fw-bold text-center mb-0" id="halamanModalLabel">Kegiatan Arek Suroboyo Baru</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('createKegiatanArekSuroboyo') }}" enctype="multipart/form-data">
                    @csrf 
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input name="judul" placeholder="Masukan Judul" type="text" class="form-control" id="judul" value="{{ old('judul') }}"    >
                    </div>
                    <div class="mb-3">
                        <label for="tag" class="form-label">Tag</label>
                        <input type="text" placeholder="Masukan Tag" name="tag" class="form-control" id="tag" value="{{ old('tag') }}"    >
                    </div>
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar</label>
                        <input type="file" name="gambar" class="form-control" id="gambar">
                    </div>
                    <div class="mb-3">
                        <label for="konten" class="form-label">Konten</label>
                        <textarea class="form-control" placeholder="Masukan Konten" name="konten" id="konten" rows="3">{{ old('konten') }}</textarea>
                    </div>                    
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <div class="form-check form-switch">
                            <input type="hidden" name="is_active" value="0"> <!-- Fallback jika checkbox tidak dicentang -->
                            <input class="form-check-input" type="checkbox" id="status" name="is_active" value="1" checked>
                            <label class="form-check-label" for="status">Aktif</label>
                        </div>
                    </div>
                </div>
        <input type="hidden" name="dibuatOleh" value="{{ Auth::user()->id }}">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<div class="modal fade" id="halamanEditModal" tabindex="-1" aria-labelledby="halamanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex flex-column align-items-center">
                <h5 class="modal-title fw-bold text-center mb-0" id="halamanModalLabel">Kegiatan Arek Suroboyo Baru</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body">
                <form method="POST" id="editFormSuroboyo" action="" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Tambahkan method PUT untuk update -->
                    <div class="mb-3">
                        <label for="editJudul" class="form-label">Judul</label>
                        <input name="judul" type="text" class="form-control" id="editJudul">
                    </div>
                    <div class="mb-3">
                        <label for="editTag" class="form-label">Tag</label>
                        <input type="text" name="tag" class="form-control" id="editTag">
                    </div>
                    <div class="mb-3">
                        <label for="editGambar" class="form-label">Gambar</label>
                        <div class="mb-2">
                            <img id="previewGambar" src="#" alt="Preview Gambar" class="img-thumbnail" width="100">
                        </div>
                        <input type="file" class="form-control" id="editGambar" name="gambar">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
                    </div>
                    <div class="mb-3">
                        <label for="editKonten" class="form-label">Konten</label>
                        <textarea class="form-control" name="konten" id="editKonten" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <div class="form-check form-switch">
                            <!-- Hidden input sebagai fallback jika checkbox tidak dicentang -->
                            <input type="hidden" name="is_active" value="0">
                            
                            <input class="form-check-input" name="is_active" type="checkbox" id="editStatus" value="1" checked>
                            <label class="form-check-label" for="status">Aktif</label>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="dibuatOleh" value="{{ Auth::user()->name }}">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<!-- Modal Delete Menu -->
<div class="modal fade" id="deleteMenuModal" tabindex="-1" aria-labelledby="deleteMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteMenuModalLabel">Hapus Kegiatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <input type="hidden" id="deleteId" name="id">
                    <p>
                    Anda akan menghapus kegiatan <strong id="deleteNama"></strong> dari sistem.<br>
                    Tindakan ini bersifat permanen.<br><br>
                    <span class="text-danger">Apakah Anda yakin ingin melanjutkan?</span>
                    </p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- bagian detail -->

<div class="modal fade" id="keteranganModal" tabindex="-1" aria-labelledby="keteranganModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Header Modal -->
            <div class="modal-header">
                <h5 class="modal-title fw-bold w-100 text-center" id="keteranganModalLabel">Detail Kegiatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Body Modal -->
            <div class="modal-body">
                <div class="row g-4 align-items-center">
                    <!-- Gambar -->
                    <div class="col-md-5">
                        <img id="modalGambar" src="" alt="Gambar Kegiatan" class="img-fluid rounded" style="max-height: 300px; object-fit: contain;">
                    </div>

                    <!-- Judul, Konten, dan Tag -->
                    <div class="col-md-7">
                        <h6 id="modalJudul" class="fw-bold mb-3 text-wrap" style="color: #333;"></h6>
                        <p id="modalKonten" class="text-wrap mb-2" style="text-align: justify; font-size: 0.95rem; color: black;"></p>
                        <p id="modalTag" class="text-wrap" style="font-size: 0.9rem; color: black;"></p>
                    </div>
                </div>
            </div>

            <!-- Footer Modal -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".edit-arekSuroboyo").forEach(button => {
            button.addEventListener("click", function () {
                let id = this.getAttribute("data-id");
                let judul = this.getAttribute("data-judul");
                let tag = this.getAttribute("data-tag");
                let konten = this.getAttribute("data-konten");
                let gambar = this.getAttribute("data-gambar");
                let status = this.getAttribute("data-status");

                // Set nilai form dalam modal
                document.getElementById("editJudul").value = judul;
                document.getElementById("editTag").value = tag;
                document.getElementById("editKonten").value = konten;
                document.getElementById("editStatus").checked = status == "1";

                // Set preview gambar
                let previewGambar = document.getElementById("previewGambar");
                if (gambar) {
                    previewGambar.src = gambar;
                    previewGambar.classList.remove("d-none");
                } else {
                    previewGambar.classList.add("d-none");
                }

                // Set action form ke URL update yang sesuai
                document.getElementById("editFormSuroboyo").action = `/KegiatanArekSuroboyo/update/${id}`;
            });
        });
    });
</script>

<!-- Script Delete Data ke Modal -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".delete-btn").forEach(button => {
            button.addEventListener("click", function() {
                let id = this.getAttribute("data-id");
                let nama = this.getAttribute("data-nama");

                console.log(id)
                console.log(nama)

                document.getElementById("deleteId").value = id;
                document.getElementById("deleteNama").textContent = nama; // Tampilkan nama di modal

                // Set action form agar mengarah ke endpoint delete yang benar
                document.getElementById("deleteForm").action = `/KegiatanArekSuroboyo/hapus/${id}`;
            });
        });
    });
</script>


<!-- bagian detail  -->
<script>
        document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('keteranganModal');
        modal.addEventListener('show.bs.modal', function (event) {
            // Button that triggered the modal
            const button = event.relatedTarget;

            // Extract data attributes
            const judul = button.getAttribute('data-judul');
            const konten = button.getAttribute('data-konten');
            const tag = button.getAttribute('data-tag');
            const gambar = button.getAttribute('data-gambar');

            // Update modal content
            modal.querySelector('#modalJudul').innerHTML = `<strong>Judul :</strong><br>${judul}`;
            modal.querySelector('#modalKonten').innerHTML = `<strong>Konten :</strong><br>${konten}`;
            modal.querySelector('#modalTag')   .textContent = `Tag: ${tag}`;
            modal.querySelector('#modalGambar').src = gambar;
        });
    });

</script>


@endsection
