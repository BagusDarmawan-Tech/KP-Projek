<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Layout</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons for Social Media Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* Custom dropdown submenu CSS */
        .dropdown-menu .dropdown-submenu {
            position: relative;
        }
        .dropdown-menu .dropdown-submenu .dropdown-menu {
            top: 0;
            left: 100%;
            margin-top: -1px;
        }
        .dropdown-submenu:hover > .dropdown-menu {
            display: block;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('assets/logo.png') }}" alt="Logo SITALAS" width="129" height="50">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="/galeri">Galeri</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Forum Anak </a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Forum Anak Kecamatan</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="/skkec">SK Fas Kecamatan</a></li>
                                    <li><a class="dropdown-item" href="/kegiatan-forum-anak-kecamatan">Kegiatan Forum Anak Kecamatan</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Forum Anak Kelurahan</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="/skkel">SK Fas Kelurahan</a></li>
                                    <li><a class="dropdown-item" href="/kegiatan-forum-anak-kelurahan">Kegiatan Forum Anak Kelurahan</a></li>
                                </ul>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="/pemantauananak">Pemantauan Usulan Anak</a></li>
                            <li><a class="dropdown-item" href="/galeri-anak">Galeri Anak</a></li>
                            <li><a class="dropdown-item" href="/kegareksby">Kegiatan Forum Anak Surabaya</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Kecamatan dan Kelurahan Layanan Anak
                        </a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Kegiatan</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="/kegiatan-kecamatan">Kegiatan Kecamatan</a></li>
                                    <li><a class="dropdown-item" href="/kegiatan-kelurahan">Kegiatan Kelurahan</a></li>
                                </ul>
                            </li>
                            <li><a class="dropdown-item" href="/kasrpa">KAS RPA</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            CFCI
                        </a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">SK</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="/skcfcikecamatan">SK Kecamatan</a></li>
                                    <li><a class="dropdown-item" href="/skcfciKelurahan">SK Kelurahan</a></li>
                                </ul>
                            </li>
                            <li><a class="dropdown-item" href="/artikel-kegiatan">Artikel Kegiatan</a></li>
                            <li><a class="dropdown-item" href="/kegiatan-cfci">Kegiatan</a></li>
                            <li><a class="dropdown-item" href="/galeri-cfci">Galeri CFCI</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main content goes here -->
    <div class="container my-4">
        @yield('content') <!-- This is where you include the content of each page -->
    </div>

    <!-- Footer -->
    <footer class="text-center text-lg-start bg-body-tertiary text-muted text-light" style="background: rgb(233, 36, 103)">
        <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
            <div class="me-5 d-none d-lg-block text-light">
                <span>Get connected with us on social networks:</span>
            </div>
            <div class="text-light">
                <a href="#" class="me-4 text-reset">
                    <i class="bi bi-facebook fs-2 text-light"></i>
                </a>
                <a href="#" class="me-4 text-reset">
                    <i class="bi bi-twitter-x fs-2 text-light"></i>
                </a>
                <a href="#" class="me-4 text-reset">
                    <i class="bi bi-tiktok fs-2 text-light"></i>
                </a>
                <a href="#" class="me-4 text-reset">
                    <i class="bi bi-instagram fs-2 text-light"></i>
                </a>
            </div>
        </section>

        <section class="text-light" style="background: rgb(233, 36, 103)">
            <div class="container text-center text-md-start mt-5 text-light">
                <div class="row mt-3">
                    <div class="col-md-3 col-lg-5 col-xl-3 mx-auto mb-4">
                        <div class="row">
                            <div class="col-6"><img class="img-fluid" src="{{ asset('assets/kla-log.png') }}" alt=""></div>
                            <div class="col-6"><img class="img-fluid" src="{{ asset('assets/logo-sby.png') }}" alt=""></div>
                        </div>
                        <p class="text-start lh-1">
                            Kota Layak Anak adalah Kota yang mempunyai 
                            sistem pembangunan berbasis hak anak melalui
                            pengintegrasian komitmen dan sumber daya pemerintah.
                        </p>
                    </div>

                    <div class="col-md-4 col-lg-5 col-xl-3 mx-auto mb-md-0 mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
                        <p><i class="bi bi-geo-alt-fill"></i> Jl. Jimerto No. 25-27, Ketabang, Kec. Genteng, Kota SBY, Jawa Timur 60272</p>
                        <p><i class="bi bi-envelope"></i> info@example.com</p>
                        <p><i class="bi bi-telephone"></i> (031) 5475600</p>
                    </div>
                </div>
            </div>
        </section>

        <div class="text-center p-4 text-light bg-opacity-10 bg-dark">
            © 2025 Copyright
        </div>
    </footer>

    <!-- Bootstrap JS Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
