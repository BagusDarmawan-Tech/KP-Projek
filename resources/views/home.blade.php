<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SI TALAS</title>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- CSS Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  </head>

  <nav class="navbar navbar-expand-lg bg-light py-5 bg-dark bg-opacity-10">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active text-" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Galeri</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Forum Anak
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">coba coba</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">CFGI</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Kegiatan Arek Suroboyo</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Dropdown link
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <body>
    <main>
          <div>
            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="datatable-search-input">Search</label>
                <input type="text" class="form-control" id="datatable-search-input" />
            </div>
              <div id="datatable">
              </div>
            <table class="table align-middle mb-0 bg-white">
                <thead class="bg-light">
                  <tr>
                    <th>Name</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Position</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <div class="d-flex align-items-center">
                        <img
                            src="https://mdbootstrap.com/img/new/avatars/8.jpg"
                            alt=""
                            style="width: 45px; height: 45px"
                            class="rounded-circle"
                            />
                        <div class="ms-3">
                          <p class="fw-bold mb-1">John Doe</p>
                          <p class="text-muted mb-0">john.doe@gmail.com</p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="fw-normal mb-1">Software engineer</p>
                      <p class="text-muted mb-0">IT department</p>
                    </td>
                    <td>
                      <span class="badge badge-success rounded-pill d-inline">Active</span>
                    </td>
                    <td>Senior</td>
                    <td>
                      <button type="button" class="btn btn-link btn-sm btn-rounded">
                        Edit
                      </button>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="d-flex align-items-center">
                        <img
                            src="https://mdbootstrap.com/img/new/avatars/6.jpg"
                            class="rounded-circle"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                        <div class="ms-3">
                          <p class="fw-bold mb-1">Alex Ray</p>
                          <p class="text-muted mb-0">alex.ray@gmail.com</p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="fw-normal mb-1">Consultant</p>
                      <p class="text-muted mb-0">Finance</p>
                    </td>
                    <td>
                      <span class="badge badge-primary rounded-pill d-inline"
                            >Onboarding</span
                        >
                    </td>
                    <td>Junior</td>
                    <td>
                      <button
                              type="button"
                              class="btn btn-link btn-rounded btn-sm fw-bold"
                              data-mdb-ripple-color="dark"
                              >
                        Edit
                      </button>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="d-flex align-items-center">
                        <img
                            src="https://mdbootstrap.com/img/new/avatars/7.jpg"
                            class="rounded-circle"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                        <div class="ms-3">
                          <p class="fw-bold mb-1">Kate Hunington</p>
                          <p class="text-muted mb-0">kate.hunington@gmail.com</p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="fw-normal mb-1">Designer</p>
                      <p class="text-muted mb-0">UI/UX</p>
                    </td>
                    <td>
                      <span class="badge badge-warning rounded-pill d-inline">Awaiting</span>
                    </td>
                    <td>Senior</td>
                    <td>
                      <button
                              type="button"
                              class="btn btn-link btn-rounded btn-sm fw-bold"
                              data-mdb-ripple-color="dark"
                              >
                        Edit
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
          </div>
          
    </main>
        <!-- Footer -->
    <footer class="text-center text-lg-start bg-body-tertiary text-muted bg-dark text-light">
        <!-- Section: Social media -->
        <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
        <!-- Left -->
        <div class="me-5 d-none d-lg-block">
            <span>Get connected with us on social networks:</span>
        </div>
        <!-- Left -->
    
        <!-- Right -->
        <div>
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
            <a href="" class="me-4 text-reset text-light">
            <i class="fab fa-linkedin"></i>
            </a>
            <a href="" class="me-4 text-reset text-light">
            <i class="fab fa-github"></i>
            </a>
        </div>
        <!-- Right -->
        </section>
        <!-- Section: Social media -->
    
        <!-- Section: Links  -->
        <section class="">
        <div class="container text-center text-md-start mt-5 bg-dark text-light">
            <!-- Grid row -->
            <div class="row mt-3">
            <!-- Grid column -->
            <div class="col-md-3 col-lg-5 col-xl-3 mx-auto mb-4">
                <!-- Content -->
                <h6 class="text-uppercase fw-bold mb-4">
                Si TALAS
                </h6>
                <div class="row">
                    {{-- <div class="col-4"><img class="img-fluid" src="{{ asset('logo.png') }}" alt=""></div> --}}
                    <div class="col-4"><img class="img-fluid" src="{{ asset('kla-log.png') }}" alt=""></div>
                    <div class="col-4"><img class="img-fluid" src="{{ asset('logo-sby.png') }}" alt=""></div>
                    <div class="col-4"><img class="img-fluid" src="{{ asset('favicon.png') }}" alt=""></div>

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
  <!-- Footer -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>
