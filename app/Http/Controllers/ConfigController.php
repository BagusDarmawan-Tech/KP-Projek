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
        $roles = Role::all();
        return view('admin.RoleManagement',compact('roles')); 
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
