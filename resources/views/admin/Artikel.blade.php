@extends('admin.admin-master')
@section('main')
<link href="{{ asset('assets/css/tabel.css') }}" rel="stylesheet">

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
                <h4 class="fw-bold">Halaman Artikel</h4>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div></div> <!-- Spacer -->
                @if (auth()->user()->hasPermissionTo('artikel-add'))
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#halamanTambahModal">+ Tambahkan Artikel</button> 
                @endif
            </div>
            
            <!-- Tombol Tambah Artikel di atas -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle text-center"  id="myTable">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center"width="10%">No</th>
                            <th class="text-center">Gambar</th>
                            <th class="text-center"width="13%">Nama Kategori</th>
                            <th class="text-center"width="25%">Judul</th>
                            <th class="text-center"width="13%">Dibuat Oleh</th>
                            <th class="text-center"width="12%">Status</th>
                            <th class="text-center"width="13%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($artikels as $artikel)
                        <tr>
                            <td style="text-align: center;">{{ $loop->iteration }}</td>
                            <td><img src="{{ asset($artikel->gambar) }}" alt="Artikel Image" width="80"></td>
                            <td>{{ $artikel->kategori ? $artikel->kategori->nama : 'Tidak ada Kategori' }}</td>
                            <td class="text-start">{{ $artikel->judul }}</td>
                            <td> {{ $artikel->user ? $artikel->user->name : 'Tidak ada pengguna' }}</td>                            <td>
                                @if($artikel->is_active == 0)
                                    <span class="badge bg-warning">Non Aktif</span>
                                @else
                                    <span class="badge bg-success">Aktif</span>
                                @endif
                            </td>
                            <td>
                                @if (auth()->user()->hasPermissionTo('artikel-edit'))
                                <button class="btn btn-sm btn-primary edit-btn" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#halamanModal"
                                    data-id="{{ $artikel->id }}"
                                    data-judul="{{ $artikel->judul }}"
                                    data-tag="{{ $artikel->tag }}"
                                    data-konten="{{ $artikel->konten }}"
                                    data-gambar="{{ asset($artikel->gambar) }}"
                                    data-status="{{ $artikel->is_active }}"
                                    data-kategoriartikelid="{{ $artikel->kategoriartikelid }}"
                                    data-subkegiatanid="{{ $artikel->subkegiatanid }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                @endif
                                <!-- Tombol Hapus -->
                                @if (auth()->user()->hasPermissionTo('artikel-delete'))
                                <button class="btn btn-sm btn-danger delete-btn" 
                                    data-id  ="{{ $artikel->id }}"
                                    data-nama ="{{ $artikel->judul }}"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteMenuModal"><i class="bi bi-trash"></i>
                                </button>   
                                @endif
                        
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
<div class="modal fade" id="halamanTambahModal" tabindex="-1" aria-labelledby="halamanTambahModalLabel" aria-hidden="true">
<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center w-100 ">
                <h5 class="modal-title fw-bold text-center" id="menuModalLabel">Tambah Menu Artikel Baru</h5>
            </div>
            <div class="modal-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form method="POST" id="myForm" action="{{ route('createArtikel') }}" enctype="multipart/form-data">
                    @csrf 
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" placeholder="Masukan Judul Artikel" class="form-control" id="judul" name="judul" value="{{ old('judul') }}" required>
                    </div>
                
                    <div class="mb-3">
                        <label for="tag" class="form-label">Tag</label>
                        <input type="text" placeholder="Masukan Tag Artikel" class="form-control" id="tag" name="tag" value="{{ old('tag') }}">
                    </div>
                
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar</label>
                        <input type="file" class="form-control" id="gambar" name="gambar" required>
                    </div>
                
                    <div class="mb-3">
                        <label for="konten" class="form-label">Konten</label>
                        <textarea placeholder="Masukan Konten Artikel" class="form-control" id="konten" rows="3" name="konten" required>{{ old('konten') }}</textarea>
                    </div>
                
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori Artikel</label>
                        <select class="form-select" id="kategori" name="kategoriartikelid" required>
                           <option value="" disabled selected>-- Pilih Kategori --</option> 
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" {{ old('kategoriartikelid') == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                
                    <div class="mb-3">
                        <label for="kegiatan" class="form-label">Kategori Kegiatan</label>
                        <select class="form-select" id="kegiatan" name="subkegiatanid" required>
                            <option value="" disabled selected>-- Pilih Kegiatan --</option>
                            @foreach ($subKegiatans as $subKegiatan)
                                <option value="{{ $subKegiatan->id }}" {{ old('subkegiatanid') == $subKegiatan->id ? 'selected' : '' }} >
                                    {{ $subKegiatan->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <div class="form-check form-switch">
                            <input type="hidden" name="is_active" value="0"> <!-- Fallback jika checkbox tidak dicentang -->
                            <input class="form-check-input" type="checkbox" id="status" name="is_active" value="1" checked>
                            <label class="form-check-label" for="status">Aktif</label>
                        </div>
                    </div>
                    <input type="hidden" name="dibuatOleh" value="{{ Auth::user()->id}}">
                    </div>

             <div class="modal-footer border-top pt-3 d-flex justify-content-end"> <!-- Tambahan border-top dan padding -->
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" id="submitBtn" class="btn btn-primary">Simpan</button>
            </div>
                </form>
        </div>
    </div>
</div>
</div>

<script>
    document.getElementById('myForm').addEventListener('submit', function() {
        document.getElementById('submitBtn').disabled = true;
    });
</script>

<!-- Modal Edit Artikel -->
<div class="modal fade" id="halamanModal" tabindex="-1" aria-labelledby="halamanModalLabel" aria-hidden="true">
<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center w-100 ">
                <h5 class="modal-title fw-bold text-center" id="menuModalLabel">Edit Menu Artikel</h5>
            </div>
            <div class="modal-body">

                <form id="editArtikelForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <input type="hidden" id="editId" name="id">

                    <div class="mb-3">
                        <label for="editJudul" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="editJudul" name="judul" required>
                    </div>

                    <div class="mb-3">
                        <label for="editTag" class="form-label">Tag</label>
                        <input type="text" class="form-control" id="editTag" name="tag" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Konten</label>
                        <textarea class="form-control" name="konten" id="editKonten" required></textarea>
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
                        <label for="editKategori" class="form-label">Kategori Artikel</label>
                        <select class="form-select" id="editKategori" name="kategoriartikelid" required>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}">
                                    {{ $kategori->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="editKegiatan" class="form-label">Kategori Kegiatan</label>
                        <select class="form-select" id="editKegiatan" name="subkegiatanid" required>
                            @foreach ($subKegiatans as $subKegiatan)
                                <option value="{{ $subKegiatan->id }}">
                                    {{ $subKegiatan->nama }}
                                </option>
                            @endforeach
                        </select>
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal Delete Menu -->
<div class="modal fade" id="deleteMenuModal" tabindex="-1" aria-labelledby="deleteMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteMenuModalLabel">Hapus Artikel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <input type="hidden" id="deleteId" name="id">
                    <p>
                    Anda akan menghapus artikel <strong id="deleteNama"></strong> dari sistem.<br>
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

{{-- modal edit --}}
<script>
   document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".edit-btn").forEach(button => {
        button.addEventListener("click", function () {
            let id = this.getAttribute("data-id");
            let judul = this.getAttribute("data-judul");
            let tag = this.getAttribute("data-tag");
            let konten = this.getAttribute("data-konten");
            let gambar = this.getAttribute("data-gambar");
            let status = this.getAttribute("data-status");
            let kategoriartikelid = this.getAttribute("data-kategoriartikelid");
            let subkegiatanid = this.getAttribute("data-subkegiatanid");

            // Set nilai form dalam modal
            document.getElementById("editId").value = id;
            document.getElementById("editJudul").value = judul;
            document.getElementById("editTag").value = tag;
            document.getElementById("editKonten").value = konten;
            document.getElementById("editKategori").value = kategoriartikelid;
            document.getElementById("editKegiatan").value = subkegiatanid;
            document.getElementById("editStatus").checked = status == "1";

            // Set preview gambar
            document.getElementById("previewGambar").src = gambar;

            // Set action form ke URL update yang sesuai
            document.getElementById("editArtikelForm").action = `/artikel/update/${id}`;
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
                document.getElementById("deleteId").value = id;
                document.getElementById("deleteNama").textContent = nama; // Tampilkan nama di modal

                // Set action form agar mengarah ke endpoint delete yang benar
                document.getElementById("deleteForm").action = `/artikel/hapus/${id}`;
            });
        });
    });
</script>
@endsection