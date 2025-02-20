@extends('admin.admin-master')

@section('main')

<link href="{{ asset('assets/css/tabel.css') }}" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container mt-5">
    <div class="card shadow-lg border-0 position-relative overflow-hidden mb-4 p-3">
        <div class="card-body">
            <h4 class="fw-bold mb-3 text-center">Kegiatan Mitra Anak</h4>
            <div class="row">
                <div class="col-md-6 ">
                    <label for="userEntri" class="form-label">User Entri</label>
                    <select id="userEntri" class="form-select">
                        <option selected disabled>--- Pilih User Entri ---</option>
                        @php
                            $users = [
                                'dispusip_kla' => 'DISPUSIP KLA',
                                'dp3a' => 'DP3A',
                                'ihsan' => 'Ihsan',
                                'kecamatan_asemrowo' => 'Kecamatan Asemrowo',
                                'kecamatan_benowo' => 'Kecamatan Benowo',
                                'kecamatan_bubutan' => 'Kecamatan Bubutan',
                                'kecamatan_bulak' => 'Kecamatan Bulak',
                                'kecamatan_dukuh_pakis' => 'Kecamatan Dukuh Pakis',
                                'kecamatan_gayungan' => 'Kecamatan Gayungan',
                                'kecamatan_genteng' => 'Kecamatan Genteng',
                                'kecamatan_gubeng' => 'Kecamatan Gubeng',
                                'kecamatan_gunung_anyar' => 'Kecamatan Gunung Anyar',
                                'kecamatan_jambangan' => 'Kecamatan Jambangan',
                                'kecamatan_karang_pilang' => 'Kecamatan Karang Pilang',
                                'kecamatan_kenjeran' => 'Kecamatan Kenjeran',
                                'kecamatan_krembangan' => 'Kecamatan Krembangan',
                                'kecamatan_lakarsantri' => 'Kecamatan Lakarsantri',
                                'kecamatan_mulyorejo' => 'Kecamatan Mulyorejo',
                                'kecamatan_pabean_cantian' => 'Kecamatan Pabean Cantian',
                                'kecamatan_pakal' => 'Kecamatan Pakal',
                                'kecamatan_sambikerep' => 'Kecamatan Sambikerep',
                                'kecamatan_sawahan' => 'Kecamatan Sawahan',
                                'kecamatan_semampir' => 'Kecamatan Semampir',
                                'kecamatan_simokerto' => 'Kecamatan Simokerto',
                                'kecamatan_sukolilo' => 'Kecamatan Sukolilo',
                                'kecamatan_sukomanunggal' => 'Kecamatan Sukomanunggal',
                                'kecamatan_tambaksari' => 'Kecamatan Tambaksari',
                                'kecamatan_tandes' => 'Kecamatan Tandes',
                                'kecamatan_tegalsari' => 'Kecamatan Tegalsari',
                                'kecamatan_tenggilis_mejoyo' => 'Kecamatan Tenggilis Mejoyo',
                                'kecamatan_wiyung' => 'Kecamatan Wiyung',
                                'kecamatan_wonocolo' => 'Kecamatan Wonocolo',
                                'kecamatan_wonokromo' => 'Kecamatan Wonokromo'
                            ];
                        @endphp
                        @foreach($users as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-6">
                    <button class="btn btn-primary" id="btnCari" style="width: 150px;">
                        <i class="bi bi-search"></i> Cari
                    </button>
                </div>
            </div>
            </div>
        </div>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if(session('success'))
    <div class="alert alert-success">
        <ul>
                <li>{{ session('success') }}</li>
        </ul>
    </div>
    @endif
    <div class="card shadow-lg border-0 position-relative overflow-hidden p-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <!-- <h5 class="fw-bold">Daftar Dokumen</h5> -->
                 <br>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahKegiatan">
                    <i class="bi bi-plus"></i> Kegiatan Mitra Anak
                </button>
            </div>
            <div class="table-responsive">
          <table class="table table-hover table-bordered align-middle text-center">
                    <thead class="table-primary">

                       <!-- Kontrol Tampilkan & Cari -->
            <div class="row mb-3 align-items-center">
                <div class="col-md-6">
                    <label for="showEntries" class="form-label me-2">Show</label>
                    <select id="showEntries" class="form-select form-select-sm d-inline-block" style="width: 80px;">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    entries
                </div>
                <div class="col-md-6 text-end">
                    <input type="text" id="searchInput" class="form-control form-control-sm d-inline-block" placeholder="Search..." style="width: 200px;">
                </div>
            </div>
            
            <!-- Tombol Tambah Artikel di atas -->           
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Detail</th>
                            <th class="text-center">Dibuat Oleh</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($mitras as $index => $mitra)
                      <tr>
                          <td style="text-align: center;">{{ $loop->iteration }}</td>
                            <!-- <td>
                                <img src="{{ asset($mitra->gambar) }}" alt="Gambar" style="width: 50px; height: 50px; object-fit: cover;">
                            </td> -->
                            <td>{{ $mitra->nama }}</td>

                            <td>
                                <a href="#" 
                                class="lihat-keterangan" 
                                data-bs-toggle="modal" 
                                data-bs-target="#keteranganModal"
                                data-caption="{{ $mitra->caption }}" 
                                data-deskripsi="{{ $mitra->deskripsi }}"
                                data-gambar="{{ asset($mitra->gambar) }}">Lihat Detail</a>
                            </td>


                            <!-- <td>{{ $mitra->deskripsi }}</td> -->
                            <td>{{ $mitra->dibuatOleh }}</td>
                            <td>
                              @if($mitra->is_active == 0)
                              <span class="badge bg-warning">Non Aktif</span>
                              @else
                                  <span class="badge bg-success">Aktif</span>
                              @endif
                            </td>
                            <td>
                              <button class="btn btn-sm btn-primary edit-mitra"
                                data-bs-toggle="modal" 
                                data-bs-target="#editArtikelModal" 
                                data-id="{{ $mitra->id }}"
                                data-nama="{{ $mitra->nama }}"
                                data-deskripsi="{{ $mitra->deskripsi }}"
                                data-caption="{{ $mitra->caption }}"
                                data-gambar="{{ asset($mitra->gambar) }}"
                                data-status="{{ $mitra->is_active }}">
                                <i class="bi bi-pencil-square"></i>
                              </button>
                                <!-- Button Delete Modal -->
                              <button class="btn btn-sm btn-danger delete-btn" 
                                    data-id  ="{{ $mitra->id }}"
                                    data-nama ="{{ $mitra->nama }}"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteMenuModal"><i class="bi bi-trash"></i>
                             </button>
                            </td>
                        </tr>                            
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Dokumen Kelurahan -->
<div class="modal fade" id="modalTambahKegiatan" tabindex="-1" aria-labelledby="modalTambahKegiatanLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header d-flex flex-column align-items-center">
        <h5 class="modal-title fw-bold text-center mb-0" id="modalTambahKegiatanLabel">Tambah Kegiatan Mitra Anak Baru</h5>
        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('createKegiatanMitraAnak') }}" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
            <label for="namaKegiatan" class="form-label fw-semibold">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama kegiatan">
          </div>
          <div class="mb-3">
            <label for="keteranganKegiatan" class="form-label fw-semibold">Deskripsi</label>
            <textarea class="form-control" id="keteranganKegiatan" rows="3" name="deskripsi" placeholder="Tambahkan keterangan kegiatan"></textarea>
          </div>
          <div class="mb-3">
            <label for="keteranganKegiatan" class="form-label fw-semibold">Caption</label>
            <textarea class="form-control" id="keteranganKegiatan" rows="3" name="caption" placeholder="Tambahkan keterangan kegiatan"></textarea>
          </div>
          <div class="mb-3">
            <label for="gambarKegiatan" class="form-label fw-semibold">Gambar</label>
            <input type="file" class="form-control" name="gambar" id="gambarKegiatan" accept="image/*" onchange="previewImage(event)">
            <img id="preview" src="#" alt="Preview" class="img-fluid mt-2 d-none" style="max-height: 200px;">
          </div>
          <div class="mb-3">
            <label class="form-label">Status</label>
            <select class="form-select" name="is_active" required>
                <option value="1">Aktif</option>
                <option value="0">Non-Aktif</option>
            </select>
        </div>
        </div>
        <input type="hidden" name="dibuatOleh" value="{{ Auth::user()->name }}">
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
    </div>
  </div>
