<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Si Talas</title>
        <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon"/>
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" >
    </head>
    <body id="page-top">
        <!-- Navigation-->
     <nav class="navbar navbar-expand-lg navbar-light shadow-sm py-4 " id="mainNav">
        <div class="container px-5">
            <a class="navbar-brand" href="#">
                <img src="logo.png" width="119" height="50" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi-list"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto me-4 my-3 my-lg-0">
                    <li class="nav-item"><a class="nav-link me-lg-3" href="#features">Home</a></li>
                    <li class="nav-item"><a class="nav-link me-lg-3" href="#download">Galeri</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Forum Anak
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Pemantauan Usulan Anak</a></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Forum Anak Kecamatan
                                  </a>
                                  <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">SK FAS Kecamatan</a></li>
                                    <li><a class="dropdown-item" href="#">Kegiatan Forum Anak Kecamatan</a></li>
                                    <li><a class="dropdown-item" href="#">Forum Anak Kecamatan</a></li>
                                  </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Kecamatan & Kelurahan Layanan Anak
                          </a>
                          <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Pemantauan Usulan Anak</a></li>
                            <li><a class="dropdown-item" href="#">Galeri Anak</a></li>
                            <li><a class="dropdown-item" href="#">Forum Anak Kecamatan</a></li>
                          </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            CFCI
                          </a>
                          <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Pemantauan Usulan Anak</a></li>
                            <li><a class="dropdown-item" href="#">Galeri Anak</a></li>
                            <li><a class="dropdown-item" href="#">Forum Anak Kecamatan</a></li>
                          </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            PISA
                          </a>
                          <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Pemantauan Usulan Anak</a></li>
                            <li><a class="dropdown-item" href="#">Galeri Anak</a></li>
                            <li><a class="dropdown-item" href="#">Forum Anak Kecamatan</a></li>
                          </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Menu Anyar
                          </a>
                          <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Pemantauan Usulan Anak</a></li>
                            <li><a class="dropdown-item" href="#">Galeri Anak</a></li>
                            <li><a class="dropdown-item" href="#">Forum Anak Kecamatan</a></li>
                          </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link me-lg-3" href="#download">Menu Anyar</a></li>
                    <li class="nav-item"><a class="nav-link me-lg-3" href="#download">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
    {{-- Navigasi END --}}
        <!-- Header-->
        <header class="masthead text-center text-white position-relative">
            <div class="masthead-content">
                <div class="container px-5">
                    <h1 class="masthead-heading mb-0">Kegiatan Kelurahan</h1>
                    <h2 class="masthead-subheading mb-0">Lorem, ipsum dolor sit amet consectetur adipisicing.</h2>
                </div>
            </div>
            <div class="bg-circle-1 bg-circle"></div>
            <div class="bg-circle-2 bg-circle"></div>
            <div class="bg-circle-3 bg-circle"></div>
            <div class="bg-circle-4 bg-circle"></div>
        
            <!-- SVG Wave -->
            <svg class="wave position-absolute bottom-0 start-0 w-100" viewBox="0 0 1440 320" xmlns="http://www.w3.org/2000/svg">
                <path fill="#ffffff" fill-opacity="1"
                    d="M0,288 C120,260,240,232,360,240 C480,248,600,288,720,288 C840,288,960,248,1080,224 C1200,200,1320,208,1440,240 V320 H0 Z">
                </path>
            </svg>            
        </header>
        
        <section class="container-sm border border-dark rounded-top" >
            <!-- Gallery -->
            <div class="row py-lg-5 rounded-top" style="background-color: #a2094e" >
                <h3 class="text-center text-light">Kegiatan Forum Anak Kelurahan</h3>
            </div>
            <div class="row py-3">
                <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                <img
                    src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(73).webp"
                    class="w-100 shadow-1-strong rounded mb-4"
                    alt="Boat on Calm Water"
                />
            
                <img
                    src="https://mdbcdn.b-cdn.net/img/Photos/Vertical/mountain1.webp"
                    class="w-100 shadow-1-strong rounded mb-4"
                    alt="Wintry Mountain Landscape"
                />
                </div>
            
                <div class="col-lg-4 mb-4 mb-lg-0">
                <img
                    src="https://mdbcdn.b-cdn.net/img/Photos/Vertical/mountain2.webp"
                    class="w-100 shadow-1-strong rounded mb-4"
                    alt="Mountains in the Clouds"
                />
            
                <img
                    src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(73).webp"
                    class="w-100 shadow-1-strong rounded mb-4"
                    alt="Boat on Calm Water"
                />
                </div>
            
                <div class="col-lg-4 mb-4 mb-lg-0">
                <img
                    src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(18).webp"
                    class="w-100 shadow-1-strong rounded mb-4"
                    alt="Waves at Sea"
                />
            
                <img
                    src="https://mdbcdn.b-cdn.net/img/Photos/Vertical/mountain3.webp"
                    class="w-100 shadow-1-strong rounded mb-4"
                    alt="Yosemite National Park"
                />
                </div>
            </div>
            <!-- Gallery -->
        </section>
        
        <!-- Footer-->
        <footer class="text-center text-lg-start bg-body-tertiary text-muted text-light" style="background: rgb(233, 36, 103)">
            <!-- Section: Social media -->
            <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
            <!-- Left -->
            <div class="me-5 d-none d-lg-block text-light">
                <span>Get connected with us on social networks:</span>
            </div>
            <!-- Left -->
        
            <!-- Right -->
            <div class="text-light">
                <a href="" class="me-4 text-reset">
                <i class="bi bi-facebook fs-2 text-light"></i>
                </a>
                <a href="" class="me-4 text-reset">
                <i class="bi bi-twitter-x fs-2 text-light"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="bi bi-tiktok fs-2 text-light"></i>
                </a>
                <a href="" class="me-4 text-reset">
                <i class="bi bi-instagram fs-2 text-light"></i>
                </a>
            </div>
            <!-- Right -->
            </section>
            <!-- Section: Social media -->
        
            <!-- Section: Links  -->
            <section class="text-light"   style="background: rgb(233, 36, 103)">
            <div class="container text-center text-md-start mt-5 text-light">
                <!-- Grid row -->
                <div class="row mt-3">
                <!-- Grid column -->
                <div class="col-md-3 col-lg-5 col-xl-3 mx-auto mb-4">
                    <div class="row">
                        {{-- <div class="col-4"><img class="img-fluid" src="{{ asset('logo.png') }}" alt=""></div> --}}
                        <div class="col-6"><img class="img-fluid" src="{{ asset('kla-log.png') }}" alt=""></div>
                        <div class="col-6"><img class="img-fluid" src="{{ asset('logo-sby.png') }}" alt=""></div>
                    </div>
                    <p class="text-start lh-1">
                        Kota Layak Anak adalah Kota yang mempunyai 
                        sistem pembangunan berbasis hak anak melalui
                        pengintegrasian komitmen dan sumber daya pemerintah.
                    </p>
                </div>
                <!-- Grid column -->
        
                <!-- Grid column -->
                {{-- <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">
                    Products
                    </h6>
                    <p>
                    <a href="#!" class="text-reset">Lorem, ipsum.</a>
                    </p>
                    <p>
                    <a href="#!" class="text-reset">Lorem, ipsum.</a>
                    </p>
                    <p>
                    <a href="#!" class="text-reset">Lorem, ipsum.</a>
                    </p>
                    <p>
                    <a href="#!" class="text-reset">Lorem, ipsum.</a>
                    </p>
                </div> --}}
                <!-- Grid column -->
        
                {{-- <!-- Grid column -->
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">
                    Useful links
                    </h6>
                    <p>
                    <a href="#!" class="text-reset">Pricing</a>
                    </p>
                    <p>
                    <a href="#!" class="text-reset">Settings</a>
                    </p>
                    <p>
                    <a href="#!" class="text-reset">Orders</a>
                    </p>
                    <p>
                    <a href="#!" class="text-reset">Help</a>
                    </p>
                </div>
                <!-- Grid column --> --}}
        
                <!-- Grid column -->
                <div class="col-md-4 col-lg-5 col-xl-3 mx-auto mb-md-0 mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
                    <p><i class="bi bi-geo-alt-fill"></i> Jl. Jimerto No. 25-27, Ketabang, Kec. Genteng, Kota SBY, Jawa Timur 60272</p>
                    <p>
                    <i class="bi bi-envelope"></i>
                      info@example.com
                    </p>
                    <p><i class="bi bi-telephone"></i>  (031) 5475600</p>
                </div>
                <!-- Grid column -->
                </div>
                <!-- Grid row -->
            </div>
            </section>
            <!-- Section: Links  -->
        
            <!-- Copyright -->
            <div class="text-center p-4 text-light bg-opacity-10 bg-dark">
            © 2025 Copyright
            </div>
            <!-- Copyright -->
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
