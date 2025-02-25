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
                @if (auth()->user()->hasPermissionTo('pemantauan usulan-add'))
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pemantauanModal">
                    + Tambah Usulan
                </button>
                @endif
            </div>

            <!-- Tabel -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle text-center"  id="myTable">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">OPD</th>
                            <th class="text-center">Nama Usulan</th>
                            <th class="text-center">Keterangan</th>
                            <th class="text-center">Tindak Lanjut</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usulans as $usulan )
                        <tr>
                            <td style="text-align: center;">{{ $loop->iteration }}</td>

                            <td> {{ $usulan->opd ? $usulan->opd->nama : 'Tidak ada pengguna' }}</td>
                            <td>{{ $usulan->namaUsulan }}</td>

                            <!-- Keterangan -->
                            <td>
                                <a href="#" 
                                class="lihat-keterangan" 
                                data-bs-toggle="modal" 
                                data-bs-target="#keteranganModal"
                                data-keterangan="{{ $usulan->keterangan }}">
                                    Lihat Keterangan
                                </a>
                            </td>
                            <!-- <td>{{ $usulan->keterangan }}</td> -->
                            <td>{{ $usulan->tindakLanjut }}</td>
                            <td>
                                @if($usulan->is_active == 0)
                                <span class="badge bg-warning">Non Aktif</span>
                                @else
                                    <span class="badge bg-success">Aktif</span>
                                @endif
                            </td>
                            <td>    
                                @if (auth()->user()->hasPermissionTo('pemantauan usulan-edit'))
                                <button class="btn btn-sm btn-primary edit-btn" data-bs-toggle="modal" data-bs-target="#editPemantauanModal" 
                                    data-id="{{ $usulan->id }}" 
                                    data-opd="{{ $usulan->opdId }}" 
                                    data-namaUsulan="{{ $usulan->namaUsulan }}" 
                                    data-keterangan="{{ $usulan->keterangan }}" 
                                    data-status="{{ $usulan->is_active }}"
                                    data-tindakLanjut="{{ $usulan->tindakLanjut }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>     
                                @endif                             
                                <!-- Button Delete Modal -->
                                @if (auth()->user()->hasPermissionTo('pemantauan usulan-delete'))
                                <button class="btn btn-sm btn-danger delete-btn" 
                                    data-id  ="{{ $usulan->id }}"
                                    data-nama ="{{ $usulan->namaUsulan }}"
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
                        <label for="opdId" class="form-label">OPD</label>
                         <select class="form-select select2" id="opdId" name="opdId" >
                            <option value="" disabled selected>Pilih OPD</option> <!-- Tidak bisa dipilih -->
                            @foreach ($opds as $opd)
                                <option value="{{ $opd->id }}">{{ $opd->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    
                    <div class="mb-3">
                        <label for="namaUsulan" class="form-label">Nama Usulan</label>
                        <input type="text" class="form-control"  id="namaUsulan" name="namaUsulan" value="{{ old('namaUsulan') }}">
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Tindak Lanjut</label>
                        <textarea class="form-control" id="" rows="2" name="tindakLanjut" value="{{ old('tindakLanjut') }}"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control" id="keterangan" rows="2" name="keterangan" value="{{ old('keterangan') }}"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
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
        <label for="opdId" class="form-label">OPD</label>
         <select class="form-select select2" id="editOpdId" name="opdId" >
            <option value="" disabled selected>Pilih OPD</option> <!-- Tidak bisa dipilih -->
            @foreach ($opds as $opd)
                <option value="{{ $opd->id }}">{{ $opd->nama }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="keterangan" class="form-label">Tindak Lanjut</label>
        <textarea class="form-control" id="editTindakLanjut" rows="2" name="tindakLanjut"></textarea>
    </div>
    <div class="mb-3">
        <label for="editNamaUsulan" class="form-label">Nama Usulan</label>
        <input type="text" class="form-control" id="editNamaUsulan" name="namaUsulan">
    </div>

    <div class="mb-3">
        <label for="editKeterangan" class="form-label">Keterangan</label>
        <textarea class="form-control" id="editKeterangan" rows="2" name="keterangan"></textarea>
    </div>
    @if (auth()->user()->hasPermissionTo('pemantauan usulan-edit'))
    <div class="mb-3">
        <label for="editStatus" class="form-label">Status</label>
        <select class="form-select" id="editStatus" name="is_active" required>
            <option value="1">Aktif</option>
            <option value="0">Non-Aktif</option>
        </select>
    </div>
    @endif
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

<div class="modal fade" id="keteranganModal" tabindex="-1" aria-labelledby="keteranganModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Header Modal -->
            <div class="modal-header">
                <h5 class="modal-title fw-bold text-center" id="keteranganModalLabel">Keterangan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <!-- Body Modal -->
            <div class="modal-body">
                <p id="modalKeterangan" style="text-align: justify;"></p>
            </div>
            
            <!-- Footer Modal -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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
            let opd = this.getAttribute("data-opd");
            let namaUsulan = this.getAttribute("data-namaUsulan");
            let keterangan = this.getAttribute("data-keterangan");
            let tindakLanjut = this.getAttribute("data-tindakLanjut");
            let status = this.getAttribute("data-status");

            console.log(opd);

            document.getElementById("editId").value = id;
            document.getElementById("editOpdId").value = opd;
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
                document.getElementById("deleteForm").action = `/pemantauan/hapus/${id}`;
            });
        });
    });
</script>

<script>
   document.addEventListener("DOMContentLoaded", function () {
    // Ambil semua tombol dengan class "lihat-keterangan"
    document.querySelectorAll(".lihat-keterangan").forEach(button => {
        button.addEventListener("click", function () {
            // Ambil data keterangan dari atribut data-keterangan
            let keterangan = this.getAttribute("data-keterangan");

            // Tetapkan keterangan ke elemen modal
            document.getElementById("modalKeterangan").innerHTML = keterangan;
        });
    });
});

 </script>   
@endsection