</div>
</div>

<!-- Modal Edit Artikel -->
<div class="modal fade" id="editArtikelModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header d-flex justify-content-center w-100 ">
              <h5 class="modal-title fw-bold text-center">Edit Artikel</h5>
              <!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
          </div>
          <div class="modal-body">
              <form id="editFormMitra" method="POST" action="" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <input type="hidden" id="editId" name="id">

                  <div class="mb-3">
                      <label for="editJudul" class="form-label">Nama</label>
                      <input type="text" class="form-control" id="editNamaKegiatan" name="nama" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea class="form-control" name="deskripsi" id="editDeskripsi" name="deskripsi" required></textarea>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Caption</label>
                    <textarea class="form-control" name="caption" id="editCaption" name="caption" required></textarea>
                  </div>
                  <div class="mb-3">
                      <label for="editGambar" class="form-label">Gambar</label>
                      <div class="mb-2">
                          <img id="previewGambar" src="#" alt="Preview Gambar" class="img-thumbnail" width="100">
                      </div>
                      <input type="file" class="form-control" id="editGambar" name="gambar">
                      <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
                  </div>
                  <div class="mb-3">
                      <label class="form-label">Status</label>
                      <select class="form-select" id="editStatus" name="is_active" required>
                          <option value="1">Aktif</option>
                          <option value="0">Non-Aktif</option>
                      </select>
                  </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                      <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>


