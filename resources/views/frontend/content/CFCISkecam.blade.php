@extends('frontend.user-main')

@section('content')
<link href="{{ asset('assets/css/tabel.css') }}" rel="stylesheet">
<div class="container mt-5">
<div class="card shadow-lg border-0 position-relative overflow-hidden mb-5"> 
    
    <!-- Card dengan Efek Unik -->
    <div class="card shadow-lg border-0 position-relative overflow-hidden">
        <!-- Bagian Header dengan Warna -->
        <div class="custom-header text-center py-4">
            <h2 class="mb-0 text-white">SK CFCI KECAMATAN - SITALAS</h2>
        </div>

        <div class="card-body mt-4">
            <!-- Tabel -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle text-center" id="myTable">
                    <thead class="text-center">
                        <tr>
                            <th  class="text-center">No</th>
                            <th  class="text-center">Kategori</th>
                            <th  class="text-center">Nama</th>
                            <th  class="text-center">Keterangan</th>
                            <th  class="text-center">File</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataAktif as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td> {{ $data->surat ? $data->surat->nama : 'Tidak ada surat' }}</td>                            
                            <td>{{ $data->nama }}</td>
                            <td>{{ $data->keterangan }}</td>
                            <td>
                                <a href="{{ asset($data->dataPendukung) }}" target="_blank">
                                    <i download class="btn btn-sm btn-success" download>
                                        <i class="bi bi-download"></i> Download
</i>
                                </a>
                            </td>                        
                        </tr>
                        @endforeach
                    </tbody>
                    
                </table>
            </div>

            <!-- Paginasi -->
            
        </div>
    </div>
</div>


@endsection
