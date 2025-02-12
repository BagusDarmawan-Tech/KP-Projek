@extends('admin.admin-master') 
@section('main')
<link href="{{ asset('assets/css/tabel.css') }}" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container mt-5">
    <div class="card shadow-lg border-0 position-relative overflow-hidden mb-5"> 
        <div class="card-body mt-4">
            <div class="text-center mb-4">
                <h4 class="fw-bold">Galeri</h4>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div></div> <!-- Spacer -->
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sliderModal">
                    + Galeri
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
                        @foreach ($galeris as $galeri )
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><img src="{{ asset($galeri->gambar) }}" alt="Slider Image" width="80"></td>
                            <td>{{ $galeri->nama }}</td>
                            <td>{{ $galeri->caption }}</td>
                            <td>{{ $galeri->dibuatOleh }}</td>
                            <td><span class="badge bg-success">{{ $galeri->is_active }}</span></td>
                            <td>
                                <!-- Button Edit Modal -->
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
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

<!-- Modal Tambah Galeri -->
<div class="modal fade" id="sliderModal" tabindex="-1" aria-labelledby="sliderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sliderModalLabel">Tambah Galeri Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('createGaleri') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama </label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" required>

                    </div>
                    <div class="mb-3">
                        <label for="sliderCaption" class="form-label">Caption</label>
                        <input type="text" class="form-control" id="caption" name="caption" value="{{ old('caption') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="sliderDeskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deksripsi" rows="2" name="deskripsi" value="{{ old('deskripsi') }}" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="sliderGambar" class="form-label">Gambar</label>
                        <input type="file" class="form-control" id="gambar" name="gambar" value="{{ old('gambar') }}" required>
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

<!-- Modal Edit Galeri -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Galeri</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="editNama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="editNama" value="Dhian">
                    </div>
                    <div class="mb-3">
                        <label for="editCaption" class="form-label">Caption</label>
                        <input type="text" class="form-control" id="editCaption" value="Magang Kominfo">
                    </div>
                    <div class="mb-3">
                        <label for="editDeskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="editDeskripsi" rows="2">Deskripsi galeri</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editGambar" class="form-label">Gambar</label>
                        <input type="file" class="form-control" id="editGambar">
                    </div>
                    <div class="mb-3">
                        <label for="editStatus" class="form-label">Status</label>
                        <select class="form-select" id="editStatus">
                            <option selected>Aktif</option>
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
        const sliderModal = new bootstrap.Modal(document.getElementById("sliderModal"));
        const editModal = new bootstrap.Modal(document.getElementById("editModal"));
        const editButtons = document.querySelectorAll('.btn-edit');

        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                const row = button.closest('tr'); 
                const nama = row.querySelector('.nama').textContent;
                const caption = row.querySelector('.caption').textContent;
                const deskripsi = row.querySelector('.deskripsi').textContent;
                const status = row.querySelector('.status').textContent.trim();
                document.getElementById("editNama").value = nama;
                document.getElementById("editCaption").value = caption;
                document.getElementById("editDeskripsi").value = deskripsi;
                
                // Mengisi status berdasarkan status yang ada
                const statusSelect = document.getElementById("editStatus");
                if (status === "Aktif") {
                    statusSelect.value = "Aktif";
                } else {
                    statusSelect.value = "Non-Aktif";
                }
                editModal.show();
            });
        });
        document.querySelector(".btn-primary").addEventListener("click", function() {
            const nama = document.getElementById("editNama").value;
            const caption = document.getElementById("editCaption").value;
            const deskripsi = document.getElementById("editDeskripsi").value;
            const status = document.getElementById("editStatus").value;
            console.log("Data yang diedit:", nama, caption, deskripsi, status);
            editModal.hide();
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