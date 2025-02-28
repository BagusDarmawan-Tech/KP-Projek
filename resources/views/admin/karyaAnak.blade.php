@extends('admin.admin-master')

@section('title', 'Karya Anak')

@section('main')

<!-- Tambahkan CSS Kustom -->
<link href="{{ asset('assets/css/tabel.css') }}" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- <script src="{{ asset('assets/js/hapus.js') }}"></script> -->

<style>
    /* untuk "Terverifikasi" */
    .bg-purple {
        background-color: #6f42c1 !important;
        color: white;
    }

    /* "Belum Terverifikasi" */
    .bg-gray {
        background-color: #adb5bd !important;
        color: white;
    }
</style>

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
<div class="card shadow-lg border-0 position-relative overflow-hidden mb-5">
    <div class="card-body mt-4">
        <div class="text-center mb-4">
            <h4 class="fw-bold">Karya Anak</h4>
        </div>

        <!-- Tombol Tambah Karya -->
        <div class="row mb-3">
            <div class="col-md-12 d-flex justify-content-end">
                @if (auth()->user()->hasPermissionTo('karya-add')) 
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahKaryaModal">
                    + Karya Anak Baru
                </button>
                @endif
            </div>
        </div>

        <!-- Tabel -->
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle text-center"  id="myTable">
                <thead class="table-primary">
                    <tr class = "text-center">
                        <th class="text-center">No</th>
                        <th class="text-nowrap text-center">Tanggal</th>
                        <th class="text-center">Pemohon</th>
                        <th class="text-center">Kreator</th>
                        <th class="text-center">Detail</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($karyas as $index => $karya)
                    <tr>
                        <td style="text-align: center;">{{ $loop->iteration }}</td>
                        <td class="text-nowrap">{{ $karya->tanggal }}</td>
                        <td>{{ $karya->user ? $karya->user->name : 'Tidak ada pengguna' }}</td>
                        <td>{{ $karya->kreator }}</td>
                    
                        <!-- bagian detail -->
                        <td>
                            <a href="#" 
                            class="lihat-detail" 
                            data-bs-toggle="modal" 
                            data-bs-target="#deskripsiModal" 
                            data-id="{{ $karya->id }}" 
                            data-judul="{{ $karya->judul }}" 
                            data-deskripsi="{{ $karya->deskripsi }}" 
                            data-gambar="{{ asset($karya->gambar) }}">Lihat Detail</a>
                        </td>

    
                        <!-- <td>{{ $karya->deskripsi }}</td> -->
                        <td>
                            @if($karya->status == 0)
                                <span class="badge bg-warning">Proses Verifikasi</span>
                            @else
                                <span class="badge bg-success">Terverifikasi</span>
                            @endif
                        </td>                        
                        <td>
                            <div class="d-flex align-items-center justify-content-center gap-1 py-1" style="min-height: 38px;">
                                
                                <!-- Tombol Edit -->
                                @if (auth()->user()->hasPermissionTo('karya-edit')) 
                                <button class="btn btn-sm btn-primary edit-karya" data-bs-toggle="modal" data-bs-target="#editKaryaModal"
                                    data-id="{{ $karya->id }}" 
                                    data-judul="{{ $karya->judul }}" 
                                    data-kreator="{{ $karya->kreator }}" 
                                    data-deskripsi="{{ $karya->deskripsi }}" 
                                    data-karya="{{ $karya->tingkatKarya }}" 
                                    data-gambar="{{ asset($karya->gambar) }}">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                @endif

                                <!-- Tombol Hapus -->
                                @if (auth()->user()->hasPermissionTo('karya-delete')) 
                                <button class="btn btn-sm btn-danger delete-btn" 
                                    data-id  ="{{ $karya->id }}"
                                    data-nama ="{{ $karya->judul }}"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteMenuModal"><i class="bi bi-trash"></i>
                                </button>  
                                @endif


                                <!-- Tombol Verifikasi -->
                                @if (auth()->user()->hasPermissionTo('karya-verifikasi')) 
                                <button class="btn btn-sm btn-success verifikasi-edit" data-bs-toggle="modal" data-bs-target="#verifikasiModal" 
                                data-status="{{ $karya->status }}" 
                                data-id="{{ $karya->id }}"
                                dataID="{{ $karya->id }}">
                                    <i class="bi bi-check-lg"></i>
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Karya -->
<div class="modal fade" id="tambahKaryaModal" tabindex="-1" aria-labelledby="tambahKaryaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex flex-column align-items-center">
            <h5 class="modal-title fw-bold text-center mb-0" id="tambahKaryaModalLabel">Tambah Karya Anak Baru</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body">
            <form method="POST" action="{{ route('createKaryaAnak') }}" enctype="multipart/form-data">
                    @csrf 
                <div class="mb-3">
                    <label class="form-label">Kreator</label>
                    <input type="text" name="kreator" class="form-control"  placeholder="Masukkan nama kreator" value="{{ old('kreator') }}" >
                </div>
                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" name="judul" class="form-control"  placeholder="Masukkan judul" value="{{ old('judul') }}" >
                </div>
                <div class="mb-3">
                    <label for="kegiatan" class="form-label">Tingkatan</label>
                    <select class="form-select" id="editTingkatKarya" name="tingkatKarya">
                        <option value="" disabled selected>-- Pilih Tingkat Karya --</option>
                            <option value="kelurahan" {{ old('tingkatKarya') == 'kelurahan' ? 'selected' : '' }}>Kelurahan</option>
                            <option value="kecamatan" {{ old('tingkatKarya') == 'kecamatan' ? 'selected' : '' }}>Kecamatan</option>
                            <option value="kota" {{ old('tingkatKarya') == 'kota' ? 'selected' : '' }}>Kota</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea class="form-control" name="deskripsi" rows="3"  placeholder="Masukkan deskripsi">{{ old('deskripsi') }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Upload Foto</label>
                    <input type="file" name="gambar" class="form-control" accept=".jpg, .png , .jpeg">
                </div>
                <input type="hidden" name="pemohon" value="{{ Auth::user()->id }}">
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Karya -->
<div class="modal fade" id="editKaryaModal" tabindex="-1" aria-labelledby="editKaryaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex flex-column align-items-center">
            <h5 class="modal-title fw-bold text-center mb-0" id="editKaryaModalLabel">Edit Karya Anak</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body">
                <form id="editKaryaForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editId" name="id">
                    <div class="mb-3">
                        <label class="form-label">Kreator</label>
                        <input type="text" name="kreator" class="form-control" id="editKreator">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Judul</label>
                        <input type="text" name="judul" class="form-control" id="editJudul">
                    </div>
                    <div class="mb-3">
                        <label for="editStatus" class="form-label">Status</label>
                        <select class="form-select" id="editTingkat" name="tingkatKarya">
                            <option value="kelurahan">Kelurahan</option>
                            <option value="kecamatan">Kecamatan</option>
                            <option value="kota">Kota</option>
                        </select>
                        </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" rows="3" id="editDeskripsi"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editGambar" class="form-label">Gambar</label>
                        <div class="mb-2">
                            <img id="previewGambar" src="#" alt="Preview Gambar" class="img-thumbnail" width="100">
                        </div>
                        <input type="file" class="form-control" id="editGambar" name="gambar">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
                    </div>
            </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
        </div>
    </div>
</div>
</div>

<!-- Modal Verifikasi -->
<div class="modal fade" id="verifikasiModal" tabindex="-1" aria-labelledby="verifikasiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="verifikasi" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" id="editIdverifikasi" name="id">
            <input type="hidden" id="editStatus" name="edit">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Verifikasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <p class="fw-semibold">Apakah Anda yakin ingin memverifikasi data ini?</p>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button class="btn btn-success" name="status" value="1" type="submit">TERIMA</button>
                    <button class="btn btn-danger"  name="status"  value="0" type="submit" data-bs-dismiss="modal">TOLAK</button>
                </div>
        </form>
        </div>
    </div>
</div>


<!-- Modal detail-->
<div class="modal fade" id="deskripsiModal" tabindex="-1" aria-labelledby="deskripsiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center w-100 ">
                <h5 class="modal-title fw-bold text-center" id="deskripsiModalLabel">Detail</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body">
                <!-- Kartu di dalam Modal -->
                <div class="card" style="width: 100%;">
                    <img id="modalGambar" class="card-img-top" alt="Gambar Karya">
                    <div class="card-body">
                        <h5 id="modalJudul" class="card-title text-center"></h5>
                        <p id="modalDeskripsi" class="card-text text-justify"></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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



<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".edit-karya").forEach(button => {
            button.addEventListener("click", function () {
                let id = this.getAttribute("data-id");
                let judul = this.getAttribute("data-judul");
                let kreator = this.getAttribute("data-kreator");
                let deskripsi = this.getAttribute("data-deskripsi");
                let gambar = this.getAttribute("data-gambar");
                let karya = this.getAttribute("data-karya");

                console.log(karya);

                // Set nilai form dalam modal
                document.getElementById("editJudul").value = judul;
                document.getElementById("editId").value = id;
                document.getElementById("editKreator").value = kreator;
                document.getElementById("editDeskripsi").value = deskripsi;
                document.getElementById("editTingkat").value = karya;


                // Set preview gambar
                let previewGambar = document.getElementById("previewGambar");
                if (gambar) {
                    previewGambar.src = gambar;
                    previewGambar.classList.remove("d-none");
                } else {
                    previewGambar.classList.add("d-none");
                }

                // Set action form ke URL update yang sesuai
                document.getElementById("editKaryaForm").action = `/karya-anak/update/${id}`;
            });
        });
    });
