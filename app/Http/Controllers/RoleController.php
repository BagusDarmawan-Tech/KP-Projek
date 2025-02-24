<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();
        return view('admin.index-coba', compact('roles'));
    }

    public function create()
    {
        $permissions = [
            'User Management' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Role Management' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Configurasi APP' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Menu Management' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Artikel' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Kategori Artikel' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Slider' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Klaster' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Sub Kegiatan' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Galeri' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Forum Anak' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Halaman' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Pemantauan Usulan' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Dokumen Kecamatan' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Kegiatan Kecamatan' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Dokumen Kelurahan' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Kegiatan Kelurahan' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'CFCI' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Artikel Anak' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Kegiatan Mitra Anak' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Kegiatan PISA' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Dokumen PISA' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Kegiatan Arek Suroboyo' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Kegiatan Forum Anak Suroboyo' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Pemantauan Suara Anak' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Karya' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Dokumen SK FAS, CFCI dan KLA' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
        ];
    
        return view('admin.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name',
            'permissions' => 'required|array'
        ]);
    
        $role = Role::create(['name' => $request->name]);
    
        // Simpan permission
        foreach ($request->permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
            $role->givePermissionTo($perm);
        }
    
        return redirect()->route('admin.index')->with('success', 'Role berhasil dibuat.');
    }
    
    public function edit(Role $role){
        $permissions = [
            'User Management' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Role Management' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Configurasi APP' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Menu Management' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Artikel' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Kategori Artikel' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Slider' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Klaster' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Sub Kegiatan' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Galeri' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Forum Anak' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Halaman' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Pemantauan Usulan' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Dokumen Kecamatan' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Kegiatan Kecamatan' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Dokumen Kelurahan' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Kegiatan Kelurahan' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'CFCI' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Artikel Anak' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Kegiatan Mitra Anak' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Kegiatan PISA' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Dokumen PISA' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Kegiatan Arek Suroboyo' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Kegiatan Forum Anak Suroboyo' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Pemantauan Suara Anak' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Karya' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Dokumen SK FAS, CFCI dan KLA' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
        ];
    

    $rolePermissions = $role->permissions->pluck('name')->toArray();

    return view('admin.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(Request $request, Role $role)
{
    $request->validate([
        'name' => 'required|string|unique:roles,name,' . $role->id,
        'permissions' => 'required|array'
    ]);

    $role->update(['name' => $request->name]);

    // Hapus permission lama & tambahkan yang baru
    $role->syncPermissions($request->permissions);

    return redirect()->route('admin.index')->with('success', 'Role berhasil diperbarui.');
}

public function destroy(Role $role)
{
    $role->delete();
    return redirect()->route('admin.index')->with('success', 'Role berhasil dihapus.');
}



}
