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
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#halamanModal">+ Tambahkan Artikel</button> 
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
                        <tr>
                            <td>1</td>
                            <td><img src="{{ asset('kids.jpg') }}" alt="Slider Image" width="80"></td>
                            <td>Judul Halaman</td>
                            <td>slug-halaman</td>
                            <td>Admin</td>
                            <td><span class="badge bg-success">Aktif</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary edit-btn" data-bs-toggle="modal" data-bs-target="#halamanModal" data-judul="Judul Halaman" data-slug="slug-halaman" data-status="Aktif"><i class="bi bi-pencil-square"></i></button>
                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah/Edit Artikel -->
<div class="modal fade" id="halamanModal" tabindex="-1" aria-labelledby="halamanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="halamanModalLabel">Tambah Artikel Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="judul">
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="slug">
                    </div>
                    <div class="mb-3">
                        <label for="tag" class="form-label">Tag</label>
                        <input type="text" class="form-control" id="tag">
                    </div>
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar</label>
                        <input type="file" class="form-control" id="gambar">
                    </div>
                    <div class="mb-3">
                        <label for="konten" class="form-label">Konten</label>
                        <textarea class="form-control" id="konten" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori Artikel</label>
                        <select class="form-select" id="kategori">
                            <option>-- Pilih Kategori --</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="klaster" class="form-label">Kategori Klaster</label>
                        <select class="form-select" id="klaster">
                            <option>-- Pilih Klaster --</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="kegiatan" class="form-label">Kategori Kegiatan</label>
                        <select class="form-select" id="kegiatan">
                            <option>-- Pilih Kegiatan --</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <input type="checkbox" id="status" checked>
                        <label for="status">Aktif</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
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