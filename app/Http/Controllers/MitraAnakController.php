<?php

namespace App\Http\Controllers;

use App\Models\KegiatanCfci;
use Illuminate\Http\Request;
use App\Models\KategoriArtikel;
use App\Models\ArtikelMitraAnak;
use App\Models\KegiatanMitraAnak;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MitraAnakController extends Controller
{

// ================================ CRUD Kegiatan CFCI
    public function kegiatanCfci() {
        $user = Auth::user();
        if ($user instanceof \App\Models\User && $user->hasPermissionTo('super admin-Full Control')) {
            // Jika user punya izin 'super admin', ambil semua data
            $cfcis = KegiatanCfci::orderBy('created_at', 'desc')->get();
        } else {
            // Jika bukan 'super admin', hanya ambil data yang dibuat oleh user
            $cfcis = KegiatanCfci::whereHas('user', function ($query) {
                    $query->where('name', Auth::user()->name);
                })
                ->orderBy('created_at', 'desc')
                ->get();
        }
        
        return view('admin.kegiatanCfci',compact(('cfcis'))); 

    }
    public function storeKegiatanCfci(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama' => 'required|string|max:255',
            'caption' => 'required|string|max:500',
            'deskripsi' => 'required|string|max:500',
            'gambar' => 'required|mimes:png,jpg,jpeg|max:6048',
            'is_active' => 'required|boolean',
        ],[
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 255 karakter.',

            'deskripsi.required' => 'deskripsi wajib diisi.',
            'deskripsi.max' => 'deskripsi maksimal 500 karakter.',

            'caption.required' => 'caption wajib diisi.',
            'caption.max' => 'caption maksimal 500 karakter.',
            
            'gambar.required' => 'Gambar wajib diunggah.',
            'gambar.mimes' => 'Gambar harus berformat JPG, PNG, atau JPEG.',
            'gambar.max' => 'Ukuran gambar maksimal 6 MB.',
            
        ]);

        if ($request->hasFile('gambar')) {
            $photo = $request->file('gambar');
            $filename = date('Y-m-d-His') . '-' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $path = $photo->storeAs('kegiatan-cfci', $filename, 'public'); // Simpan di storage/public/kegiatan_mitra_anak
        } else {
            return redirect()->back()->with('error', 'Gambar tidak ditemukan');
        }

        // dd($path);
        KegiatanCfci::create([
            'nama' => $request->nama,
            'caption' => $request->caption,
            'deskripsi' => $request->deskripsi,
            'gambar' => 'storage/' . $path, 
            'dibuatOleh' => $request->dibuatOleh,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('kegiatan-cfci')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'nama' => 'required|string|max:255',
            'caption' => 'required|string|max:500',
            'deskripsi' => 'required|string|max:500',
            'gambar' => 'mimes:png,jpg,jpeg|max:6048',
            'is_active' => 'required|boolean',
        ],[
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 255 karakter.',

            'deskripsi.required' => 'deskripsi wajib diisi.',
            'deskripsi.max' => 'deskripsi maksimal 500 karakter.',

            'caption.required' => 'caption wajib diisi.',
            'caption.max' => 'caption maksimal 500 karakter.',
            
            'gambar.mimes' => 'Gambar harus berformat JPG, PNG, atau JPEG.',
            'gambar.max' => 'Ukuran gambar maksimal 6 MB.',
            
        ]);
    
        $kegiatan = KegiatanCfci::findOrFail($id);
    
        // Simpan data baru
        $data = [
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'caption' => $request->caption,
            'is_active' => $request->is_active,
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
            $photo->storeAs('kegiatan-cfci', $gambarName, 'public');
            $path = $photo->storeAs('kegiatan-cfci', $gambarName, 'public');

            // Simpan nama gambar baru ke database
            $data['gambar'] = 'storage/' . $path;
        }
    
        // Update slider
        $kegiatan->update($data);
    
        return redirect()->route('kegiatan-cfci')->with('success', 'kegiatan-cfci berhasil diperbarui!');
    }

    public function destroyMitraCfci($id)
    {
        $kegiatan = KegiatanCfci::findOrFail($id);
        
        if ($kegiatan->gambar) {
            // Konversi path dari 'storage/' ke 'public/' untuk Storage::delete
            $filePath = str_replace('storage/', 'public/', $kegiatan->gambar);
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
        }

        $kegiatan->delete();

        return redirect()->route('kegiatan-cfci')->with('success', 'Kegiatan CFCI berhasil dihapus!');
    }
// ================================ END CRUD Kegiatan CFCI



