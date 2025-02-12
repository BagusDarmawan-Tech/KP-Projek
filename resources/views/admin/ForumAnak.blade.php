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
                <table class="table table-hover table-bordered align-middle text-center">
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

                        @foreach ($forumAnaks as $forumAnak )
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><img src="{{ asset($forumAnak->gambar) }}" alt="Slider Image" width="80"></td>
                            <td>{{ $forumAnak->nama }}</td>
                            <td>{{ $forumAnak->caption }}</td>
                            <td>{{ $forumAnak->dibuatOleh }}</td>
                            <td><span class="badge bg-success">{{ $forumAnak->is_active }}</span></td>

                            <td>
                                <!-- Button Edit Modal -->
                                <button class="btn btn-sm btn-primary btn-edit" data-bs-toggle="modal" data-bs-target="#editModal">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <!-- Tombol Hapus dengan konfirmasi -->
                                <button class="btn btn-sm btn-danger delete-slider">
                                    <i class="bi bi-trash"></i>
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

<!-- Modal Tambah Forum Anak -->
<div class="modal fade" id="sliderModal" tabindex="-1" aria-labelledby="sliderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sliderModalLabel">Tambah Forum Anak Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                        <input type="text" class="form-control" id="sliderCaption"  name="caption" value="{{ old('caption') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="sliderDeskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="sliderDeskripsi" rows="2"  name="deskripsi" value="{{ old('deskripsi') }}" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="sliderGambar" class="form-label">Gambar</label>
                        <input type="file" class="form-control" id="sliderGambar"  name="gambar" value="{{ old('gambar') }}" required>
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
            
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
        </div>
    </div>
</div>

<!-- Modal Edit Forum Anak -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Forum Anak</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="editNama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="editNama">
                    </div>
                    <div class="mb-3">
                        <label for="editCaption" class="form-label">Caption</label>
                        <input type="text" class="form-control" id="editCaption">
                    </div>
                    <div class="mb-3">
                        <label for="editDeskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="editDeskripsi" rows="2"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editGambar" class="form-label">Gambar</label>
                        <input type="file" class="form-control" id="editGambar">
                    </div>
                    <div class="mb-3">
                        <label for="editStatus" class="form-label">Status</label>
                        <select class="form-select" id="editStatus">
                            <option value="Aktif">Aktif</option>
                            <option value="Non-Aktif">Non-Aktif</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const editButtons = document.querySelectorAll('.btn-edit');

        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                // Get the data from the selected row
                const row = button.closest('tr');
                const nama = row.getAttribute('data-nama');
                const caption = row.getAttribute('data-caption');
                const deskripsi = row.getAttribute('data-deskripsi');
                const gambar = row.getAttribute('data-gambar');
                const status = row.getAttribute('data-status');
                
                // Fill the modal with the data
                document.getElementById("editNama").value = nama;
                document.getElementById("editCaption").value = caption;
                document.getElementById("editDeskripsi").value = deskripsi;
                document.getElementById("editStatus").value = status;
                
                // Optional: Show image preview if available
                if (gambar) {
                    document.getElementById("editGambar").value = gambar; // In a real case, you may want to show the current image in a preview.
                }

                // Show the modal
                new bootstrap.Modal(document.getElementById("editModal")).show();
            });
        });
    });
</script>

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

@endsection
