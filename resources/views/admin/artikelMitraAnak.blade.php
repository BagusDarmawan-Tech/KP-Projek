@extends('admin.admin-master')
@section('main')
<link href="{{ asset('assets/css/tabel.css') }}" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('assets/js/hapus.js') }}"></script>

<div class="container mt-5">
    <div class="card shadow-lg border-0 position-relative overflow-hidden mb-5">
        <div class="card-body mt-4">
            <div class="text-center mb-4">
                <h4 class="fw-bold">Artikel Mitra Anak</h4>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div></div> <!-- Spacer -->
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">+ Artikel Mitra Anak</button> 
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle text-center">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Nama Kategori</th>
                            <th>Judul</th>
                            <th>Dibuat Oleh</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td><img src="{{ asset('kids.jpg') }}" alt="Slider Image" width="80"></td>
                            <td>Judul Halaman</td>
                            <td>slug-halaman</td>
                            <td>Admin</td>
                            <td><span class="badge bg-success">Aktif</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary edit-btn" data-bs-toggle="modal" data-bs-target="#editModal"><i class="bi bi-pencil-square"></i></button>
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

<!-- Modal Tambah Artikel -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex flex-column align-items-center">
                <h5 class="modal-title fw-bold text-center mb-0" id="tambahModalLabel">Tambah Artikel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="judul">
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="slug">
                    </div>
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori Artikel</label>
                        <select class="form-select" id="kategori">
                            <option>-- Pilih Kategori --</option>
                            <option value="Artikel Mitra Anak">Artikel Mitra Anak</option>

                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tag" class="form-label">Tag</label>
                        <input type="text" class="form-control" id="tag">
                    </div>
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar</label>
                        <input type="file" class="form-control" id="gambar">
                    </div>
                    <div class="mb-3">
                        <label for="konten" class="form-label">Konten</label>
                        <textarea class="form-control" id="konten" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="sliderStatus" class="form-label">Status</label>
                        <select class="form-select" id="sliderStatus">
                            <option selected>--- Pilih Status ---</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Non-Aktif">Non-Aktif</option>
                        </select>
                    </div>
                    <input type="hidden" name="dibuatOleh" value="{{ Auth::user()->name }}">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
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
    // Pratinjau Gambar Saat Dipilih di Modal Tambah
    document.getElementById('gambarTambah').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('previewGambarTambah');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                preview.src = event.target.result;
                preview.classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        } else {
            preview.src = '';
            preview.classList.add('d-none');
        }
    });

    // Pratinjau Gambar Saat Dipilih di Modal Edit
    document.getElementById('gambarEdit').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('previewGambarEdit');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                preview.src = event.target.result;
                preview.classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        } else {
            preview.src = '';
            preview.classList.add('d-none');
        }
    });

    // Tambah/Edit Artikel Logika Placeholder (Anda bisa sesuaikan dengan backend Anda)
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function() {
            const modalTitle = document.getElementById('editModalLabel');
            modalTitle.textContent = 'Edit Artikel';

            // Isi data ke form modal untuk pengeditan
            document.getElementById('judulEdit').value = 'Judul Contoh'; // Contoh nilai
            document.getElementById('slugEdit').value = 'judul-contoh';
            document.getElementById('kategoriEdit').value = 'Artikel Mitra Anak';
            document.getElementById('kontenEdit').value = 'Ini adalah contoh konten.';
            document.getElementById('statusEdit').value = 'Aktif';

            const preview = document.getElementById('previewGambarEdit');
            preview.src = '{{ asset('kids.jpg') }}'; // Contoh gambar
            preview.classList.remove('d-none');
        });
    });
</script>
@endsection
