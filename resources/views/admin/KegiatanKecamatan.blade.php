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
  @if(session('success'))
  <div class="alert alert-success">
      <ul>
              <li>{{ session('success') }}</li>
      </ul>
  </div>
  @endif
    <div class="card shadow-lg border-0 position-relative overflow-hidden mb-4 p-3">
        <div class="card-body">
            <h4 class="fw-bold mb-3 text-center">Kegiatan Kecamatan</h4>
            <div class="row">
                <div class="col-md-6 col-12">
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
                <div class="col-md-6 col-12">
                    <button class="btn btn-primary w-100" id="btnCari">
                        <i class="bi bi-search"></i> Cari
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="card shadow-lg border-0 position-relative overflow-hidden p-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <!-- <h5 class="fw-bold">Daftar Dokumen</h5> -->
                 <br>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahKegiatan">
                    <i class="bi bi-plus"></i> Kegiatan Kecamatan 
                </button>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle text-center" id="myTable">
                    <thead class="table-primary">        
                        <tr>
                            <th class="text-center" >No</th>
                            <th class="text-center">Gambar</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Keterangan</th>
                            <th class="text-center">Dibuat Oleh</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($kegiatans as $index => $kegiatan)
                      <tr>
                          <td style="text-align: center;">{{ $loop->iteration }}</td>
                            <td><img src="{{ asset($kegiatan->gambar) }}" alt="Slider Image" width="80"></td>

                            <td>{{ $kegiatan->nama }}</td>
                            <td>{{ $kegiatan->dibuatOleh }}</td>
                            <td>{{ $kegiatan->keterangan }}</td>
                            <td>
                              @if($kegiatan->is_active == 0)
                                  <span class="badge bg-warning">Non Aktif</span>
                              @else
                                  <span class="badge bg-success">Aktif</span>
                              @endif
                            </td>  
                            <td>
                              <button class="btn btn-sm btn-primary btn-edit-kegiatan"
                                data-id="{{ $kegiatan->id }}"
                                data-nama="{{ $kegiatan->nama }}"
                                data-gambar="{{ asset($kegiatan->gambar) }}"
                                data-status="{{ $kegiatan->is_active }}"
                                data-kecamatan="{{ $kegiatan->kecamatanid }}"
                                data-keterangan="{{ $kegiatan->keterangan }}"
                                data-status="{{ $kegiatan->is_active }}"
                                data-bs-toggle="modal"
                                data-bs-target="#modaEditKegiatan">
                                <i class="bi bi-pencil-square"></i>
                              </button>                                 
                                <!-- Tombol Hapus -->
                                <button class="btn btn-sm btn-danger delete-btn" 
                                    data-id  ="{{ $kegiatan->id }}"
                                    data-nama ="{{ $kegiatan->nama }}"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteMenuModal"><i class="bi bi-trash"></i>
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

<!-- Modal Tambah Dokumen Kecamatan -->
<div class="modal fade" id="modalTambahKegiatan" tabindex="-1" aria-labelledby="modalTambahKegiatanLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header d-flex justify-content-center w-100 ">
        <h5 class="modal-title modal-title fw-bold text-center" id="modalTambahKegiatanLabel">Tambah Kegiatan Kecamatan Baru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('createKegiatanKecamatan') }}" enctype="multipart/form-data">
          @csrf 
          <div class="mb-3">
            <label for="kegiatan" class="form-label">Kecamatan</label>
            <select class="form-select" id="kegiatan" name="kecamatanid" required>
                <option value="" disabled selected>-- Pilih Kecamatan --</option>
                @foreach ($kecamatans as $kecamatan)
                    <option value="{{ $kecamatan->id }}" {{ old('subkegiatanid') == $kecamatan->id ? 'selected' : '' }} >
                        {{ $kecamatan->nama }}
                    </option>
                @endforeach
            </select>
         </div>
          <div class="mb-3">
            <label for="namaKegiatan" class="form-label fw-semibold">Nama</label>
            <input type="text" class="form-control" name="nama" id="namaKegiatan" placeholder="Masukkan nama kegiatan">
          </div>
          <div class="mb-3">
            <label for="gambarKegiatan" class="form-label fw-semibold">Gambar</label>
            <input type="file" name="gambar" class="form-control" id="gambarKegiatan" accept="image/*" onchange="previewImage(event)">
          </div>
          <div class="mb-3">
            <label for="keteranganKegiatan" class="form-label fw-semibold">Keterangan</label>
            <textarea class="form-control" name="keterangan" id="keteranganKegiatan" rows="3" placeholder="Tambahkan keterangan kegiatan"></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Status</label>
            <div class="form-check form-switch">
                <!-- Hidden input sebagai fallback jika checkbox tidak dicentang -->
                <input type="hidden" name="is_active" value="0">
                
                <input class="form-check-input" name="is_active" type="checkbox" id="status" value="1" checked>
                <label class="form-check-label" for="status">Aktif</label>
            </div>
          </div>
        
          <input type="hidden" name="dibuatOleh" value="{{ Auth::user()->name }}">        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Edit Dokumen Kecamatan -->
