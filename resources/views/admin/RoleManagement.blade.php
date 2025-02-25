@extends('admin.admin-master')
@section('main')
<link href="{{ asset('assets/css/tabel.css') }}" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="container mt-5">
    <div class="card shadow-lg border-0 position-relative overflow-hidden mb-5"> 
        <div class="card-body mt-4">
            <div class="text-center mb-4">
                <h4 class="fw-bold">Role Management</h4>
            </div>
            
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div></div> <!-- Spacer -->
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kategoriModal">
                    + Tambah Role
                </button>
            </div>

            <!-- Kontrol Atas (Tampilkan & Cari) -->
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

            <!-- Tabel -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle text-center">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role )
                        <tr>
                            <td style="text-align: center;">{{ $loop->iteration }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                            <button class="btn btn-sm btn-primary edit-btn" data-bs-toggle="modal" data-bs-target="#EditModal"data-status="Aktif"><i class="bi bi-pencil-square"></i></button>
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


<!-- Modal Tambah -->
<div class="modal fade" id="kategoriModal" tabindex="-1" aria-labelledby="kategoriModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center w-100">
                @if (auth()->user()->hasPermissionTo('role management-list'))
                <h5 class="modal-title fw-bold text-center" id="kategoriModalLabel">Tambah Menu Role Management</h5>
                @endif
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.store') }}" method="POST">
                    <!-- Input Nama -->
                    <div class="mb-3">
                        <label for="kategoriNama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="kategoriNama" placeholder="Masukkan Nama">
                    </div>

                    <!-- Daftar Akses -->
                    <div class="mb-3">
                        <label for="akses" class="form-label">Akses</label>
                        <div class="table-responsive " style="max-height: 300px; overflow-y: auto; border: 1px solid #ddd;">
                            <table class="table table-bordered table-hover ">
                                <thead class="table-light" style="position: sticky; top: 0; z-index: 2;">
                                    <tr>
                                        <th>Nama Menu</th>
                                        <th><input type="checkbox" id="checkAllList"> List</th>
                                        <th><input type="checkbox" id="checkAllAdd"> Add</th>
                                        <th><input type="checkbox" id="checkAllEdit"> Edit</th>
                                        <th><input type="checkbox" id="checkAllDelete"> Delete</th>
                                        <th><input type="checkbox" id="checkAllVerify"> Verifikasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Dashboard</td>
                                        <td class="text-center"><input type="checkbox" name="dashboard_list"></td>
                                        <td class="text-center"><input type="checkbox" name="dashboard_add"></td>
                                        <td class="text-center"><input type="checkbox" name="dashboard_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="dashboard_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="dashboard_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Config</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>User Management</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Role Management</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Configurasi APP</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Web Management</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Menu Management</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Artikel</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Kategori Artikel</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Slider</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Klaster</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Sub Kegiatan</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Galeri</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Forum Anak</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Halaman</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Pemantauan Usulan</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Kecamatan Layak Anak</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Dokumen Kecamatan</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Kegiatan Kecamatan</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Kelurahan Layak Anak </td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Dokumen Kelurahan
                                        </td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Kegiatan Kelurahan</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Mitra Anak</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Kegiatan CFCI</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Artikel Anak</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Pusat Informasi Sahabat Anak</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Dokumen Pisa</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Kegiatan Pisa</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Kegiatan Arek Suroboyo</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Kegiatan Forum Anak Surabaya</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Usulan Kegiatan</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Pemantauan Suara Anak</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Karya</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Dokumen SK FAS, CFCI dan KLA</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <!-- Tambahkan menu lainnya di sini -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Tombol Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>



<!-- bagian Edit -->
<div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="EditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center w-100">
                <h5 class="modal-title fw-bold text-center" id="EditModalLabel">Edit Menu Role Management</h5>
            </div>
            <div class="modal-body">
                <form>
                    <!-- Input Nama -->
                    <div class="mb-3">
                        <label for="kategoriNama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="kategoriNama" placeholder="Masukkan Nama">
                    </div>

                    <!-- Daftar Akses -->
                    <div class="mb-3">
                        <label for="akses" class="form-label">Akses</label>
                        <div class="table-responsive " style="max-height: 300px; overflow-y: auto; border: 1px solid #ddd;">
                            <table class="table table-bordered table-hover ">
                                <thead class="table-light" style="position: sticky; top: 0; z-index: 2;">
                                    <tr>
                                        <th style="width: 40%; text-align: left; background: white;">Nama Menu</th>
                                        <th style="width: 10%; text-align: center; background: white;">List</th>
                                        <th style="width: 10%; text-align: center; background: white;">Add</th>
                                        <th style="width: 10%; text-align: center; background: white;">Edit</th>
                                        <th style="width: 10%; text-align: center; background: white;">Delete</th>
                                        <th style="width: 10%; text-align: center; background: white;">Verifikasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Dashboard</td>
                                        <td class="text-center"><input type="checkbox" name="dashboard_list"></td>
                                        <td class="text-center"><input type="checkbox" name="dashboard_add"></td>
                                        <td class="text-center"><input type="checkbox" name="dashboard_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="dashboard_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="dashboard_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Config</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>User Management</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Role Management</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Configurasi APP</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Web Management</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Menu Management</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Artikel</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Kategori Artikel</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Slider</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Klaster</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Sub Kegiatan</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Galeri</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Forum Anak</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Halaman</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Pemantauan Usulan</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Kecamatan Layak Anak</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Dokumen Kecamatan</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Kegiatan Kecamatan</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Kelurahan Layak Anak </td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Dokumen Kelurahan
                                        </td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Kegiatan Kelurahan</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Mitra Anak</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Kegiatan CFCI</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Artikel Anak</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Pusat Informasi Sahabat Anak</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Dokumen Pisa</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Kegiatan Pisa</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Kegiatan Arek Suroboyo</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Kegiatan Forum Anak Surabaya</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Usulan Kegiatan</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Pemantauan Suara Anak</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Karya</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Dokumen SK FAS, CFCI dan KLA</td>
                                        <td class="text-center"><input type="checkbox" name="config_list"></td>
                                        <td class="text-center"><input type="checkbox" name="config_add"></td>
                                        <td class="text-center"><input type="checkbox" name="config_edit"></td>
                                        <td class="text-center"><input type="checkbox" name="config_delete"></td>
                                        <td class="text-center"><input type="checkbox" name="config_verifikasi"></td>
                                    </tr>
                                    <!-- Tambahkan menu lainnya di sini -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Tombol Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>



<!-- Modal Delete -->
<div class="modal fade" id="deleteMenuModal" tabindex="-1" aria-labelledby="deleteMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteMenuModalLabel">Hapus Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus Data di Menu ini?
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
        var kategoriModal = new bootstrap.Modal(document.getElementById("kategoriModal"));
    });
</script>




@endsection