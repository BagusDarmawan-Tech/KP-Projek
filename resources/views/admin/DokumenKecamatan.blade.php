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
            <div class="d-flex justify-content-end mb-1">
                @if (auth()->user()->hasPermissionTo('dokumen kecamatan-add'))
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dokumenKelurahanModal">
                    <i class="bi bi-plus"></i> Dokumen Kecamatan
                </button>
                @endif
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle text-center" id="myTable">
                <thead class="table-primary">
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Jenis Dokumen</th>
                        <th class="text-center">Kecamatan</th>
                        <th class="text-center">Data Dukung</th>
                        <th class="text-center">Dibuat Oleh</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dokumens as $index => $dokumen)
                    <tr>
                        <td style="text-align: center;">{{ $loop->iteration }}</td>
                        <td> {{ $dokumen->surat ? $dokumen->surat->nama : 'Tidak ada pengguna' }}</td>
                        <td> {{ $dokumen->kecamatan ? $dokumen->kecamatan->nama : 'Tidak ada pengguna' }}</td>
                        <td>
                            <a href="{{ asset($dokumen->dataPendukung) }}" target="_blank">
                                <i class="fas fa-file-pdf text-danger fa-2x"></i>
                            </a>
                        </td>
                        <td>{{ $dokumen->user ? $dokumen->user->name : 'Tidak ada pengguna' }}</td>
                        <td>
                            @if($dokumen->is_active == 0)
                            <span class="badge bg-warning">Non Aktif</span>
                            @else
                                <span class="badge bg-success">Aktif</span>
                            @endif
                        </td>                        
                        <td>
                        @if (auth()->user()->hasPermissionTo('dokumen kecamatan-edit'))
                            <button class="btn btn-sm btn-primary btn-dokumen"
                                data-id="{{ $dokumen->id }}"
                                data-nama="{{ $dokumen->nama }}"
                                data-file="{{ asset($dokumen->dataPendukung) }}"
                                data-status="{{ $dokumen->is_active }}"
                                data-jenisSurat="{{ $dokumen->jenis_suratid }}"
                                data-kecamatan="{{ $dokumen->kecamatanid }}"
                                data-keterangan="{{ $dokumen->keterangan }}"
                                data-status="{{ $dokumen->is_active }}"
                                data-bs-toggle="modal"
                                data-bs-target="#editDokumenModal">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                        @endif                            
                                <!-- Tombol Hapus -->
                        @if (auth()->user()->hasPermissionTo('dokumen kecamatan-delete'))
                                <button class="btn btn-sm btn-danger delete-btn" 
                                    data-id  ="{{ $dokumen->id }}"
                                    data-nama ="{{ $dokumen->nama }}"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteMenuModal"><i class="bi bi-trash"></i>
                                </button>   
                        @endif                       
                            </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


