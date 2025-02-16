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
    <div class="card shadow-lg border-0 position-relative overflow-hidden mb-5"> 
        <div class="card-body mt-4">
            <div class="text-center mb-4">
                <h4 class="fw-bold">Slider</h4>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div></div> <!-- Spacer -->
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sliderModal">
                    + Tambah Slider
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
                            <th>Deskripsi</th>
                            <th>Dibuat Oleh</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sliders as $index => $Slider)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><img src="{{ asset($Slider->gambar) }}" alt="Slider Image" width="80"></td>
                            <td>{{ $Slider->nama }}</td>
                            <td>{{ $Slider->caption }}</td>
                            <td>{{ $Slider->deskripsi }}</td>
                            <td>{{ $Slider->dibuatOleh }}</td>
                            <td>
                                    @if($Slider->is_active == 0)
                                        <span class="badge bg-warning">Non Aktif</span>
                                    @else
                                        <span class="badge bg-success">Aktif</span>
                                    @endif
                            </td>
                            <td>
                                <!-- Bagian buttom edit -->
                                <button class="btn btn-sm btn-primary edit-slider" 
                                    data-id="{{ $Slider->id }}" 
                                    data-nama="{{ $Slider->nama }}" 
                                    data-caption="{{ $Slider->caption }}" 
                                    data-deskripsi="{{ $Slider->deskripsi }}" 
                                    data-is_active="{{ $Slider->is_active }}" 
                                    data-gambar="{{ asset( $Slider->gambar) }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                                            <!-- Tombol Hapus dengan konfirmasi -->
                                <button class="btn btn-sm btn-danger delete-slider"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Slider -->
<div class="modal fade" id="sliderModal" tabindex="-1" aria-labelledby="sliderModalLabel" aria-hidden="true">
<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center w-100 ">
                <h5 class="modal-title fw-bold text-center" id="sliderModalLabel">Tambah Menu Slider Baru</h5>
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
                <form method="POST" action="{{ route('createSlider') }}" enctype="multipart/form-data">
                    @csrf 
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Caption</label>
                        <input type="text" class="form-control" name="caption" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gambar</label>
                        <input type="file" class="form-control" name="gambar" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="is_active" required>
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
</div>

<!-- Modal Edit Slider -->
<div class="modal fade" id="editSliderModal" tabindex="-1" aria-labelledby="editSliderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center w-100">
                <h5 class="modal-title fw-bold text-center" id="editSliderModalLabel">Edit Slider</h5>
            </div>
            <div class="modal-body">
                <form id="editSliderForm" method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" id="editNama" required maxlength="255">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Caption</label>
                        <input type="text" class="form-control" name="caption" id="editCaption" required maxlength="500">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" id="editDeskripsi" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gambar (Maks. 2MB, PNG/JPG/JPEG)</label>
                        <input type="file" class="form-control" name="gambar" id="editGambar">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengganti gambar.</small>
                        <br>
                        <img id="previewGambar" src="" alt="Gambar Slider" class="img-fluid mt-2" style="max-height: 150px;">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="is_active" id="editIsActive" required>
                            <option value="1">Aktif</option>
                            <option value="0">Non-Aktif</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-top pt-3 d-flex justify-content-end">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="editSliderForm">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        var kategoriModal = new bootstrap.Modal(document.getElementById("kategoriModal"));
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".edit-slider").forEach(button => {
            button.addEventListener("click", function () {
                const id = this.getAttribute("data-id");
                const nama = this.getAttribute("data-nama");
                const caption = this.getAttribute("data-caption");
                const deskripsi = this.getAttribute("data-deskripsi");
                const isActive = this.getAttribute("data-is_active");
                const gambar = this.getAttribute("data-gambar");
    
                // Isi form dengan data dari tombol edit
                document.getElementById("editNama").value = nama;
                document.getElementById("editCaption").value = caption;
                document.getElementById("editDeskripsi").value = deskripsi;
                document.getElementById("editIsActive").value = isActive;
    
                // Tampilkan gambar yang ada
                if (gambar) {
                    document.getElementById("previewGambar").src = gambar;
                } else {
                    document.getElementById("previewGambar").src = "";
                }
    
                // Set action form
                document.getElementById("editSliderForm").action = "/slider/update/" + id;
    
                // Tampilkan modal
                new bootstrap.Modal(document.getElementById("editSliderModal")).show();
            });
        });
    });
    </script>
    

@endsection
