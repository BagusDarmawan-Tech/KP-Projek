<?php

namespace App\Http\Controllers;

use App\Models\DokumenPisa;
use App\Models\JenisSurat;
use App\Models\KegiatanPisa;
use Illuminate\Http\Request;

class PusatInformasiSahabatController extends Controller
{

    // =========== CRUD dokumen pisa
    public function HalamanDokumen() {
        $surats = JenisSurat::all();
        $dokumens = DokumenPisa::all();
        return view('admin.DokumenPisaa',compact('surats','dokumens')); 
    }

    public function storeDokumenPisa(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenisSurat' => 'required|string|max:255',
            'dataPendukung' => 'required|mimes:pdf,doc,docx|max:10048', // Hanya PDF, DOC, DOCX, max 2MB
            'keterangan' => 'required|string|max:500',
            'is_active' => 'required|in:0,1', // Pastikan hanya 0 atau 1 yang diterima
        ]);
    
        // Simpan file ke storage/public/forum-anak
        $file = $request->file('dataPendukung');
        $filename = date('Y-m-d-His') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('dokumen-pisa', $filename, 'public'); // Disimpan di storage/app/public/dokumen-pisa
    
        DokumenPisa::create([
            'nama' => $request->nama,
            'jenisSurat' => $request->jenisSurat,
            'keterangan' => $request->keterangan,
            'dataPendukung' => $path, // Hanya menyimpan path yang benar
            'is_active' => $request->is_active,
            'dibuatOleh' => $request->dibuatOleh, // Pastikan dibuatOleh tidak null
        ]);
    
        return redirect()->route('DokumenLayakAnak')->with('success', 'Kategori berhasil ditambahkan!');
    } 
    
    // =========== END CRUD dokumen pisa


    // =========== CRUD kegiatan pisa
    public function HalamanKegiatan() {
        return view('admin.KegiatanPisaa'); 
    }

    public function storeKegiatanPisa(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama' => 'required|string|max:255',
            'caption' => 'required|string|max:255',
            'gambar' => 'required|mimes:png,jpg,jpeg|max:2048',
            'deskripsi' => 'required|string|max:500',
            'is_active' => 'required|boolean',
        ]);

        if ($request->hasFile('gambar')) {
            $photo = $request->file('gambar');
            $filename = date('Y-m-d-His') . '-' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $path = $photo->storeAs('kegiatan-pisa', $filename, 'public'); // Simpan di storage/public/forum-anak
        } else {
            return redirect()->back()->with('error', 'Gambar tidak ditemukan');
        }

        KegiatanPisa::create([
            'nama' => $request->nama,
            'caption' => $request->caption,
            'deskripsi' => $request->deskripsi,
            'gambar' => 'storage/' . $path, 
            'is_active' => $request->is_active,
            'dibuatOleh' => $request->dibuatOleh
        ]);

        return redirect()->route('KegiatanLayakanak')->with('success', 'Kategori berhasil ditambahkan!');
    }
    // =========== CRUD kegiatan pisa
}
