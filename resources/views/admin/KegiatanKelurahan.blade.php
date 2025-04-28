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
                 @if (auth()->user()->hasPermissionTo('kegiatan kelurahan-add'))
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahKegiatan">
                    <i class="bi bi-plus"></i> Tambah kegiatan Kelurahan
                </button>
                @endif
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle text-center" id="myTable">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center" width="10%">No</th>
                            <th class="text-center" width="20%">Nama</th>
                            <th class="text-center" width="17%">Kelurahan</th>
                            <th class="text-center" width="17%">Dibuat Oleh</th>
                            <th class="text-center" width="12%">Status</th>
                            <th class="text-center" width="18%" >Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kegiatans as $index => $kegiatan)
                        <tr>
                            <td style="text-align: center;">{{ $loop->iteration }}</td>
                            <!-- <td><img src="{{ asset($kegiatan->gambar) }}" alt="Slider Image" width="80"></td> -->
                            <td class="text-start">{{ $kegiatan->nama }}</td>
                            <td class="text-start">{{ $kegiatan->kelurahan ? $kegiatan->kelurahan->nama : 'Tidak ada Nama' }}</td>
                            <td>{{ $kegiatan->user ? $kegiatan->user->name : 'Tidak ada pengguna' }}</td>
                            <td>
                                @if($kegiatan->is_active == 0)
                                    <span class="badge bg-warning">Non Aktif</span>
                                @else
                                    <span class="badge bg-success">Aktif</span>
                                @endif
                              </td>
                            <td>
                            @if (auth()->user()->hasPermissionTo('kegiatan kelurahan-edit'))
                                <button class="btn btn-sm btn-primary btn-edit-kegiatan"
                                    data-id="{{ $kegiatan->id }}"
                                    data-nama="{{ $kegiatan->nama }}"
                                    data-gambar="{{ asset($kegiatan->gambar) }}"
                                    data-status="{{ $kegiatan->is_active }}"
                                    data-kelurahan="{{ $kegiatan->kelurahanid }}"
                                    data-keterangan="{{ $kegiatan->keterangan }}"
                                    data-status="{{ $kegiatan->is_active }}"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modaEditKegiatan">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                            @endif 

                             <!-- Tombol Hapus -->
                             @if (auth()->user()->hasPermissionTo('kegiatan kelurahan-delete'))
                                <button class="btn btn-sm btn-danger delete-btn" 
                                    data-id  ="{{ $kegiatan->id }}"
                                    data-nama ="{{ $kegiatan->nama }}"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteMenuModal"><i class="bi bi-trash"></i>
                                </button>
                            @endif

                            <!-- Tombol  detail -->
                            <a href="#" 
                            class="lihat-keterangan btn btn-sm rounded-circle edit-verifikasi" style="background-color: #FFC107; width: 36px; height: 36px;" 
                                data-bs-toggle="modal" 
                                data-bs-target="#keteranganModal"
                                data-nama="{{ $kegiatan->nama }}"
                                data-keterangan="{{ $kegiatan->keterangan }}"
                                data-gambar="{{asset($kegiatan->gambar) }}">
                               galer
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
                    <h5 class="modal-title fw-bold text-center" id="menuModalLabel">Tambah Kegiatan Kelurahan</h5>
                </div>
                <div class="modal-body">
                    <form method="POST" id="myForm" action="{{ route('createKegiatanKelurahan') }}" enctype="multipart/form-data">
                        @csrf 
                        <div class="mb-3">
                            <label for="kegiatan" class="form-label">Kelurahan</label>
                            <select class="form-select" id="kegiatan" name="kelurahanid">
                                <option value="" disabled selected>-- Pilih Kelurahan --</option>
                                @foreach ($kelurahans as $kelurahan)
                                    <option value="{{ $kelurahan->id }}" {{ old('kegiatan') == $kelurahan->id ? 'selected' : '' }} >
                                        {{ $kelurahan->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="namaKegiatan" class="form-label fw-semibold">Nama</label>
                            <input type="text" name="nama" class="form-control" id="namaKegiatan" placeholder="Masukkan nama kegiatan" value="{{ old('nama') }}" >
                        </div>
                        <div class="mb-3">
                            <label for="gambarKegiatan" class="form-label fw-semibold">Gambar</label>
                            <input type="file" class="form-control" id="gambarKegiatan" name="gambar">
                        </div>
                        <div class="mb-3">
                            <label for="keteranganKegiatan" class="form-label fw-semibold">Keterangan</label>
                            <textarea class="form-control" name="keterangan" id="keteranganKegiatan" rows="3" placeholder="Tambahkan keterangan kegiatan">{{ old('keterangan') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <div class="form-check form-switch">
                                <!-- Hidden input sebagai fallback jika checkbox tidak dicentang -->
                                <input type="hidden" name="is_active" value="0">
                                
                                <input class="form-check-input" name="is_active" type="checkbox" id="status" value="1" checked>
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
                    <h5 class="modal-title fw-bold text-center" id="menuModalLabel">Edit Menu Kegiatan Kelurahan</h5>
                </div>
                <div class="modal-body">
            <form id="editKegiatanForm" method="POST" enctype="multipart/form-data">
                 @csrf
                @method('PUT')
                <input type="hidden" id="editId" name="id">
                    <div class="mb-3">
                        <label for="namaKegiatan" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" id="editNama" >
                    </div>
                    <div class="mb-3">
                        <label for="kegiatan" class="form-label">Kelurahan</label>
                        <select class="form-select" id="editKelurahan" name="kelurahanid">
                            <option value="" disabled selected>-- Pilih Kelurahan --</option>
                            @foreach ($kelurahans as $kelurahan)
                                <option value="{{ $kelurahan->id }}" {{ old('kegiatan') == $kelurahan->id ? 'selected' : '' }} >
                                    {{ $kelurahan->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="gambarKegiatan" class="form-label">Gambar</label>
                        <input type="file" name="gambar" class="form-control" id="editGambar" accept="image/*" onchange="previewImage(event)">
                        <img id="previewGambar" src="#" alt="Preview Gambar" class="img-fluid mt-2 d-none" style="max-height: 200px;">
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
   <!-- Modal -->
<div class="modal fade" id="keteranganModal" tabindex="-1" aria-labelledby="keteranganModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="keteranganModalLabel">Detail Kegiatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <img id="modal-gambar" src="" alt="Gambar Kegiatan" class="img-fluid rounded" style="max-width: 100%;">
                </div>
                <h5 id="modal-nama" class="text-center"></h5>
                <p id="modal-keterangan" class="text-muted text-center"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>


<script>
  document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".btn-edit-kegiatan").forEach(button => {
        button.addEventListener("click", function () {
            let id = this.getAttribute("data-id");
            let nama = this.getAttribute("data-nama");
            let gambar = this.getAttribute("data-gambar");
            let kelurahan = this.getAttribute("data-kelurahan");
            let keterangan = this.getAttribute("data-keterangan");
            let status = this.getAttribute("data-status");

            console.log("Gambar URL:", gambar); // Debugging

            document.getElementById("editId").value = id;
            document.getElementById("editNama").value = nama;
            document.getElementById("editKelurahan").value = kelurahan;
            document.getElementById("editKeterangan").value = keterangan;
            document.getElementById("editStatus").checked = status == "1";

            // Set preview gambar
            let previewGambar = document.getElementById("previewGambar");
            if (gambar && gambar !== "null") {
                previewGambar.src = gambar;
                previewGambar.classList.remove("d-none");
            } else {
                previewGambar.src = "#";
                previewGambar.classList.add("d-none");
            }

            // Pastikan action form mengarah ke URL update yang benar
            document.getElementById("editKegiatanForm").action = `/kegiatanKelurahan/update/${id}`;
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
                document.getElementById("deleteForm").action = `/kegiatanKelurahan/hapus/${id}`;
            });
        });
    });
  </script>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var keteranganModal = document.getElementById("keteranganModal");

        keteranganModal.addEventListener("show.bs.modal", function(event) {
            var button = event.relatedTarget; // Tombol yang diklik
            if (!button) return; // Jika button tidak ditemukan, hentikan eksekusi

            var nama = button.getAttribute("data-nama");
            var keterangan = button.getAttribute("data-keterangan");
            var gambar = button.getAttribute("data-gambar");

            // Debugging: Cek apakah data sudah diambil dengan benar
            console.log("Nama:", nama);
            console.log("Keterangan:", keterangan);
            console.log("Gambar:", gambar);

            // Isi modal dengan data yang diambil dari tombol
            document.getElementById("modal-nama").textContent = nama || "Tidak Ada Nama";
            document.getElementById("modal-keterangan").textContent = keterangan || "Tidak Ada Keterangan";
            document.getElementById("modal-gambar").src = gambar || "https://via.placeholder.com/150";
        });
    });
</script>
