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
            <h4 class="fw-bold mb-3 text-center">Dokumen Kelurahan</h4>
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

    <div class="card shadow-lg border-0 position-relative overflow-hidden p-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold">Daftar Dokumen</h5>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#TambahDokumenModal">
                    <i class="bi bi-plus"></i> Dokumen Kelurahan
                </button>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle text-center" id="myTable">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Jenis Dokumen</th>
                            <th class="text-center">Nama Dokumen</th>
                            <th class="text-center">Data Dukung</th>
                            <th class="text-center">Dibuat Oleh</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dokumens as $index => $dokumen)
                        <tr>
                            <td style="text-align: center;">{{ $loop->iteration }}</td>
                            <td> {{ $dokumen->surat ? $dokumen->surat->nama : 'Tidak ada surat' }}</td>                            <td>{{ $dokumen->nama }}</td>
                            <td>
                                <a href="{{ asset($dokumen->dataPendukung) }}" target="_blank">
                                    <i class="fas fa-file-pdf text-danger fa-2x"></i>
                                </a>
                            </td>
                            <td>{{ $dokumen->dibuatOleh }}</td>
                            <td>
                                @if($dokumen->is_active == 0)
                                <span class="badge bg-warning">Non Aktif</span>
                                @else
                                    <span class="badge bg-success">Aktif</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-sm btn-primary btn-edit-dokumen"
                                    data-id="{{ $dokumen->id }}"
                                    data-nama="{{ $dokumen->nama }}"
                                    data-file="{{ asset($dokumen->dataPendukung) }}"
                                    data-status="{{ $dokumen->is_active }}"
                                    data-jenisSurat="{{ $dokumen->jenis_suratid }}"
                                    data-kelurahan="{{ $dokumen->kelurahanid }}"
                                    data-keterangan="{{ $dokumen->keterangan }}"
                                    data-status="{{ $dokumen->is_active }}"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editDokumenModal">
                                    <i class="bi bi-pencil-square"></i>
                                </button>

                                <!-- Tombol Hapus -->
                                <button class="btn btn-sm btn-danger delete-btn" 
                                    data-id  ="{{ $dokumen->id }}"
                                    data-nama ="{{ $dokumen->nama }}"
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

<!-- Modal Tambahan Dokumen Kelurahan -->
<div class="modal fade" id="TambahDokumenModal" tabindex="-1" aria-labelledby="TambahDokumenModalLabel" aria-hidden="true">
    <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-center w-100 ">
                    <h5 class="modal-title fw-bold text-center" id="TambahDokumenModalLabel">Tambah Menu Dokumen Kelurahan Baru</h5>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('createDokumenKelurahan') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="kegiatan" class="form-label">Jenis Surat</label>
                            <select class="form-select" id="kegiatan" name="jenis_suratid" required>
                                <option value="" disabled selected>-- Pilih Surat --</option>
                                @foreach ($surats as $surat)
                                    <option value="{{ $surat->id }}" {{ old('subkegiatanid') == $surat->id ? 'selected' : '' }} >
                                        {{ $surat->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="kegiatan" class="form-label">Kelurahan</label>
                            <select class="form-select" id="kegiatan" name="kelurahanid" required>
                                <option value="" disabled selected>-- Pilih Kelurahan --</option>
                                @foreach ($kelurahans as $kelurahan)
                                    <option value="{{ $kelurahan->id }}" {{ old('subkegiatanid') == $kelurahan->id ? 'selected' : '' }} >
                                        {{ $kelurahan->nama }}
                                    </option>
                                @endforeach
                            </select>
                         </div>
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Data Dukung</label>
                            <input type="file" class="form-control" name="dataPendukung">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <textarea class="form-control" name="keterangan"></textarea>
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
                    
                </div>
                <input type="hidden" name="dibuatOleh" value="{{ Auth::user()->name }}">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
</div>


<!-- Modal Edit Dokumen Kelurahan -->
<div class="modal fade" id="editDokumenModal" tabindex="-1" aria-labelledby="editDokumenModalLabel" aria-hidden="true">
<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center w-100 ">
                <h5 class="modal-title fw-bold text-center" id="editDokumenModalLabel">Edit Menu Dokumen Kelurahan</h5>
            </div>
            <div class="modal-body">
                <form id="editDokumenForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editId" name="id">
                    <div class="mb-3">
                        <label for="kegiatan" class="form-label">Jenis Surat</label>
                        <select class="form-select" id="editJenisSurat" name="jenis_suratid" required>
                            <option value="" disabled selected>-- Pilih Surat --</option>
                            @foreach ($surats as $surat)
                                <option value="{{ $surat->id }}" {{ old('subkegiatanid') == $surat->id ? 'selected' : '' }} >
                                    {{ $surat->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="kegiatan" class="form-label">Kelurahan</label>
                        <select class="form-select" id="editKelurahan" name="kelurahanid" required>
                            <option value="" disabled selected>-- Pilih Kelurahan --</option>
                            @foreach ($kelurahans as $kelurahan)
                                <option value="{{ $kelurahan->id }}" {{ old('subkegiatanid') == $kelurahan->id ? 'selected' : '' }} >
                                    {{ $kelurahan->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" id="editNama" name="nama">
                    </div>
                    <div class="mb-3">
                        <label for="editFile" class="form-label">Edit File Data Pendukung</label>
                        <div class="mb-2">
                            <a id="previewFile" href="#" target="_blank" class="btn btn-secondary btn-sm">Lihat File Saat Ini</a>
                        </div>
                        <input type="file" class="form-control" id="editFile" name="dataPendukung">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah file.</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea id="editKeterangan" class="form-control" name="keterangan" ></textarea>
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

{{-- //update --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".btn-edit-dokumen").forEach(button => {
        button.addEventListener("click", function () {
            let id = this.getAttribute("data-id");
            let nama = this.getAttribute("data-nama");
            let jenisSurat = this.getAttribute("data-jenisSurat");
            let kelurahan = this.getAttribute("data-kelurahan");
            let file = this.getAttribute("data-file");
            let keterangan = this.getAttribute("data-keterangan");
            let status = this.getAttribute("data-status");

            console.log(status)
            document.getElementById("editId").value = id;
            document.getElementById("editNama").value = nama;
            document.getElementById("editJenisSurat").value = jenisSurat;
            document.getElementById("editKelurahan").value = kelurahan;
            document.getElementById("previewFile").href = file;
            document.getElementById("editKeterangan").value = keterangan;
            document.getElementById("editStatus").checked = status == "1";

            // Pastikan action form mengarah ke URL update yang benar
            document.getElementById("editDokumenForm").action = `/dokumenKelurahan/update/${id}`;
         
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
                document.getElementById("deleteForm").action = `/dokumenKelurahan/hapus/${id}`;
            });
        });
    });
  </script>

@endsection
