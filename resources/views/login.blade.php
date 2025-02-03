<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
  <body class="">
    <section class="h-100 gradient-form">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-10">
              <div class="card rounded-3 text-black shadow md-4">
                <div class="row g-0">
                  <div class="col-lg-6">
                    <div class="card-body p-md-5 mx-md-4">
      
                      <div class="text-center">
                        <img src="{{ asset('logo.png') }}"
                          style="width: 185px;" alt="logo">
                        <h4 class="mt-1 mb-5 pb-1">Selamat Datang Admin</h4>
                      </div>
      
                      <form>
      
                        <div data-mdb-input-init class="form-outline mb-4">
                            <label for="floatingInputDisabled">Username</label>
                            <input type="text" class="form-control" id="floatingInputDisabled">
                        </div>
      
                        <div data-mdb-input-init class="form-outline mb-4">
                            <label class="form-label" for="form2Example22">Password</label>
                          <input type="password" id="form2Example22" class="form-control" />
                        </div>

                        <div data-mdb-input-init class="form-outline mb-4">
                            <label class="form-label" for="form2Example22">CAPTA</label>
                          <input type="password" id="form2Example22" class="form-control" />
                        </div>

                        <div class="d-grid gap-2">
                            <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="button">Button</button>
                        </div>
      
                        {{-- <div class="d-flex align-items-center justify-content-center pb-4">
                          <p class="mb-0 me-2">Don't have an account?</p>
                          <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-danger">Create new</button>
                        </div> --}}
      
                      </form>
      
                    </div>
                  </div>
                  <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                    <div class="row text-white px-3 py-4 p-md-5 mx-md-4">
                      <img src="{{ asset('kids-cover.png') }}" alt="" width="220" height="280">
                      <h4 class="mb-4">Silahkan Login untuk mengoperasikan website
                        Kota Layak Anak</h4>
                      <p class="small mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                  </div>
                </div>
                <div class="" height="20">

                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>