//========================CRUD ArtikelMitra ANAk
    public function artikelmitraanak() {
        $user = Auth::user();
        if ($user instanceof \App\Models\User && $user->hasPermissionTo('super admin-Full Control')) {
            // Jika user punya izin 'super admin', ambil semua data
            $artikels = ArtikelMitraAnak::orderBy('created_at', 'desc')->get();
        } else {
            // Jika bukan 'super admin', hanya ambil data yang dibuat oleh user
            $artikels = ArtikelMitraAnak::whereHas('user', function ($query) {
                    $query->where('name', Auth::user()->name);
                })
                ->orderBy('created_at', 'desc')
                ->get();
        }

        $kategoris = KategoriArtikel::where('is_active', true)->get();
        
        return view('admin.artikelMitraAnak', compact('kategoris', 'artikels'));        
    }

    public function storeArtikelMitra(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'judul' => 'required|string|max:255',
            'tag' => 'required|string|max:255',
            'konten' => 'required|string|max:500',
            'gambar' => 'required|mimes:png,jpg,jpeg|max:6048',
            'is_active' => 'required|boolean',
        ],[
            'judul.required' => 'Nama wajib diisi.',
            'judul.max' => 'Nama maksimal 255 karakter.',

            'tag.required' => 'Tag wajib diisi.',

            'konten.required' => 'konten wajib diisi.',
            'konten.max' => 'konten maksimal 500 karakter.',
            
            'gambar.required' => 'gambar wajib diunggah.',
            'gambar.mimes' => 'Dat Pendukung harus berformat JPG, PNG, atau JPEG.',
            'gambar.max' => 'Ukuran gambar maksimal 6 MB.',
            
        ]);

        if ($request->hasFile('gambar')) {
            $photo = $request->file('gambar');
            $filename = date('Y-m-d-His') . '-' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $path = $photo->storeAs('artikel_mitra_anak', $filename, 'public'); // Simpan di storage/public/artikel_mitra_anak
        } else {
            return redirect()->back()->with('error', 'Gambar tidak ditemukan');
        }

        // dd($path);
        $slug ='/';
        ArtikelMitraAnak::create([
            'judul' => $request->judul,
            'kategoriartikelid' => $request->kategoriartikelid,
            'slug' => $slug,
            'tag' => $request->tag,
            'konten' => $request->konten,
            'gambar' => 'storage/' . $path, 
            'dibuatOleh' => $request->dibuatOleh,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('artikel-mitraanak')->with('success', 'Artikel Anak berhasil ditambahkan!');
    }

    public function updateArtikelMitra(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'judul' => 'required|string|max:255',
            'tag' => 'required|string|max:255',
            'konten' => 'required|string|max:500',
            'gambar' => 'mimes:png,jpg,jpeg|max:6048',
            'is_active' => 'required|boolean',
        ],[
            'judul.required' => 'Nama wajib diisi.',
            'tag.required' => 'Tag wajib diisi.',
            'judul.max' => 'Nama maksimal 255 karakter.',

            'konten.required' => 'konten wajib diisi.',
            'konten.max' => 'konten maksimal 500 karakter.',
            
            'gambar.mimes' => 'Gambar harus berformat JPG, PNG, atau JPEG.',
            'gambar.max' => 'Ukuran gambar maksimal 6 MB.',
            
        ]);
    
        $artikel = ArtikelMitraAnak::findOrFail($id);
    
        // Simpan data baru
        $data = [
            'judul' => $request->judul,
            'tag' => $request->tag,
            'konten' => $request->konten,
            'is_active' => $request->is_active,
            'kategoriartikelid' => $request->kategoriartikelid,
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
    
        return redirect()->route('artikel-mitraanak')->with('success', 'Artikel Anak berhasil diperbarui!');
    }

    public function destroyArtikelMitra($id)
    {
        $artikel = ArtikelMitraAnak::findOrFail($id);
        
        if ($artikel->gambar) {
            // Konversi path dari 'storage/' ke 'public/' untuk Storage::delete
            $filePath = str_replace('storage/', 'public/', $artikel->gambar);
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
        }

        $artikel->delete();

        return redirect()->route('artikel-mitraanak')->with('success', 'Artikel mitra berhasil dihapus!');
    }
      //========================END CRUD ArtikelMitra ANAK 

    


    //========================CRUD KEGIATAN MITRA ANAK 
    public function kegiatanMitraAnak() {
        $user = Auth::user();
        if ($user instanceof \App\Models\User && $user->hasPermissionTo('super admin-Full Control')) {
            // Jika user punya izin 'super admin', ambil semua data
            $mitras = KegiatanMitraAnak::orderBy('created_at', 'desc')->get();
        } else {
            // Jika bukan 'super admin', hanya ambil data yang dibuat oleh user
            $mitras = KegiatanMitraAnak::whereHas('user', function ($query) {
                    $query->where('name', Auth::user()->name);
                })
                ->orderBy('created_at', 'desc')->get();
        }
        
        return view('admin.kegiatanMitraAnak',compact(('mitras'))); 
    }

    public function storeKegiatanMitraAnak(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama' => 'required|string|max:255',
            'caption' => 'required|string|max:500',
            'deskripsi' => 'required|string|max:500',
            'gambar' => 'required|mimes:png,jpg,jpeg|max:6048',
            'dibuatOleh' => 'required|string|max:255',
            'is_active' => 'required|boolean',
        ],[
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 255 karakter.',

            'deskripsi.required' => 'deskripsi wajib diisi.',
            'deskripsi.max' => 'deskripsi maksimal 500 karakter.',

            'caption.required' => 'caption wajib diisi.',
            'caption.max' => 'caption maksimal 500 karakter.',

            'slug.required' => 'slug wajib diisi.',
            'slug.max' => 'slug maksimal 100 karakter.',
            
            'gambar.required' => 'gambar wajib diunggah.',
            'gambar.mimes' => 'Dat Pendukung harus berformat JPG, PNG, atau JPEG.',
            'gambar.max' => 'Ukuran gambar maksimal 6 MB.',
            
        ]);

        if ($request->hasFile('gambar')) {
            $photo = $request->file('gambar');
            $filename = date('Y-m-d-His') . '-' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $path = $photo->storeAs('kegiatan_mitra_anak', $filename, 'public'); // Simpan di storage/public/kegiatan_mitra_anak
        } else {
            return redirect()->back()->with('error', 'Gambar tidak ditemukan');
        }

        // dd($path);
        KegiatanMitraAnak::create([
            'nama' => $request->nama,
            'caption' => $request->caption,
            'deskripsi' => $request->deskripsi,
            'gambar' => 'storage/' . $path, 
            'dibuatOleh' => $request->dibuatOleh,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('kegiatan-mitra')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function updateKegiatanMitra(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'nama' => 'required|string|max:255',
            'caption' => 'required|string|max:500',
            'deskripsi' => 'required|string|max:500',
            'gambar' => 'mimes:png,jpg,jpeg|max:6048',
            'is_active' => 'required|boolean',
        ],[
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 255 karakter.',

            'deskripsi.required' => 'deskripsi wajib diisi.',
            'deskripsi.max' => 'deskripsi maksimal 500 karakter.',

            'caption.required' => 'caption wajib diisi.',
            'caption.max' => 'caption maksimal 500 karakter.',


            'gambar.mimes' => 'Gambar harus berformat JPG, PNG, atau JPEG.',
            'gambar.max' => 'Ukuran gambar maksimal 6 MB.',
            
        ]);
    
        $kegiatan_mitra_anak = KegiatanMitraAnak::findOrFail($id);
    
        // Simpan data baru
        $data = [
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'caption' => $request->caption,
            'is_active' => $request->is_active,
        ];
    
        // Jika ada gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($kegiatan_mitra_anak->gambar) {
                // Hapus gambar berdasarkan path lengkap yang disimpan di database
                if (Storage::exists(str_replace('storage/', 'public/', $kegiatan_mitra_anak->gambar))) {
                    Storage::delete(str_replace('storage/', 'public/', $kegiatan_mitra_anak->gambar));
                }
            }
            // Simpan gambar baru dengan nama format "YYYY-MM-DD-nama-baru.jpg"
            $photo = $request->file('gambar');
            $gambarName = date('Y-m-d-His') . '-' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('kegiatan_mitra_anak', $gambarName, 'public');
            $path = $photo->storeAs('kegiatan_mitra_anak', $gambarName, 'public');

            // Simpan nama gambar baru ke database
            $data['gambar'] = 'storage/' . $path;
        }
    
        // Update slider
        $kegiatan_mitra_anak->update($data);
    
        return redirect()->route('kegiatan-mitra')->with('success', 'Kegiatan Mitra Anak berhasil diperbarui!');
    }


    public function destroyKegiatanMitra($id)
    {
        $kegiatan = KegiatanMitraAnak::findOrFail($id);
        
        if ($kegiatan->gambar) {
            // Konversi path dari 'storage/' ke 'public/' untuk Storage::delete
            $filePath = str_replace('storage/', 'public/', $kegiatan->gambar);
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
        }

        $kegiatan->delete();

        return redirect()->route('kegiatan-mitra')->with('success', 'Kegiatan mitra berhasil dihapus!');
    }
  //======================== END CRUD KEGIATAN MITRA ANAK 

}
