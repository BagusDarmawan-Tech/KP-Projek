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
            <div class="text-center mb-4">
                <h4 class="fw-bold">Configurasi APP</h4>
            </div>
            
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div></div> <!-- Spacer -->
                @if (auth()->user()->hasPermissionTo('configurasi app-add'))
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kategoriModal">
                    + Tambah Configurasi APP
                </button>
                @endif
            </div>

            <!-- Tabel -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle text-center" id="myTable">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Detail</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-start">
                        @foreach($komponents as $index => $komponen)
                        <tr>
                            <td style="text-align: center;">{{ $loop->iteration }}</td>
                            <td>{{ $komponen->nama }}</td>
                            <td>{{ $komponen->detail }}</td>
                            <td>
                            @if (auth()->user()->hasPermissionTo('configurasi app-edit'))
                                <button class="btn btn-sm btn-primary btn-edit-kegiatan"
                                    data-id="{{ $komponen->id }}"
                                    data-nama="{{ $komponen->nama }}"
                                    data-detail="{{ $komponen->detail }}"
                                    data-bs-toggle="modal"
                                    data-bs-target="#EditModal">
                                    <i class="bi bi-pencil-square"></i>
                                </button> 
                            @endif
                             <!-- Tombol Hapus -->
                             @if (auth()->user()->hasPermissionTo('configurasi app-delete'))
                             <button class="btn btn-sm btn-danger delete-btn" 
                                data-id  ="{{ $komponen->id }}"
                                data-nama ="{{ $komponen->nama }}"
                                data-bs-toggle="modal" 
                                data-bs-target="#deleteMenuModal"><i class="bi bi-trash"></i>
                            </button>  
                            @endif                          
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal Tambah connfig -->
<div class="modal fade" id="kategoriModal" tabindex="-1" aria-labelledby="kategoriModalLabel" aria-hidden="true">
<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center w-100 ">
                <h5 class="modal-title fw-bold text-center" id="kategoriModalLabel">Tambah Menu Configurasi APP</h5>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('createConfigurasiAPP') }}" >
                    @csrf 
                    <div class="mb-3">
                        <label for="kategoriNama" class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" id="kategoriNama" placeholder="Masukkan Nama">
                    </div>
                    <div class="mb-3">
                        <label for="kategoriSlug" class="form-label">Detail</label>
                        <input type="text" name="detail" class="form-control" id="kategoriSlug" placeholder="Masukkan Detail">
                    </div>
                  <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- bagian edit -->
<div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="EditModalLabel" aria-hidden="true">
<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center w-100 ">
                <h5 class="modal-title fw-bold text-center" id="EditModalLabel">Edit Menu Configurasi APP</h5>
            </div>
            <div class="modal-body">
                <form id="editForm" method="POST" enctype="multipart/form-data">
                    @csrf
                   @method('PUT')
                   <input type="hidden" id="editId" name="id">
                   @if (auth()->user()->hasPermissionTo('configurasi app-add'))
                    <div class="mb-3">
                        <label for="kategoriNama" class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" id="editNama" placeholder="Masukkan Nama">
                    </div>
                    @else
                        <input type="hidden" name="nama" id="editNama">
                    @endif
                    <div class="mb-3">
                        <label for="kategoriSlug" class="form-label">Detail</label>
                        <input type="text" name="detail" class="form-control" id="editDetail" placeholder="Masukkan Detail">
                    </div>
                  <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
                </form>
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
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <input type="hidden" id="deleteId" name="id">
                    <p>Apakah Anda yakin ingin menghapus record<br> <strong id="deleteNama"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
      document.querySelectorAll(".btn-edit-kegiatan").forEach(button => {
          button.addEventListener("click", function () {
              let id = this.getAttribute("data-id");
              let nama = this.getAttribute("data-nama");
              let detail = this.getAttribute("data-detail");

            console.log(detail);
              document.getElementById("editId").value = id;
              document.getElementById("editNama").value = nama;
              document.getElementById("editDetail").value = detail;
  
  
              // Pastikan action form mengarah ke URL update yang benar
              document.getElementById("editForm").action = `/configurasiAPP/update/${id}`;
          });
      });
  });
  </script>


<!-- Script Delete Data ke Modal -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".delete-btn").forEach(button => {
            button.addEventListener("click", function() {
                let id = this.getAttribute("data-id");
                let nama = this.getAttribute("data-nama");
  
                console.log(id)
                console.log(nama)
  
                document.getElementById("deleteId").value = id;
                document.getElementById("deleteNama").textContent = nama; // Tampilkan nama di modal
  
                // Set action form agar mengarah ke endpoint delete yang benar
                document.getElementById("deleteForm").action = `/ConfigurasiAPP/hapus/${id}`;
            });
        });
    });
  </script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var kategoriModal = new bootstrap.Modal(document.getElementById("kategoriModal"));
    });
</script>



@endsection