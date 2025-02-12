@extends('admin.admin-master')

@section('title', 'Karya Anak')

@section('main')

<!-- Tambahkan CSS Kustom -->
<link href="{{ asset('assets/css/tabel.css') }}" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('assets/js/hapus.js') }}"></script>

<style>
    /* untuk "Terverifikasi" */
    .bg-purple {
        background-color: #6f42c1 !important;
        color: white;
    }

    /* "Belum Terverifikasi" */
    .bg-gray {
        background-color: #adb5bd !important;
        color: white;
    }
</style>

<div class="card shadow-lg border-0 position-relative overflow-hidden mb-5">
    <div class="card-body mt-4">
        <div class="text-center mb-4">
            <h4 class="fw-bold">Karya Anak</h4>
        </div>

        <!-- Tombol Tambah Karya -->
        <div class="row mb-3">
            <div class="col-md-12 d-flex justify-content-end">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahKaryaModal">
                    + Tambah Karya Anak Baru
                </button>
            </div>
        </div>

        <!-- Tabel -->
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle text-center">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th class="text-nowrap">Tanggal</th>
                        <th>Pemohon</th>
                        <th>Kreator</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Hasil Karya</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td class="text-nowrap">06 Februari 2025 01:24</td>
                        <td>kecamatan_wonocolo</td>
                        <td>Tes</td>
                        <td>Tes...</td>
                        <td>Tes</td>
                        <td><img src="{{ asset('kids.jpg') }}" width="60"></td>
                        <td>
                            <span class="badge bg-success">Terverifikasi</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center justify-content-center gap-1 py-1" style="min-height: 38px;">
                                <!-- Tombol Edit -->
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editKaryaModal">
                                    <i class="bi bi-pencil"></i>
                                </button>

                                <!-- Tombol Hapus -->
                                <button class="btn btn-sm btn-danger delete-slider">
                                    <i class="bi bi-trash"></i>
                                </button>

                                <!-- Tombol Verifikasi -->
                                <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#verifikasiModal">
                                    <i class="bi bi-check-lg"></i>
                                </button>
                            </div>
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Karya -->
<div class="modal fade" id="tambahKaryaModal" tabindex="-1" aria-labelledby="tambahKaryaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahKaryaModalLabel">Tambah Karya Anak Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Kreator</label>
                    <input type="text" class="form-control" required placeholder="Masukkan nama kreator">
                </div>
                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" class="form-control" required placeholder="Masukkan judul">
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea class="form-control" rows="3" required placeholder="Masukkan deskripsi"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Upload Foto</label>
                    <input type="file" class="form-control" accept=".jpg, .png">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Karya -->
<div class="modal fade" id="editKaryaModal" tabindex="-1" aria-labelledby="editKaryaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editKaryaModalLabel">Edit Karya Anak</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Kreator</label>
                    <input type="text" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea class="form-control" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Upload Foto</label>
                    <input type="file" class="form-control" accept=".jpg, .png">
                    <small class="text-muted">Tidak ada file yang dipilih</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Verifikasi -->
<div class="modal fade" id="verifikasiModal" tabindex="-1" aria-labelledby="verifikasiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Verifikasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <p class="fw-semibold">Apakah Anda yakin ingin memverifikasi data ini?</p>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button class="btn btn-success">TERIMA</button>
                <button class="btn btn-danger" data-bs-dismiss="modal">TOLAK</button>
            </div>
        </div>
    </div>
</div>

@endsection