@extends('admin.admin-master')
@section('main')
<div class="container">
    <h2>Buat Role Baru</h2>
    <form action="{{ route('admin.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Role</label>
            <input type="text" name="name" class="form-control" placeholder="Masukkan Nama" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <h4>Akses</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Menu</th>
                    <th><input type="checkbox" id="checkAllList"> List</th>
                    <th><input type="checkbox" id="checkAllAdd"> Add</th>
                    <th><input type="checkbox" id="checkAllEdit"> Edit</th>
                    <th><input type="checkbox" id="checkAllDelete"> Delete</th>
                    <th><input type="checkbox" id="checkAllVerify"> Verifikasi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($permissions as $menu => $perms)
                <tr>
                    <td><strong>{{ $menu }}</strong></td>
                    @foreach($perms as $index => $perm)
                        <td>
                            <input type="checkbox" class="check-{{ $perm }}" name="permissions[]" value="{{ strtolower($menu) . '-' . $perm }}">
                        </td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>

<script>
    // Fungsi untuk checklist semua checkbox dalam satu kolom
    document.getElementById('checkAllList').addEventListener('change', function() {
        let checkboxes = document.querySelectorAll('.check-list');
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
    });

    document.getElementById('checkAllAdd').addEventListener('change', function() {
        let checkboxes = document.querySelectorAll('.check-add');
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
    });

    document.getElementById('checkAllEdit').addEventListener('change', function() {
        let checkboxes = document.querySelectorAll('.check-edit');
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
    });

    document.getElementById('checkAllDelete').addEventListener('change', function() {
        let checkboxes = document.querySelectorAll('.check-delete');
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
    });

    document.getElementById('checkAllVerify').addEventListener('change', function() {
        let checkboxes = document.querySelectorAll('.check-verifikasi');
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
    });
</script>
@endsection
