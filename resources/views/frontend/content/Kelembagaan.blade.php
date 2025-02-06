@extends('frontend.user-main')

@section('content')
<div class="container mt-5">
    <!-- Card dengan Efek Header -->
    <div class="card shadow-lg border-0 position-relative overflow-hidden">
        <!-- Bagian Header dengan Warna -->
        <div class="custom-header text-center py-4">
            <h2 class="mb-0 text-white">Kelembagaan</h2>
        </div>

        <div class="card-body mt-4">
            <!-- Kontrol Atas (Tampilkan & Cari) -->
            <div class="row mb-3 align-items-center">
                <div class="col-md-6">
                    <label for="showEntries" class="form-label me-2">Tampilkan</label>
                    <select id="showEntries" class="form-select form-select-sm d-inline-block" style="width: 80px;">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <div class="col-md-6 text-end">
                    <input type="text" id="searchInput" class="form-control form-control-sm d-inline-block" placeholder="🔍 Cari dokumen..." style="width: 200px;">
                </div>
            </div>

            <!-- Tabel -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Keterangan</th>
                            <th>File</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($documents as $index => $document)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ $document->nama }}</td>
                                <td>{{ $document->keterangan }}</td>
                                <td class="text-center">
                                    <a href="{{ asset('storage/files/' . $document->file) }}" class="btn btn-sm btn-outline-secondary" download>
                                        📥 Download
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Tidak ada data tersedia</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginasi -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <span class="text-muted">Menampilkan {{ $documents->count() }} dari {{ $documents->total() }} data</span>
                <nav>
                    {{ $documents->links() }}
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- CSS untuk Efek Header -->
<style>
    .custom-header {
        font-size: 22px;
        font-weight: bold;
        padding: 15px;
        border-radius: 15px 15px 50% 50%;
        background: rgb(233, 36,103);
        color: white;
    }

    .table th {
        font-weight: bold;
        text-align: center;
    }

    .btn-outline-secondary {
        border-radius: 10px;
    }
</style>
@endsection
