@extends('admin.admin-master') 
@section('main')
<link href="{{ asset('assets/css/tabel.css') }}" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


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
    <div class="card shadow-lg border-0 position-relative overflow-hidden mb-5"> 
        <div class="card-body mt-4">
            <div class="text-center mb-4">
                <h4 class="fw-bold">Slider</h4>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div></div> <!-- Spacer -->
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sliderModal">
                    + Tambah Slider
                </button>
            </div>

            <!-- Tabel -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle text-center"  id="myTable">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <!-- <th>Gambar</th>
                            <th>Nama</th> -->
                            <!-- <th>Caption</th> -->
                            <th>Detail</th>
                            <th>Dibuat Oleh</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sliders as $index => $Slider)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <!-- <td><img src="{{ asset($Slider->gambar) }}" alt="Slider Image" width="80"></td>
                            <td>{{ $Slider->nama }}</td> -->
                            <!-- <td>{{ $Slider->caption }}</td> -->

                            <!-- Bagian detail -->
                            <td>
                                <a href="#" 
                                class="lihat-detail" 
                                data-bs-toggle="modal" 
                                data-bs-target="#deskripsiModal" 
                                data-gambar="{{ asset($Slider->gambar) }}"
                                data-nama="{{ $Slider->nama }}"
                                data-caption="{{ $Slider->caption }}"
                                data-deskripsi="{{ $Slider->deskripsi }}">Lihat Detail
                                </a> 
                            </td>

                            <!-- <td>{{ $Slider->deskripsi }}</td> -->
                            <td>{{ $Slider->dibuatOleh }}</td>
                            <td>
                                    @if($Slider->is_active == 0)
                                        <span class="badge bg-warning">Non Aktif</span>
                                    @else
                                        <span class="badge bg-success">Aktif</span>
                                    @endif
                            </td>

                            <td>
                                <!-- Bagian buttom edit -->
                                <button class="btn btn-sm btn-primary edit-slider" 
                                    data-id="{{ $Slider->id }}" 
                                    data-nama="{{ $Slider->nama }}" 
                                    data-caption="{{ $Slider->caption }}" 
                                    data-deskripsi="{{ $Slider->deskripsi }}" 
                                    data-is_active="{{ $Slider->is_active }}" 
                                    data-gambar="{{ asset( $Slider->gambar) }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                             <!-- Tombol Hapus dengan konfirmasi -->
                                <button class="btn btn-sm btn-danger delete-btn" 
                                    data-id  ="{{ $Slider->id }}"
                                    data-nama ="{{ $Slider->nama }}"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteMenuModal"><i class="bi bi-trash"></i>
                                </button>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Slider -->
<div class="modal fade" id="sliderModal" tabindex="-1" aria-labelledby="sliderModalLabel" aria-hidden="true">
<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center w-100 ">
                <h5 class="modal-title fw-bold text-center" id="sliderModalLabel">Tambah Menu Slider Baru</h5>
            </div>
            <div class="modal-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form method="POST" action="{{ route('createSlider') }}" enctype="multipart/form-data">
                    @csrf 
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Caption</label>
                        <input type="text" class="form-control" name="caption" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gambar</label>
                        <input type="file" class="form-control" name="gambar" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="is_active" required>
                            <option value="1">Aktif</option>
                            <option value="0">Non-Aktif</option>
                        </select>
                    </div>
                    <input type="hidden" name="dibuatOleh" value="{{ Auth::user()->name }}">
            </div>
                    <div class="modal-footer border-top pt-3 d-flex justify-content-end"> <!-- Tambahan border-top dan padding -->
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Slider -->
<div class="modal fade" id="editSliderModal" tabindex="-1" aria-labelledby="editSliderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center w-100">
                <h5 class="modal-title fw-bold text-center" id="editSliderModalLabel">Edit Slider</h5>
            </div>
            <div class="modal-body">
                <form id="editSliderForm" method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" id="editNama" required maxlength="255">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Caption</label>
                        <input type="text" class="form-control" name="caption" id="editCaption" required maxlength="500">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" id="editDeskripsi" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gambar (Maks. 2MB, PNG/JPG/JPEG)</label>
                        <input type="file" class="form-control" name="gambar" id="editGambar">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengganti gambar.</small>
                        <br>
                        <img id="previewGambar" src="" alt="Gambar Slider" class="img-fluid mt-2" style="max-height: 150px;">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="is_active" id="editIsActive" required>
                            <option value="1">Aktif</option>
                            <option value="0">Non-Aktif</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-top pt-3 d-flex justify-content-end">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" form="editSliderForm">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete -->
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
                    <p>Apakah Anda yakin ingin menghapus Slider<br> <strong id="deleteNama"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal detail -->
<div class="modal fade" id="deskripsiModal" tabindex="-1" aria-labelledby="deskripsiModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <!-- Header Modal -->
      <div class="modal-header">
        <h5 class="modal-title fw-bold" id="deskripsiModalLabel">Detail</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Body Modal -->
      <div class="modal-body text-center">
        <!-- Gambar -->
        <img id="modalGambar" src="" alt="Detail Gambar" class="img-fluid mb-3" style="max-height: 300px; object-fit: cover;">

        <!-- Judul -->
        <h5 id="modalJudul" class="fw-bold"></h5>

        <!-- Deskripsi -->
        <p id="modalDeskripsi" class="mt-3"></p>
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
        var kategoriModal = new bootstrap.Modal(document.getElementById("kategoriModal"));
    });
</script>

{{-- edit --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".edit-slider").forEach(button => {
            button.addEventListener("click", function () {
                const id = this.getAttribute("data-id");
                const nama = this.getAttribute("data-nama");
                const caption = this.getAttribute("data-caption");
                const deskripsi = this.getAttribute("data-deskripsi");
                const isActive = this.getAttribute("data-is_active");
                const gambar = this.getAttribute("data-gambar");
    
                // Isi form dengan data dari tombol edit
                document.getElementById("editNama").value = nama;
                document.getElementById("editCaption").value = caption;
                document.getElementById("editDeskripsi").value = deskripsi;
                document.getElementById("editIsActive").value = isActive;
    
                // Tampilkan gambar yang ada
                if (gambar) {
                    document.getElementById("previewGambar").src = gambar;
                } else {
                    document.getElementById("previewGambar").src = "";
                }
    
                // Set action form
                document.getElementById("editSliderForm").action = "/slider/update/" + id;
    
                // Tampilkan modal
                new bootstrap.Modal(document.getElementById("editSliderModal")).show();
            });
        });
    });
    </script>


{{-- hapus --}}
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
                document.getElementById("deleteForm").action = `/slider/hapus/${id}`;
            });
        });
    });
</script>

<!-- bagian detail -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
      // Menambahkan event listener pada setiap elemen dengan class "lihat-detail"
      document.querySelectorAll(".lihat-detail").forEach(button => {
          button.addEventListener("click", function () {
              // Ambil data dari atribut elemen
              let judul = this.getAttribute("data-nama");
              let deskripsi = this.getAttribute("data-deskripsi");
              let gambar = this.getAttribute("data-gambar");

              // Tetapkan teks header modal menjadi "Detail"
              document.getElementById("deskripsiModalLabel").innerText = "Detail";

              // Isi data ke dalam modal
              document.getElementById("modalJudul").innerText = judul; // Judul
              document.getElementById("modalDeskripsi").innerText = deskripsi; // Deskripsi
              document.getElementById("modalGambar").src = gambar; // Gambar
          });
      });
  });
</script>
@endsection

