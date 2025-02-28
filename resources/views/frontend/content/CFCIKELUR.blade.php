@extends('frontend.user-main')

@section('content')
<link href="{{ asset('assets/css/tabel.css') }}" rel="stylesheet">
<div class="container mt-5">
<div class="card shadow-lg border-0 position-relative overflow-hidden mb-5"> 
    
    <!-- Card dengan Efek Unik -->
    <div class="card shadow-lg border-0 position-relative overflow-hidden">
        <!-- Bagian Header dengan Warna -->
        <div class="custom-header text-center py-4">
            <h2 class="mb-0 text-white">SK CFCI KELURAHAN - SITALAS</h2>
        </div>

        <div class="card-body mt-4">

            <!-- Tabel -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle" id="myTable">
                    <thead class="text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Keterangan</th>
                            <th>File</th>
                        </tr>
                    </thead>
                    
                </table>
            </div>

            <!-- Paginasi -->
            
        </div>
    </div>
</div>


@endsection
