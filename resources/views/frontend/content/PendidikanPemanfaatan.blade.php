@extends('frontend.user-main')

@section('content')
<link href="{{ asset('assets/css/tabel.css') }}" rel="stylesheet">
<div class="container mt-5">
    <div class="card shadow-lg border-0 position-relative overflow-hidden mb-5"> 
        
        <!-- Card dengan Efek Unik -->
        <div class="card shadow-lg border-0 position-relative overflow-hidden">
            <!-- Bagian Header dengan Warna -->
            <div class="custom-header text-center py-4">
                <h2 class="mb-0 text-white">Pendidikan, Pemanfaatan Waktu Luang dan Kegiatan Budaya</h2>
            </div>

            <div class="card-body mt-4">
                <!-- Tabel -->
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle fixed-table"  id="myTable">
                        <thead class="text-center">
                            <tr>
                                <th  class="text-center col-no">No</th>
                                <th class="text-center col-nama">Nama</th>
                                <th class="text-center col-keterangan">Keterangan</th>
                                <th class="text-center col-file">File</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $index => $data)
                            <tr>
                                <td class=" text-center col-no" data-label="No">{{ $index + 1 }}</td>
                                <td class="col-nama" data-label="Nama">{{ $data->nama }}</td>
                                <td class="col-keterangan" data-label="Keterangan">{{ Str::limit($data->keterangan, 100, '...') }}</td>
                                <td  class="text-center col-file" data-label="File">
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
