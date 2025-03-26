<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\JenisSurat;
use Illuminate\Http\Request;
use App\Models\DokumenKecamatan;
use App\Models\KegiatanKecamatan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KecamatanLayakController extends Controller
{
    //================crud dokumen kecamatan
    public function dokumenkec() {
        $user = Auth::user();
        if ($user instanceof \App\Models\User && $user->hasPermissionTo('super admin-Full Control')) {
            // Jika user punya izin 'super admin', ambil semua data
            $dokumens = DokumenKecamatan::orderBy('created_at', 'desc')->get();
        } else {
            // Jika bukan 'super admin', hanya ambil data yang dibuat oleh user
            $dokumens = DokumenKecamatan::whereHas('user', function ($query) {
                    $query->where('name', Auth::user()->name);
                })
                ->orderBy('created_at', 'desc')->get();
        }
        $kecamatans = Kecamatan::all();
        $surats = JenisSurat::all();

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
            
            'dataPendukung.required' => 'File Dokumen wajib diunggah.',
            'dataPendukung.mimes' => 'File Dokumen harus berformat PDF.',
            'dataPendukung.max' => 'Ukuran File Dokumen maksimal 10 MB.',
            
        ]);
    
        $file = $request->file('dataPendukung');
        $filename = date('Y-m-d-His') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('dokumen-kecamatan', $filename, 'public'); // Disimpan di storage/app/public/sub-kegiatan
    
        DokumenKecamatan::create([
            'nama' => $request->nama,
            'jenis_suratid' => $request->jenis_suratid,
            'kecamatanid' => $request->kecamatanid,
            'keterangan' => $request->keterangan,
            'dataPendukung' => 'storage/'.$path,
            'is_active' => $request->is_active,
            'dibuatOleh' => $request->dibuatOleh, 
        ]);
    
        return redirect()->route('dokumen-kec')->with('success', 'Dokumen berhasil ditambahkan!');
    }  

    public function updateDokumenKecamatan(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_suratid' => 'required|string|max:255',
            'kecamatanid' => 'required|string|max:255',
            'dataPendukung' => 'mimes:pdf|max:10048', // Hanya PDF, DOC, DOCX, max 2MB
            'keterangan' => 'required|string|max:500',
            'is_active' => 'required|in:0,1', // Pastikan hanya 0 atau 1 yang diterima
        ],[
            'nama.required' => 'nama wajib diisi.',
            'nama.max' => 'nama maksimal 255 karakter.',
            
            'jenis_suratid.required' => 'jenisSurat wajib diisi.',
            'kelurahanid.required' => 'jenisSurat wajib diisi.',
            'keterangan.required' => 'keterangan wajib diisi.',
            'keterangan.max' => 'keterangan maksimal 500 karakter.',
            
            'dataPendukung.mimes' => 'dataPendukung harus berformat PDF.',
            'dataPendukung.max' => 'Ukuran dataPendukung maksimal 10 MB.',
            
        ]);
    
        $dokumen = DokumenKecamatan::findOrFail($id);
    
        // Simpan data baru
        $data = [
            'nama' => $request->nama,
            'kecamatanid' => $request->kecamatanid,
            'keterangan' => $request->keterangan,
            'is_active' => $request->is_active,
            'jenis_suratid' => $request->jenis_suratid,
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
            $file->storeAs('dokumen-kecamatan', $fileName, 'public');
            $path = $file->storeAs('dokumen-kecamatan', $fileName, 'public');

            // Simpan nama FILE baru ke database
            $data['dataPendukung'] = 'storage/' . $path;
        }        
    
        // Update dokumen
        $dokumen->update($data);
    
        return redirect()->route('dokumen-kec')->with('success', 'Dokumen berhasil diperbarui!');
    }

    public function destroyDokumenKecamatan($id)
    {
        $dokumen = DokumenKecamatan::findOrFail($id);
        
        if ($dokumen->dataPendukung) {
            // Konversi path dari 'storage/' ke 'public/' untuk Storage::delete
            $filePath = str_replace('storage/', 'public/', $dokumen->dataPendukung);
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
        }

        $dokumen->delete();

        return redirect()->route('dokumen-kec')->with('success', 'Dokumen berhasil dihapus!');
    }
    //======================END crud dokumen kecamatan




    //============crud kegiatan kecamatan
    public function kegiatanKecamatan() {
        $user = Auth::user();
        if ($user instanceof \App\Models\User && $user->hasPermissionTo('super admin-Full Control')) {
            // Jika user punya izin 'super admin', ambil semua data
            $kegiatans = KegiatanKecamatan::orderBy('created_at', 'desc')->get();
        } else {
            // Jika bukan 'super admin', hanya ambil data yang dibuat oleh user
            $kegiatans = KegiatanKecamatan::whereHas('user', function ($query) {
                    $query->where('name', Auth::user()->name);
                })
                ->orderBy('created_at', 'desc')->get();
        }
        $kecamatans = Kecamatan::all();
        
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
            'gambar' => 'storage/' . $path,
            'is_active' => $request->is_active,
            'dibuatOleh' => $request->dibuatOleh, 
        ]);
    
        return redirect()->route('kegiatan-kecamatan')->with('success', 'Kegiatan berhasil ditambahkan!');
    }  

    public function updateKegiatanKecamatan(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'nama' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
            'gambar' => 'mimes:png,jpg,jpeg|max:2048',
            'is_active' => 'required|boolean',
        ],[
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 255 karakter.',
            
            'keterangan.required' => 'keterangan wajib diisi.',
            'keterangan.max' => 'keterangan maksimal 500 karakter.',

            'gambar.mimes' => 'Gambar harus berformat JPG, PNG, atau JPEG.',
            'gambar.max' => 'Ukuran gambar maksimal 2 MB.',
            
        ]);
    
        $kegiatan = KegiatanKecamatan::findOrFail($id);
    
        // Simpan data baru
        $data = [
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
            'kecamatan' => $request->kecamatanid,
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
            $photo->storeAs('kegiatan-kecamatan', $gambarName, 'public');
            $path = $photo->storeAs('kegiatan-kecamatan', $gambarName, 'public');

            // Simpan nama gambar baru ke database
            $data['gambar'] = 'storage/' . $path;
        }
    
        // Update slider
        $kegiatan->update($data);
    
        return redirect()->route('kegiatan-kecamatan')->with('success', 'Kegiatan berhasil diperbarui!');
    }

    public function destroyKegiatanKecamatan($id)
    {
        $suara = KegiatanKecamatan::findOrFail($id);
        
        if ($suara->gambar) {
            // Konversi path dari 'storage/' ke 'public/' untuk Storage::delete
            $filePath = str_replace('storage/', 'public/', $suara->gambar);
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
        }

        $suara->delete();

        return redirect()->route('kegiatan-kecamatan')->with('success', 'Kegiatan berhasil dihapus!');
    }
    //============crud kegiatan kecamatan
}
