<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
      

                      <!-- Form Login-->
                      <form method="POST" action="{{ route('login') }}">
                        @if ($errors->has('email'))
                            <p class="text-sm text-danger">{{ $errors->first('email') }}</p>
                        @endif
                        @csrf
                        <div data-mdb-input-init class="form-outline mb-4">
                            <label for="floatingInputDisabled" :value="__('Email')" class=" ">Email</label>
                            <input id="email" class="form-control border border-dark" type="email" name="email" :value="old('email')" required autofocus autocomplete="username">
                        </div>
      
                        <div data-mdb-input-init class="form-outline mb-4">
                            <labelfor="password" :value="__('Password')" class=" ">Password</labelfor=>
                          <input id="password" class="form-control border border-dark"
                          type="password"
                          name="password"
                          required autocomplete="current-password" />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />

                        <div>
                            <label for="captcha" class="">Masukkan Kode Validasi</label>
                            @error('captcha')
                                <p style="color: red;">{{ $message }}</p>
                            @enderror
                            <div class="d-flex align-items-center gap-2">
                              <img src="{{ captcha_src() }}" alt="captcha" id="captcha-img" class="img-fluid rounded mb-1">
                              <button type="button" onclick="refreshCaptcha()"><i class="bi bi-arrow-clockwise"></i></button>
                          </div>
                          
                            <input type="text" name="captcha" class="border border-dark form-control w-50 mb-4">
                    
                        </div>

                        <div class="d-grid gap-2 text-center">
                          <x-primary-button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3">
                              {{ __('Log in') }}        
                              <i class="bi bi-box-arrow-in-right"></i>

                          </x-primary-button>
                          <a href="{{ route('password.request') }}" class="text-dark text-decoration-none" style="color: black !important;">Lupa Password</a>
                        </div> 
      
                        {{-- <div class="d-flex align-items-center justify-content-center pb-4">
                          <p class="mb-0 me-2">Don't have an account?</p>
                          <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-danger">Create new</button>
                        </div> --}}
      
                      </form>
                      <!-- END Form Login-->
                    </div>
                  </div>
                  <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                    <div class="row text-white px-3 py-4 p-md-5 mx-md-4">
                      <img src="{{ asset('kids-cover.png') }}" alt="" width="220" height="280">
                      <h4 class="mb-4 text-center">Silahkan Login untuk Mengoperasikan website
                        Kota Layak Anak</h4>
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
      <script>
        function refreshCaptcha() {
            document.getElementById('captcha-img').src = "/captcha/default?" + Date.now();
        }
    </script>
    
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>