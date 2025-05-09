<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('dashboard') ? '' : 'collapsed' }}" href="{{route('dashboard')}}">
        <i class="bi bi-grid"></i> 
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->


    {{-- CONFIG --}}
    @if (auth()->user()->hasAnyPermission(['configurasi app-list', 'user management-list', 'role management-list']))
    <li class="nav-item {{ request()->is('config/*') ? 'active' : '' }}">
      <a class="nav-link {{ request()->is('config/*') ? '' : 'collapsed' }}" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-gear-wide"></i><span>Config</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="components-nav" class="nav-content collapse {{ request()->is('config/*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
        
        @if (auth()->user()->hasPermissionTo('user management-list'))
        <li>
          <a class= "{{ request()->routeIs('UserManagement') ? 'active' : '' }}" href="{{route('UserManagement')}}">
            <i class="bi bi-circle"></i><span>Users Management</span>
          </a>
        </li>
        @endif
        
        @if (auth()->user()->hasPermissionTo('role management-list'))
        <li>
          <a class= "{{ request()->routeIs('HalamanRole') ? 'active' : '' }}" href="{{route('HalamanRole')}}">
            <i class="bi bi-circle"></i><span>Role Management</span>
          </a>
        </li>
        @endif

        @if (auth()->user()->hasPermissionTo('configurasi app-list'))
        <li>
          <a class= "{{ request()->routeIs('HalamanConfigurasi') ? 'active' : '' }}" href="{{route('HalamanConfigurasi')}}">
            <i class="bi bi-circle"></i><span>Configurasi App</span>
          </a>
        </li>
        @endif

        <!-- <li>
          <a class= "{{ request()->routeIs('components-breadcrumbs.html') ? 'active' : '' }}" href="components-breadcrumbs.html">
            <i class="bi bi-circle"></i><span>Module Management</span>
          </a>
        </li> -->
        <!-- <li>
          <a class= "{{ request()->routeIs('components-buttons.html') ? 'active' : '' }}" href="components-buttons.html">
            <i class="bi bi-circle"></i><span>Menu Management</span>
          </a>
        </li> -->
      </ul>
    </li><!-- End Components Nav -->
    @endif
    {{-- END CONFIG --}}

    {{-- WEB MANAGEMENT --}}
    @if (auth()->user()->hasAnyPermission(['artikel-list', 'kategori artikel-list','slider-list','klaster-list','sub kegiatan-list','galeri-list','forum anak-list','halaman-list','pemantauan usulan-list','surat-list','opd-list']))
    <li class="nav-item {{ request()->is('web-management/*') ? 'active' : '' }}">
      <a class="nav-link {{ request()->is('web-management/*') ? '' : 'collapsed' }}" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-keyboard"></i><span>Web Management</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="forms-nav" class="nav-content collapse {{ request()->is('web-management/*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">

        @if (auth()->user()->hasPermissionTo('artikel-list'))
        <li>
          <a class="{{ request()->routeIs('Artikel') ? 'active' : '' }}" href="{{route('Artikel')}}">
            <i class="bi bi-circle"></i><span>Artikel</span>
          </a>
        </li>
        @endif

        @if (auth()->user()->hasPermissionTo('kategori artikel-list'))
        <li>
          <a class="{{ request()->routeIs('kategoriArtikel') ? 'active' : '' }}" href="{{route('kategoriArtikel')}}">
            <i class="bi bi-circle"></i><span>Kategori Artikel</span>
          </a>
        </li>
        @endif

        @if (auth()->user()->hasPermissionTo('slider-list'))
        <li>
          <a class="{{ request()->routeIs('slider') ? 'active' : '' }}" href="{{route('slider')}}">
            <i class="bi bi-circle"></i><span >Slider</span>
          </a>
        </li>
        @endif

        @if (auth()->user()->hasPermissionTo('klaster-list'))
        <li>
          <a class="{{ request()->routeIs('Klaster') ? 'active' : '' }}"href="{{route('Klaster')}}">
            <i class="bi bi-circle"></i><span>Klaster</span>
          </a>
        </li>
        @endif

        @if (auth()->user()->hasPermissionTo('sub kegiatan-list'))
        <li>
          <a class="{{ request()->routeIs('sub-kegiatan') ? 'active' : '' }}"href="{{route('sub-kegiatan')}}">
            <i class="bi bi-circle"></i><span>Sub Kegiatan</span>
          </a>
        </li>
        @endif

        @if (auth()->user()->hasPermissionTo('galeri-list'))
        <li>
          <a class="{{ request()->routeIs('galeri') ? 'active' : '' }}"href="{{route('galeri')}}">
            <i class="bi bi-circle"></i><span>Galleri</span>
          </a>
        </li>
        @endif

        {{-- @if (auth()->user()->hasPermissionTo('forum anak-list'))
        <li>
          <a class="{{ request()->routeIs('forum-anak') ? 'active' : '' }}" href="{{route('forum-anak')}}">
            <i class="bi bi-circle"></i><span class="text-danger">Forum Anak</span>
          </a>
        </li>
        @endif --}}

        {{-- @if (auth()->user()->hasPermissionTo('halaman-list'))
        <li>
          <a class="{{ request()->routeIs('Halamandong') ? 'active' : '' }}" href="{{route('Halamandong')}}">
            <i class="bi bi-circle"></i><span class="text-danger">Halaman </span>
          </a>
        </li>
        @endif --}}

        {{-- @if (auth()->user()->hasPermissionTo('pemantauan usulan-list'))
        <li>
          <a class="{{ request()->routeIs('PemantauanUsulanAnak') ? 'active' : '' }}" href="{{route('PemantauanUsulanAnak')}}">
            <i class="bi bi-circle"></i><spa class="text-danger">Pemantauan Usulan </spa>
          </a>
        </li>
        @endif --}}

        @if (auth()->user()->hasPermissionTo('opd-list'))
        <li>
          <a class="{{ request()->routeIs('opd') ? 'active' : '' }}" href="{{route('opd')}}">
            <i class="bi bi-circle"></i><span>OPD</span>
          </a>
        </li>
        @endif

        @if (auth()->user()->hasPermissionTo('surat-list'))
        <li>
          <a class="{{ request()->routeIs('suratJenis') ? 'active' : '' }}" href="{{route('suratJenis')}}">
            <i class="bi bi-circle"></i><span>Surat Jenis</span>
          </a>
        </li>
        @endif
      </ul>
    </li><!-- End Forms Nav -->
  @endif
    {{-- END WEB MANAGEMENT --}}

    {{-- KECAMATAN --}}
    @if (auth()->user()->hasAnyPermission(['kegiatan kecamatan-list','dokumen kecamatan-list']))
    <li class="nav-item {{ request()->is('Kecamatan-Layak-Anak/*') ? 'active' : '' }}">
      <a class="nav-link {{ request()->is('Kecamatan-Layak-Anak/*') ? '' : 'collapsed' }}" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-house-gear-fill"></i><span>Kecamatan Layak Anak</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="tables-nav" class="nav-content collapse {{ request()->is('Kecamatan-Layak-Anak/*') ? 'show' : '' }} " data-bs-parent="#sidebar-nav">
        @if (auth()->user()->hasPermissionTo('dokumen kecamatan-list'))
        <li>
          <a class="{{ request()->routeIs('dokumen-kec') ? 'active' : '' }}" href="{{route('dokumen-kec')}}">
            <i class="bi bi-circle"></i><span>Dokumen Kecamatan</span>
          </a>
        </li>
        @endif

        @if (auth()->user()->hasPermissionTo('kegiatan kecamatan-list'))
        <li>
          <a class="{{ request()->routeIs('kegiatan-kecamatan') ? 'active' : '' }}" href="{{route('kegiatan-kecamatan')}}">
            <i class="bi bi-circle"></i><span>Kegiatan Kecamatan</span>
          </a>
        </li>
        @endif
      </ul>
    </li><!-- End Tables Nav -->
    @endif
    {{-- END KECAMATAN --}}

    {{-- KELURAHAN --}}
    @if (auth()->user()->hasAnyPermission(['dokumen kelurahan-list' ,'kegiatan kelurahan-list']))
    <li class="nav-item {{ request()->is('Kelurahan-Layak-Anak/*') ? 'active' : '' }}">
      <a class="nav-link {{ request()->is('Kelurahan-Layak-Anak/*') ? '' : 'collapsed' }}" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-house-gear-fill"></i><span>Kelurahan Layak Anak</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="charts-nav" class="nav-content collapse {{ request()->is('Kelurahan-Layak-Anak/*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
        @if (auth()->user()->hasPermissionTo('dokumen kelurahan-list'))
        <li>
          <a class="{{ request()->routeIs('HalamanDokument') ? 'active' : '' }}" href="{{route('HalamanDokument')}}">
            <i class="bi bi-circle"></i><span>Dokumen Kelurahan</span>
          </a>
        </li>
        @endif

        @if (auth()->user()->hasPermissionTo('kegiatan kelurahan-list'))
        <li>
          <a class="{{ request()->routeIs('Kegiatankelurahan') ? 'active' : '' }}" href="{{route('Kegiatankelurahan')}}">
            <i class="bi bi-circle"></i><span>Kegiatan Kelurahan</span>
          </a>
        </li>
        @endif
      </ul>
    </li><!-- End Charts Nav -->
    @endif
    {{-- END KELURAHAN --}}
     
    {{-- MITRA --}}
    @if (auth()->user()->hasAnyPermission('kegiatan mitra anak-list','cfci-list','artikel anak-list'))
    <li class="nav-item {{ request()->is('Mitra-Anak/*') ? 'active' : '' }}">
      <a class="nav-link {{ request()->is('Mitra-Anak/*') ? '' : 'collapsed' }}" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-palette"></i><span>Mitra Anak</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="icons-nav" class="nav-content collapse {{ request()->is('Mitra-Anak/*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
        @if (auth()->user()->hasPermissionTo('cfci-list'))
        <li>
          <a class="{{ request()->routeIs('kegiatan-cfci') ? 'active' : '' }}" href="{{route('kegiatan-cfci')}}">
            <i class="bi bi-circle"></i><span>Kegiatan CFCI</span>
          </a>
        </li>
        @endif

        @if (auth()->user()->hasPermissionTo('artikel anak-list'))
        <li>
          <a class="{{ request()->routeIs('artikel-mitraanak') ? 'active' : '' }}" href="{{route('artikel-mitraanak')}}">
            <i class="bi bi-circle"></i><span>Artikel Anak</span>
          </a>
        </li>
        @endif

        @if (auth()->user()->hasPermissionTo('kegiatan mitra anak-list'))
        <li>
          <a class="{{ request()->routeIs('kegiatan-mitra') ? 'active' : '' }}" href="{{route('kegiatan-mitra')}}">
            <i class="bi bi-circle"></i><span>Kegiatan Mitra Anak</span>
          </a>
        </li>
        @endif

      </ul>
    </li><!-- End Icons Nav -->
    @endif
    {{-- END MITRA --}}

    {{-- PUSAT INFORMASI SAHABAT --}}
    @if (auth()->user()->hasAnyPermission(['dokumen pisa-list','kegiatan pisa-list']))
    <li class="nav-item {{ request()->is('Pusat-Informasi-Sahabat-Anak/*') ? 'active' : '' }}">
      <a class="nav-link {{ request()->is('Pusat-Informasi-Sahabat-Anak/*') ? '' : 'collapsed' }}" data-bs-target="#icons" data-bs-toggle="collapse" href="#">
        <i class="bi bi-info-circle"></i><span>Pusat Informasi Sahabat Anak</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="icons" class="nav-content collapse {{ request()->is('Pusat-Informasi-Sahabat-Anak/*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
       
        @if (auth()->user()->hasPermissionTo('dokumen pisa-list'))
        <li>
          <a class="{{ request()->routeIs('DokumenLayakAnak') ? 'active' : '' }}" href="{{route('DokumenLayakAnak')}}">
            <i class="bi bi-circle"></i><span>Dokumen PISA</span>
          </a>
        </li>
        @endif

        @if (auth()->user()->hasPermissionTo('kegiatan pisa-list'))
        <li>
          <a class="{{ request()->routeIs('KegiatanLayakanak') ? 'active' : '' }}" href="{{route('KegiatanLayakanak')}}">
            <i class="bi bi-circle"></i><span>Kegiatan PISA</span>
          </a>
        </li>
        @endif
      </ul>
    </li><!-- End Icons Nav -->
    @endif
    {{--END PUSAT INFORMASI SAHABAT --}}

    {{-- KEGIATAN AREK SUROBOYO --}}
    @if (auth()->user()->hasPermissionTo('kegiatan arek suroboyo-list'))
    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('kegiatan-arek') ? '' : 'collapsed' }}" href="{{ route('kegiatan-arek') }}">
        <i class="bi bi-journal-text"></i>
        <span>Kegiatan Arek Suroboyo</span>
      </a>
    </li>
    @endif
    {{-- END KEGIATAN AREK SUROBOYO --}}

    {{-- FORUM ANAK SUROBOYO --}}
    @if (auth()->user()->hasPermissionTo('kegiatan forum anak suroboyo-list'))
    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('KegiatanForumSurabaya') ? '' : 'collapsed' }}" href="{{ route('KegiatanForumSurabaya') }}">
        <i class="bi bi-journal-text"></i>
        <span>Kegiatan Forum Anak Surabaya</span>
      </a>
    </li>
    @endif
    {{-- END FORUM ANAK SUROBOYO --}}

    {{-- PEMANTAUAN SUARA --}}
    @if (auth()->user()->hasAnyPermission(['pemantauan suara anak-list','karya-list']))
    <li class="nav-item {{ request()->is('Usulan-Kegiatan/*') ? 'active' : '' }}">
      <a class="nav-link {{ request()->is('Usulan-Kegiatan/*') ? '' : 'collapsed' }}" data-bs-target="#usulan-kegiatan" data-bs-toggle="collapse" href="#">
        <i class="bi bi-gem"></i><span>Usulan Kegiatan</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="usulan-kegiatan" class="nav-content collapse {{ request()->is('Usulan-Kegiatan/*') ? 'show' : '' }} " data-bs-parent="#sidebar-nav">
        @if (auth()->user()->hasPermissionTo('pemantauan suara anak-list'))
        <li>
          <a class="{{ request()->routeIs('pemantauan-suara') ? 'active' : '' }}"href="{{route('pemantauan-suara')}}">
            <i class="bi bi-circle"></i><span>Pemantauan Suara Anak</span>
          </a>
        </li>
        <li>
        @endif
        @if (auth()->user()->hasPermissionTo('karya-list'))
          <a class="{{ request()->routeIs('karya-anak') ? 'active' : '' }}"href="{{route('karya-anak')}}">
            <i class="bi bi-circle"></i><span>Karya</span>
          </a>
        </li>
        @endif
      </ul>
    </li><!-- End Icons Nav -->
    @endif
    {{-- END PEMANTAUAN SUARA --}}
  <script>
document.addEventListener("DOMContentLoaded", function () {
    let sidebarNav = document.querySelector("#sidebar-nav");

    // Ambil semua menu yang memiliki submenu
    let menuWithSubmenu = sidebarNav.querySelectorAll("a[data-bs-toggle='collapse']");

    menuWithSubmenu.forEach(submenu => {
        let target = document.querySelector(submenu.getAttribute("data-bs-target"));
        let collapseInstance = new bootstrap.Collapse(target, { toggle: false });

        // Jika submenu memiliki halaman aktif, maka buka secara default
        let isActive = target.querySelector(".active") !== null;
        if (isActive) {
            collapseInstance.show();
        }

        // Tambahkan event listener untuk toggle submenu saat diklik
        submenu.addEventListener("click", function (event) {
            event.preventDefault(); // Mencegah reload jika tombol adalah link

            if (target.classList.contains("show")) {
                collapseInstance.hide();
            } else {
                collapseInstance.show();
            }

        });
    });
});
</script>
</aside>

<!-- Modal Structure -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="logoutModalLabel">Konfirmasi keluar</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin untuk keluar Halaman?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
        <a href="{{ route('admin.logout') }}" class="btn btn-danger">Keluar</a>
      </div>
    </div>
  </div>
</div>



