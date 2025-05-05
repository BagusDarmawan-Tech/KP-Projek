@extends('frontend.user-main')

@section('content')
<link href="{{ asset('assets/css/tabel.css') }}" rel="stylesheet">
<div class="container mt-5">
<div class="card shadow-lg border-0 position-relative overflow-hidden mb-5"> 
    
    <!-- Card dengan Efek Unik -->
    <div class="card shadow-lg border-0 position-relative overflow-hidden">
        <!-- Bagian Header dengan Warna -->
        <div class="custom-header text-center py-4">
            <h2 class="mb-0 text-white">SK FAS KELURAHAN - SITALAS</h2>
        </div>

        <div class="card-body mt-4">

            <!-- Tabel -->
            <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle fixed-table" id="myTable">
    <thead>
        <tr>
            <th class="text-center col-no">No</th>
            <th class="text-center col-kategori">Kategori</th>
            <th class="text-center col-nama">Nama</th>
            <th class="text-center col-keterangan">Keterangan</th>
            <th class="text-center col-file">File</th>
        </tr>
    </thead>
    <tbody>
    @foreach($dataAktif as $index => $data)
    <tr>
        <td class="col-no" data-label="No">{{ $loop->iteration }}</td>
        <td class=" text-center col-kategori" data-label="Kategori">
            {{ $data->surat ? $data->surat->nama : 'Tidak ada surat' }}
        </td>
        <td class="col-nama" data-label="Nama">{{ $data->nama }}</td>
        <td class="col-keterangan" data-label="Keterangan">{{ Str::limit($data->keterangan, 100, '...') }}</td>
        <td class="col-file" data-label="File">
            <a href="{{ asset('/' . $data->dataPendukung) }}" 
               class="btn btn-sm btn-success btn-download-responsive" 
               download title="Download">
                <div class="download-icon-text">
                    <i class="bi bi-download"></i>
                    <span class="download-text">Download</span>
                </div>
            </a>
        </td>
    </tr>
    @endforeach
</tbody>

</table>

            </div>

            <!-- Paginasi -->
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
