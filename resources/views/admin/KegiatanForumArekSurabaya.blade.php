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
            @if (auth()->user()->hasPermissionTo('kegiatan arek suroboyo-add'))
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahKegiatan">
                    <i class="bi bi-plus"></i> Tambah kegiatan Forum Anak Surabaya
                </button>
            @endif
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle text-center"  id="myTable">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Dibuat Oleh</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($kegiatans as $index => $kegiatan)
                      <tr>
                          <td style="text-align: center;">{{ $loop->iteration }}</td>

                          <td style="text-align: left;">{{ Str::limit($kegiatan->nama, 40, '...') }}</td>
                
                            <td> {{ $kegiatan->user ? $kegiatan->user->name : 'Tidak ada pengguna' }}</td>                            <td>
                              @if($kegiatan->is_active == 0)
                              <span class="badge bg-warning">Non Aktif</span>
                              @else
                                  <span class="badge bg-success">Aktif</span>
                              @endif

                            </td>
                            <td>
                            @if (auth()->user()->hasPermissionTo('kegiatan arek suroboyo-edit'))
                                <button class="btn btn-sm btn-primary edit-forum" data-bs-toggle="modal" data-bs-target="#modaEditKegiatan"
                                    data-id="{{ $kegiatan->id }}" 
                                    data-nama="{{ $kegiatan->nama }}" 
                                    data-keterangan="{{ $kegiatan->keterangan }}" 
                                    data-gambar="{{ asset($kegiatan->gambar) }}" 
                                    data-status="{{ $kegiatan->is_active }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                            @endif
                                <!-- Button Delete Modal -->
                            @if (auth()->user()->hasPermissionTo('kegiatan arek suroboyo-delete'))
                                <button class="btn btn-sm btn-danger delete-btn" 
                                    data-id  ="{{ $kegiatan->id }}"
                                    data-nama ="{{ $kegiatan->nama }}"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteMenuModal"><i class="bi bi-trash"></i>
                                </button> 
                            @endif  
                            
                            <!-- detail -->
                            <a href="#" 
                                class="lihat-keterangan btn btn-sm rounded-circle edit-verifikasi" style="background-color: #FFC107; width: 36px; height: 36px;" 
                                data-bs-toggle="modal" 
                                data-bs-target="#keteranganModal"
                                data-deskripsi="{{ $kegiatan->keterangan}}"
                                data-gambar="{{ asset($kegiatan->gambar) }}">
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
            <div class="modal-header d-flex justify-content-center w-100 ">
                <h5 class="modal-title fw-bold text-center" id="modalTambahKegiatanLabel">Tambah Menu Kegiatan Forum Arek Surabaya</h5>
            </div>
            <div class="modal-body">
      <form method="POST" action="{{ route('createForumAnakSurabaya') }}" id="myForm" enctype="multipart/form-data">
          @csrf 
          <div class="mb-3">
            <label for="namaKegiatan" class="form-label fw-semibold">Nama</label>
            <input type="text" name="nama" class="form-control" id="namaKegiatan" value="{{ old('nama')}}" placeholder="Masukkan nama kegiatan">
          </div>
          <div class="mb-3">
            <label for="gambarKegiatan" class="form-label fw-semibold">Gambar</label>
            <input name="gambar" type="file" class="form-control" id="gambarKegiatan" accept="image/*" onchange="previewImage(event)">
            <img id="preview" src="#" alt="Preview" class="img-fluid mt-2 d-none" style="max-height: 200px;">
          </div>
          <div class="mb-3">
            <label for="keteranganKegiatan" class="form-label fw-semibold">Keterangan</label>
            <textarea class="form-control" name="keterangan" id="keteranganKegiatan" rows="3" placeholder="Tambahkan keterangan kegiatan">{{ old('keterangan') }}</textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Status</label>
            <div class="form-check form-switch">
                <input type="hidden" name="is_active" value="0"> <!-- Fallback jika checkbox tidak dicentang -->
                <input class="form-check-input" type="checkbox" id="status" name="is_active" value="1" checked>
                <label class="form-check-label" for="status">Aktif</label>
            </div>
        </div>
        <input type="hidden" name="dibuatOleh" value="{{ Auth::user()->id }}">
    </div>
    <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" id="submitBtn" class="btn btn-primary">Simpan</button>
        </div>
    </form>
  </div>
