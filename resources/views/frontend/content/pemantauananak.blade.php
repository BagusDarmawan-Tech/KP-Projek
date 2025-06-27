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
               <table class="table table-hover table-bordered align-middle  fixed-table" id="myTable">
    <thead class="text-center">
        <tr>
            <th class="text-center col-no">No</th>
            <th class="text-center col-kategori">Usulan Anak Untuk Pembangunan Kota Surabaya</th>
            <th class="text-center col-nama">OPD Pelaksana</th>
            <th class="text-center col-keterangan">Keterangan</th>
            <th class="text-center col-file">Status Tindak Lanjut</th>
        </tr>
    </thead>
    <tbody>
        @forelse($datas as $key => $data)
            <tr class="text-start">
                <td class=" text-center col-no" data-label="No">{{ $key + 1 }}</td>
                <td class=" text-center col-kategori" data-label="Kategori">{{ $data->nomorSuara }}</td>
                <td class="col-nama" data-label="Nama">{{ $data->pemohon ? $data->user->name : 'Tidak ada pengguna' }}</td>
                <td class="col-keterangan" data-label="Keterangan">{{ $data->deskripsi }}</td>
                <td  class="text-center col-file" data-label="File">{{ $data->tindakLanjut }}</td>
            </tr>
        @empty
            <!-- <tr>
                <td colspan="5" class="text-center">Tidak ada data aktif.</td>
            </tr> -->
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
