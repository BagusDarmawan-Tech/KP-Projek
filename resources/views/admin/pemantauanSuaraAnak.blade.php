@extends('admin.admin-master')

@section('title', 'Pemantauan Suara Anak')

@section('main')

<link href="{{ asset('assets/css/tabel.css') }}" rel="stylesheet">
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
            <h4 class="fw-bold">Pemantauan Suara Anak</h4>
        </div>

        <!-- Kontrol Atas -->
        <div class="row mb-3">
            <div class="col-md-12 d-flex justify-content-end">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahPemantauanModal">
                    + Pemantauan Suara Anak
                </button>
            </div>
        </div>


        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle text-center" id="myTable">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Nomor</th>
                        <th class="text-nowrap">Tanggal</th>
                        <th>Pemohon</th>
                        <th>Perihal</th>
                        <th>Deskripsi</th>
                        <th>Hasil TL</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($suaras as $index => $suara)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $suara->nomorSuara }}</td>
                        <td class="text-nowrap">{{ $suara->tanggal }}</td>
                        <td>{{ $suara->pemohon }}</td>
                        <td>{{ $suara->perihal }}</td>
                        <td>{{ $suara->deskripsi}}</td>
                        @if(is_null($suara->tindakLanjut))
                            <td class="text-danger">Dinsos : ✖ Belum di TL</td>
                        @else
                        <td class="text-danger">Dinsos : ✅  Sudah di TL</td>
                        @endif
                           
                        <td>
                            @if(is_null($suara->tindakLanjut))
                                <span class="badge bg-warning">Tindak Lanjut</span>
                            @else
                                <span class="badge bg-success">Sudah Tindak Lanjut</span>
                            @endif
                        </td>
                        <td class="d-flex align-items-center justify-content-center gap-2 py-2">
                            <!-- Tombol Edit -->
                            <button class="btn btn-sm btn-primary edit-usulan" 
                                data-bs-toggle="modal" 
                                data-bs-target="#editForm"
                                data-id="{{ $suara->id }}"
                                data-perihal="{{ $suara->perihal }}"
                                data-deskripsi="{{ $suara->deskripsi }}">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <!-- Tombol Tindak Lanjut -->
                            <button class="btn btn-sm rounded-circle edit-tindakan"
                                    style="background-color: #6A0DAD; width: 36px; height: 36px;"
                                    data-bs-toggle="modal" data-bs-target="#tindakLanjutModal"
                                    data-id="{{ $suara->id }}"
                                    data-tanggalTindakLanjut="{{ $suara->tanggalTindakLanjut }}"
                                    data-file="{{ asset('storage/' . $suara->file) }}"
                                    data-tindakLanjut="{{ $suara->tindakLanjut }}">
                                <i class="bi bi-calendar text-white fs-6"></i>
                            </button>
                    
                            
                            <!-- Tombol Finalisasi -->
                            <button class="btn btn-sm rounded-circle edit-verifikasi" style="background-color: #FFC107; width: 36px; height: 36px;"
                                data-bs-toggle="modal" data-bs-target="#finalisasiModal"
                                data-id="{{ $suara->id }}"
                                data-status="{{ $suara->is_active }}">
                                <i class="bi bi-list-task text-white fs-6"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Modal Tambah Pemantauan -->
<div class="modal fade" id="tambahPemantauanModal" tabindex="-1" aria-labelledby="tambahPemantauanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex flex-column align-items-center">
            <h5 class="modal-title fw-bold text-center mb-0" id="tambahPemantauanModalLabel">Tambah Pemantauan Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('createPemantauanSuara') }}" >
                    @csrf 
                <div class="mb-3">
                    <label class="form-label">Perihal</label>
                    <input type="text" class="form-control" name="perihal" required placeholder="Masukkan perihal">
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea class="form-control" name="deskripsi" rows="3" required placeholder="Masukkan deskripsi"></textarea>
                </div>
                <input type="hidden" name="pemohon" value="{{ Auth::user()->name }}">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- Modal Edit Pemantauan -->
