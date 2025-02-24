@extends('frontend.user-main')

@section('content')
<link href="{{ asset('assets/css/tabel.css') }}" rel="stylesheet">

<div class="container mt-5">
    <div class="card shadow-lg border-0 position-relative overflow-hidden mb-5"> 
    
        <!-- Card dengan Efek Unik -->
        <div class="card shadow-lg border-0 position-relative overflow-hidden">
            <!-- Bagian Header dengan Warna -->
            <div class="custom-header text-center py-4">
                <h2 class="mb-0 text-white">SK FAS KECAMATAN - SITALAS</h2>
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
                                <th>Kategori</th>
                                <th>Nama</th>
                                <th>Keterangan</th>
                                <th>File</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($dataAktif as $index => $data)
                        <tr>
                            <td style="text-align: center;">{{ $loop->iteration }}</td>
                            <td class="text-center"> {{ $data->surat ? $data->surat->nama : 'Tidak ada surat' }}</td>                            
                           
                            <td class="text-center">{{ $data->nama }}</td>
                            <td class="text-center">{{ $data->keterangan }}</td>
                            <td class="text-center">
                            <a href="{{ asset('/' . $data->dataPendukung) }}" download class="btn btn-sm btn-primary">Download</a>
                        </td>

                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Paginasi (Opsional, jika menggunakan paginasi) -->
                {{-- @if(method_exists($dataAktif, 'links'))
                    <div class="d-flex justify-content-center mt-3">
                        {{ $dataAktif->links() }}
                    </div>
                @endif --}}
            </div>
        </div>
    </div>
</div>
@endsection
