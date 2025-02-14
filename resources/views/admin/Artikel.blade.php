@extends('admin.admin-master')
@section('main')
<link href="{{ asset('assets/css/tabel.css') }}" rel="stylesheet">

<div class="container mt-5">
    <div class="card shadow-lg border-0 position-relative overflow-hidden mb-5">
        <div class="card-body mt-4">
            <div class="text-center mb-4">
                <h4 class="fw-bold">Halaman Artikel</h4>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div></div> <!-- Spacer -->
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#halamanTambahModal">+ Tambahkan Artikel</button> 
            </div>

            <!-- Kontrol Tampilkan & Cari -->
            <div class="row mb-3 align-items-center">
                <div class="col-md-6">
                    <label for="showEntries" class="form-label me-2">Show</label>
                    <select id="showEntries" class="form-select form-select-sm d-inline-block" style="width: 80px;">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    entries
                </div>
                <div class="col-md-6 text-end">
                    <input type="text" id="searchInput" class="form-control form-control-sm d-inline-block" placeholder="Search..." style="width: 200px;">
                </div>
            </div>
            
            <!-- Tombol Tambah Artikel di atas -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle text-center">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Nama Kategori</th>
                            <th>Judul</th>
                            <th>Dibuat Oleh</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($artikels as $artikel)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><img src="{{ asset( $artikel->gambar ) }}" alt="Slider Image" width="80"></td>
                            <td>{{ $artikel->judul }}</td>
                            <td>{{ $artikel->slug }}</td>
                            <td>{{ $artikel->dibuatOleh }}</td>
                            <td><span class="badge bg-success">{{ $artikel->is_active }}</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary edit-btn" data-bs-toggle="modal" data-bs-target="#halamanModal" data-judul="Judul Halaman" data-slug="slug-halaman" data-status="Aktif"><i class="bi bi-pencil-square"></i></button>
                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteMenuModal"><i class="bi bi-trash"></i></button>
                                </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<
<!-- Modal Tambah -->
<div class="modal fade" id="halamanTambahModal" tabindex="-1" aria-labelledby="halamanTambahModalLabel" aria-hidden="true">
<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center w-100 ">
                <h5 class="modal-title fw-bold text-center" id="menuModalLabel">Tambah Menu Artikel Baru</h5>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('createArtikel') }}" enctype="multipart/form-data">
                    @csrf 
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul') }}" required>
                    </div>
                
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') }}" required>
                    </div>
                
                    <div class="mb-3">
                        <label for="tag" class="form-label">Tag</label>
                        <input type="text" class="form-control" id="tag" name="tag" value="{{ old('tag') }}">
                    </div>
                
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar</label>
                        <input type="file" class="form-control" id="gambar" name="gambar" required>
                    </div>
                
                    <div class="mb-3">
                        <label for="konten" class="form-label">Konten</label>
                        <textarea class="form-control" id="konten" rows="3" name="konten" required>{{ old('konten') }}</textarea>
                    </div>
                
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori Artikel</label>
                        <select class="form-select" id="kategori" name="kategoriartikelid" required>
                            <!-- <option value="" disabled selected>-- Pilih Kategori --</option> -->
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
                        <label for="kategoriStatus" class="form-label">Status</label>
                        <select class="form-select" id="kategoriStatus" name="is_active" required>
                            <option value="" disabled selected>--- Pilih Status ---</option>
                            <option value="1" {{ old('is_active') == "1" ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('is_active') == "0" ? 'selected' : '' }}>Non-Aktif</option>
                        </select>
                    </div>
                    <input type="hidden" name="dibuatOleh" value="{{ Auth::user()->name }}">
                    </div>

             <div class="modal-footer border-top pt-3 d-flex justify-content-end"> <!-- Tambahan border-top dan padding -->
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
                </form>
        </div>
    </div>
</div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="halamanModal" tabindex="-1" aria-labelledby="halamanModalLabel" aria-hidden="true">
<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center w-100 ">
                <h5 class="modal-title fw-bold text-center" id="menuModalLabel">Edit Menu Artikel Baru</h5>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('createArtikel') }}" enctype="multipart/form-data">
                    @csrf 
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul') }}" required>
                    </div>
                
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') }}" required>
                    </div>
                
                    <div class="mb-3">
                        <label for="tag" class="form-label">Tag</label>
                        <input type="text" class="form-control" id="tag" name="tag" value="{{ old('tag') }}">
                    </div>
                
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar</label>
                        <input type="file" class="form-control" id="gambar" name="gambar" required>
                    </div>
                
                    <div class="mb-3">
                        <label for="konten" class="form-label">Konten</label>
                        <textarea class="form-control" id="konten" rows="3" name="konten" required>{{ old('konten') }}</textarea>
                    </div>
                
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori Artikel</label>
                        <select class="form-select" id="kategori" name="kategoriartikelid" required>
                            <!-- <option value="" disabled selected>-- Pilih Kategori --</option> -->
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
                                    {{ $subKegiatan->id }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="kategoriStatus" class="form-label">Status</label>
                        <select class="form-select" id="kategoriStatus" name="is_active" required>
                            <option value="" disabled selected>--- Pilih Status ---</option>
                            <option value="1" {{ old('is_active') == "1" ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('is_active') == "0" ? 'selected' : '' }}>Non-Aktif</option>
                        </select>
                    </div>
                    <input type="hidden" name="dibuatOleh" value="{{ Auth::user()->name }}">
                    </div>
                    <div class="modal-footer border-top pt-3 d-flex justify-content-end"> <!-- Tambahan border-top dan padding -->
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
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
                <h5 class="modal-title" id="deleteMenuModalLabel">Hapus Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus menu ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".edit-btn").forEach(button => {
            button.addEventListener("click", function () {
                document.getElementById("halamanModalLabel").textContent = "Edit Artikel";
                document.getElementById("judul").value = this.getAttribute("data-judul");
                document.getElementById("slug").value = this.getAttribute("data-slug");
                document.getElementById("status").checked = this.getAttribute("data-status") === "Aktif";
            });
        });
    });
</script>
@endsection