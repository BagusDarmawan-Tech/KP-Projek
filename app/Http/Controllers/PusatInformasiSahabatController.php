<?php

namespace App\Http\Controllers;

use App\Models\JenisSurat;
use App\Models\DokumenPisa;
use App\Models\KegiatanPisa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PusatInformasiSahabatController extends Controller
{

    // =========== CRUD dokumen pisa
    public function HalamanDokumen() {
        $user = Auth::user();
        if ($user instanceof \App\Models\User && $user->hasPermissionTo('super admin-Full Control')) {
            // Jika user punya izin 'super admin', ambil semua data
            $dokumens = DokumenPisa::orderBy('created_at', 'desc')->get();
        } else {
            // Jika bukan 'super admin', hanya ambil data yang dibuat oleh user
            $dokumens = DokumenPisa::whereHas('user', function ($query) {
                    $query->where('name', Auth::user()->name);
                })
                ->orderBy('created_at', 'desc')
                ->get();
        }
        $surats = JenisSurat::all();
        
        return view('admin.DokumenPisaa',compact('surats','dokumens')); 
    }

    public function storeDokumenPisa(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenisSurat' => 'required|string|max:255',
            'dataPendukung' => 'required|mimes:pdf|max:10048', // Hanya PDF, DOC, DOCX, max 2MB
            'keterangan' => 'required|string|max:500',
            'is_active' => 'required|in:0,1', // Pastikan hanya 0 atau 1 yang diterima
        ],[
            'nama.required' => 'nama wajib diisi.',
            'nama.max' => 'nama maksimal 255 karakter.',
            
            'jenisSurat.required' => 'jenisSurat wajib diisi.',
            'keterangan.required' => 'keterangan wajib diisi.',
            'keterangan.max' => 'keterangan maksimal 500 karakter.',
            
            'dataPendukung.required' => 'dataPendukung wajib diisi.',
            'dataPendukung.mimes' => 'dataPendukung harus berformat PDF.',
            'dataPendukung.max' => 'Ukuran dataPendukung maksimal 10 MB.',
            
        ]);
    
        // Simpan file ke storage/public/forum-anak
        $file = $request->file('dataPendukung');
        $filename = date('Y-m-d-His') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('dokumen-pisa', $filename, 'public'); // Disimpan di storage/app/public/dokumen-pisa
    
        DokumenPisa::create([
            'nama' => $request->nama,
            'jenisSurat' => $request->jenisSurat,
            'keterangan' => $request->keterangan,
            'dataPendukung' => 'storage/'.$path, // Hanya menyimpan path yang benar
            'is_active' => $request->is_active,
            'dibuatOleh' => $request->dibuatOleh, // Pastikan dibuatOleh tidak null
        ]);
    
        return redirect()->route('DokumenLayakAnak')->with('success', 'Dokumen berhasil ditambahkan!');
    } 

    public function updateDokumenPisa(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenisSurat' => 'required|string|max:255',
            'dataPendukung' => 'mimes:pdf|max:10048', // Hanya PDF, DOC, DOCX, max 2MB
            'keterangan' => 'required|string|max:500',
            'is_active' => 'required|in:0,1', // Pastikan hanya 0 atau 1 yang diterima
        ],[
            'nama.required' => 'nama wajib diisi.',
            'nama.max' => 'nama maksimal 255 karakter.',
            
            'jenisSurat.required' => 'jenisSurat wajib diisi.',
            'keterangan.required' => 'keterangan wajib diisi.',
            'keterangan.max' => 'keterangan maksimal 500 karakter.',
            
            'dataPendukung.mimes' => 'dataPendukung harus berformat PDF.',
            'dataPendukung.max' => 'Ukuran dataPendukung maksimal 10 MB.',
            
        ]);
    
        $dokumen = DokumenPisa::findOrFail($id);
    
        // Simpan data baru
        $data = [
            'nama' => $request->nama,
            'jenisSurat' => $request->jenisSurat,
            'keterangan' => $request->keterangan,
            'is_active' => $request->is_active,
        ];
    
        // Jika ada file baru
        if ($request->hasFile('dataPendukung')) {
            // Hapus FILE lama jika ada
            if ($dokumen->dataPendukung) {
                // Hapus FILE berdasarkan path lengkap yang disimpan di database
                if (Storage::exists(str_replace('storage/', 'public/', $dokumen->dataPendukung))) {
                    Storage::delete(str_replace('storage/', 'public/', $dokumen->dataPendukung));
                }
            }
            // Simpan FILE baru dengan nama format "YYYY-MM-DD-nama-baru.PDF"
            $file = $request->file('dataPendukung');
            $fileName = date('Y-m-d-His') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('dokumen-pisa', $fileName, 'public');
            $path = $file->storeAs('dokumen-pisa', $fileName, 'public');

            // Simpan nama FILE baru ke database
            $data['dataPendukung'] = 'storage/' . $path;
        }

    
        // Update dokumen
        $dokumen->update($data);
    
        return redirect()->route('DokumenLayakAnak')->with('success', 'Dokumen berhasil diperbarui!');
    }

    public function destroyHalamanDokumenPisa($id)
    {
        $kegiatan = DokumenPisa::findOrFail($id);
        
        if ($kegiatan->dataPendukung) {
            // Konversi path dari 'storage/' ke 'public/' untuk Storage::delete
            $filePath = str_replace('storage/', 'public/', $kegiatan->dataPendukung);
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
        }

        $kegiatan->delete();

        return redirect()->route('DokumenLayakAnak')->with('success', 'Dokumen berhasil dihapus!');
    }
    
    // =========== END CRUD dokumen pisa


    // =========== CRUD kegiatan pisa
    public function HalamanKegiatan() {
        $user = Auth::user();
        if ($user instanceof \App\Models\User && $user->hasPermissionTo('super admin-Full Control')) {
            // Jika user punya izin 'super admin', ambil semua data
            $kegiatans = KegiatanPisa::orderBy('created_at', 'desc')->get();
        } else {
            // Jika bukan 'super admin', hanya ambil data yang dibuat oleh user
            $kegiatans = KegiatanPisa::whereHas('user', function ($query) {
                    $query->where('name', Auth::user()->name);
                })
                ->orderBy('created_at', 'desc')
                ->get();
        }
        
        return view('admin.KegiatanPisaa',compact('kegiatans'));
    }

    public function storeKegiatanPisa(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama' => 'required|string|max:255',
            'caption' => 'required|string|max:255',
            'gambar' => 'required|mimes:png,jpg,jpeg|max:6048',
            'deskripsi' => 'required|string|max:500',
            'is_active' => 'required|boolean',
        ],[
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 255 karakter.',
            
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'deskripsi.max' => 'Deskripsi maksimal 500 karakter.',

            'caption.required' => 'Caption wajib diisi.',
            'caption.max' => 'Caption maksimal 500 karakter.',
            
            'gambar.mimes' => 'Gambar harus berformat PNG JPG JPEG.',
            'gambar.required' => 'Gambar Wajib diisi.',
            'gambar.max' => 'Ukuran gambar maksimal 6 MB.',
            
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

        return redirect()->route('KegiatanLayakanak')->with('success', 'Kegiatan Pisa berhasil ditambahkan!');
    }

    public function updateKegiatanPisa(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'nama' => 'required|string|max:255|unique:kategori_artikel,nama',
            'gambar' => 'mimes:png,jpg,jpeg|max:2048',
            'deskripsi' => 'required|string|max:500',
            'is_active' => 'required|boolean',
        ],[
            'nama.unique' => 'Nama Klaster ini sudah digunakan, silakan pilih yang lain.',
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 255 karakter.',

            'deskripsi.required' => 'deskripsi wajib diisi.',
            'deskripsi.max' => 'deskripsi maksimal 30 karakter.',
            
            'gambar.mimes' => 'Gambar harus berformat JPG, PNG, atau JPEG.',
            'gambar.max' => 'Ukuran gambar maksimal 2 MB.',
            
        ]);
    
        $klaster = KegiatanPisa::findOrFail($id);
    
        // Simpan data baru
        $data = [
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'is_active' => $request->is_active,
        ];
    
        // Jika ada gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($klaster->gambar) {
                // Hapus gambar berdasarkan path lengkap yang disimpan di database
                if (Storage::exists(str_replace('storage/', 'public/', $klaster->gambar))) {
                    Storage::delete(str_replace('storage/', 'public/', $klaster->gambar));
                }
            }
            // Simpan gambar baru dengan nama format "YYYY-MM-DD-nama-baru.jpg"
            $photo = $request->file('gambar');
            $gambarName = date('Y-m-d-His') . '-' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('kegiatan-pisa', $gambarName, 'public');
            $path = $photo->storeAs('kegiatan-pisa', $gambarName, 'public');

            // Simpan nama gambar baru ke database
            $data['gambar'] = 'storage/' . $path;
        }
    
        // Update slider
        $klaster->update($data);
    
        return redirect()->route('KegiatanLayakanak')->with('success', 'Kegiatan berhasil diperbarui!');
    }

    public function destroyKegiatanPisa($id)
    {
        $kegiatan = KegiatanPisa::findOrFail($id);
        
        if ($kegiatan->gambar) {
            // Konversi path dari 'storage/' ke 'public/' untuk Storage::delete
            $filePath = str_replace('storage/', 'public/', $kegiatan->gambar);
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
        }

        $kegiatan->delete();

        return redirect()->route('KegiatanLayakanak')->with('success', 'Kegiatan berhasil dihapus!');
    }
    // =========== CRUD kegiatan pisa
}
