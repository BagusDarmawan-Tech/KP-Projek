@extends('frontend.user-main')

@section('content')
<link href="{{ asset('assets/css/tabel.css') }}" rel="stylesheet">

<style>
    /* Warna latar belakang untuk header tabel menjadi pink */
    .custom-header {
        background-color: #e92467 !important;
        color: white;
        border-bottom-left-radius: 50% 20%;
        border-bottom-right-radius: 50% 20%;
    }
</style>

<div class="container mt-5">
    <div class="card shadow-lg border-0 position-relative overflow-hidden mb-5"> 
        <!-- Header Card -->
        <div class="custom-header text-center py-4">
            <h2 class="mb-0 text-white">PANTAU SUARA ANAK</h2>
        </div>

        <div class="card-body mt-4">
            <!-- Tabel Data -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle" id="myTable">
                    <thead class="text-center bg-light">
                        <tr class="text-center">
                            <th>No</th>
                            <th>Pengusul</th>
                            <th>Perihal</th>
                            <th>Deskripsi</th>
                            <th>Hasil Tindak Lanjut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($datas as $index => $data)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="text-center">{{ $data->user ? $data->user->name : 'Tidak ada pemohon' }}</td>
                                <td class="text-center">{{ $data->perihal }}</td>
                                <td class="text-center">{{ $data->deskripsi }}</td>
                                <td class="text-center">
                                    <!-- Tombol Unduh -->
                                    <a href="{{ asset($data->file) }}" class="btn btn-sm btn-success" download>
                                        <i class="bi bi-download"></i> Download
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data yang ditemukan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginasi -->
            <div class="d-flex justify-content-center mt-4">
                {{-- Jika Anda menggunakan paginasi, tampilkan di sini --}}
                {{-- {{ $datas->links() }} --}}
            </div>
        </div>
    </div>
</div>
@endsection
