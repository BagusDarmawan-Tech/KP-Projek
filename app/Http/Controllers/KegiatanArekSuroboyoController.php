<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KegiatanArekSuroboyo;
use Illuminate\Support\Facades\Storage;

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
            'gambar' => 'required|mimes:png,jpg,jpeg|max:2048',
            'konten' => 'required|string|max:500',
            'is_active' => 'required|boolean',
        ],[
            'judul.required' => 'judul wajib diisi.',
            'judul.max' => 'judul maksimal 255 karakter.',

            'tag.required' => 'tag wajib diisi.',
            'tag.max' => 'tag maksimal 255 karakter.',

            'konten.required' => 'konten wajib diisi.',
            'konten.max' => 'konten maksimal 500 karakter.',
            
            'gambar.required' => 'Gambar wajib diisi.',
            'gambar.mimes' => 'Gambar harus berformat JPG, PNG, atau JPEG.',
            'gambar.max' => 'Ukuran gambar maksimal 6 MB.',
            
        ]);

        if ($request->hasFile('gambar')) {
            $photo = $request->file('gambar');
            $filename = date('Y-m-d-His') . '-' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $path = $photo->storeAs('kegiatan-arek-suroboyo', $filename, 'public'); // Simpan di storage/public/forum-anak
        } else {
            return redirect()->back()->with('error', 'Gambar tidak ditemukan');
        }

        $slug ='/';

        KegiatanArekSuroboyo::create([
            'judul' => $request->judul,
            'tag' => $request->tag,
            'konten' => $request->konten,
            'slug' => $slug,
            'gambar' => 'storage/' . $path, 
            'is_active' => $request->is_active,
            'dibuatOleh' => $request->dibuatOleh
        ]);

        return redirect()->route('kegiatan-arek')->with('success', 'Kegiatan Surabaya berhasil ditambahkan!');
    }

    public function updateKegiatanArekSuroboyo(Request $request, $id)
    {
       // dd($request->all());
       $request->validate([
        'judul' => 'required|string|max:255',
        'tag' => 'required|string|max:255',
        'gambar' => 'mimes:png,jpg,jpeg|max:2048',
        'konten' => 'required|string|max:500',
    ],[
        'judul.required' => 'judul wajib diisi.',
        'judul.max' => 'judul maksimal 255 karakter.',

        'tag.required' => 'tag wajib diisi.',
        'tag.max' => 'tag maksimal 255 karakter.',

        'konten.required' => 'konten wajib diisi.',
        'konten.max' => 'konten maksimal 500 karakter.',

        'gambar.mimes' => 'Gambar harus berformat JPG, PNG, atau JPEG.',
        'gambar.max' => 'Ukuran gambar maksimal 6 MB.',
        
    ]);
    
        $kegiatan = KegiatanArekSuroboyo::findOrFail($id);

    
        // Simpan data baru
        $data = [
            'judul' => $request->judul,
            'tag' => $request->tag,
            'konten' => $request->konten,
            'is_active' => $request->is_active
        ];
    
        // Jika ada gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($kegiatan->gambar) {
                // Hapus gambar berdasarkan path lengkap yang disimpan di database
                if (Storage::exists(str_replace('storage/', 'public/', $kegiatan->gambar))) {
                    Storage::delete(str_replace('storage/', 'public/', $kegiatan->gambar));
                }
            }
            // Simpan gambar baru dengan nama format "YYYY-MM-DD-nama-baru.jpg"
            $photo = $request->file('gambar');
            $gambarName = date('Y-m-d-His') . '-' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('kegiatan-arek-suroboyo', $gambarName, 'public');
            $path = $photo->storeAs('kegiatan-arek-suroboyo', $gambarName, 'public');

            // Simpan nama gambar baru ke database
            $data['gambar'] = 'storage/' . $path;
        }
    
        // Update slider
        $kegiatan->update($data);
    
        return redirect()->route('kegiatan-arek')->with('success', 'Artikel Anak berhasil diperbarui!');
    }

    public function destroyKegiatanArekSuroboyo($id)
    {
        $kegiatan = KegiatanArekSuroboyo::findOrFail($id);
        
        if ($kegiatan->gambar) {
            // Konversi path dari 'storage/' ke 'public/' untuk Storage::delete
            $filePath = str_replace('storage/', 'public/', $kegiatan->gambar);
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
        }

        $kegiatan->delete();

        return redirect()->route('kegiatan-arek')->with('success', 'Kegiatan Arek Surabaya berhasil dihapus!');
    }
}
