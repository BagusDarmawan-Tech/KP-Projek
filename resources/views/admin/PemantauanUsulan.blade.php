@extends('admin.admin-master')
@section('main')
<link href="{{ asset('assets/css/tabel.css') }}" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container mt-5">
    <div class="card shadow-lg border-0 position-relative overflow-hidden mb-5">
        <div class="card-body mt-4">
            <div class="text-center mb-4">
                <h4 class="fw-bold">Pemantauan Usulan Anak</h4>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div></div> <!-- Spacer -->
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pemantauanModal">
                    + Tambah Usulan
                </button>
            </div>

            <!-- Kontrol Tampilkan & Cari -->
            <div class="row mb-3 align-items-center">
                <div class="col-md-6">
                    <label for="showEntries" class="form-label me-2">Show</label>
                    <select id="showEntries" class="form-select form-select-sm d-inline-block" style="width: 80px;">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    entries
                </div>
                <div class="col-md-6 text-end">
                    <input type="text" id="searchInput" class="form-control form-control-sm d-inline-block" placeholder="Search..." style="width: 200px;">
                </div>
            </div>

            <!-- Tabel -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle text-center">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>OPD</th>
                            <th>OPD Terlibat</th>
                            <th>Nama Usulan</th>
                            <th>Tindak Lanjut</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usulans as $usulan )
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td> {{ $usulan->user ? $usulan->user->name : 'Tidak ada pengguna' }}</td>
                            <td> {{ $usulan->user ? $usulan->user->name : 'Tidak ada pengguna' }}</td>
                            <td>{{ $usulan->namaUsulan }}</td>
                            <td>{{ $usulan->tindakLanjut }}</td>
                            <td><span class="badge bg-success">{{ $usulan->is_active }}</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary edit-btn" data-bs-toggle="modal" data-bs-target="#editPemantauanModal" data-judul="Judul Halaman" data-slug="slug-halaman" data-status="Aktif"><i class="bi bi-pencil-square"></i></button>
                                <button class="btn btn-sm btn-danger delete-slider"><i class="bi bi-trash"></i> </button>

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
                <form method="POST" action="{{ route('createPemantauanUsulan') }}" >
                    @csrf 
                    <input type="hidden" name="userid" value="{{ Auth::user()->id }}">
                    <div class="mb-3">
                        <label for="namaUsulan" class="form-label">Nama Usulan</label>
                        <input type="text" class="form-control"  id="namaUsulan" name="namaUsulan" value="{{ old('namaUsulan') }}">
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control" id="keterangan" rows="2" name="keterangan" value="{{ old('keterangan') }}"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
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
                <form>
                    <div class="mb-3">
                        <label for="editNamaOPD" class="form-label">Tindak Lanjut</label>
                        <select class="form-select" id="editNamaOPD">
                            <option selected>--- Pilih OPD ---</option>
                            <option value="Dinas Kesehatan">Dinas Kesehatan</option>
                            <option value="Dinas Pendidikan">Dinas Pendidikan</option>
                        </select>
                    </div>
                    <div class="mb-3 d-flex align-items-center">
                        <label class="form-label me-2">Status</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="editStatus">
                            <label class="form-check-label" for="editStatus">Aktif</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Bagian delete -->
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

<script>
document.querySelectorAll(".edit-btn").forEach(button => {
    button.addEventListener("click", function () {
        document.getElementById("editNamaOPD").value = this.dataset.opd;
        document.getElementById("editNamaUsulan").value = this.dataset.usulan;
        document.getElementById("editTindakLanjut").value = this.dataset.tindak;
        document.getElementById("editKeterangan").value = this.dataset.keterangan;
        document.getElementById("editStatus").checked = this.dataset.status === "Aktif";
        new bootstrap.Modal(document.getElementById("editPemantauanModal")).show();
    });
});
</script>

@endsection
