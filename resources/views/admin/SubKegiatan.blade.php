@extends('admin.admin-master')
@section('main')

<link href="{{ asset('assets/css/tabel.css') }}" rel="stylesheet">

<div class="container mt-5">
    <div class="card shadow-lg border-0 position-relative overflow-hidden mb-5">
        <div class="card-body mt-4">
            <div class="text-center mb-4">
                <h4 class="fw-bold">Sub Kegiatan</h4>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div></div> <!-- Spacer -->
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#subKegiatanModal">
                    + Sub Kegiatan
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
                            <th>No</th>
                            <th>Klaster</th>
                            <th>Nama Sub Kegiatan</th>
                            <th>Data Dukung</th>
                            <th>Dibuat Oleh</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Kelembagaan</td>
                            <td>Peraturan</td>
                            <td>-</td> <!-- Pastikan ini menampilkan file jika ada -->
                            <td>Ema</td>
                            <td><span class="badge bg-success">Aktif</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i></button>
                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Sub Kegiatan -->
<div class="modal fade" id="subKegiatanModal" tabindex="-1" aria-labelledby="subKegiatanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="subKegiatanModalLabel">Tambah Sub Kegiatan Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Klaster</label>
                        <select class="form-select" name="klaster" required>
                            <option selected>--- Pilih Klaster ---</option>
                            <option value="Kelembagaan">Kelembagaan</option>
                            <option value="Hak Sipil Dan Kebebasan">Hak Sipil Dan Kebebasan</option>
                            <option value="Lingkungan Keluarga Dan Pengasuhan Alternatif">Lingkungan Keluarga Dan Pengasuhan Alternatif</option>
                            <option value="Kesehatan Dasar Dan Kesejahteraan">Kesehatan Dasar Dan Kesejahteraan</option>
                            <option value="Pendidikan, Pemanfaatan Waktu Luang Dan Kegiatan Budaya">Pendidikan, Pemanfaatan Waktu Luang Dan Kegiatan Budaya</option>
                            <option value="Perlindungan Khusus">Perlindungan Khusus</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="namaSubKegiatan" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="namaSubKegiatan" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="dataDukung" class="form-label">Data Dukung</label>
                        <input type="file" class="form-control" id="dataDukung" name="data_dukung" accept=".pdf,.doc,.docx,.jpg,.png">
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan">
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option selected>--- Pilih Status ---</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Non-Aktif">Non-Aktif</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
