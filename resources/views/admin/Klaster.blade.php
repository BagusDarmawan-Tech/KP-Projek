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
                <h4 class="fw-bold">Klaster</h4>
            </div>
            
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div></div> <!-- Spacer -->
                @if (auth()->user()->hasPermissionTo('klaster-add'))
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kategoriModal">
                    + Tambah Klaster
                </button>
                @endif
            </div>

            <!-- Tabel -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle text-center"  id="myTable">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Icon</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Gambar</th>
                            <th class="text-center">Dibuat Oleh</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($klasters as $klaster)
                        <tr>
                            <td style="text-align: center;">{{ $loop->iteration }}</td>
                            <td><i class="{{ $klaster->icon }}"></i></td>
                            <td>{{ $klaster->nama }}</td>
                            <td><img src="{{ asset($klaster->gambar) }}" alt="Gambar" width="50"></td>
                            <td>
                             {{ $klaster->user ? $klaster->user->name : 'Tidak ada pengguna' }}  
                            </td>                           
                            <td>
                                @if($klaster->is_active == 0)
                                <span class="badge bg-warning">Non Aktif</span>
                                @else
                                <span class="badge bg-success">Aktif</span>
                                @endif
                            </td>
                            <td>
                                @if (auth()->user()->hasPermissionTo('klaster-edit'))
                                <button class="btn btn-sm btn-primary edit-klaster"
                                    data-id="{{ $klaster->id }}"
                                    data-nama="{{ $klaster->nama }}"
                                    data-icon="{{ $klaster->icon }}"
                                    data-gambar="{{ asset($klaster->gambar) }}"
                                    data-is_active="{{ $klaster->is_active }}"
                                    data-bs-toggle="modal"
                                    data-bs-target="#EditModal">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                @endif
                                <!-- Button Delete Modal -->
                                @if (auth()->user()->hasPermissionTo('klaster-delete'))
                                <button class="btn btn-sm btn-danger delete-btn" 
                                    data-id  ="{{ $klaster->id }}"
                                    data-nama ="{{ $klaster->nama }}"
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


<!-- Modal Tambah Klaster -->
<div class="modal fade" id="kategoriModal" tabindex="-1" aria-labelledby="kategoriModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center w-100 ">
                <h5 class="modal-title fw-bold text-center" id="kategoriModalLabel">Tambah Menu Klaster Baru</h5>
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
                <form method="POST" action="{{ route('createKlaster') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="kategoriIcon" class="form-label">Icon</label>
                        <select class="form-select" id="kategoriIcon" name="icon">
                            <option value="bi-house" {{ old('icon') == 'bi-house' ? 'selected' : '' }}>🏠 Home</option>
                            <option value="bi-person" {{ old('icon') == 'bi-person' ? 'selected' : '' }}>👤 User</option>
                            <option value="bi-gear" {{ old('icon') == 'bi-gear' ? 'selected' : '' }}>⚙️ Settings</option>
                            <option value="bi-envelope" {{ old('icon') == 'bi-envelope' ? 'selected' : '' }}>✉️ Mail</option>
                            <option value="bi-bell" {{ old('icon') == 'bi-bell' ? 'selected' : '' }}>🔔 Notification</option>
                            <option value="bi-chat-dots" {{ old('icon') == 'bi-chat-dots' ? 'selected' : '' }}>💬 Chat</option>
                            <option value="bi-calendar" {{ old('icon') == 'bi-calendar' ? 'selected' : '' }}>📅 Calendar</option>
                            <option value="bi-camera" {{ old('icon') == 'bi-camera' ? 'selected' : '' }}>📷 Camera</option>
                            <option value="bi-cart" {{ old('icon') == 'bi-cart' ? 'selected' : '' }}>🛒 Cart</option>
                            <option value="bi-heart" {{ old('icon') == 'bi-heart' ? 'selected' : '' }}>❤️ Favorite</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="kategoriNama" class="form-label">Nama</label>
                        <input type="text" class="form-control"  id="nama" name="nama" value="{{ old('nama') }}" placeholder="Masukkan Nama">
                    </div>

                    <div class="mb-3">
                        <label for="kategoriGambar" class="form-label">Gambar</label>
                        <input type="file" class="form-control" id="gambar" name="gambar">
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

<!-- Modal edit -->
<div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="EditModalLabel" aria-hidden="true">
<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center w-100 ">
                <h5 class="modal-title fw-bold text-center" id="EdiEditModal">Edit Klaster</h5>
            </div>
            <div class="modal-body">
                <form id="editKlasterForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <input type="hidden" id="editId" name="id">

                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" id="editNama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Icon</label>
                        <input type="text" class="form-control" id="editIcon" name="icon" required>
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


<!-- {{-- <update --}} -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".edit-klaster").forEach(button => {
            button.addEventListener("click", function () {
                let id = this.getAttribute("data-id");
                let nama = this.getAttribute("data-nama");
                let icon = this.getAttribute("data-icon");
                let gambar = this.getAttribute("data-gambar");
                let status = this.getAttribute("data-is_active");

                document.getElementById("editId").value = id;
                document.getElementById("editNama").value = nama;
                document.getElementById("editIcon").value = icon;
                document.getElementById("editStatus").checked = status == "1";
                document.getElementById("previewGambar").src = gambar;

                // Atur action form agar mengarah ke URL update dengan ID
                document.getElementById("editKlasterForm").action = `/klaster/update/${id}`;
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
                document.getElementById("deleteForm").action = `/klaster/hapus/${id}`;
            });
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var kategoriModal = new bootstrap.Modal(document.getElementById("kategoriModal"));
    });
</script>



@endsection