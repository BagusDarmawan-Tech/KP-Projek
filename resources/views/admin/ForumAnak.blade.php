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
                <h4 class="fw-bold">Forum Anak</h4>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div></div> <!-- Spacer -->
            @if (auth()->user()->hasPermissionTo('forum anak-add'))
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sliderModal">
                    + Forum Anak
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
                        @foreach ($forumAnaks as $forumAnak)
                        <tr>
                            <td style="text-align: center;">{{ $loop->iteration }}</td>
                            <td><img src="{{ asset($forumAnak->gambar) }}" alt="Slider Image" width="80"></td>
                            <td>{{ $forumAnak->nama }}</td>
                            <td>{{ $forumAnak->caption }}</td>
                            <td>{{ $forumAnak->user ? $forumAnak->user->name : 'Tidak ada pengguna' }}</td>
                            <td>
                                <span class="badge {{ $forumAnak->is_active ? 'bg-success' : 'bg-danger' }}">
                                    {{ $forumAnak->is_active ? 'Aktif' : 'Non-Aktif' }}
                                </span>
                            </td>
                            <td>
                                <!-- Button Edit Modal -->
                            @if (auth()->user()->hasPermissionTo('forum anak-edit'))
                                <button class="btn btn-sm btn-primary edit-btn"
                                    data-id="{{ $forumAnak->id }}"
                                    data-nama="{{ $forumAnak->nama }}"
                                    data-caption="{{ $forumAnak->caption }}"
                                    data-gambar="{{ asset($forumAnak->gambar) }}"
                                    data-status="{{ $forumAnak->is_active }}"
                                    data-deskripsi="{{ $forumAnak->deskripsi }}"
                                    data-bs-toggle="modal"
                                    data-bs-target="#HalamaneditModal">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                            @endif
                        
                                <!-- Button Delete Modal -->
                            @if (auth()->user()->hasPermissionTo('forum anak-delete'))
                                <button class="btn btn-sm btn-danger delete-btn" 
                                    data-id  ="{{ $forumAnak->id }}"
                                    data-nama ="{{ $forumAnak->nama }}"
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

<!-- Modal Tambah Forum Anak -->
<div class="modal fade" id="sliderModal" tabindex="-1" aria-labelledby="sliderModalLabel" aria-hidden="true">
<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center w-100 ">
                <h5 class="modal-title fw-bold text-center" id="menuModalLabel">Tambah Menu Forum Anak Baru</h5>
            </div>
            <div class="modal-body">
                <form method="POST" id="myForm" action="{{ route('createForumAnak') }}" enctype="multipart/form-data">
                    @csrf 
                    <div class="mb-3">
                        <label for="sliderNama" class="form-label">Nama </label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" >
                    </div>
                    <div class="mb-3">
                        <label for="sliderCaption" class="form-label">Caption</label>
                        <input type="text" class="form-control" id="sliderCaption" name="caption" value="{{ old('caption') }}" >
                    </div>
                    <div class="mb-3">
                        <label for="sliderDeskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="sliderDeskripsi" rows="2" name="deskripsi" >{{ old('deskripsi') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="sliderGambar" class="form-label">Gambar</label>
                        <input type="file" class="form-control" id="sliderGambar" name="gambar">
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
                    </div>
                    <div class="modal-footer border-top pt-3 d-flex justify-content-end"> <!-- Tambahan border-top dan padding -->
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

<!-- Modal Edit Forum Anak -->
<div class="modal fade" id="HalamaneditModal" tabindex="-1" aria-labelledby="HalamaneditModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center w-100">
                <h5 class="modal-title fw-bold text-center" id="HalamaneditModalLabel">Edit Forum Anak</h5>
            </div>
            <div class="modal-body">
                <form id="editHalamanForm" method="POST" enctype="multipart/form-data">
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
                        <label class="form-label">Status</label>
                        <div class="form-check form-switch">
                            <!-- Hidden input sebagai fallback jika checkbox tidak dicentang -->
                            <input type="hidden" name="is_active" value="0">
                            
                            <input class="form-check-input" name="is_active" type="checkbox" id="editStatus" value="1" checked>
                            <label class="form-check-label" for="status">Aktif</label>
                        </div>
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
        document.querySelectorAll(".edit-btn").forEach(button => {
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
                document.getElementById("editStatus").checked = status == "1";
                document.getElementById("editDeskripsi").value = deskripsi;

                // Atur form agar mengarah ke URL update yang benar
                document.getElementById("editHalamanForm").action = `/forumAnak/update/${id}`;
            });
        });
    });
</script>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        const editButtons = document.querySelectorAll('.btn-edit');

        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                const row = button.closest('tr');

                document.getElementById("editId").value = row.getAttribute('data-id') || "";
                document.getElementById("editNama").value = row.getAttribute('data-nama') || "";
                document.getElementById("editCaption").value = row.getAttribute('data-caption') || "";
                document.getElementById("editDeskripsi").value = row.getAttribute('data-deskripsi') || "";
                document.getElementById("editStatus").value = row.getAttribute('data-status') || "1";

                const gambarUrl = row.getAttribute('data-gambar') || "";
                const previewGambar = document.getElementById("previewGambar");
                previewGambar.src = gambarUrl ? `{{ asset('') }}${gambarUrl}` : "{{ asset('default.jpg') }}";
            });
        });

        document.querySelectorAll(".delete-slider").forEach(button => {
            button.addEventListener("click", function () {
                const row = button.closest('tr');
                const forumId = row.getAttribute('data-id');

                Swal.fire({
                    title: "<b>Apakah Anda Yakin?</b>",
                    text: "Data ini akan dihapus secara permanen.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#6c757d",
                    confirmButtonText: "Hapus",
                    cancelButtonText: "Batal",
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/forum-anak/${forumId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json',
                            },
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire("Dihapus!", "Data berhasil dihapus.", "success")
                                    .then(() => location.reload());
                            } else {
                                Swal.fire("Error!", "Terjadi kesalahan saat menghapus data.", "error");
                            }
                        })
                        .catch(error => {
                            Swal.fire("Error!", "Tidak dapat terhubung ke server.", "error");
                        });
                    }
                });
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
                document.getElementById("deleteForm").action = `/forumAnak/hapus/${id}`;
            });
        });
    });
</script>
@endsection
