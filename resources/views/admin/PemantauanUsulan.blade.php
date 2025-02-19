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
                <h4 class="fw-bold">Pemantauan Usulan Anak</h4>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div></div> <!-- Spacer -->
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pemantauanModal">
                    + Tambah Usulan
                </button>
            </div>

            <!-- Tabel -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle text-center"  id="myTable">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>OPD</th>
                            <th>OPD Terlibat</th>
                            <th>Nama Usulan</th>
                            <th>Tindak Lanjut</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usulans as $usulan )
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td> {{ $usulan->user ? $usulan->user->name : 'Tidak ada pengguna' }}</td>
                            <td> {{ $usulan->user ? $usulan->user->name : 'Tidak ada pengguna' }}</td>
                            <td>{{ $usulan->namaUsulan }}</td>
                            <td>{{ $usulan->tindakLanjut }}</td>
                            <td>
                                @if($usulan->is_active == 0)
                                <span class="badge bg-warning">Non Aktif</span>
                                @else
                                    <span class="badge bg-success">Aktif</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-sm btn-primary edit-btn" data-bs-toggle="modal" data-bs-target="#editPemantauanModal" 
                                    data-id="{{ $usulan->id }}" 
                                    data-namaUsulan="{{ $usulan->namaUsulan }}" 
                                    data-keterangan="{{ $usulan->keterangan }}" 
                                    data-status="{{ $usulan->is_active }}"
                                    data-tindakLanjut="{{ $usulan->tindakLanjut }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>                                  
                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteMenuModal"><i class="bi bi-trash"></i></button>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Usulan -->
<div class="modal fade" id="pemantauanModal" tabindex="-1" aria-labelledby="pemantauanModalLabel" aria-hidden="true">
<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center w-100 ">
                <h5 class="modal-title fw-bold text-center" id="menuModalLabel">Tambah Menu Pemantauan Usulan Anak</h5>
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
                <form method="POST" action="{{ route('createPemantauanUsulan') }}" >
                    @csrf 
                    <input type="hidden" name="userid" value="{{ Auth::user()->id }}">
                    <div class="mb-3">
                        <label for="namaUsulan" class="form-label">Nama Usulan</label>
                        <input type="text" class="form-control"  id="namaUsulan" name="namaUsulan" value="{{ old('namaUsulan') }}">
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control" id="keterangan" rows="2" name="keterangan" value="{{ old('keterangan') }}"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Usulan -->
<div class="modal fade" id="editPemantauanModal" tabindex="-1" aria-labelledby="editPemantauanModalLabel" aria-hidden="true">
<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center w-100 ">
                <h5 class="modal-title fw-bold text-center" id="menuModalLabel">Edit Pemantauan Usulan Anak</h5>
            </div>
            <div class="modal-body">
<form id="editForm" method="POST">
    @csrf
    @method('PUT')
    <input type="hidden" id="editId" name="id"> <!-- Tambahkan input hidden untuk ID -->
    
    <div class="mb-3">
        <label for="editTindakLanjut" class="form-label">Tindak Lanjut</label>
        <select class="form-select" id="editTindakLanjut" name="tindakLanjut">
            <option value="Diproses">Diproses</option>
            <option value="Telah Diproses">Telah Diproses</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="editNamaUsulan" class="form-label">Nama Usulan</label>
        <input type="text" class="form-control" id="editNamaUsulan" name="namaUsulan">
    </div>

    <div class="mb-3">
        <label for="editKeterangan" class="form-label">Keterangan</label>
        <textarea class="form-control" id="editKeterangan" rows="2" name="keterangan"></textarea>
    </div>

    <div class="mb-3">
        <label for="editStatus" class="form-label">Status</label>
        <select class="form-select" id="editStatus" name="is_active" required>
            <option value="1">Aktif</option>
            <option value="0">Non-Aktif</option>
        </select>
    </div>
</div>
    <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </div>
</form>

            </div>
        </div>
    </div>
</div>


<!-- Modal delete -->
<div class="modal fade" id="deleteMenuModal" tabindex="-1" aria-labelledby="deleteMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteMenuModalLabel">Hapus Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus Data di Menu ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger">Hapus</button>
            </div>
        </div>
    </div>
</div>
 

<!-- Script untuk Mengisi Data ke Modal -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".edit-btn").forEach(button => {
        button.addEventListener("click", function() {
            let id = this.getAttribute("data-id");
            let namaUsulan = this.getAttribute("data-namaUsulan");
            let keterangan = this.getAttribute("data-keterangan");
            let tindakLanjut = this.getAttribute("data-tindakLanjut");
            let status = this.getAttribute("data-status");

            document.getElementById("editId").value = id;
            document.getElementById("editNamaUsulan").value = namaUsulan;
            document.getElementById("editTindakLanjut").value = tindakLanjut;
            document.getElementById("editKeterangan").value = keterangan;
            document.getElementById("editStatus").checked = status === "1"; // Pastikan status diubah ke boolean

            // Set action form update sesuai ID
            document.getElementById("editForm").action = `/pemantauan/update/${id}`;
        });
    });
});

</script>

@endsection
