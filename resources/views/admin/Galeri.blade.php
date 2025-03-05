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
    <div class="card shadow-lg border-0 position-relative overflow-hidden mb-5"> 
        <div class="card-body mt-4">
            <div class="text-center mb-4">
                <h4 class="fw-bold">Galeri</h4>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div></div> <!-- Spacer -->
                @if (auth()->user()->hasPermissionTo('galeri-add'))
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sliderModal">
                    + Galeri
                </button>
                @endif
            </div>

            <!-- Tabel -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle text-center"  id="myTable">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Gambar</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Caption</th>
                            <th class="text-center">Dibuat Oleh</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($galeris as $galeri)
                        <tr>
                            <td style="text-align: center;">{{ $loop->iteration }}</td>
                            <td><img src="{{ asset($galeri->gambar) }}" alt="Gambar Galeri" width="80"></td>
                            <td class="nama">{{ $galeri->nama }}</td>
                            <td class="caption">{{ $galeri->caption }}</td>
                            <td>{{ $galeri->user ? $galeri->user->name : 'Tidak ada pengguna' }}</td>
                            <td>
                                <span class="badge {{ $galeri->is_active ? 'bg-success' : 'bg-danger' }}">
                                    {{ $galeri->is_active ? 'Aktif' : 'Non-Aktif' }}
                                </span>
                            </td>
                            <td>
                                <!-- Button Edit Modal -->
                                @if (auth()->user()->hasPermissionTo('galeri-edit'))
                                <button class="btn btn-sm btn-primary btn-edit"
                                    data-id="{{ $galeri->id }}"
                                    data-nama="{{ $galeri->nama }}"
                                    data-caption="{{ $galeri->caption }}"
                                    data-deskripsi="{{ $galeri->deskripsi }}"
                                    data-gambar="{{ asset($galeri->gambar) }}"
                                    data-status="{{ $galeri->is_active }}"
                                    data-bs-toggle="modal"
                                    data-bs-target="#GaleriEditModal">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                @endif
                        
                                <!-- Tombol Hapus -->
                                @if (auth()->user()->hasPermissionTo('galeri-delete'))
                                <button class="btn btn-sm btn-danger delete-btn" 
                                    data-id  ="{{ $galeri->id }}"
                                    data-nama ="{{ $galeri->nama }}"
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

<!-- Modal Tambah Galeri -->
<div class="modal fade" id="sliderModal" tabindex="-1" aria-labelledby="sliderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('createGaleri') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header d-flex justify-content-center w-100 ">
                    <h5 class="modal-title fw-bold text-center" id="sliderModalLabel">Tambah Galeri Baru</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Isi nama galeri">
                    </div>
                    <div class="mb-3">
                        <label for="caption" class="form-label">Caption</label>
                        <input type="text" class="form-control" id="caption" name="caption" value="{{ old('caption') }}" placeholder="Isi caption yang sesuai ">
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="{{ old('deskripsi') }}" placeholder="Isi deskripsi galeri">
                    </div>
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar</label>
                        <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="is_active" required>
                            <option value="" disabled selected>--- Pilih Status ---</option>
                            <option value="1">Aktif</option>
                            <option value="0">Non-Aktif</option>
                        </select>
                    </div>
                    <input type="hidden" name="dibuatOleh" value="{{ Auth::user()->id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal Edit Galeri -->
<div class="modal fade" id="GaleriEditModal" tabindex="-1" aria-labelledby="GaleriEditModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center w-100">
                <h5 class="modal-title fw-bold text-center" id="GaleriEditModalLabel">Edit Galeri</h5>
            </div>
            <div class="modal-body">
                <form id="editGaleriForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <input type="hidden" id="editId" name="id">

                    <div class="mb-3">
                        <label for="editNama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="editNama" name="nama" required>
                    </div>

                    <div class="mb-3">
                        <label for="editCaption" class="form-label">Caption</label>
                        <input type="text" class="form-control" id="editCaption" name="caption" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" id="editDeskripsi" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editGambar" class="form-label">Edit Gambar</label>
                        <div class="mb-2">
                            <img id="previewGambar" src="" alt="Gambar Saat Ini" width="100" class="rounded border">
                        </div>
                        <input type="file" class="form-control" id="editGambar" name="gambar">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
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


{{-- modaldelete --}}
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



<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".btn-edit").forEach(button => {
            button.addEventListener("click", function () {
                let id = this.getAttribute("data-id");
                let nama = this.getAttribute("data-nama");
                let caption = this.getAttribute("data-caption");
                let gambar = this.getAttribute("data-gambar");
                let status = this.getAttribute("data-status");
                let deskripsi = this.getAttribute("data-deskripsi");

                document.getElementById("editId").value = id;
                document.getElementById("editNama").value = nama;
                document.getElementById("editCaption").value = caption;
                document.getElementById("previewGambar").src = gambar;
                document.getElementById("editStatus").value = status;
                document.getElementById("editDeskripsi").value = deskripsi;

                // Atur form agar mengarah ke URL update yang benar
                document.getElementById("editGaleriForm").action = `/galeri/update/${id}`;
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
                document.getElementById("deleteForm").action = `/galeri/hapus/${id}`;
            });
        });
    });
</script>


@endsection