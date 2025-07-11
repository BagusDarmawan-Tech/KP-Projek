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
                <h4 class="fw-bold">Kategori Artikel</h4>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div></div> <!-- Spacer -->
                @if (auth()->user()->hasPermissionTo('kategori artikel-add'))
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kategoriModal">
                    + Kategori Artikel
                </button>
                @endif
            </div>


            <!-- Tabel -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle text-center"  id="myTable">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Kategori</th>
                            <th class="text-center">Dibuat Oleh</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kategori_artikel as $kategori)
                        <tr>
                            <td style="text-align: center;">{{ $loop->iteration }}</td>
                            <td>{{ $kategori->nama }}</td>
                            <td>{{ $kategori->user ? $kategori->user->name : 'Tidak ada pengguna' }}</td>
                            <td>
                                @if($kategori->is_active == 0)
                                <span class="badge bg-warning">Non Aktif</span>
                                @else
                                    <span class="badge bg-success">Aktif</span>
                                @endif
                            </td>
                            <td>
                                @if (auth()->user()->hasPermissionTo('kategori artikel-edit'))
                                <button class="btn btn-sm btn-primary edit-btn" data-bs-toggle="modal" data-bs-target="#editMenuModal" 
                                    data-id="{{ $kategori->id }}" 
                                    data-nama="{{ $kategori->nama }}" 
                                    data-status="{{ $kategori->is_active }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>    
                                @endif      
                                
                                @if (auth()->user()->hasPermissionTo('kategori artikel-delete'))
                                <button class="btn btn-sm btn-danger delete-btn" 
                                    data-id  ="{{ $kategori->id }}"
                                    data-nama ="{{ $kategori->nama }}"
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

<!-- Modal Tambah Kategori Artikel -->
<div class="modal fade" id="kategoriModal" tabindex="-1" aria-labelledby="kategoriModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center w-100 ">
                <h5 class="modal-title fw-bold text-center" id="kategoriModalLabel">Tambah Menu Kategori Baru</h5>
            </div>
            <div class="modal-body"> 
                <form method="POST" id="myForm" action="{{ route('createKategoriArtikel') }}">
                    @csrf    
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" id="nama" placeholder="Masukan Nama Kategori" name="nama" value="{{ old('nama') }}" >
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
            
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>

                        <button type="submit" id="submitBtn" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('myForm').addEventListener('submit', function() {
        document.getElementById('submitBtn').disabled = true;
    });
</script>

{{-- END Modal Succes --}}

<!-- Modal Edit Menu -->
<div class="modal fade" id="editMenuModal" tabindex="-1" aria-labelledby="editMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center w-100">
                <h5 class="modal-title fw-bold text-center" id="editMenuModalLabel">Edit Kategori Artikel</h5>
            </div>
    
            <div class="modal-body">
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT') <!-- Gunakan method PUT untuk update -->

                    <input type="hidden" id="editId" name="id"> <!-- Menyimpan ID Kategori -->
                    <div class="mb-3">
                        <label for="editNama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="editNama" name="nama" required>
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

                    
                    <input type="hidden" name="dibuatOleh" value="{{ Auth::user()->name }}">
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" form="editForm">Simpan Perubahan</button>
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
                    <p>Apakah Anda yakin ingin menghapus Kategori Artikel<br> <strong id="deleteNama"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Script untuk Mengisi Data ke Modal -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".edit-btn").forEach(button => {
            button.addEventListener("click", function() {
                let id = this.getAttribute("data-id");
                let nama = this.getAttribute("data-nama");
                let status = this.getAttribute("data-status");

                document.getElementById("editId").value = id;
                document.getElementById("editNama").value = nama;
                document.getElementById("editStatus").checked = status == "1";;

                // Set action form update sesuai ID kategori
                document.getElementById("editForm").action = `/kategori-artikel/update/${id}`;
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
                document.getElementById("deleteForm").action = `/kategori/hapus/${id}`;
            });
        });
    });
</script>

@endsection
