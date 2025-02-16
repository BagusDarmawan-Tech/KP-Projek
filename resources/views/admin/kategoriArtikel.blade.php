@extends('admin.admin-master')
@section('main')
<link href="{{ asset('assets/css/tabel.css') }}" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container mt-5">
    <div class="card shadow-lg border-0 position-relative overflow-hidden mb-5"> 
        <div class="card-body mt-4">
            <div class="text-center mb-4">
                <h4 class="fw-bold">Kategori Artikel</h4>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div></div> <!-- Spacer -->
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kategoriModal">
                    + Kategori Artikel
                </button>
            </div>


            <!-- Tabel -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle text-center"  id="myTable">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Dibuat Oleh</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kategori_artikel as $kategori)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $kategori->nama }}</td>
                            <td>{{ $kategori->dibuatOleh }}</td>
                            <td>
                                @if($kategori->is_active == 0)
                                <span class="badge bg-warning">Non Aktif</span>
                                @else
                                    <span class="badge bg-success">Aktif</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-sm btn-primary edit-btn" data-bs-toggle="modal" data-bs-target="#editMenuModal" 
                                    data-id="{{ $kategori->id }}" 
                                    data-nama="{{ $kategori->nama }}" 
                                    data-status="{{ $kategori->is_active }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>                           
                                <button class="btn btn-sm btn-danger delete-slider"><i class="bi bi-trash"></i> </button>
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
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            var kategoriModal = new bootstrap.Modal(document.getElementById('kategoriModal'), {
                            });
                            kategoriModal.show();
                        });
                    </script>
                @endif
            
                <form method="POST" action="{{ route('createKategoriArtikel') }}">
                    @csrf    
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" required>
                    </div>
            
                    <div class="mb-3">
                        <label for="kategoriStatus" class="form-label">Status</label>
                        <select class="form-select" id="kategoriStatus" name="is_active" required>
                            <!-- <option value="" disabled selected>--- Pilih Status ---</option> -->
                            <option value="1" {{ old('is_active') == "1" ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('is_active') == "0" ? 'selected' : '' }}>Non-Aktif</option>
                        </select>
                    </div>
            
                    <input type="hidden" name="dibuatOleh" value="{{ Auth::user()->name }}">
            
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Sukses -->
@if(session('success'))
<!-- Modal Sukses -->
<div class="modal fade show d-block" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="successModalLabel">
                    <i class="bi bi-check-circle"></i> Berhasil!
                </h5>
            </div>
            <div class="modal-body text-center">
                <p class="text-muted mb-0">{{ session('success') }}</p>
            </div>
            <div class="modal-footer justify-content-center">
                <a href="{{ route('kategoriArtikel') }}" class="btn btn-success px-4">
                    OK
                </a>
            </div>
        </div>
    </div>
</div>
@endif



{{-- END Modal Succes --}}

<!-- Modal Edit Menu -->
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
                        <label for="editStatus" class="form-label">Status</label>
                        <select class="form-select" id="editStatus" name="is_active" required>
                            <option value="1">Aktif</option>
                            <option value="0">Non-Aktif</option>
                        </select>
                    </div>
                    
                    <input type="hidden" name="dibuatOleh" value="{{ Auth::user()->name }}">
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="editForm">Update</button>
            </div>
        </div>
    </div>
</div>


<!-- Bagian Delete Menu -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".delete-slider").forEach(button => {
            button.addEventListener("click", function () {
                Swal.fire({
                    title: "<b>Apakah Anda Yakin!</b>",
                    text: "Akan Menghapus Data ini!",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#6c757d",
                    confirmButtonText: "CONFIRM",
                    cancelButtonText: "CANCEL",
                    customClass: {
                        title: 'fw-bold',
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Dihapus!",
                            text: "Data telah berhasil dihapus.",
                            icon: "success"
                        });
                    }
                });
            });
        });
    });
    </script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var kategoriModal = new bootstrap.Modal(document.getElementById("kategoriModal"));
    });
</script>


<!-- Script untuk Menampilkan Modal Jika Ada Pesan Sukses -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        @if(session('success'))
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
        @endif
    });
</script>


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
                document.getElementById("editStatus").value = status;

                // Set action form update sesuai ID kategori
                document.getElementById("editForm").action = `/kategori-artikel/update/${id}`;
            });
        });
    });
</script>

@endsection
