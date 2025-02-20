<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\ForumAnakSurabaya;
use Illuminate\Support\Facades\Storage;


class KegiatanForumArekSurabayaController extends Controller
{
    public function HalamanForum() {
      
        $kegiatans = ForumAnakSurabaya::all();
        return view('admin.KegiatanForumArekSurabaya',compact('kegiatans'));
    }

    public function storeForumAnakSurabaya(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama' => 'required|string|max:255',
            'gambar' => 'required|mimes:png,jpg,jpeg|max:6048',
            'keterangan' => 'required|string|max:500',
            'is_active' => 'required|boolean',
        ],[
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 255 karakter.',

            'keterangan.required' => 'keterangan wajib diisi.',
            'keterangan.max' => 'konten maksimal 500 karakter.',
            
            'gambar.required' => 'gambar wajib diunggah.',
            'gambar.mimes' => 'Gambar harus berformat JPG, PNG, atau JPEG.',
            'gambar.max' => 'Ukuran gambar maksimal 6 MB.',
        ]);


        if ($request->hasFile('gambar')) {
            $photo = $request->file('gambar');
            $filename = date('Y-m-d-His') . '-' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $path = $photo->storeAs('kegiatan-forum-anak-surabaya', $filename, 'public'); // Simpan di storage/public/forum-anak
        } else {
            return redirect()->back()->with('error', 'Gambar tidak ditemukan');
        }

        $tanggal = Carbon::now()->toDateString();

        ForumAnakSurabaya::create([
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
            'gambar' => 'storage/' . $path, 
            'is_active' => $request->is_active,
            'dibuatOleh' => $request->dibuatOleh,
            'tanggal' => $tanggal
        ]);

        return redirect()->route('KegiatanForumSurabaya')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function updateHalamanForum(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'nama' => 'required|string|max:255',
            'keterangan' => 'required|string|max:500',
            'gambar' => 'mimes:png,jpg,jpeg|max:6048',
        ],[
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 255 karakter.',

            'keterangan.required' => 'konten wajib diisi.',
            'keterangan.max' => 'konten maksimal 500 karakter.',
            
            'gambar.mimes' => 'Gambar harus berformat JPG, PNG, atau JPEG.',
            'gambar.max' => 'Ukuran gambar maksimal 6 MB.',
            
        ]);
    
        $artikel = ForumAnakSurabaya::findOrFail($id);

        $tanggal = Carbon::now()->toDateString();
    
        // Simpan data baru
        $data = [
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
            'is_active' => $request->is_active,
            'tanggal' => $tanggal
        ];
    
        // Jika ada gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($artikel->gambar) {
                // Hapus gambar berdasarkan path lengkap yang disimpan di database
                if (Storage::exists(str_replace('storage/', 'public/', $artikel->gambar))) {
                    Storage::delete(str_replace('storage/', 'public/', $artikel->gambar));
                }
            }
            // Simpan gambar baru dengan nama format "YYYY-MM-DD-nama-baru.jpg"
            $photo = $request->file('gambar');
            $gambarName = date('Y-m-d-His') . '-' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('artikel', $gambarName, 'public');
            $path = $photo->storeAs('artikel', $gambarName, 'public');

            // Simpan nama gambar baru ke database
            $data['gambar'] = 'storage/' . $path;
        }
    
        // Update slider
        $artikel->update($data);
    
        return redirect()->route('KegiatanForumSurabaya')->with('success', 'Artikel Anak berhasil diperbarui!');
    }

    public function destroyHalamanForum($id)
    {
        $kegiatan = ForumAnakSurabaya::findOrFail($id);
        
        if ($kegiatan->gambar) {
            // Konversi path dari 'storage/' ke 'public/' untuk Storage::delete
            $filePath = str_replace('storage/', 'public/', $kegiatan->gambar);
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
        }

        $kegiatan->delete();

        return redirect()->route('KegiatanForumSurabaya')->with('success', 'Kegiatan Forum berhasil dihapus!');
    }
}

