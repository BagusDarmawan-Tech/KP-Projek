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
                <h4 class="fw-bold">Sub Kegiatan</h4>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div></div> <!-- Spacer -->
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#subKegiatanModal">
                    + Sub Kegiatan
                </button>
            </div>

            <!-- Tabel -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle text-center"  id="myTable">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center" >No</th>
                            <th class="text-center" >Klaster</th>
                            <th class="text-center" >Nama Sub Kegiatan</th>
                            <th class="text-center" >Data Dukung</th>
                            <th class="text-center" >Dibuat Oleh</th>
                            <th class="text-center" >Status</th>
                            <th class="text-center" >Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($subKegiatans as $subKegiatan)
                        <tr>
                            <td style="text-align: center;">{{ $loop->iteration }}</td>
                            <td>{{ $subKegiatan->user ? $subKegiatan->user->nama : 'Tidak ada pengguna' }}</td>
                            <td>{{ $subKegiatan->nama }}</td>
                            <td>
                                <a href="{{ asset($subKegiatan->dataPendukung) }}" target="_blank">
                                    <i class="fas fa-file-pdf text-danger fa-2x"></i>
                                </a>
                            </td>
                            <td>{{ $subKegiatan->dibuatOleh }}</td>
                            <td>
                                <span class="badge {{ $subKegiatan->is_active ? 'bg-success' : 'bg-warning' }}">
                                    {{ $subKegiatan->is_active ? 'Aktif' : 'Non-Aktif' }}
                                </span>
                            </td>
                            <td>
                                <!-- Button Edit Modal -->
                                <button class="btn btn-sm btn-primary btn-edit"
                                    data-id="{{ $subKegiatan->id }}"
                                    data-nama="{{ $subKegiatan->nama }}"
                                    data-file="{{ asset('storage/' . $subKegiatan->dataPendukung) }}"
                                    data-status="{{ $subKegiatan->is_active }}"
                                    data-klaster="{{ $subKegiatan->klusterid }}"
                                    data-keterangan="{{ $subKegiatan->keterangan }}"
                                    data-bs-toggle="modal"
                                    data-bs-target="#SubKegiatanEditModal">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                
                        
                                <!-- Tombol Hapus -->
                                <button class="btn btn-sm btn-danger delete-btn" 
                                    data-id  ="{{ $subKegiatan->id }}"
                                    data-nama ="{{ $subKegiatan->nama }}"
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

<!-- Modal Tambah Sub Kegiatan -->
<div class="modal fade" id="subKegiatanModal" tabindex="-1" aria-labelledby="subKegiatanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center w-100 ">
                <h5 class="modal-title fw-bold text-center" id="menuModalLabel">Tambah Sub Kegiatan</h5>
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
                <form method="POST" action="{{ route('createSubKegiatan') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Klaster</label>
                        <select class="form-select" name="klusterid" required>
                            <option value="" disabled selected>--- Pilih Klaster ---</option>
                            @foreach ($klasters as $klaster)
                            <option value="{{ $klaster->id }}" {{ old('klasterid') == $klaster->id ? 'selected' : '' }}>
                                {{ $klaster->nama }}
                            </option>       
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="namaSubKegiatan" value="{{ old('nama') }}" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="dataDukung" class="form-label">Data Dukung</label>
                        <input type="file" class="form-control" id="dataPendukung" name="dataPendukung" accept=".pdf">
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input type="text" value="{{ old('keterangan') }}" class="form-control" id="keterangan" name="keterangan">
                    </div>
                    <div class="mb-3">
                        <label for="kategoriStatus" class="form-label">Status</label>
                        <select class="form-select" id="kategoriStatus" name="is_active" value="{{ old('is_active') }}" required>
                            <option value="" disabled selected>--- Pilih Status ---</option>
                            <option value="1" {{ old('is_active') == "1" ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('is_active') == "0" ? 'selected' : '' }}>Non-Aktif</option>
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


<!-- Modal Edit Sub Kegiatan -->
<div class="modal fade" id="SubKegiatanEditModal" tabindex="-1" aria-labelledby="SubKegiatanEditModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center w-100">
                <h5 class="modal-title fw-bold text-center" id="SubKegiatanEditModalLabel">Edit Sub Kegiatan</h5>
            </div>
            <div class="modal-body">
                <form id="editSubKegiatanForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <input type="hidden" id="editId" name="id">

                    <div class="mb-3">
                        <label for="editNama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="editNama" name="nama" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Klaster</label>
                        <select class="form-select" name="klusterid" id="editKlaster" required>
                            @foreach ($klasters as $klaster)
                                <option value="{{ $klaster->id }}">{{ $klaster->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea class="form-control" name="keterangan" id="editKeterangan" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editFile" class="form-label">Edit File Data Pendukung</label>
                        <div class="mb-2">
                            <a id="previewFile" href="#" target="_blank" class="btn btn-secondary btn-sm">Lihat File Saat Ini</a>
                        </div>
                        <input type="file" class="form-control" id="editFile" name="dataPendukung">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah file.</small>
                    </div>

                    <div class="mb-3">
                        <label for="editStatus" class="form-label">Status</label>
                        <select class="form-select" id="editStatus" name="is_active" required>
                            <option value="1">Aktif</option>
                            <option value="0">Non-Aktif</option>
                        </select>
                    </div>
                    </div>
                    <div class="modal-footer border-top pt-3 d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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




{{-- Bagian edit --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".btn-edit").forEach(button => {
        button.addEventListener("click", function () {
            let id = this.getAttribute("data-id");
            let nama = this.getAttribute("data-nama");
            let klaster = this.getAttribute("data-klaster");
            let file = this.getAttribute("data-file");
            let status = this.getAttribute("data-status");
            let keterangan = this.getAttribute("data-keterangan");

            document.getElementById("editId").value = id;
            document.getElementById("editNama").value = nama;
            document.getElementById("editKlaster").value = klaster;
            document.getElementById("previewFile").href = file;
            document.getElementById("editStatus").value = status;
            document.getElementById("editKeterangan").value = keterangan;

            // Pastikan action form mengarah ke URL update yang benar
            document.getElementById("editSubKegiatanForm").action = `/subKegiatan/update/${id}`;
         
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
                document.getElementById("deleteForm").action = `/subKegiatan/hapus/${id}`;
            });
        });
    });
</script>


@endsection
