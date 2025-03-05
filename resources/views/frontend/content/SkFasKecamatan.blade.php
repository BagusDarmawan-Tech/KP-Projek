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
                <!-- Tabel -->
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle" id="myTable">
                        <thead class="text-center">
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Kategori</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Keterangan</th>
                                <th class="text-center">File</th>
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
                            <a href="{{ asset('/' . $data->dataPendukung) }}" download class="btn btn-sm btn-success" download>
                                        <i class="bi bi-download"></i> Download</a>
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
