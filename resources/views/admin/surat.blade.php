@extends('admin.admin-master')
@section('main')
<link href="{{ asset('assets/css/tabel.css') }}" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- <script src="{{ asset('assets/js/hapus.js') }}"></script> -->

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
    <div class="card shadow-lg border-0 position-relative overflow-hidden mb-5">
        <div class="card-body mt-4">
            <div class="text-center">
                <h4 class="fw-bold">Surat Jenis</h4>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <div></div>
                @if (auth()->user()->hasPermissionTo('surat-add'))
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahArtikelModal">+ Jenis Surat</button> 
                @endif
            </div>
            
            <!-- Tombol Tambah Artikel di atas -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle text-center"  id="myTable">
                    <thead class="table-primary text-start">
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($surats as $index => $opd)
                        <tr>
                            <td style="text-align: center;">{{ $loop->iteration }}</td>
                            <td class="text-start">{{ $opd->nama }}</td>
                            <td>
                                @if($opd->is_active == 0)
                                <span class="badge bg-warning">Non Aktif</span>
                                @else
                                    <span class="badge bg-success">Aktif</span>
                                @endif
                            </td>
                            <td>
                                @if (auth()->user()->hasPermissionTo('surat-edit'))
                                <button class="btn btn-sm btn-primary edit-btn" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editArtikelModal"
                                    data-id="{{ $opd->id }}" 
                                    data-judul="{{ $opd->nama }}" 
                                    data-status="{{ $opd->is_active }}">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                @endif
                                <!-- Button Delete Modal -->
                                @if (auth()->user()->hasPermissionTo('surat-delete'))
                                <button class="btn btn-sm btn-danger delete-btn" 
                                        data-id  ="{{ $opd->id }}"
                                        data-nama ="{{ $opd->nama }}"
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
    </div>
</div>

<!-- Modal Tambah Artikel -->
<div class="modal fade" id="tambahArtikelModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center w-100">
                <h5 class="modal-title fw-bold text-center">Tambah Organisasi Perangkat Daerah</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('createSuratJenis') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="judul" class="form-label">Nama Organisasi Perangkat Daerah</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}">
                    </div>
                    <div class="mb-3">
                        <label for="kategoriStatus" class="form-label">Status</label>
                        <select class="form-select" id="kategoriStatus" name="is_active" required>
                            <option value="" disabled selected>--- Pilih Status ---</option>
                            <option value="1" {{ old('is_active') == "1" ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('is_active') == "0" ? 'selected' : '' }}>Non-Aktif</option>
                        </select>
                    </div>
                    </div>
                    <input type="hidden" name="dibuatOleh" value="{{ Auth::user()->id }}">

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
            <div class="modal-header d-flex justify-content-center w-100">
                <h5 class="modal-title fw-bold text-center" id="menuModalLabel">Edit Organisasi Perangkat Daerah</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
            </div>
            <div class="modal-body">
                <form id="editForm" method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editId" name="id">

                    <div class="mb-3">
                        <label for="editJudul" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="editJudul" name="nama" required>
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





<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".edit-btn").forEach(button => {
            button.addEventListener("click", function() {
                let id = this.getAttribute("data-id");
                let judul = this.getAttribute("data-judul");
                let status = this.getAttribute("data-status");

                document.getElementById("editId").value = id;
                document.getElementById("editJudul").value = judul;
                document.getElementById("editStatus").value = status;
                
                document.getElementById("editForm").action = `/suratJenis/update/${id}`;
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
                document.getElementById("deleteForm").action = `/suratJenis/hapus/${id}`;
            });
        });
    });
</script>

@endsection