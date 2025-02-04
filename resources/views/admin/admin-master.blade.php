<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon"/>

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
  <link rel="stylesheet" href="{{ asset('assets/css/style-bagus.css') }}">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  @include('admin.body.nav')
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
    @include('admin.body.sidebar')
  <!-- End Sidebar-->

  <main id="main" class="main">
    @yield('main')
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
    @include('admin.body.footer')
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor-bagus JS Files -->
  <link rel="stylesheet" href="{{ asset('assets/css/style-bagus.css') }}">

  <script src="{{ asset('assets/vendor-bagus/apexcharts/apexcharts.min.js' ) }}"></script>
  <script src="{{ asset('assets/vendor-bagus/bootstrap/js/bootstrap.bundle.min.js' ) }}"></script>
  <script src="{{ asset('assets/vendor-bagus/chart.js/chart.umd.js' ) }}"></script>
  <script src="{{ asset('assets/vendor-bagus/echarts/echarts.min.js' ) }}"></script>
  <script src="{{ asset('assets/vendor-bagus/quill/quill.js' ) }}"></script>
  <script src="{{ asset('assets/vendor-bagus/simple-datatables/simple-datatables.js' ) }}"></script>
  <script src="{{ asset('assets/vendor-bagus/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset('assets/vendor-bagus/php-email-form/validate.js' ) }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('assets/js/main-bagus.js' ) }}"></script>

</body>

</html>