<!-- Modal Tambah Dokumen Kecamatan -->
<div class="modal fade" id="dokumenKelurahanModal" tabindex="-1" aria-labelledby="dokumenKelurahanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header d-flex flex-column align-items-center">
            <h5 class="modal-title fw-bold text-center mb-0" id="dokumenKelurahanModalLabel">
                Tambah Dokumen Kecamatan Baru
            </h5>
            <!-- <button type="button" class="btn-close position-absolute end-0 top-0" data-bs-dismiss="modal" aria-label="Close"></button> -->
        </div>

            <div class="modal-body">
                <form method="POST" id="myForm" action="{{ route('createDokumenKecamatan') }}" enctype="multipart/form-data">
                    @csrf 
                    <div class="mb-3">
                        <label for="kegiatan" class="form-label">Kecamatan</label>
                        <select class="form-select" id="kegiatan" name="kecamatanid" required>
                            <option value="" disabled selected>-- Pilih Kecamatan --</option>
                            @foreach ($kecamatans as $kecamatan)
                                <option value="{{ $kecamatan->id }}" {{ old('subkegiatanid') == $kecamatan->id ? 'selected' : '' }} >
                                    {{ $kecamatan->nama }}
                                </option>
                            @endforeach
                        </select>
                     </div>
                    <div class="mb-3">
                        <label for="kegiatan" class="form-label">Jenis Surat</label>
                        <select class="form-select" id="kegiatan" name="jenis_suratid" required>
                            <option value="" disabled selected>-- Pilih Surat --</option>
                            @foreach ($surats as $surat)
                                <option value="{{ $surat->id }}" {{ old('subkegiatanid') == $surat->id ? 'selected' : '' }} >
                                    {{ $surat->nama }}
                                </option>
                            @endforeach
                        </select>
                     </div>
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" value="{{ old('nama') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Data Dukung</label>
                        <input type="file" class="form-control" name="dataPendukung" accept="application/pdf">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea class="form-control" name="keterangan">{{ old('keterangan') }}</textarea>
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

<script>
    document.getElementById('myForm').addEventListener('submit', function() {
        document.getElementById('submitBtn').disabled = true;
    });
</script>

<!-- Modal Edit Dokumen Kecamatan -->
<div class="modal fade" id="editDokumenModal" tabindex="-1" aria-labelledby="editDokumenModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex flex-column align-items-center">
                <h5 class="modal-title fw-bold text-center" id="editDokumenModalLabel">Edit Dokumen Kecamatan</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body">
                <form id="editDokumenForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editId" name="id">
                    <div class="mb-3">
                        <label for="kegiatan" class="form-label">Kecamatan</label>
                        <select class="form-select" id="editKecamatan" name="kecamatanid" required>
                            <option value="" disabled selected>-- Pilih Kecamatan --</option>
                            @foreach ($kecamatans as $kecamatan)
                                <option value="{{ $kecamatan->id }}" {{ old('subkegiatanid') == $kecamatan->id ? 'selected' : '' }} >
                                    {{ $kecamatan->nama }}
                                </option>
                            @endforeach
                        </select>
                     </div>
                    <div class="mb-3">
                        <label for="kegiatan" class="form-label">Jenis Surat</label>
                        <select class="form-select" id="editJenisSurat" name="jenis_suratid" required>
                            <option value="" disabled selected>-- Pilih Surat --</option>
                            @foreach ($surats as $surat)
                                <option value="{{ $surat->id }}" {{ old('subkegiatanid') == $surat->id ? 'selected' : '' }} >
                                    {{ $surat->nama }}
                                </option>
                            @endforeach
                        </select>
                     </div>
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" id="editNama" name="nama">
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
                        <label class="form-label">Keterangan</label>
                        <textarea id="editKeterangan" class="form-control" name="keterangan" ></textarea>
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
</div>
{{-- //update --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".btn-dokumen").forEach(button => {
        button.addEventListener("click", function () {
            let id = this.getAttribute("data-id");
            let nama = this.getAttribute("data-nama");
            let jenisSurat = this.getAttribute("data-jenisSurat");
            let kecamatan = this.getAttribute("data-kecamatan");
            let file = this.getAttribute("data-file");
            let keterangan = this.getAttribute("data-keterangan");
            let status = this.getAttribute("data-status");
            
            document.getElementById("editId").value = id;
            document.getElementById("editNama").value = nama;
            document.getElementById("editJenisSurat").value = jenisSurat;
            document.getElementById("editKecamatan").value = kecamatan;
            document.getElementById("previewFile").href = file;
            document.getElementById("editKeterangan").value = keterangan;
            document.getElementById("editStatus").checked = status == "1";

            // Pastikan action form mengarah ke URL update yang benar
            document.getElementById("editDokumenForm").action = `/dokumenKecamatan/update/${id}`;
         
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
                document.getElementById("deleteForm").action = `/dokumenKecamatan/hapus/${id}`;
            });
        });
    });
  </script>
@endsection
