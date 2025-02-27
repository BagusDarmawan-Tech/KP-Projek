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

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->
        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            {{-- <img src="assets/img/profile-img.jpg" alt="" class="rounded-circle"> --}}
            <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
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

          <div class="modal fade shadow-none p-3 mb-5 bg-light bg-opacity-50" id="accountSettingsModal" data-bs-backdrop="false" tabindex="-1">
              <div class="modal-dialog modal-lg modal-dialog-centered ">
              <div class="modal-content shadow-lg">
                
                <!-- Modal Header -->
                <div class="modal-header text-white">
                  <h5 class="modal-title" id="accountSettingsModalLabel">Profile</h5>
                  <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body text-dark">
  
                  <!-- Profile Information -->
                  <div class="card p-3 mb-3 border border-primary shadow-sm">
                    <h3 class="text-dark">Profile Information</h3>
                    <p>Update your account's profile information and email address.</p>
                    
                    <form method="POST" action="{{ route('profile.update') }}">
                      @csrf
                      @method('patch')
                      
                      <label class="form-label" for="name" :value="__('Name')">Nama</label>
                      <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}">
                
                      <label class="form-label mt-2">Email</label>
                      <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}">
                
                      <button type="submit" class="btn btn-primary mt-3 w-100">Save</button>
                    </form>
                  </div>
                
                  <!-- Update Password -->
                  <div class="card p-3 mb-3 border border-primary shadow-sm">
                    <h3 class="text-dark">Update Password</h3>
                    <p>Ensure your account is using a long, random password to stay secure.</p>
                    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                      @csrf
                  </form>
                    <form method="POST" action="">
                      @csrf
                      @method('PUT')
                
                      <label class="form-label">Current Password</label>
                      <input type="password" name="current_password" class="form-control">
                
                      <label class="form-label mt-2">New Password</label>
                      <input type="password" name="password" class="form-control">
                
                      <label class="form-label mt-2">Confirm Password</label>
                      <input type="password" name="password_confirmation" class="form-control">
                
                      <button type="submit" class="btn btn-primary mt-3 w-100">Save</button>
                    </form>
                  </div>
                
                  <!-- Delete Account -->
                  <div class="card p-3 border border-primary shadow-sm">
                    <h3 class="text-dark">Delete Account</h3>
                    <p>Once your account is deleted, all of its resources and data will be permanently deleted.</p>
                    
                    <form method="POST" action="">
                      @csrf
                      @method('DELETE')
                      
                      <button type="submit" class="btn btn-danger w-100" 
                        onclick="return confirm('Are you sure you want to delete your account? This action cannot be undone.')">
                        Delete Account
                      </button>
                    </form>
                  </div>
                
                </div>
                

                <!-- Modal Footer -->


              </div>
            </div>
          </div>

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