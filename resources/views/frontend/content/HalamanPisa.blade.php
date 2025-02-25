@extends('frontend.user-main')

@section('content')
<link href="{{ asset('assets/css/tabel.css') }}" rel="stylesheet">
<div class="container mt-5">
    <div class="card shadow-lg border-0 position-relative overflow-hidden mb-5"> 
        
        <!-- Card dengan Efek Unik -->
        <div class="card shadow-lg border-0 position-relative overflow-hidden">
            <!-- Bagian Header dengan Warna -->
            <div class="custom-header text-center py-4">
                <h2 class="mb-0 text-white">HALAMAN DOKUMENTASI PISA</h2>
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
                        <thead class="text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Keterangan</th>
                                <th>Jenis Surat</th>
                                <th>File</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($details as $index => $detail)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td class="text-center">{{ $detail->nama }}</td>                          
                                    <td class="text-center">{{ $detail->keterangan }}</td>
                                    <td class="text-center">{{ $detail->jenisSurat }}</td>
                                    <td class="text-center">
                                        @if ($detail->jenisSurat)
                                            <!-- Tombol unduh file -->
                                            <a href="{{ asset($detail ->dataPendukung)}}" download class="btn btn-sm btn-primary ms-2">
                                                Download
                                            </a>
                                        @else
                                            <span class="text-muted">File tidak tersedia</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Data tidak tersedia</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Paginasi -->
                <div class="d-flex justify-content-end mt-3">
                    {{-- Tambahkan link pagination jika menggunakan paginated data --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
