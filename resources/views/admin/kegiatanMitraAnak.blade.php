@extends('admin.admin-master')

@section('main')

<link href="{{ asset('assets/css/tabel.css') }}" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container mt-5">
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger text-center p-1 px-2 small">  
                        {{ $error }}
            </div>
        @endforeach
    @endif
    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success')}}
        
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
            
            <!-- Tombol Tambah Artikel di atas -->           
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Dibuat Oleh</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($mitras as $index => $mitra)
                      <tr>
                          <td style="text-align: center;">{{ $loop->iteration }}</td>
                            <td>{{ $mitra->nama }}

                            </td>

                            <td>{{ $mitra->user ? $mitra->user->name : 'Tidak ada pengguna' }}</td>
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

                             <a href="#" 
                                class="lihat-keterangan btn btn-sm rounded-circle edit-verifikasi" style="background-color: #FFC107; width: 36px; height: 36px;" 
                                data-bs-toggle="modal" 
                                data-bs-target="#keteranganModal"
                                data-caption="{{ $mitra->caption }}" 
                                data-deskripsi="{{ $mitra->deskripsi }}"
                                data-gambar="{{ asset($mitra->gambar) }}">
                                <i class="bi bi-list-task text-white fs-6"></i>
                            </a>

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
        <form method="POST" id="myForm" action="{{ route('createKegiatanMitraAnak') }}" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
            <label for="namaKegiatan" class="form-label fw-semibold">Nama Kegiatan</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama kegiatan" value="{{ old('nama') }}"    >
          </div>
          <div class="mb-3">
            <label for="keteranganKegiatan" class="form-label fw-semibold">Caption</label>
            <textarea class="form-control" id="keteranganKegiatan" rows="3" name="caption" placeholder="Tambahkan keterangan kegiatan">{{ old('caption') }}</textarea>
          </div>
          <div class="mb-3">
            <label for="keteranganKegiatan" class="form-label fw-semibold">Deskripsi</label>
            <textarea class="form-control" id="keteranganKegiatan" rows="3" name="deskripsi" placeholder="Tambahkan keterangan kegiatan" >{{ old('deskripsi') }}</textarea>
          </div>
          <div class="mb-3">
            <label for="gambarKegiatan" class="form-label fw-semibold">Gambar</label>
            <input type="file" class="form-control" name="gambar" id="gambarKegiatan" accept="image/*" onchange="previewImage(event)">
            <img id="preview" src="#" alt="Preview" class="img-fluid mt-2 d-none" style="max-height: 200px;">
          </div>
          <div class="mb-3">
            <label class="form-label">Status</label>
            <div class="form-check form-switch">
                <input type="hidden" name="is_active" value="0"> <!-- Fallback jika checkbox tidak dicentang -->
                <input class="form-check-input" type="checkbox" id="status" name="is_active" value="1" checked>
                <label class="form-check-label" for="status">Aktif</label>
            </div>
        </div>
        </div>
        <input type="hidden" name="dibuatOleh" value="{{ Auth::user()->id }}">
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" id="submitBtn" class="btn btn-primary">Simpan</button>
        </div>
    </form>
    </div>
  </div>
</div>
</div>

<script>
    document.getElementById('myForm').addEventListener('submit', function() {
        document.getElementById('submitBtn').disabled = true;
    });
</script>

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
                    <div class="form-check form-switch">
                        <!-- Hidden input sebagai fallback jika checkbox tidak dicentang -->
                        <input type="hidden" name="is_active" value="0">
                        
                        <input class="form-check-input" name="is_active" type="checkbox" id="editStatus" value="1" checked>
                        <label class="form-check-label" for="status">Aktif</label>
                    </div>
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
        document.getElementById("editStatus").checked = status == "1";
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
