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
                        @foreach ($galeris as $galeri)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><img src="{{ asset($galeri->gambar) }}" alt="Slider Image" width="80"></td>
                            <td class="nama">{{ $galeri->nama }}</td>
                            <td class="caption">{{ $galeri->caption }}</td>
                            <td>{{ $galeri->dibuatOleh }}</td>
                            <td>
                                <span class="badge {{ $galeri->is_active ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $galeri->is_active ? 'Aktif' : 'Non-Aktif' }}
                                </span>
                            </td>
                            <td>
                                <!-- Button Edit Modal -->
                                <button class="btn btn-sm btn-primary btn-edit" 
                                    data-id="{{ $galeri->id }}" 
                                    data-nama="{{ $galeri->nama }}" 
                                    data-caption="{{ $galeri->caption }}" 
                                    data-gambar="{{ asset($galeri->gambar) }}"
                                    data-status="{{ $galeri->is_active }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <!-- Tombol Hapus dengan konfirmasi -->
                                <button class="btn btn-sm btn-danger delete-slider" data-id="{{ $galeri->id }}">
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

            <div class="modal-header d-flex justify-content-center w-100 ">
                <h5 class="modal-title fw-bold text-center" id="menuModalLabel">Tambah Menu Galeri</h5>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('createGaleri') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="caption" class="form-label">Caption</label>
                        <input type="text" class="form-control" id="caption" name="caption" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <input type="text" class="form-control" id="deskripsi" name="ddeskripsi" required>
                    </div>
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar</label>
                        <input type="file" class="form-control" id="gambar" name="gambar" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="is_active" required>
                            <option value="" disabled selected>--- Pilih Status ---</option>
                            <option value="1">Aktif</option>
                            <option value="0">Non-Aktif</option>
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

<!-- Modal Edit Galeri -->
<div class="modal fade" id="editGaleriModal" tabindex="-1" aria-labelledby="editGaleriModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header d-flex justify-content-center w-100 ">
                <h5 class="modal-title fw-bold text-center" id="menuModalLabel">Edit Menu Galeri</h5>
            </div>
            <div class="modal-body">
             <form>
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
                        <input type="text" class="form-control" id="editDeskripsi" name="caption" required>
                    </div>
                    <div class="mb-3">
                        <label for="editGambar" class="form-label">Gambar</label>
                        <input type="file" class="form-control" id="editGambar" name="gambar">
                        <img id="editPreviewGambar" src="" alt="Preview Gambar" width="100" class="mt-2">
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
    // Tombol Edit
    document.querySelectorAll('.btn-edit').forEach((btn) => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            const nama = this.dataset.nama;
            const caption = this.dataset.caption;
            const deskripsi = this.dataset.deskripsi;
            const gambar = this.dataset.gambar;
            const status = this.dataset.status;

            document.querySelector('#editId').value = id;
            document.querySelector('#editNama').value = nama;
            document.querySelector('#editCaption').value = caption;
            document.querySelector('#editDeskripsi').value = deskripsi;
            document.querySelector('#editPreviewGambar').src = gambar;
            document.querySelector('#editStatus').value = status;

            const editModal = new bootstrap.Modal(document.getElementById('editGaleriModal'));
            editModal.show();
        });
    });

    // Tombol Hapus
    document.querySelectorAll(".delete-slider").forEach(button => {
        button.addEventListener("click", function () {
            const id = this.dataset.id;

            Swal.fire({
                title: "<b>Apakah Anda Yakin?</b>",
                text: "Data ini akan dihapus!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#6c757d",
                confirmButtonText: "Hapus",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/galeri/${id}`, {
                        method: "DELETE",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        }
                    }).then(response => {
                        if (response.ok) {
                            Swal.fire("Berhasil!", "Data telah dihapus.", "success")
                                .then(() => location.reload());
                        } else {
                            Swal.fire("Gagal!", "Terjadi kesalahan.", "error");
                        }
                    });
                }
            });
        });
    });
});
</script>

@endsection
