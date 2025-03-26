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
            <div class="text-center">
                <h4 class="fw-bold">Slider</h4>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <div></div> <!-- Spacer -->
                @if (auth()->user()->hasPermissionTo('slider-add'))
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sliderModal">
                    + Tambah Slider
                </button>
                @endif
            </div>

            <!-- Tabel -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle text-center"  id="myTable">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center">No</th>
                            <!-- <th>Gambar</th> -->
                            <th class="text-center">Nama</th>
                            <!-- <th>Caption</th> -->
                            <th class="text-center">Dibuat Oleh</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sliders as $index => $Slider)
                        <tr>
                        <td style="text-align: center;">{{ $loop->iteration }}</td>
                            <!-- <td><img src="{{ asset($Slider->gambar) }}" alt="Slider Image" width="80"></td> -->
                            <td>{{ $Slider->nama }}</td>
                            <!-- <td>{{ $Slider->caption }}</td> -->

                            <!-- Bagian detail -->
                            <td> {{ $Slider->user ? $Slider->user->name : 'Tidak ada pengguna' }}</td>
                            <td>
                                    @if($Slider->is_active == 0)
                                        <span class="badge bg-warning">Non Aktif</span>
                                    @else
                                        <span class="badge bg-success">Aktif</span>
                                    @endif
                            </td>
                            <td>
                                <!-- Bagian buttom edit -->
                                @if (auth()->user()->hasPermissionTo('slider-edit'))
                                <button class="btn btn-sm btn-primary edit-slider" 
                                    data-id="{{ $Slider->id }}" 
                                    data-nama="{{ $Slider->nama }}" 
                                    data-caption="{{ $Slider->caption }}" 
                                    data-deskripsi="{{ $Slider->deskripsi }}" 
                                    data-is_active="{{ $Slider->is_active }}" 
                                    data-gambar="{{ asset( $Slider->gambar) }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                @endif
                             <!-- Tombol Hapus dengan konfirmasi -->
                             @if (auth()->user()->hasPermissionTo('slider-delete'))
                                <button class="btn btn-sm btn-danger delete-btn" 
                                    data-id  ="{{ $Slider->id }}"
                                    data-nama ="{{ $Slider->nama }}"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteMenuModal"><i class="bi bi-trash"></i>
                                </button>
                            @endif

                            <a href="#" 
                                class="lihat-detail btn btn-sm rounded-circle edit-verifikasi" style="background-color: #FFC107; width: 36px; height: 36px;" 
                                data-bs-toggle="modal" 
                                data-bs-target="#deskripsiModal" 
                                data-gambar="{{ asset($Slider->gambar) }}"
                                data-caption="{{ $Slider->caption }}"
                                data-deskripsi="{{ $Slider->deskripsi }}">
                                <i class="bi bi-list-task text-white fs-6"></i>
                                </a>

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
                <form method="POST" id="myForm" action="{{ route('createSlider') }}" enctype="multipart/form-data">
                    @csrf 
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" value="{{ old('nama') }}" >
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Caption</label>
                        <input type="text" class="form-control" name="caption" value="{{ old('caption') }}" >
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" >{{ old('deskripsi') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gambar</label>
                        <input type="file" class="form-control" name="gambar" >
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
                        <div class="form-check form-switch">
                            <!-- Hidden input sebagai fallback jika checkbox tidak dicentang -->
                            <input type="hidden" name="is_active" value="0">
                            
                            <input class="form-check-input" name="is_active" type="checkbox" id="editStatus" value="1" checked>
                            <label class="form-check-label" for="status">Aktif</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-top pt-3 d-flex justify-content-end">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" form="editSliderForm">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete -->
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
                    <p>Apakah Anda yakin ingin menghapus Slider<br> <strong id="deleteNama"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal detail -->
<div class="modal fade" id="deskripsiModal" tabindex="-1" aria-labelledby="deskripsiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h5 class="modal-title fw-bold" id="deskripsiModalLabel">Detail</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body">
                <div id="modalContent" style="display: flex; align-items: flex-start; gap: 20px;">
                    <!-- Gambar di sebelah kiri -->
                    <img id="modalGambar" src="" alt="Gambar" style="max-width: 40%; border-radius: 8px;" />

                    <!-- Teks di sebelah kanan -->
                    <div style="flex: 1;">
                        <!-- <p id="modalJudul" style="margin: 0 0 10px 0;">Judul</p> -->
                        <p id="modalCaption" style="margin: 0 0 10px 0; ">Caption</p>
                        <p id="modalDeskripsi" style="margin: 0;">Deskripsi</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        var kategoriModal = new bootstrap.Modal(document.getElementById("kategoriModal"));
    });
</script>

{{-- edit --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".edit-slider").forEach(button => {
            button.addEventListener("click", function () {
                const id = this.getAttribute("data-id");
                const nama = this.getAttribute("data-nama");
                const caption = this.getAttribute("data-caption");
                const deskripsi = this.getAttribute("data-deskripsi");
                const status = this.getAttribute("data-is_active");
                const gambar = this.getAttribute("data-gambar");
    
                // Isi form dengan data dari tombol edit
                document.getElementById("editNama").value = nama;
                document.getElementById("editCaption").value = caption;
                document.getElementById("editDeskripsi").value = deskripsi;
                document.getElementById("editStatus").checked = status == "1";
    
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


{{-- hapus --}}
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
                document.getElementById("deleteForm").action = `/slider/hapus/${id}`;
            });
        });
    });
</script>

<!-- bagian detail -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".lihat-detail").forEach(button => {
        button.addEventListener("click", function () {
            // Ambil data dari atribut elemen
            let judul = this.getAttribute("data-nama");
            let caption = this.getAttribute("data-caption");
            let deskripsi = this.getAttribute("data-deskripsi");
            let gambar = this.getAttribute("data-gambar");

            // Tetapkan nilai ke elemen dalam modal
            // document.getElementById("modalJudul").innerText = ` Nama : ${judul}`;
            document.getElementById("modalCaption").innerHTML =`<strong>Caption : </strong><br> ${caption}`;
            document.getElementById("modalDeskripsi").innerHTML =`<strong>Deskripsi : </strong><br> ${deskripsi}`;;
            document.getElementById("modalGambar").src = gambar;
        });
    });
});
</script>

@endsection