<div class="modal fade" id="editForm" tabindex="-1" aria-labelledby="editForm" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex flex-column align-items-center">
            <h5 class="modal-title fw-bold text-center mb-0" id="tambahPemantauanModalLabel">Tambah Pemantauan Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="editUsulanForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                <input type="hidden" id="editId" name="id">
                <div class="mb-3">
                    <label class="form-label">Perihal</label>
                    <input type="text" class="form-control" id="editPerihal" name="perihal" required placeholder="Masukkan perihal">
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea class="form-control" name="deskripsi" id="editDeskripsi" rows="3" required placeholder="Masukkan deskripsi"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
       
        </div>
    </div>
</div>

<!-- Modal Tindak Lanjut -->
<div class="modal fade" id="tindakLanjutModal" tabindex="-1" aria-labelledby="tindakLanjutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex flex-column align-items-center">
            <h5 class="modal-title fw-bold text-center mb-0" id="tindakLanjutModalLabel">Tindak Lanjut </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editTindakLanjutForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                <input type="hidden" id="ubahId" name="id">
                <div class="mb-3">
                    <label class="form-label">Tindak Lanjut</label>
                    <textarea class="form-control" name="tindakLanjut" id="editTindakLanjut" rows="3" required placeholder="Masukkan tindak lanjut"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal Tindak Lanjut</label>
                    <input type="date" id="editTanggalTindakLanjut" class="form-control" name="tanggalTindakLanjut" required>
                </div>                
                <div class="mb-3">
                    <label for="editFile" class="form-label">Edit File Data Pendukung</label>
                    <div class="mb-2">
                        <a id="previewFile" href="#" target="_blank" class="btn btn-secondary btn-sm">Lihat File Saat Ini</a>
                    </div>
                    <input type="file" class="form-control" id="editFile" name="file">
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah file.</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Finalisasi -->
<div class="modal fade" id="finalisasiModal" tabindex="-1" aria-labelledby="finalisasiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="verifikasi" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" id="editIdVerifikasi" name="id">
                <input type="hidden" id="editStatus" name="edit">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Apakah Anda Yakin?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <p>Akan memfinalisasi data ini!</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="is_active" value="1" class="btn btn-danger">Konfirmasi</button>
                </div>
            </form>
        </div>
    </div>
</div>




{{-- Finalisasi --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".edit-verifikasi").forEach(button => {
            button.addEventListener("click", function () {
                let id = this.getAttribute("data-id");
                let status = this.getAttribute("data-status");
                console.log(status);
                document.getElementById("editIdVerifikasi").value = id;
                document.getElementById("editStatus").value = status;

                // Atur action form agar mengarah ke URL update dengan ID
                document.getElementById("verifikasi").action = `/verifikasi/update/${id}`;
            });
        });
    });
</script>

{{-- <update --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".edit-usulan").forEach(button => {
            button.addEventListener("click", function () {
                let id = this.getAttribute("data-id");
                let perihal = this.getAttribute("data-perihal");
                let deskripsi = this.getAttribute("data-deskripsi");

                document.getElementById("editId").value = id;
                document.getElementById("editPerihal").value = perihal;
                document.getElementById("editDeskripsi").value = deskripsi;

                // Atur action form agar mengarah ke URL update dengan ID
                document.getElementById("editUsulanForm").action = `/pemantauan-suara/update/${id}`;
            });
        });
    });
</script>


{{-- tindak lanjut --}}
<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".edit-tindakan").forEach(button => {
        button.addEventListener("click", function () {
            let id = this.getAttribute("data-id");
            console.log(id); // Cek apakah id terambil dengan benar

            let tindakLanjut = this.getAttribute("data-tindakLanjut");
            let tanggalTindakLanjut = this.getAttribute("data-tanggalTindakLanjut");
            let file = this.getAttribute("data-file");

            console.log(file);

             let coba = document.getElementById("ubahId").value = id;
             console.log(coba);
            document.getElementById("editTanggalTindakLanjut").value = tanggalTindakLanjut;
            document.getElementById("editTindakLanjut").value = tindakLanjut;
            document.getElementById("previewFile").href = file;

            // Atur action form agar mengarah ke URL update dengan ID
            document.getElementById("editTindakLanjutForm").action = `/tindak-lanjut/update/${id}`;
        });
    });
});

</script>
@endsection
