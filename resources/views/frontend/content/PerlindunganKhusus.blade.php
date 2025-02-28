@extends('frontend.user-main')

@section('content')
<link href="{{ asset('assets/css/tabel.css') }}" rel="stylesheet">
<div class="container mt-5">
    <div class="card shadow-lg border-0 position-relative overflow-hidden mb-5"> 
        
        <!-- Card dengan Efek Unik -->
        <div class="card shadow-lg border-0 position-relative overflow-hidden">
            <!-- Bagian Header dengan Warna -->
            <div class="custom-header text-center py-4">
                <h2 class="mb-0 text-white">Perlindungan Khusus</h2>
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
                                <th>File</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $index => $data)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="text-center">{{ $data->nama }}</td>
                                <td class="text-center">{{ $data->keterangan }}</td>
                                <td class="text-center">
                                    <a href="{{ asset('/' . $data->dataPendukung) }}" target="_blank" class="btn btn-sm btn-success" download>
                                        <i class="bi bi-download"></i> Download
                            
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Paginasi -->
                {{-- Tambahkan logika pagination jika diperlukan --}}
            </div>
        </div>
    </div>
</div>
@endsection
