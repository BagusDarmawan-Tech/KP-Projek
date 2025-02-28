@extends('admin.admin-master')

@section('title', 'Dokumen Kecamatan')

@section('main')

<link href="{{ asset('assets/css/tabel.css') }}" rel="stylesheet">

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
                <h4 class="fw-bold">Users Management</h4>
            </div>
            <!-- Kontrol Atas -->
            <!-- Tombol + Dokumen Kecamatan di kanan atas -->
            <div class="row mb-3">
                <div class="col-md-12 d-flex justify-content-end">
                    @if (auth()->user()->hasPermissionTo('user management-add'))
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#subKegiatanModal">
                        Registrasi User
                    </button>
                    @endif
                </div>
            </div>
    
            <!-- Kontrol Atas (Show Entries & Search) -->
    
    
            <!-- Tabel -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle text-center" id="myTable">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user as $person)
                        <tr>
                            <td style="text-align: center;">{{ $loop->iteration }}</td>
                            <td>{{ $person->name }}</td>
                            <td>{{ $person->email }}</td>
                            <td>{{ $person->getRoleNames()->implode(', ') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>


<!-- Modal Tambah Sub Kegiatan -->
<div class="modal fade" id="subKegiatanModal" tabindex="-1" aria-labelledby="subKegiatanModalLabel" aria-hidden="true">
<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center w-100 ">
                <h5 class="modal-title fw-bold text-center" id="subKegiatanModalLabel">Tambah User</h5>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('register') }}">
                @csrf    
                    <div class="mb-3">
                        <label class="form-label" for="name" :value="__('Name')">Nama</label>
                        <input type="text" class="form-control"  id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" >
                        <x-input-error :messages="$errors->get('name')" class="text-danger" />
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select class="form-select" name="role" >
                            <option selected disabled>--- Pilih Role ---</option>
                            @foreach ($roles as $role )
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                            <option value="admin">Admin</option>
                            <option value="opd">OPD</option>
                            <option value="user">User</option>
                        </select>
                        <x-input-error :messages="$errors->get('role')" class="text-danger" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="email" :value="__('Email')">Email</label>
                        <input type="email" class="form-control" name="email" :value="old('email')" >
                        <x-input-error :messages="$errors->get('email')" class="text-danger" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="password" :value="__('Password')">Password</label>
                        <input id="password" name="password" type="password" class="form-control"  autocomplete="new-password">
                        <x-input-error :messages="$errors->get('password')" class="text-danger" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="password_confirmation" :value="__('Confirm Password')">Confirm Password</label>
                        <input id="password_confirmation" class="form-control"
                        type="password"
                        name="password_confirmation"  autocomplete="new-password">
                        <x-input-error :messages="$errors->get('password_confirmation')" class="text-danger" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
                </div>
                        </form>
        </div>
    </div>
</div>


<!-- Modal Edit Kegiatan -->
<div class="modal fade" id="EditKegiatanManModal" tabindex="-1" aria-labelledby="EditKegiatanManModalLabel" aria-hidden="true">
<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center w-100 ">
                <h5 class="modal-title fw-bold text-center" id="EditKegiatanManModalLabel">Edit Menu User</h5>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('register') }}">
                @csrf    
                    <div class="mb-3">
                        <label class="form-label" for="name" :value="__('Name')">Nama</label>
                        <input type="text" class="form-control"  id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"  required>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select class="form-select" name="role" required>
                            <option selected disabled>--- Pilih Role ---</option>
                            <option value="developer">Developer</option>
                            <option value="admin">Admin</option>
                            <option value="opd">OPD</option>
                            <option value="user">User</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="email" :value="__('Email')">Email</label>
                        <input type="email" class="form-control" name="email" :value="old('email')" required>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="password" :value="__('Password')">Password</label>
                        <input id="password" name="password" type="password" class="form-control" required autocomplete="new-password">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="password_confirmation" :value="__('Confirm Password')">Confirm Password</label>
                        <input id="password_confirmation" class="form-control"
                        type="password"
                        name="password_confirmation" required autocomplete="new-password">
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <!-- <option selected>--- Pilih Status ---</option> -->
                            <option value="Aktif">Aktif</option>
                            <option value="Non-Aktif">Non-Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
                </div>
        </div>
    </div>
</div>

<!-- MOdal delete -->
 
<div class="modal fade" id="deleteMenuModal" tabindex="-1" aria-labelledby="deleteMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteMenuModalLabel">Hapus Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus Data di Menu ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>



@endsection
