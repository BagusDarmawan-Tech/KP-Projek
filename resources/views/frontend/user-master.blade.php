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
        @include('frontend.body.nav')
        {{-- Navigasi END --}}

        <!-- Header-->
        @include('frontend.body.header')
        <!-- END Header-->

        <!-- Main-->
        <section class="container-sm border border-dark rounded-top" >
            <!-- Gallery -->
            <div class="row py-lg-5 rounded-top" style="background-color: #a2094e" >
                <h3 class="text-center text-light">PISA</h3>
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
        <!-- END Main-->
        
        <!-- Footer-->
        @include('frontend.body.footer')
        <!-- END Footer-->
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
