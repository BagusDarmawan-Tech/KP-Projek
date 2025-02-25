@extends('admin.admin-master')
@section('main')
<link href="{{ asset('assets/css/tabel.css') }}" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- <script src="{{ asset('assets/js/hapus.js') }}"></script> -->
<div class="container mt-5">
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
    <div class="card shadow-lg border-0 position-relative overflow-hidden mb-5">
        <div class="card-body mt-4">
            <div class="text-center mb-4">
                <h4 class="fw-bold">Kegiatan CFCI</h4>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div></div>
                @if (auth()->user()->hasPermissionTo('cfci-add'))
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kegiatanModal">+ Kegiatan CFCI</button> 
                @endif
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle text-center"  id="myTable">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Detail</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cfcis as $index => $cfci)
                        <tr>
                            <td style="text-align: center;">{{ $loop->iteration }}</td>
                            <!-- <td><img src="{{ asset($cfci->gambar) }}" alt="Kegiatan CFCI" width="80"></td> -->
                            <td>{{ $cfci->nama }}</td>

                            <!-- <td>{{ $cfci->caption }}</td> -->
                             
                            <td>
                                @if($cfci->is_active == 0)
                                <span class="badge bg-warning">Non Aktif</span>
                                @else
                                    <span class="badge bg-success">Aktif</span>
                                @endif
                            </td>
                            <!-- bagian detail -->
                            <td>
                                <a href="#" 
                                class="lihat-keterangan" 
                                data-bs-toggle="modal" 
                                data-bs-target="#keteranganModal"
                                data-caption="{{ $cfci->caption }}" 
                                data-deskripsi="{{ $cfci->deskripsi }}"
                                data-gambar="{{ asset($cfci->gambar) }}">Lihat Keterangan</a>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-primary edit-cfci" data-bs-toggle="modal" data-bs-target="#editKegiatanModal" 
                                    data-id="{{ $cfci->id }}" 
                                    data-nama="{{ $cfci->nama }}" 
                                    data-caption="{{ $cfci->caption }}" 
                                    data-deskripsi="{{ $cfci->deskripsi }}"
                                    data-gambar="{{ asset($cfci->gambar) }}" 
                                    data-status="{{ $cfci->is_active }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>                                 
                                <!-- Button Delete Modal -->
                                <button class="btn btn-sm btn-danger delete-btn" 
                                    data-id  ="{{ $cfci->id }}"
                                    data-nama ="{{ $cfci->nama }}"
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

<!-- Modal Tambah/Edit Kegiatan -->
<div class="modal fade" id="kegiatanModal" tabindex="-1" aria-labelledby="kegiatanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex flex-column align-items-center">
                <h5 class="modal-title fw-bold text-center mb-0" id="kegiatanModalLabel">Tambah Kegiatan CFCI Baru</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('createMitraCfci') }}" enctype="multipart/form-data">
                    @csrf 
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama">
                    </div>
                    <div class="mb-3">
                        <label for="caption" class="form-label">Caption</label>
                        <input type="text" class="form-control" id="caption" name="caption">
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" rows="3" name="deskripsi"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar</label>
                        <input type="file" class="form-control" id="gambar" name="gambar">
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

<!-- Modal Edit Kegiatan -->
<div class="modal fade" id="editKegiatanModal" tabindex="-1" aria-labelledby="editKegiatanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex flex-column align-items-center">
                <h5 class="modal-title fw-bold text-center mb-0" id="editKegiatanModalLabel">Edit Kegiatan CFCI</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body">
                <form action="" id="editFormCfci" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="editNamaKegiatan" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="editNamaKegiatan" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="editCaption" class="form-label">Caption</label>
                        <input type="text" class="form-control" id="editCaption" name="caption" required>
                    </div>
                    <div class="mb-3">
                        <label for="editDeskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="editDeskripsi" name="deskripsi" rows="3" required></textarea>
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
            <div class="modal-footer border-top pt-3 d-flex justify-content-end"> <!-- Tambahan border-top dan padding -->
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


<!-- modal detail  -->
<div class="modal fade" id="keteranganModal" tabindex="-1" aria-labelledby="keteranganModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Header Modal -->
            <div class="modal-header">
    <h5 class="modal-title fw-bold" id="keteranganModalLabel">Detail</h5>
    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
</div>


            <!-- Body Modal -->
            <div class="modal-body">
                <div class="row">
                    <!-- Gambar -->
                    <div class="col-md-4">
                        <img id="modalGambar" src="" alt="Gambar" class="img-fluid rounded">
                    </div>

                    <!-- Caption dan Deskripsi -->
                    <div class="col-md-8">
                        <p id="modalCaption" style="text-align: justify;"></p>
                        <p id="modalDeskripsi" style="text-align: justify;"></p>
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
      document.querySelectorAll(".edit-cfci").forEach(button => {
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
          document.getElementById("editFormCfci").action = `/update/${id}`;
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
                document.getElementById("deleteForm").action = `/mitraCfci/hapus/${id}`;
            });
        });
    });
</script>

<!-- modal detail -->
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
            document.getElementById("modalCaption").innerHTML = `<strong>Caption :</strong><br>${caption}`;
            document.getElementById("modalDeskripsi").innerHTML = `<strong>Deskripsi :</strong><br>${deskripsi}`;
            document.getElementById("modalGambar").src = gambar;

            // Tambahkan gaya untuk memusatkan teks header di tengah
            const modalHeader = document.querySelector("#keteranganModal .modal-header");
            modalHeader.style.display = "flex";
            modalHeader.style.justifyContent = "center";
            modalHeader.style.alignItems = "center";
            modalHeader.style.position = "relative";

            const closeButton = modalHeader.querySelector(".btn-close");
            closeButton.style.position = "absolute";
            closeButton.style.right = "10px";

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
