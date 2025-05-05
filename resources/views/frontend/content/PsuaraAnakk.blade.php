@extends('frontend.user-main')

@section('content')
<link href="{{ asset('assets/css/tabel.css') }}" rel="stylesheet">

<div class="container mt-5">
    <div class="card shadow-lg border-0 position-relative overflow-hidden mb-5"> 
        <!-- Header Card -->
         
        <div class="custom-header text-center py-4">
            <h2 class="mb-0 text-white">PANTAU SUARA ANAK</h2>
        </div>

        <div class="card-body mt-4">
            <!-- Tabel Data -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle fixed-table" id="myTable">
                    <thead>
                        <tr>
                            <th class="text-center col-no">No</th>
                            <th class="text-center col-kategori">Pengusul</th>
                            <th class="text-center col-nama">Perihal</th>
                            <th class="text-center col-keterangan">Deskripsi</th>
                            <th class="text-center col-file">Hasil Tindak Lanjut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($datas as $index => $data)
                            <tr>
                                <td class=" text-center col-no" data-label="No">{{ $index + 1 }}</td>
                                <td class=" text-center col-kategori" data-label="Kategori">{{ $data->user ? $data->user->name : 'Tidak ada pemohon' }}</td>
                                <td lass="col-nama" data-label="Nama">{{ $data->perihal }}</td>
                                <td class="col-keterangan" data-label="Keterangan">{{  Str::limit($data->deskripsi, 100, '...') }}</td>
                                <td class="text-center col-file" data-label="File">
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
