<?php

namespace App\Http\Controllers;

use App\Models\KegiatanArekSuroboyo;
use Illuminate\Http\Request;

class KegiatanArekSuroboyoController extends Controller
{


    public function kegiatanarek() {
        $kegiatans = KegiatanArekSuroboyo::all();
        return view('admin.kegiatanArekSuroboyo',compact('kegiatans')); 
    }

    public function storeKegiatanArekSuroboyo(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'judul' => 'required|string|max:255',
            'tag' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'gambar' => 'required|mimes:png,jpg,jpeg|max:2048',
            'konten' => 'required|string|max:500',
            'is_active' => 'required|boolean',
        ]);

        if ($request->hasFile('gambar')) {
            $photo = $request->file('gambar');
            $filename = date('Y-m-d-His') . '-' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $path = $photo->storeAs('kegiatan-arek-suroboyo', $filename, 'public'); // Simpan di storage/public/forum-anak
        } else {
            return redirect()->back()->with('error', 'Gambar tidak ditemukan');
        }

        KegiatanArekSuroboyo::create([
            'judul' => $request->judul,
            'tag' => $request->tag,
            'konten' => $request->konten,
            'slug' => $request->slug,
            'gambar' => 'storage/' . $path, 
            'is_active' => $request->is_active,
            'dibuatOleh' => $request->dibuatOleh
        ]);

        return redirect()->route('kegiatan-arek')->with('success', 'Kategori berhasil ditambahkan!');
    }
}
