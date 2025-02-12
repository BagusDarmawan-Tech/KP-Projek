@extends('admin.admin-master')
@section('main')
<link href="{{ asset('assets/css/tabel.css') }}" rel="stylesheet">

<div class="container mt-5">
    <div class="card shadow-lg border-0 position-relative overflow-hidden mb-5"> 
        <div class="card-body mt-4">
            <div class="text-center mb-4">
                <h4 class="fw-bold">Klaster</h4>
            </div>
            
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div></div> <!-- Spacer -->
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kategoriModal">
                    + Tambah Klaster
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
                            <th>Icon</th>
                            <th>Nama</th>
                            <th>Slug</th>
                            <th>Gambar</th>
                            <th>Dibuat Oleh</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($klasters as $klaster )
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><i class="{{ $klaster->icon }}"></i></td>
                            <td>{{ $klaster->nama }}</td>
                            <td>{{ $klaster->slug }}</td>
                            <td><img src="{{ asset($klaster->gambar) }}" alt="Gambar" width="50"></td>
                            <td>{{ $klaster->dibuatOleh }}</td>
                            <td><span class="badge bg-success">{{ $klaster->is_active }}</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary"><i class="bi bi-pencil"></i></button>
                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal Tambah Klaster -->
<div class="modal fade" id="kategoriModal" tabindex="-1" aria-labelledby="kategoriModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kategoriModalLabel">Tambah Klaster Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('createKlaster') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="kategoriIcon" class="form-label">Icon</label>
                        <input type="text" class="form-control" class="form-control" id="nama" name="icon" value="{{ old('icon') }}" placeholder="Masukkan Icon">
                    </div>
                    <div class="mb-3">
                        <label for="kategoriNama" class="form-label">Nama</label>
                        <input type="text" class="form-control"  id="nama" name="nama" value="{{ old('nama') }}" placeholder="Masukkan Nama">
                    </div>
                    <div class="mb-3">
                        <label for="kategoriSlug" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="slug" id="caption" name="slug" value="{{ old('slug') }}" placeholder="Masukkan Slug">
                    </div>
                    <div class="mb-3">
                        <label for="kategoriGambar" class="form-label">Gambar</label>
                        <input type="file" class="form-control" id="gambar" name="gambar" value="{{ old('gambar') }}">
                    </div>
                    <div class="mb-3">
                        <label for="kategoriStatus" class="form-label">Status</label>
                        <select class="form-select" id="kategoriStatus" name="is_active" required>
                            <option value="" disabled selected>--- Pilih Status ---</option>
                            <option value="1" {{ old('is_active') == "1" ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('is_active') == "0" ? 'selected' : '' }}>Non-Aktif</option>
                        </select>
                    </div>
                    </div>
                    <input type="hidden" name="dibuatOleh" value="{{ Auth::user()->name }}">
            
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
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