<div class="modal fade" id="modaEditKegiatan" tabindex="-1" aria-labelledby="modaEditKegiatanLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header modal-header d-flex justify-content-center w-100 ">
        <h5 class="modal-title fw-bold text-center" id="modaEditKegiatan">Edit Kegiatan Kecamatan</h5>
        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
      </div>
      <div class="modal-body">
        <form id="editKegiatanForm" method="POST" enctype="multipart/form-data">
          @csrf
         @method('PUT')
         <input type="hidden" id="editId" name="id">
         <div class="mb-3">
          <label for="kegiatan" class="form-label">Kecamatan</label>
          <select class="form-select" id="editKecamatan" name="kecamatanid" required>
              <option value="" disabled selected>-- Pilih Kecamatan --</option>
              @foreach ($kecamatans as $kecamatan)
                  <option value="{{ $kecamatan->id }}" {{ old('subkegiatanid') == $kecamatan->id ? 'selected' : '' }} >
                      {{ $kecamatan->nama }}
                  </option>
              @endforeach
          </select>
       </div>
          <div class="mb-3">
            <label for="namaKegiatan" class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" id="editNama">
          </div>
          <div class="mb-3">
            <label for="gambarKegiatan" class="form-label">Gambar</label>
            <input type="file" name="gambar" class="form-control" id="editGambar" accept="image/*" onchange="previewImage(event)">
            <img id="previewGambar" src="#" alt="Preview Gambar" class="img-fluid mt-2 d-none" style="max-height: 200px;">
        </div>
          <div class="mb-3">
            <label for="keteranganKegiatan" class="form-label">Keterangan</label>
            <textarea class="form-control" name="keterangan" id="editKeterangan" rows="3"></textarea>
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
      </div>
    </form>
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
            let gambar = this.getAttribute("data-gambar");
            let kecamatan = this.getAttribute("data-kecamatan");
            let keterangan = this.getAttribute("data-keterangan");
            let status = this.getAttribute("data-status");

            console.log("Gambar URL:", gambar); // Debugging

            document.getElementById("editId").value = id;
            document.getElementById("editNama").value = nama;
            document.getElementById("editKecamatan").value = kecamatan;
            document.getElementById("editKeterangan").value = keterangan;
            document.getElementById("editStatus").checked = status == "1";

            // Set preview gambar
            let previewGambar = document.getElementById("previewGambar");
            if (gambar && gambar !== "null") {
                previewGambar.src = gambar;
                previewGambar.classList.remove("d-none");
            } else {
                previewGambar.src = "#";
                previewGambar.classList.add("d-none");
            }

            // Pastikan action form mengarah ke URL update yang benar
            document.getElementById("editKegiatanForm").action = `/kegiatanKecamatan/update/${id}`;
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
              document.getElementById("deleteForm").action = `/kegiatanKecamatan/hapus/${id}`;
          });
      });
  });
</script>
@endsection
