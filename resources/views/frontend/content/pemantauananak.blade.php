@extends('frontend.user-main')

@section('content')
<link href="{{ asset('assets/css/tabel.css') }}" rel="stylesheet">
<div class="container mt-5">
<div class="card shadow-lg border-0 position-relative overflow-hidden mb-5"> 
    
    <!-- Card dengan Efek Unik -->
    <div class="card shadow-lg border-0 position-relative overflow-hidden">
        <!-- Bagian Header dengan Warna -->
        <div class="custom-header text-center py-4">
            <h2 class="mb-0 text-white">Pemantauan Usulan Anak</h2>
        </div>

        <div class="card-body mt-4">

            <!-- Tabel -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle" id="myTable">
                    <thead class="text-center">
                        <tr>
                            <th>No</th>
                            <th>Usulan Anak Untuk Pembangunan Kota Surabaya</th>
                            <th>OPD Pelaksana</th>
                            <th>Keterangan</th>
                            <th>Status Tindak Lanjut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($datas as $key => $data)
                            <tr>
                                <td class="text-center">{{ $key + 1 }}</td>
                                <td class ="text-center">{{ $data->namaUsulan }} <!-- Kolom "usulan" -->
                                <td class ="text-center">{{ $data -> user ? $data -> user -> name : 'Tidak ada pengguna' }}</td>
                                <td class ="text-center">{{ $data->keterangan }}</td> <!-- Kolom "keterangan" -->
                                <td class="text-center">
                                        <!-- Cek nilai 'tindakLanjut' dan tampilkan badge -->
                                        @if($data->tindakLanjut === 'Diproses')
                                            <span class="badge bg-success">Belom di Tindak Lanjut</span>
                                        @elseif($data->tindakLanjut === 'Telah Diproses')
                                            <span class="badge bg-warning">Sudah di Tindak Lanjut</span>
                                        @else
                                            <span class="badge bg-secondary">Tidak Ada Status</span>
                                        @endif
                                    </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data aktif.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginasi (Jika diperlukan) -->
            {{-- @if(method_exists($datas, 'links'))
                <div class="d-flex justify-content-center mt-3">
                    {{ $datas->links() }}
                </div>
            @endif --}}
        </div>
    </div>
</div>
@endsection
