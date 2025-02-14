@extends('admin.admin-master')
@section('main')
<link href="{{ asset('assets/css/tabel.css') }}" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="container mt-5">
    <div class="card shadow-lg border-0 position-relative overflow-hidden mb-5"> 
        <div class="card-body mt-4">
            <div class="text-center mb-4">
                <h4 class="fw-bold">Role Management</h4>
            </div>
            
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div></div> <!-- Spacer -->
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kategoriModal">
                    + Tambah Role
                </button>
            </div>

            <!-- Kontrol Atas (Tampilkan & Cari) -->
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
                            <th>Nama</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Artikel</td>
                            <td>
                            <button class="btn btn-sm btn-primary edit-btn" data-bs-toggle="modal" data-bs-target="#EditModal"data-status="Aktif"><i class="bi bi-pencil-square"></i></button>
                            <button class="btn btn-sm btn-danger delete-slider"><i class="bi bi-trash"></i> </button>                            
                        </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal Tambah  -->
<div class="modal fade" id="kategoriModal" tabindex="-1" aria-labelledby="kategoriModalLabel" aria-hidden="true">
<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center w-100 ">
                <h5 class="modal-title fw-bold text-center" id="kategoriModalLabel">Tambah Menu Role Management</h5>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="kategoriNama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="kategoriNama" placeholder="Masukkan Nama">
                    </div>
                    </div>
                    <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- bagian Edit -->
 <!-- Modal Tambah Klaster -->
<div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="EditModalLabel" aria-hidden="true">
<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center w-100 ">
                <h5 class="modal-title fw-bold text-center" id="EditModalLabel">Edit  Menu Role Management</h5>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="kategoriNama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="kategoriNama" placeholder="Masukkan Nama">
                    </div>
                    </div>
                    <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
                </form>
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