<!-- Modal Delete Menu -->
<div class="modal fade" id="deleteMenuModal" tabindex="-1" aria-labelledby="deleteMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteMenuModalLabel">Hapus Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <input type="hidden" id="deleteId" name="id">
                    <p>Apakah Anda yakin ingin menghapus record<br> <strong id="deleteNama"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal detail -->
<div class="modal fade" id="keteranganModal" tabindex="-1" aria-labelledby="keteranganModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Header Modal -->
            <div class="modal-header d-flex justify-content-center">
                <h5 class="modal-title fw-bold w-100 text-center" id="keteranganModalLabel">Detail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Body Modal -->
            <div class="modal-body">
                <div class="row g-4 align-items-center">
                    <!-- Gambar -->
                    <div class="col-md-5">
                        <img id="modalGambar" src="" alt="Gambar" class="img-fluid rounded" style="max-height: 300px; object-fit: contain;">
                    </div>

                    <!-- Caption dan Deskripsi -->
                    <div class="col-md-7">
                        <div>
                            <p id="modalCaption" style="text-align: justify; font-size: 0.95rem; color: black;"></p>
                            <p id="modalDeskripsi" style="text-align: justify; font-size: 0.95rem; color: black;"></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Modal -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>



<script>
  document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".edit-mitra").forEach(button => {
      button.addEventListener("click", function () {
        let id = this.getAttribute("data-id");
        let nama = this.getAttribute("data-nama");
        let deskripsi = this.getAttribute("data-deskripsi");
        let gambar = this.getAttribute("data-gambar");
        let status = this.getAttribute("data-status");
        let caption = this.getAttribute("data-caption");

        // Set nilai form dalam modal
        document.getElementById("editNamaKegiatan").value = nama;
        document.getElementById("editDeskripsi").value = deskripsi;
        document.getElementById("editStatus").value = status;
        document.getElementById("editCaption").value = caption;

        // Set preview gambar
        document.getElementById("previewGambar").src = gambar;
        document.getElementById("previewGambar").classList.remove("d-none");

        // Set action form ke URL update yang sesuai
        document.getElementById("editFormMitra").action = `/kegiatanMitra/update/${id}`;
      });
    });
  });
</script>

  <!-- Script Delete Data ke Modal -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".delete-btn").forEach(button => {
            button.addEventListener("click", function() {
                let id = this.getAttribute("data-id");
                let nama = this.getAttribute("data-nama");
                document.getElementById("deleteId").value = id;
                document.getElementById("deleteNama").textContent = nama; // Tampilkan nama di modal
                // Set action form agar mengarah ke endpoint delete yang benar
                document.getElementById("deleteForm").action = `/kegiatanMitra/hapus/${id}`;
            });
        });
    });
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Pilih semua tombol dengan class "lihat-keterangan"
    document.querySelectorAll(".lihat-keterangan").forEach(button => {
        button.addEventListener("click", function () {
            // Ambil data dari atribut elemen tombol
            let caption = this.getAttribute("data-caption");
            let deskripsi = this.getAttribute("data-deskripsi");
            let gambar = this.getAttribute("data-gambar");

            // Tetapkan data ke elemen dalam modal
            document.getElementById("modalCaption").innerHTML = `<strong>Caption:</strong><br>${caption}`;
            document.getElementById("modalDeskripsi").innerHTML = `<strong>Deskripsi:</strong><br>${deskripsi}`;
            document.getElementById("modalGambar").src = gambar;

            // Tambahkan gaya untuk teks rata kanan-kiri
            const modalCaption = document.getElementById("modalCaption");
            const modalDeskripsi = document.getElementById("modalDeskripsi");
            modalCaption.style.textAlign = "justify"; // Rata kanan-kiri
            modalDeskripsi.style.textAlign = "justify"; // Rata kanan-kiri
        });
    });
});


</script>

@endsection
