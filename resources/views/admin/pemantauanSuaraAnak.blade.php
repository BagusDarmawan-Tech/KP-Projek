@extends('admin.admin-master')

@section('title', 'Pemantauan Suara Anak')

@section('main')

<link href="{{ asset('assets/css/tabel.css') }}" rel="stylesheet">

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

        <!-- Kontrol Show Entries & Search -->
        <div class="row mb-3 align-items-center">
            <div class="col-md-6">
                <label for="showEntries" class="form-label me-2">Tampilkan</label>
                <select id="showEntries" class="form-select form-select-sm d-inline-block" style="width: 80px;">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                data
            </div>
            <div class="col-md-6 text-end">
                <input type="text" id="searchInput" class="form-control form-control-sm d-inline-block" placeholder="Cari..." style="width: 200px;">
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
                            <!-- Tombol Tindak Lanjut -->
                            <button class="btn btn-sm rounded-circle" style="background-color: #6A0DAD; width: 36px; height: 36px;"
                                data-bs-toggle="modal" data-bs-target="#tindakLanjutModal">
                                <i class="bi bi-calendar text-white fs-6"></i>
                            </button>
                            
                            <!-- Tombol Finalisasi -->
                            <button class="btn btn-sm rounded-circle" style="background-color: #FFC107; width: 36px; height: 36px;"
                                data-bs-toggle="modal" data-bs-target="#finalisasiModal">
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

<!-- Modal Tindak Lanjut -->
<div class="modal fade" id="tindakLanjutModal" tabindex="-1" aria-labelledby="tindakLanjutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex flex-column align-items-center">
            <h5 class="modal-title fw-bold text-center mb-0" id="tindakLanjutModalLabel">Tindak Lanjut </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('createTindakLanjut') }}" >
                    @csrf 
                <div class="mb-3">
                    <label class="form-label">Tindak Lanjut</label>
                    <textarea class="form-control" name="tindakLanjut" rows="3" required placeholder="Masukkan tindak lanjut"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal Tindak Lanjut</label>
                    <input type="datetime-local" class="form-control" name="tanggalTindakLanjut" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Upload Foto</label>
                    <input type="file" class="form-control" name="file" accept=".pdf, .doc, .docx">
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
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Apakah Anda Yakin?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <p>Akan memfinalisasi data ini!</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger">Konfirmasi</button>
            </div>
        </div>
    </div>
</div>
@endsection
