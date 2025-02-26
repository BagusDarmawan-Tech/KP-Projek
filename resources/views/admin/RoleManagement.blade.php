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
                <h4 class="fw-bold">Role Management</h4>
            </div>
            
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div></div> <!-- Spacer -->
                @if (auth()->user()->hasPermissionTo('role management-add'))
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kategoriModal">
                    + Tambah Role
                </button>
                @endif
            </div>

            <!-- Tabel -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle text-center" id="myTable">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role )
                        <tr>
                            <td style="text-align: center;">{{ $loop->iteration }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                @if (auth()->user()->hasPermissionTo('role management-edit'))
                                <a href="{{ route('EditRole', $role->id) }}">
                                    <button class="btn btn-sm btn-primary edit-btn">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                </a>
                                @endif
                                
                                @if (auth()->user()->hasPermissionTo('role management-delete'))
                                <button class="btn btn-sm btn-danger delete-btn" 
                                    data-id  ="{{ $role->id }}"
                                    data-nama ="{{ $role->name }}"
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


<!-- Modal Tambah -->
<div class="modal fade" id="kategoriModal" tabindex="-1" aria-labelledby="kategoriModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center w-100">
                @if (auth()->user()->hasPermissionTo('role management-list'))
                <h5 class="modal-title fw-bold text-center" id="kategoriModalLabel">Tambah Menu Role Management</h5>
                @endif
            </div>
            <div class="modal-body">
            <form action="{{ route('storeRoleManagement') }}" method="POST">
                    @csrf
                    <!-- Input Nama -->
                    <div class="mb-3">
                        <label for="kategoriNama" class="form-label">Nama</label>
                        <input type="text" name="name" class="form-control" id="kategoriNama" placeholder="Masukkan Nama">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Daftar Akses -->
                    <div class="mb-3">
                        <label for="akses" class="form-label">Akses</label>
                        @error('permissions')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="table-responsive " style="max-height: 300px; overflow-y: auto; border: 1px solid #ddd;">
                            <table class="table table-bordered table-hover "  id="myTable">
                                <thead class="table-light" style="position: sticky; top: 0; z-index: 2;">
                                    <tr>
                                        <th>Nama Menu</th>
                                        <th><input type="checkbox" id="checkAllList"> List</th>
                                        <th><input type="checkbox" id="checkAllAdd"> Add</th>
                                        <th><input type="checkbox" id="checkAllEdit"> Edit</th>
                                        <th><input type="checkbox" id="checkAllDelete"> Delete</th>
                                        <th><input type="checkbox" id="checkAllVerify"> Verifikasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $menu => $perms)
                                    <tr>
                                        <td>{{ $menu }}</td>
                                        @foreach($perms as $index => $perm)
                                            <td>
                                                <input type="checkbox" class="check-{{ $perm }}" name="permissions[]" value="{{ strtolower($menu) . '-' . $perm }}">
                                            </td>
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <!-- Tombol Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
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



<script>
    document.addEventListener("DOMContentLoaded", function () {
        var kategoriModal = new bootstrap.Modal(document.getElementById("kategoriModal"));
    });
</script>

<script>
    // Fungsi untuk checklist semua checkbox dalam satu kolom
    document.getElementById('checkAllList').addEventListener('change', function() {
        let checkboxes = document.querySelectorAll('.check-list');
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
    });

    document.getElementById('checkAllAdd').addEventListener('change', function() {
        let checkboxes = document.querySelectorAll('.check-add');
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
    });

    document.getElementById('checkAllEdit').addEventListener('change', function() {
        let checkboxes = document.querySelectorAll('.check-edit');
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
    });

    document.getElementById('checkAllDelete').addEventListener('change', function() {
        let checkboxes = document.querySelectorAll('.check-delete');
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
    });

    document.getElementById('checkAllVerify').addEventListener('change', function() {
        let checkboxes = document.querySelectorAll('.check-verifikasi');
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
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
                document.getElementById("deleteForm").action = `/role/delete/${id}`;
            });
        });
    });
</script>




@endsection