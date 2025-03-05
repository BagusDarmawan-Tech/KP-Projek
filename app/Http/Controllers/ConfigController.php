<?php

namespace App\Http\Controllers;

use App\Models\ConfigApp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ConfigController extends Controller
{
    public function RoleManagementt() {
        $roles = Role::with('permissions')->get();
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
            'OPD' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Surat' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Super Admin' => ['Full Control ']
        ];
        
        return view('admin.RoleManagement',compact('roles','permissions')); 
    }

    public function storeRoleManagement(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|unique:roles,name',
            'permissions' => 'required|array'
        ],[
            'name.required' => 'Nama role wajib diisi.',
            'name.string' => 'Nama role harus berupa teks.',
            'name.unique' => 'Nama role sudah digunakan, silakan pilih yang lain.',
            'permissions.required' => 'Setidaknya satu izin harus dipilih.',
            'permissions.array' => 'Format izin tidak valid.'
        ]);

        //tambah validasi
        $role = Role::create(['name' => $request->name]);
    
        // Simpan permission
        foreach ($request->permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
            $role->givePermissionTo($perm);
        }
    
        return redirect()->route('HalamanRole')->with('success', 'Role berhasil dibuat.');
    }


    public function RoleEdit(Role $role){
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
            'OPD' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Surat' => ['list', 'add', 'edit', 'delete', 'verifikasi'],
            'Super Admin' => ['Full Control']
        ];
    

    $rolePermissions = $role->permissions->pluck('name')->toArray();

    return view('admin.RoleManagementEdit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(Request $request, Role $role)
{
    $request->validate([
        'name' => 'required|string|unique:roles,name,' . $role->id,
        'permissions' => 'required|array'
    ], [
        'name.required' => 'Nama role wajib diisi.',
        'name.string' => 'Nama role harus berupa teks.',
        'name.unique' => 'Nama role sudah digunakan, silakan pilih yang lain.',
        'permissions.required' => 'Setidaknya satu izin harus dipilih.',
        'permissions.array' => 'Format izin tidak valid.'
    ]);
    

    $role->update(['name' => $request->name]);

    // Hapus permission lama & tambahkan yang baru
    $role->syncPermissions($request->permissions);

    return redirect()->route('HalamanRole')->with('success', 'Role berhasil diperbarui.');
}

public function destroy(Role $role)
{
    $role->delete();
    return redirect()->route('HalamanRole')->with('success', 'Role berhasil dihapus.');
}
    //END ROLE CRUD


    //CRUD CONFIG APP
    
    public function ConfigurasiAPP() {
        $komponents = ConfigApp::all();
        return view('admin.ConfigurasiAPP' ,compact('komponents')); 
    }

    public function storeConfigurasiAPP(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama' => 'required|string|max:255',
            'detail' => 'required|string|max:500'
        ],[
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 255 karakter.',
            
            'detail.required' => 'Detail wajib diisi.',
            'detail.max' => 'Detail maksimal 500 karakter.'
            
        ]);
    
        ConfigApp::create([
            'nama' => $request->nama,
            'detail' => $request->detail, 
        ]);
    
        return redirect()->route('HalamanConfigurasi')->with('success', 'Komponen berhasil ditambahkan!');
    } 

    public function updateConfigurasiAPP(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'nama' => 'required|string|max:255',
            'detail' => 'required|string|max:255'
        ],[
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 255 karakter.',
            
            'detail.required' => 'detail wajib diisi.',
            'detail.max' => 'detail maksimal 255 karakter.'
            
        ]);
    
        $komponen = ConfigApp::findOrFail($id);
    
        // Simpan data baru
        $data = [
            'nama' => $request->nama,
            'detail' => $request->detail
        ];
    
    
        // Update slider
        $komponen->update($data);
    
        return redirect()->route('HalamanConfigurasi')->with('success', 'Komponen berhasil diperbarui!');
    }

    public function destroyConfigurasiAPP($id)
    {
        $komponen = ConfigApp::findOrFail($id);

        $komponen->delete();

        return redirect()->route('HalamanConfigurasi')->with('success', 'Komponen berhasil dihapus!');
    }

    //END CONFIG APP
}