</div>
</div>
<script>
    document.getElementById('myForm').addEventListener('submit', function() {
        document.getElementById('submitBtn').disabled = true;
    });
</script>

<!-- Modal Edit Dokumen Kelurahan -->
<div class="modal fade" id="modaEditKegiatan" tabindex="-1" aria-labelledby="modaEditKegiatanLabel" aria-hidden="true">
<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center w-100 ">
                <h5 class="modal-title fw-bold text-center" id="modaEditKegiatanLabel">Edit Menu Kegiatan Forum Arek Surabaya</h5>
            </div>
            <div class="modal-body">
                <form id="editFormForum" method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                <div class="mb-3">
                    <label for="namaKegiatan" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="editNamaKegiatan" name="nama">
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
                    <label for="keteranganKegiatan" class="form-label">Keterangan</label>
                    <textarea class="form-control" name="keterangan" id="editKeterangan" rows="3"></textarea>
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
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
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
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <!-- Header Modal -->
            <div class="modal-header d-flex justify-content-center">
                <h5 class="modal-title fw-bold w-100 text-center" id="keteranganModalLabel">Detail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Body Modal -->
            <div class="modal-body text-center">
                <!-- Gambar -->
                <div>
                    <img id="modalGambar" src="" alt="Gambar Kegiatan" class="img-fluid rounded mb-3" style="max-height: 250px; object-fit: contain;">
                </div>

                <!-- Keterangan -->
                <div>
                    <p id="modalDeskripsi" style="text-align: center; font-size: 1rem; color: black;"></p>
                </div>
            </div>

            <!-- Footer Modal -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
</div>



<script>
    document.addEventListener("DOMContentLoaded", function () {
      document.querySelectorAll(".edit-forum").forEach(button => {
        button.addEventListener("click", function () {
          let id = this.getAttribute("data-id");
          let nama = this.getAttribute("data-nama");
          let keterangan = this.getAttribute("data-keterangan");
          let gambar = this.getAttribute("data-gambar");
          let status = this.getAttribute("data-status");
  
          // Set nilai form dalam modal
          document.getElementById("editNamaKegiatan").value = nama;
          document.getElementById("editKeterangan").value = keterangan;
          document.getElementById("editStatus").checked = status == "1";

  
          // Set preview gambar
          document.getElementById("previewGambar").src = gambar;
          document.getElementById("previewGambar").classList.remove("d-none");
  
          // Set action form ke URL update yang sesuai
          document.getElementById("editFormForum").action = `/halamanForum/update/${id}`;
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

                console.log(id)
                console.log(nama)

                document.getElementById("deleteId").value = id;
                document.getElementById("deleteNama").textContent = nama; // Tampilkan nama di modal

                // Set action form agar mengarah ke endpoint delete yang benar
                document.getElementById("deleteForm").action = `/halamanForumAnakSurabaya/hapus/${id}`;
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
            let deskripsi = this.getAttribute("data-deskripsi");
            let gambar = this.getAttribute("data-gambar");

            // Tetapkan data ke elemen dalam modal
            document.getElementById("modalDeskripsi").innerHTML = `<strong>Keterangan :</strong><br>${deskripsi}`;
            document.getElementById("modalGambar").src = gambar;

            // Tambahkan gaya untuk menaruh teks di tengah
            const modalDeskripsi = document.getElementById("modalDeskripsi");
            modalDeskripsi.style.textAlign = "center"; // Teks di tengah horizontal
        });
    });
});



</script>

@endsection
