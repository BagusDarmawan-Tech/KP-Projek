@extends('admin.admin-master')

@section('main')

<link href="{{ asset('assets/css/tabel.css') }}" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
    <div class="card shadow-lg border-0 position-relative overflow-hidden p-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <!-- <h5 class="fw-bold">Daftar Dokumen</h5> -->
                 <br>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahKegiatan">
                    <i class="bi bi-plus"></i> Tambah kegiatan Pisa
                </button>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle text-center" id="myTable">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Nama</th>
                            <th>Keterangan</th>
                            <th>Dibuat Oleh</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kegiatans as $index => $kegiatan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><img src="{{ asset($kegiatan->gambar) }}" alt="Gambar" width="50"></td>
                            <td>{{ $kegiatan->nama }}</td>
                            <td>{{ $kegiatan->deskripsi }}</td>
                            <td>{{ $kegiatan->user ? $kegiatan->user->name : 'Tidak ada pengguna' }}</td>
                            <td>
                                @if($kegiatan->is_active == 0)
                                    <span class="badge bg-warning">Non Aktif</span>
                                @else
                                    <span class="badge bg-success">Aktif</span>
                                @endif
                            </td>                            
                                <td>
                                    <button class="btn btn-sm btn-primary edit-arekSuroboyo" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#modaEditKegiatan"
                                            data-id="{{ $kegiatan->id }}" 
                                            data-nama="{{ $kegiatan->nama }}" 
                                            data-caption="{{ $kegiatan->caption }}" 
                                            data-deskripsi="{{ htmlspecialchars($kegiatan->deskripsi, ENT_QUOTES, 'UTF-8') }}" 
                                            data-gambar="{{ asset($kegiatan->gambar) }}" 
                                            data-status="{{ $kegiatan->is_active }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                            
                                    <!-- Button Delete Modal -->
                                    <button class="btn btn-sm btn-danger delete-btn" 
                                        data-id  ="{{ $kegiatan->id }}"
                                        data-nama ="{{ $kegiatan->nama }}"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#deleteMenuModal"><i class="bi bi-trash"></i>
                                    </button>                            
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
<div class="modal fade" id="modalTambahKegiatan" tabindex="-1" aria-labelledby="modalTambahKegiatanLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center w-100 ">
                <h5 class="modal-title fw-bold text-center" id="modalTambahKegiatanLabel">Tambah Menu Kegiatan Pisa Baru</h5>
            </div>
            <div class="modal-body">
             <form method="POST" action="{{ route('createKegiatanPisa') }}" enctype="multipart/form-data">
                    @csrf 
                    <div class="mb-3">
                        <label for="namaKegiatan" class="form-label fw-semibold">Nama</label>
                        <input type="text" class="form-control" name="nama" id="namaKegiatan" placeholder="Masukkan nama kegiatan" value="{{ old('nama') }}">
                    </div>
                    <div class="mb-3">
                        <label for="gambarKegiatan" class="form-label fw-semibold">Gambar</label>
                        <input type="file" class="form-control" name="gambar" id="gambarKegiatan">
                    </div>
                    <div class="mb-3">
                        <label for="keteranganKegiatan" class="form-label fw-semibold">Caption</label>
                        <textarea class="form-control" name="caption" id="caption" rows="3" placeholder="Tambahkan keterangan kegiatan">{{ old('caption') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="keteranganKegiatan" class="form-label fw-semibold">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" id="keterangan" rows="3" placeholder="Tambahkan keterangan kegiatan">{{ old('deskripsi') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <div class="form-check form-switch">
                            <input type="hidden" name="is_active" value="0"> <!-- Fallback jika checkbox tidak dicentang -->
                            <input class="form-check-input" type="checkbox" id="status" name="is_active" value="1" checked>
                            <label class="form-check-label" for="status">Aktif</label>
                        </div>
                    </div>
                    <input type="hidden" name="dibuatOleh" value="{{ Auth::user()->id }}">
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
                                
     
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modaEditKegiatan" tabindex="-1" aria-labelledby="modaEditKegiatanLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center w-100">
                <h5 class="modal-title fw-bold text-center" id="modaEditKegiatanLabel">Edit Menu Kegiatan Pisa</h5>
            </div>
            <div class="modal-body">
                <form method="POST" id="editKegiatanPisa" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') 
                    <!-- Input ID (tersembunyi) -->
                    <input type="hidden" id="editId" name="id">
                    
                    <div class="mb-3">
                        <label for="editNama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="editNama" name="nama">
                    </div>

                    <div class="mb-3">
                        <label for="editGambar" class="form-label">Gambar</label>
                        <div class="mb-2">
                            <img id="previewGambar" src="#" alt="Preview Gambar" class="img-thumbnail d-none" width="100">
                        </div>
                        <input type="file" class="form-control" id="editGambar" name="gambar">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
                    </div>

                    <div class="mb-3">
                        <label for="editDeskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="editDeskripsi" name="deskripsi" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <div class="form-check form-switch">
                            <input type="hidden" name="is_active" value="0">
                            <input class="form-check-input" name="is_active" type="checkbox" id="editStatus" value="1" checked>
                            <label class="form-check-label" for="editStatus">Aktif</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>



<!-- Modal Delete Menu -->
<div class="modal fade" id="deleteMenuModal" tabindex="-1" aria-labelledby="deleteMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteMenuModalLabel">Hapus Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <input type="hidden" id="deleteId" name="id">
                    <p>Apakah Anda yakin ingin menghapus record<br> <strong id="deleteNama"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script> 
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".edit-arekSuroboyo").forEach(button => {
            button.addEventListener("click", function () {
                let id = this.getAttribute("data-id");
                let nama = this.getAttribute("data-nama");
                let deskripsi = this.getAttribute("data-deskripsi");
                let gambar = this.getAttribute("data-gambar");
                let status = this.getAttribute("data-status");

                // Isi nilai form dalam modal
                document.getElementById("editId").value = id;
                document.getElementById("editNama").value = nama;
                document.getElementById("editDeskripsi").value = decodeURIComponent(deskripsi);
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
                document.getElementById("editKegiatanPisa").action = `/kegiatanPisa/update/${id}`;
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
                document.getElementById("deleteForm").action = `/kegiatanPisa/hapus/${id}`;
            });
        });
    });
</script>

@endsection
