@extends('admin.admin-master')

@section('main')

<link href="{{ asset('assets/css/tabel.css') }}" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="container mt-5">
    <div class="card shadow-lg border-0 position-relative overflow-hidden mb-4 p-3">
        <div class="card-body">
            <h4 class="fw-bold mb-3 text-center">Kegiatan Forum arek Surabaya</h4>
            <div class="row">
                <div class="col-md-6 ">
                    <label for="userEntri" class="form-label">User Entri</label>
                    <select id="userEntri" class="form-select">
                        <option selected disabled>--- Pilih User Entri ---</option>
                        @php
                            $users = [
                                'dispusip_kla' => 'DISPUSIP KLA',
                                'dp3a' => 'DP3A',
                                'ihsan' => 'Ihsan',
                                'kecamatan_asemrowo' => 'Kecamatan Asemrowo',
                                'kecamatan_benowo' => 'Kecamatan Benowo',
                                'kecamatan_bubutan' => 'Kecamatan Bubutan',
                                'kecamatan_bulak' => 'Kecamatan Bulak',
                                'kecamatan_dukuh_pakis' => 'Kecamatan Dukuh Pakis',
                                'kecamatan_gayungan' => 'Kecamatan Gayungan',
                                'kecamatan_genteng' => 'Kecamatan Genteng',
                                'kecamatan_gubeng' => 'Kecamatan Gubeng',
                                'kecamatan_gunung_anyar' => 'Kecamatan Gunung Anyar',
                                'kecamatan_jambangan' => 'Kecamatan Jambangan',
                                'kecamatan_karang_pilang' => 'Kecamatan Karang Pilang',
                                'kecamatan_kenjeran' => 'Kecamatan Kenjeran',
                                'kecamatan_krembangan' => 'Kecamatan Krembangan',
                                'kecamatan_lakarsantri' => 'Kecamatan Lakarsantri',
                                'kecamatan_mulyorejo' => 'Kecamatan Mulyorejo',
                                'kecamatan_pabean_cantian' => 'Kecamatan Pabean Cantian',
                                'kecamatan_pakal' => 'Kecamatan Pakal',
                                'kecamatan_sambikerep' => 'Kecamatan Sambikerep',
                                'kecamatan_sawahan' => 'Kecamatan Sawahan',
                                'kecamatan_semampir' => 'Kecamatan Semampir',
                                'kecamatan_simokerto' => 'Kecamatan Simokerto',
                                'kecamatan_sukolilo' => 'Kecamatan Sukolilo',
                                'kecamatan_sukomanunggal' => 'Kecamatan Sukomanunggal',
                                'kecamatan_tambaksari' => 'Kecamatan Tambaksari',
                                'kecamatan_tandes' => 'Kecamatan Tandes',
                                'kecamatan_tegalsari' => 'Kecamatan Tegalsari',
                                'kecamatan_tenggilis_mejoyo' => 'Kecamatan Tenggilis Mejoyo',
                                'kecamatan_wiyung' => 'Kecamatan Wiyung',
                                'kecamatan_wonocolo' => 'Kecamatan Wonocolo',
                                'kecamatan_wonokromo' => 'Kecamatan Wonokromo'
                            ];
                        @endphp
                        @foreach($users as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-6">
                    <button class="btn btn-primary" id="btnCari" style="width: 150px;">
                        <i class="bi bi-search"></i> Cari
                    </button>
                </div>
            </div>
            </div>
        </div>
    </div>
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

    <div class="card shadow-lg border-0 position-relative overflow-hidden p-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <!-- <h5 class="fw-bold">Daftar Dokumen</h5> -->
                 <br>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahKegiatan">
                    <i class="bi bi-plus"></i> Tambah kegiatan Forum Anak Surabaya
                </button>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle text-center"  id="myTable">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Nama</th>
                            <th>Keterangan</th>
                            <th>Dibuat Oleh</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($kegiatans as $index => $kegiatan)
                      <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td><img src="{{ asset($kegiatan->gambar) }}" alt="Kegiatan CFCI" width="80"></td>
                          <td>{{ $kegiatan->nama }}</td>
                            <td>{{ $kegiatan->keterangan }}</td>
                            <td>{{ $kegiatan->dibuatOleh }}</td>
                            <td>
                              @if($kegiatan->is_active == 0)
                              <span class="badge bg-warning">Non Aktif</span>
                              @else
                                  <span class="badge bg-success">Aktif</span>
                              @endif

                            </td>
                            <td>
                                <button class="btn btn-sm btn-primary edit-forum" data-bs-toggle="modal" data-bs-target="#modaEditKegiatan"
                                    data-id="{{ $kegiatan->id }}" 
                                    data-nama="{{ $kegiatan->nama }}" 
                                    data-keterangan="{{ $kegiatan->keterangan }}" 
                                    data-gambar="{{ asset($kegiatan->gambar) }}" 
                                    data-status="{{ $kegiatan->is_active }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
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

<!-- Modal Tambah Dokumen Kelurahan -->
<div class="modal fade" id="modalTambahKegiatan" tabindex="-1" aria-labelledby="modalTambahKegiatanLabel" aria-hidden="true">
<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center w-100 ">
                <h5 class="modal-title fw-bold text-center" id="modalTambahKegiatanLabel">Tambah Menu Kegiatan Forum Arek Surabaya</h5>
            </div>
            <div class="modal-body">
      <form method="POST" action="{{ route('createForumAnakSurabaya') }}" enctype="multipart/form-data">
          @csrf 
          <div class="mb-3">
            <label for="namaKegiatan" class="form-label fw-semibold">Nama</label>
            <input type="text" name="nama" class="form-control" id="namaKegiatan" placeholder="Masukkan nama kegiatan">
          </div>
          <div class="mb-3">
            <label for="gambarKegiatan" class="form-label fw-semibold">Gambar</label>
            <input name="gambar" type="file" class="form-control" id="gambarKegiatan" accept="image/*" onchange="previewImage(event)">
            <img id="preview" src="#" alt="Preview" class="img-fluid mt-2 d-none" style="max-height: 200px;">
          </div>
          <div class="mb-3">
            <label for="keteranganKegiatan" class="form-label fw-semibold">Keterangan</label>
            <textarea class="form-control" name="keterangan" id="keteranganKegiatan" rows="3" placeholder="Tambahkan keterangan kegiatan"></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Status</label>
            <select class="form-select" name="is_active" required>
                <option value="1">Aktif</option>
                <option value="0">Non-Aktif</option>
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
</div>

<!-- Modal Edit Dokumen Kelurahan -->
<div class="modal fade" id="modaEditKegiatan" tabindex="-1" aria-labelledby="modaEditKegiatanLabel" aria-hidden="true">
<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center w-100 ">
                <h5 class="modal-title fw-bold text-center" id="modaEditKegiatanLabel">Edit Menu Kegiatan Forum Arek Surabaya</h5>
            </div>
            <div class="modal-body">
                <form id="editFormForum" method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                <div class="mb-3">
                    <label for="namaKegiatan" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="editNamaKegiatan" name="nama">
                </div>
                <div class="mb-3">
                    <label for="editGambar" class="form-label">Gambar</label>
                    <div class="mb-2">
                        <img id="previewGambar" src="#" alt="Preview Gambar" class="img-thumbnail" width="100">
                    </div>
                    <input type="file" class="form-control" id="editGambar" name="gambar">
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
                </div>
                <div class="mb-3">
                    <label for="keteranganKegiatan" class="form-label">Keterangan</label>
                    <textarea class="form-control" name="keterangan" id="editKeterangan" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select class="form-select" id="editStatus" name="is_active" required>
                        <option value="1">Aktif</option>
                        <option value="0">Non-Aktif</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
    </div>
  </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
      document.querySelectorAll(".edit-forum").forEach(button => {
        button.addEventListener("click", function () {
          let id = this.getAttribute("data-id");
          let nama = this.getAttribute("data-nama");
          let keterangan = this.getAttribute("data-keterangan");
          let gambar = this.getAttribute("data-gambar");
          let status = this.getAttribute("data-status");
  
          // Set nilai form dalam modal
          document.getElementById("editNamaKegiatan").value = nama;
          document.getElementById("editKeterangan").value = keterangan;
          document.getElementById("editStatus").value = status;
  
          // Set preview gambar
          document.getElementById("previewGambar").src = gambar;
          document.getElementById("previewGambar").classList.remove("d-none");
  
          // Set action form ke URL update yang sesuai
          document.getElementById("editFormForum").action = `/halamanForum/update/${id}`;
        });
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
