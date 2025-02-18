<?php

namespace App\Http\Controllers;

use App\Models\DokumenKelurahan;
use App\Models\KegiatanKelurahan;
use Illuminate\Http\Request;

class KelurahanLayakAnakController extends Controller
{

    // CRUD DOKUMEN KELURAHAN
    public function HalamanDokumenLayakAnak() {
        return view('admin.dokumenKelurahan'); 
    }

    public function storeDokumenKelurahan(Request $request)
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
        $path = $file->storeAs('dokumen-kelurahan', $filename, 'public'); // Disimpan di storage/app/public/sub-kegiatan
    
        DokumenKelurahan::create([
            'nama' => $request->nama,
            'jenis_suratid' => $request->jenis_suratid,
            'kelurahanid' => $request->kecamatanid,
            'keterangan' => $request->keterangan,
            'dataPendukung' => $path,
            'is_active' => $request->is_active,
            'dibuatOleh' => $request->dibuatOleh, 
        ]);
    
        return redirect()->route('HalamanDokument')->with('success', 'Dokumen berhasil ditambahkan!');
    } 
// END CRUD KEGIATAN KELURAHAN











// CRUD KEGIATAN KELURAHAN
    public function KegiatanKelurahanAnak() {
        return view('admin.KegiatanKelurahan'); 
    }
    public function storeKegiatanKelurahan(Request $request)
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
        $path = $file->storeAs('kegiatan-kelurahan', $filename, 'public'); // Disimpan di storage/app/public/sub-kegiatan
    
        KegiatanKelurahan::create([
            'nama' => $request->nama,
            'kelurahanid' => $request->kecamatanid,
            'keterangan' => $request->keterangan,
            'gambar' => $path,
            'is_active' => $request->is_active,
            'dibuatOleh' => $request->dibuatOleh, 
        ]);
    
        return redirect()->route('Kegiatankelurahan')->with('success', 'Kegiatan berhasil ditambahkan!');
    } 
// END CRUD KEGIATAN KELURAHAN
    
}
