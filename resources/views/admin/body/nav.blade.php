<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="{{ route('dashboard') }}" class="logo d-flex align-items-center">
        <img src="{{ asset('logo.png') }}" alt="" >
        {{-- <span class="d-none d-lg-block">SiTalas</span> --}}
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            {{-- <img src="assets/img/profile-img.jpg" alt="" class="rounded-circle"> --}}
            <span class=" dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>{{ Auth::user()->name }}</h6>
              <span>{{ Auth::user()->email }}</span>
              <h6>{{ Auth::user()->roles->first()->name ?? 'No Role' }}
              </h6>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="{{ route('profile.edit') }}"  data-bs-target="#accountSettingsModal">
              <i class="bi bi-gear"></i>
              <span>Account Settings</span>
            </a>
          </li>


            <!-- <li>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li> -->

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.logout') }}">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li>
        <!-- End Profile Nav -->

      </ul>

          <!-- Modal Account Settings -->
          <style>
            /* Tambahkan shadow kustom untuk efek lebih dalam */
            .modal-content {
              /* box-shadow: 0px 20px 100px rgba(0, 0, 0, 0.3); */
              border-radius: 20px;
              background-color:white;
            }

            /* Batasi tinggi modal agar tidak terlalu panjang */
            .modal-body {
              max-height: 70vh;
              overflow-y: auto;
              padding: 20px;
            }

            /* Ubah semua teks dalam modal menjadi hitam */
            .modal-body, .modal-title, .modal-footer, .card {
              color: black;
            }

            /* Posisi tombol show/hide password */
            .password-wrapper {
              position: relative;
            }

            .toggle-password {
              position: absolute;
              right: 10px;
              top: 50%;
              transform: translateY(-50%);
              cursor: pointer;
              background: none;
              border: none;
            }
          </style>

  

          <script>
            function togglePassword(inputId, iconId) {
              var passwordField = document.getElementById(inputId);
              var icon = document.getElementById(iconId);

              if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.classList.remove("bi-eye-slash");
                icon.classList.add("bi-eye");
              } else {
                passwordField.type = "password";
                icon.classList.remove("bi-eye");
                icon.classList.add("bi-eye-slash");
              }
            }

          </script>



    </nav>
  <!-- End Icons Navigation -->
  

  </header>