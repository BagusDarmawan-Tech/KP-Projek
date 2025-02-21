<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Pages / Tidak ditemukan 404</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <!-- Vendor-bagus CSS Files -->
  <link rel="stylesheet" href="{{ asset('assets/vendor-bagus/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor-bagus/bootstrap-icons/bootstrap-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor-bagus/boxicons/css/boxicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor-bagus/quill/quill.snow.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor-bagus/quill/quill.bubble.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor-bagus/remixicon/remixicon.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor-bagus/simple-datatables/style.css') }}">

  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/css/style-bagus.css') }}" rel="stylesheet">

</head>

<body>

  <main>
    <div class="container">
      <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
        <h1 style="color: #ff6584">404</h1>
        <h2 class="text-center ">Oops! Halaman yang Anda cari tidak tersedia. <br><span class="text-dark"> {{ $current_url }}</span></h2>
        <span></span>
        <a class="btn" href="{{ url('/') }}">Kembali ke landing Page</a>
        <img src="{{ asset('assets/img/not-found.svg') }}" class="img-fluid py-5" alt="Page Not Found">
        <div class="credits">
        </div>
      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor-bagus/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/vendor-bagus/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor-bagus/chart.js/chart.umd.js') }}"></script>
  <script src="{{ asset('assets/vendor-bagus/echarts/echarts.min.js') }}"></script>
  <script src="{{ asset('assets/vendor-bagus/quill/quill.js') }}"></script>
  <script src="{{ asset('assets/vendor-bagus/simple-datatables/simple-datatables.js') }}"></script>
  <script src="{{ asset('assets/vendor-bagus/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset('assets/vendor-bagus/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('assets/js/main-bagus.js') }}"></script>

</body>

</html>