@extends('admin.admin-master')
@section('main')

<div class="pagetitle ">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    <div class="row justify-content-center">

        <div class="col-lg-6">
            <div class="card text-center shadow p-4">
                <div class="card-body">
                    <img src="{{ asset('kids-rm.png') }}" alt="Dashboard Image" class="img-fluid mb-3" width="350">
                    <h4 class="fw-bold text-danger">Selamat Datang Admin</h4>
                    <p class="text-dark">Sistem Kota Layak Anak Surabaya</p>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection
