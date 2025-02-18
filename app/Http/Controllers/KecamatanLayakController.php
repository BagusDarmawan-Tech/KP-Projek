<?php

namespace App\Http\Controllers;

use App\Models\DokumenKecamatan;
use App\Models\JenisSurat;
use App\Models\Kecamatan;
use App\Models\KegiatanKecamatan;
use Illuminate\Http\Request;

class KecamatanLayakController extends Controller
{
    public function dokumenkec() {
        $kecamatans = Kecamatan::all();
        $surats = JenisSurat::all();
        $dokumens = DokumenKecamatan::all();
        return view('admin.DokumenKecamatan',compact('kecamatans','surats','dokumens')); 
    }
    public function storeDokumenKecamatan(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama' => 'required|string|max:255',
            'dataPendukung' => 'required|mimes:pdf|max:10048', 
            'keterangan' => 'required|string|max:500',
            'is_active' => 'required|in:0,1', 
            // 'jenis_suratid' =>'required',
            'kecamatanid' =>'required',
        ],[
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 255 karakter.',
            
            'keterangan.required' => 'Keterangan wajib diisi.',
            'keterangan.max' => 'Keterangan maksimal 500 karakter.',
            
            'dataPendukung.required' => 'Data Pendukung wajib diunggah.',
            'dataPendukung.mimes' => 'Data Pendukung harus berformat PDF.',
            'dataPendukung.max' => 'Ukuran Data Pendukung maksimal 10 MB.',
            
        ]);
    
        $file = $request->file('dataPendukung');
        $filename = date('Y-m-d-His') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('dokumen-kecamtan', $filename, 'public'); // Disimpan di storage/app/public/sub-kegiatan
    
        DokumenKecamatan::create([
            'nama' => $request->nama,
            'jenis_suratid' => $request->jenis_suratid,
            'kecamatanid' => $request->kecamatanid,
            'keterangan' => $request->keterangan,
            'dataPendukung' => $path,
            'is_active' => $request->is_active,
            'dibuatOleh' => $request->dibuatOleh, 
        ]);
    
        return redirect()->route('dokumen-kec')->with('success', 'Dokumen berhasil ditambahkan!');
    }  



    ///////kegiatan
    public function kegiatanKecamatan() {
        $kecamatans = Kecamatan::all();
        $kegiatans = KegiatanKecamatan::all();
        return view('admin.KegiatanKecamatan',compact('kecamatans','kegiatans'));
    }
    public function storeKegiatanKecamatan(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama' => 'required|string|max:255',
            'gambar' => 'required|mimes:png,jpg,jpeg|max:6048',
            'keterangan' => 'required|string|max:500'
        ],[
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 255 karakter.',
            
            'gambar.required' => 'gambar wajib diisi.',
            'gambar.max' => 'gambar maksimal 500 karakter.',

            'keterangan.required' => 'Keterangan wajib diisi.',
            'keterangan.max' => 'Keterangan maksimal 500 karakter.',
            
        ]);
    
        $file = $request->file('gambar');
        $filename = date('Y-m-d-His') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('kegiatan-kecamatan', $filename, 'public'); // Disimpan di storage/app/public/sub-kegiatan
    
        KegiatanKecamatan::create([
            'nama' => $request->nama,
            'kecamatanid' => $request->kecamatanid,
            'keterangan' => $request->keterangan,
            'gambar' => $path,
            'is_active' => $request->is_active,
            'dibuatOleh' => $request->dibuatOleh, 
        ]);
    
        return redirect()->route('kegiatan-kecamatan')->with('success', 'Kegiatan berhasil ditambahkan!');
    }  
}
