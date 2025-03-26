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
            <div class="text-center mb-4">
                <h4 class="fw-bold">Artikel Mitra Anak</h4>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div></div>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahArtikelModal">+ Artikel Mitra Anak</button> 
            </div>
            
            <!-- Tombol Tambah Artikel di atas -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle text-center"  id="myTable">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Gambar</th>
                            <th class="text-center">Nama Kategori</th>
                            <th class="text-center">Judul</th>
                            <th class="text-center">Dibuat Oleh</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($artikels as $index => $artikel)
                        <tr>
                            <td style="text-align: center;">{{ $loop->iteration }}</td>
                            <td><img src="{{ asset($artikel->gambar) }}" alt="Slider Image" width="80"></td>
                            <td> {{ $artikel->kategori ? $artikel->kategori->nama : 'Tidak ada kategori' }}</td>
                            <td>{{ $artikel->judul }}</td>
                            <td>{{ $artikel->user ? $artikel->user->name : 'Tidak ada pengguna' }}</td>
                            <td>
                                @if($artikel->is_active == 0)
                                <span class="badge bg-warning">Non Aktif</span>
                                @else
                                    <span class="badge bg-success">Aktif</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-sm btn-primary edit-btn" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editArtikelModal"
                                    data-id="{{ $artikel->id }}" 
                                    data-judul="{{ $artikel->judul }}" 
                                    data-tag="{{ $artikel->tag }}" 
                                    data-konten="{{ $artikel->konten }}" 
                                    data-status="{{ $artikel->is_active }}"
                                    data-gambar="{{ asset($artikel->gambar) }}"
                                    data-kategoriartikelid="{{ $artikel->kategoriartikelid }}">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <!-- Button Delete Modal -->
                                <button class="btn btn-sm btn-danger delete-btn" 
                                        data-id  ="{{ $artikel->id }}"
                                        data-nama ="{{ $artikel->judul }}"
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

<!-- Modal Tambah Artikel -->
<div class="modal fade" id="tambahArtikelModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center w-100">
                <h5 class="modal-title fw-bold text-center">Tambah Artikel</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('createArtikelMitra') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukan Judul Artikel" value="{{ old('judul') }}">
                    </div>
                    <div class="mb-3">
                        <label for="tag" class="form-label">Tag</label>
                        <input type="text" class="form-control" id="tag" placeholder="Masukan Tag yang sesuai artikel" name="tag" value="{{ old('tag') }}">
                    </div>
                    <div class="mb-3">
                        <label for="kategoriartikelid" class="form-label">Kategori Artikel</label>
                        <select class="form-select" id="kategoriartikelid" name="kategoriartikelid">
                            <option value="" disabled selected>-- Pilih Kategori Artikel--</option>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" {{ old('kategoriartikelid') == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>                    
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar</label>
                        <input type="file" class="form-control" id="gambar" name="gambar" required>
                    </div>
                    <div class="mb-3">
                        <label for="konten" class="form-label">Konten</label>
                        <textarea class="form-control" placeholder="Masukan deskripsi konten dari artikel" id="konten" rows="3" name="konten" value="{{ old('konten') }}"></textarea>
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
                <h5 class="modal-title fw-bold text-center" id="menuModalLabel">Edit Artikel</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
            </div>
            <div class="modal-body">
                <form id="editForm" method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editId" name="id">

                    <div class="mb-3">
                        <label for="editJudul" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="editJudul" name="judul" required>
                    </div>
                    <div class="mb-3">
                        <label for="tag" class="form-label">Tag</label>
                        <input type="text" class="form-control" id="editTag" name="tag">
                    </div>
                    <div class="mb-3">
                        <label for="editKategori" class="form-label">Kategori Artikel</label>
                        <select class="form-select" id="editKategori" name="kategoriartikelid">
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                            @endforeach
                        </select>
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
                        <label for="editKonten" class="form-label">Konten</label>
                        <textarea class="form-control" id="editKonten" rows="3" name="konten"></textarea>
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
                let konten = this.getAttribute("data-konten");
                let status = this.getAttribute("data-status");
                let gambar = this.getAttribute("data-gambar");
                let tag = this.getAttribute("data-tag");

                document.getElementById("editId").value = id;
                document.getElementById("editJudul").value = judul;
                document.getElementById("editKonten").value = konten;
                document.getElementById("editStatus").checked = status == "1";
                document.getElementById("editTag").value = tag;
                document.getElementById("previewGambar").src = gambar;

                
                document.getElementById("editForm").action = `/artikelMitra/update/${id}`;
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
                document.getElementById("deleteForm").action = `/artikelMitra/hapus/${id}`;
            });
        });
    });
</script>

@endsection