</script>

{{-- verifikasi --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".verifikasi-edit").forEach(button => {
            button.addEventListener("click", function () {
                let status = this.getAttribute("data-status");
                let id = this.getAttribute("data-id");
                let di = this.getAttribute("dataID");

                // Set nilai form dalam modal
                document.getElementById("editStatus").value = status;
                document.getElementById("editIdverifikasi").value = di;

                // Set action form ke URL update yang sesuai
                document.getElementById("verifikasi").action = `/karya-anak/verifikasi/${id}`;
            });
        });
    });
</script>

<!-- untuk deskripsi -->
  <script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".lihat-detail").forEach(button => {
            button.addEventListener("click", function () {
                // Ambil data dari atribut elemen
                let judul = this.getAttribute("data-judul");
                let deskripsi = this.getAttribute("data-deskripsi");
                let gambar = this.getAttribute("data-gambar");

                // Tetapkan teks header modal selalu "Detail"
                document.getElementById("deskripsiModalLabel").innerText = "Detail";

                // Set nilai ke elemen dalam modal
                document.getElementById("modalJudul").innerText = judul; // Judul dalam kartu
                document.getElementById("modalDeskripsi").innerText = deskripsi; // Deskripsi
                document.getElementById("modalGambar").src = gambar; // Gambar dalam kartu
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
                document.getElementById("deleteForm").action = `/karya-anak/hapus/${id}`;
            });
        });
    });
</script>
@endsection

