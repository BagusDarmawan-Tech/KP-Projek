@extends('admin.admin-master')
@section('main')
<link href="{{ asset('assets/css/tabel.css') }}" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<div class="container mt-5">
    <div class="card shadow-lg border-0 position-relative overflow-hidden mb-5">
        <div class="card-body mt-4">
            <div class="text-center mb-4">
                <h4 class="fw-bold">Menu Management</h4>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div></div> <!-- Spacer -->
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#menuModal">+ Tambah Menu Management</button> 
            </div>
            <!-- Kontrol Atas -->
            <div class="row mb-3">
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
                    <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Search..." style="width: 200px;">
                </div>
            </div>

            <!-- Tabel -->
            <table id="menuTable" class="table table-hover table-bordered text-center">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Nama Menu</th>
                        <th>Module</th>
                        <th>URL</th>
                        <th>Urutan</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Kegiatan Forum Anak Kecamatan</td>
                        <td></td>
                        <td>kegiatan_kecamatan</td>
                        <td>
                            <button class="btn btn-sm btn-link p-0" onclick="toggleRowOrder(this)">&#8593;</button>
                        </td>
                        <td>&#10004;</td>
                        <td>
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editMenuModal"><i class="bi bi-pencil-square"></i></button>
                            <button class="btn btn-sm btn-danger delete-slider"><i class="bi bi-trash"></i> </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Menu -->
<div class="modal fade" id="menuModal" tabindex="-1" aria-labelledby="menuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center w-100 ">
                <h5 class="modal-title fw-bold text-center" id="menuModalLabel">Tambah Menu Management Baru</h5>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="menuName" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="menuName" placeholder="Masukkan nama menu">
                    </div>
                    <div class="mb-3">
                        <label for="menuParent" class="form-label">Parent</label>
                        <select id="menuParent" class="form-select">
                            <option>--- Pilih Parent ---</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="menuModule" class="form-label">Modul</label>
                        <select id="menuModule" class="form-select">
                            <option>--- Pilih Modul ---</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="menuLink" class="form-label">Link</label>
                        <select id="menuLink" class="form-select">
                            <option>--- Pilih Link ---</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <!-- <option selected>--- Pilih Status ---</option> -->
                            <option value="Aktif">Aktif</option>
                            <option value="Non-Aktif">Non-Aktif</option>
                        </select>
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

<!-- Modal Edit Menu -->
    <div class="modal fade" id="editMenuModal" tabindex="-1" aria-labelledby="editMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center w-100 ">
                <h5 class="modal-title fw-bold text-center" id="menuModalLabel">Edit Menu Management Baru</h5>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="editMenuName" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="editMenuName" placeholder="Masukkan nama menu">
                    </div>
                    <div class="mb-3">
                        <label for="editMenuParent" class="form-label">Parent</label>
                        <select id="editMenuParent" class="form-select">
                            <option>--- Pilih Parent ---</option>
                            <!-- Tambahkan opsi sesuai kebutuhan -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editMenuModule" class="form-label">Modul</label>
                        <select id="editMenuModule" class="form-select">
                            <option>--- Pilih Modul ---</option>
                            <!-- Tambahkan opsi sesuai kebutuhan -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editMenuLink" class="form-label">Link</label>
                        <select id="editMenuLink" class="form-select">
                            <option>--- Pilih Link ---</option>
                            <!-- Tambahkan opsi sesuai kebutuhan -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <!-- <option selected>--- Pilih Status ---</option> -->
                            <option value="Aktif">Aktif</option>
                            <option value="Non-Aktif">Non-Aktif</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Update changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete Menu -->
<div class="modal fade" id="deleteMenuModal" tabindex="-1" aria-labelledby="deleteMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteMenuModalLabel">Hapus Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus menu ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleRowOrder(button) {
        let row = button.closest('tr');
        let previousRow = row.previousElementSibling;
        let nextRow = row.nextElementSibling;

        if (previousRow && button.textContent === "↑") {
            row.parentNode.insertBefore(row, previousRow);
            button.textContent = "↓";
        } else if (nextRow && button.textContent === "↓") {
            row.parentNode.insertBefore(nextRow, row);
            button.textContent = "↑";
        }
    }
    </script>
    <!-- // !-- Bagian delete --> 
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
