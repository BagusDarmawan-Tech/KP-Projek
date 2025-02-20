<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link rel="stylesheet" href="//cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">


  <!-- Favicons -->
  <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

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
  <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

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
  <script>
    document.addEventListener("DOMContentLoaded", function () {
        let sessionExpiresAt = {{ session('sessionExpiresAt', time() + (config('session.lifetime') * 60)) }} * 1000;
        let warningTime = 30000; // 30 detik sebelum logout
        let warningTriggered = false;
        let sessionActive = false;
        let loginUrl = "{{ route('login') }}"; 

        function checkSession() {
            let now = new Date().getTime();
            let timeLeft = sessionExpiresAt - now;

            // Jika waktu sesi tinggal 30 detik dan belum ada peringatan sebelumnya
            if (timeLeft <= warningTime && !warningTriggered) {
                warningTriggered = true;
                
                let confirmExtend = confirm("⚠️ Sesi Anda akan habis dalam 30 detik. Klik OK untuk memperpanjang sesi.");
                
                if (confirmExtend) {
                    extendSession(); 
                } else {
                    setTimeout(() => {
                        alert("🔴 Sesi Anda telah habis. Anda akan dialihkan ke halaman login.");
                        window.location.href = loginUrl;
                    }, warningTime);
                }
            }

            // Jika waktu habis dan tidak diklik, logout
            if (timeLeft <= 0) {
                alert("🔴 Sesi Anda telah habis. Anda akan dialihkan ke halaman login.");
                window.location.href = loginUrl;
            }
        }

        function extendSession() {
            fetch('/session-keep-alive')
                .then(response => response.json())
                .then(data => {
                    if (data.sessionUpdated) {
                        sessionExpiresAt = new Date().getTime() + ({{ config('session.lifetime') * 60 }} * 1000);
                        warningTriggered = false;
                    }
                });
        }

        function keepSessionAlive() {
            if (sessionActive) {
                fetch('/session-keep-alive')
                    .then(response => response.json())
                    .then(data => {
                        if (data.logout) {
                            alert("🔴 Sesi Anda telah habis.");
                            window.location.href = loginUrl;
                        } else {
                            sessionExpiresAt = new Date().getTime() + ({{ config('session.lifetime') * 60 }} * 1000);
                        }
                    });
            }
        }

        // Deteksi aktivitas pengguna untuk memperpanjang sesi
        function resetSessionActivity() {
            sessionActive = true;
        }

        document.addEventListener("mousemove", resetSessionActivity);
        document.addEventListener("keydown", resetSessionActivity);
        document.addEventListener("click", resetSessionActivity);

        // Jalankan pengecekan sesi dan perbarui otomatis
        setInterval(checkSession, 5000); // Cek status sesi setiap 5 detik
        setInterval(keepSessionAlive, 30000); // Perpanjang sesi otomatis jika ada aktivitas setiap 30 detik
    });
  </script>





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

  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
  <script>
    $(document).ready(function(){

        $('#myTable').DataTable();
    })
</script>


</body>

</html>