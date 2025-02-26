@extends('admin.admin-master')
@section('main')
<link href="{{ asset('assets/css/tabel.css') }}" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="container">
    <h2>Edit Role</h2>
    <form action="{{ route('updateRole', $role->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="name" class="form-label">Nama Role</label>
            <input type="text" name="name" class="form-control" value="{{ $role->name }}" required>
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
                            <input type="checkbox" class="check-{{ $perm }}" name="permissions[]" 
                                value="{{ strtolower($menu) . '-' . $perm }}" 
                                {{ in_array(strtolower($menu) . '-' . $perm, $rolePermissions) ? 'checked' : '' }}>
                        </td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<script>
    function toggleCheckboxes(headerCheckboxId, className) {
        document.getElementById(headerCheckboxId).addEventListener('change', function() {
            let checkboxes = document.querySelectorAll('.' + className);
            checkboxes.forEach(checkbox => checkbox.checked = this.checked);
        });
    }

    toggleCheckboxes('checkAllList', 'check-list');
    toggleCheckboxes('checkAllAdd', 'check-add');
    toggleCheckboxes('checkAllEdit', 'check-edit');
    toggleCheckboxes('checkAllDelete', 'check-delete');
    toggleCheckboxes('checkAllVerify', 'check-verifikasi');
</script>
@endsection
