@extends('admin.admin-master')

@section('main')
<link href="{{ asset('assets/css/tabel.css') }}" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container mt-5">
    <div class="card shadow-lg border-0 position-relative overflow-hidden mb-5"> 
        <div class="card-body mt-4">
            <div class="text-center mb-4">
                <h4 class="fw-bold">Forum Anak</h4>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div></div> <!-- Spacer -->
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sliderModal">
                    + Forum Anak
                </button>
            </div>

            <!-- Tabel -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle text-center"  id="myTable">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Nama</th>
                            <th>Caption</th>
                            <th>Dibuat Oleh</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($forumAnaks as $forumAnak)
                        <tr 
                            data-id="{{ $forumAnak->id }}" 
                            data-nama="{{ $forumAnak->nama }}" 
                            data-caption="{{ $forumAnak->caption }}"
                            data-deskripsi="{{ $forumAnak->deskripsi }}"
                            data-gambar="{{ $forumAnak->gambar }}"
                            data-status="{{ $forumAnak->is_active }}">
                            <td>{{ $loop->iteration }}</td>
                            <td><img src="{{ asset($forumAnak->gambar) }}" alt="Slider Image" width="80"></td>
                            <td>{{ $forumAnak->nama }}</td>
                            <td>{{ $forumAnak->caption }}</td>
                            <td>{{ $forumAnak->dibuatOleh }}</td>
                            <td>
                                <span class="badge {{ $forumAnak->is_active ? 'bg-success' : 'bg-danger' }}">
                                    {{ $forumAnak->is_active ? 'Aktif' : 'Non-Aktif' }}
                                </span>
                            </td>
                            <td>
                                <!-- Button Edit Modal -->
                                <button class="btn btn-sm btn-primary edit-btn" data-bs-toggle="modal" data-bs-target="#HalamaneditModal" data-judul="Judul Halaman" data-slug="slug-halaman" data-status="Aktif"><i class="bi bi-pencil-square"></i></button>
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

<!-- Modal Tambah Forum Anak -->
<div class="modal fade" id="sliderModal" tabindex="-1" aria-labelledby="sliderModalLabel" aria-hidden="true">
<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center w-100 ">
                <h5 class="modal-title fw-bold text-center" id="menuModalLabel">Tambah Menu Forum Anak Baru</h5>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('createForumAnak') }}" enctype="multipart/form-data">
                    @csrf 
                    <div class="mb-3">
                        <label for="sliderNama" class="form-label">Nama </label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="sliderCaption" class="form-label">Caption</label>
                        <input type="text" class="form-control" id="sliderCaption" name="caption" value="{{ old('caption') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="sliderDeskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="sliderDeskripsi" rows="2" name="deskripsi" value="{{ old('deskripsi') }}" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="sliderGambar" class="form-label">Gambar</label>
                        <input type="file" class="form-control" id="sliderGambar" name="gambar" value="{{ old('gambar') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="kategoriStatus" class="form-label">Status</label>
                        <select class="form-select" id="kategoriStatus" name="is_active" required>
                            <option value="" disabled selected>--- Pilih Status ---</option>
                            <option value="1" {{ old('is_active') == "1" ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('is_active') == "0" ? 'selected' : '' }}>Non-Aktif</option>
                        </select>
                    </div>
                    <input type="hidden" name="dibuatOleh" value="{{ Auth::user()->name }}">
                    </div>
                    <div class="modal-footer border-top pt-3 d-flex justify-content-end"> <!-- Tambahan border-top dan padding -->
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Forum Anak -->
<div class="modal fade" id="HalamaneditModal" tabindex="-1" aria-labelledby="HalamaneditModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center w-100 ">
                <h5 class="modal-title fw-bold text-center" id="menuModalLabel">Edit Menu Forum Anak</h5>
            </div>
            <div class="modal-body">
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
                        <label for="editDeskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="editDeskripsi" name="deskripsi" rows="2" required></textarea>
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
                        <div class="modal-footer border-top pt-3 d-flex justify-content-end"> <!-- Tambahan border-top dan padding -->
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
                </form>
        </div>
    </div>
</div>

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
@endsection
