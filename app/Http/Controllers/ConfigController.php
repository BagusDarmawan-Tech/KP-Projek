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
        ];
        return view('admin.RoleManagement',compact('roles','permissions')); 
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
            'detail' => 'required|string|max:255'
        ],[
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 255 karakter.',
            
            'detail.required' => 'Detail wajib diisi.',
            'detail.max' => 'Detail maksimal 255 karakter.'
            
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
