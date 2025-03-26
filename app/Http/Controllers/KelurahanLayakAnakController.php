<?php

namespace App\Http\Controllers;
use Spatie\Permission\Traits\HasRoles;
use view;
use App\Models\Kelurahan;
use App\Models\JenisSurat;
use Illuminate\Http\Request;
use App\Models\DokumenKelurahan;
use App\Models\KegiatanKelurahan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KelurahanLayakAnakController extends Controller
{

    // CRUD DOKUMEN KELURAHAN
    public function HalamanDokumenLayakAnak() {
        $user = Auth::user();
        if ($user instanceof \App\Models\User && $user->hasPermissionTo('super admin-Full Control')) {
            // Jika user punya izin 'super admin', ambil semua data
            $dokumens = DokumenKelurahan::orderBy('created_at', 'desc')->get();
        } else {
            // Jika bukan 'super admin', hanya ambil data yang dibuat oleh user
            $dokumens = DokumenKelurahan::whereHas('user', function ($query) {
                    $query->where('name', Auth::user()->name);
                })
                ->orderBy('created_at', 'desc')->get();
        }
        

        $kelurahans = Kelurahan::all();
        $surats = JenisSurat::all();
        return view('admin.dokumenKelurahan',compact('dokumens','kelurahans','surats'));
    }

    public function storeDokumenKelurahan(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama' => 'required|string|max:255',
            'dataPendukung' => 'required|mimes:pdf|max:10048', 
            'keterangan' => 'required|string|max:500',
            'is_active' => 'required|in:0,1', 
            'jenis_suratid' =>'required',
            'kelurahanid' =>'required',
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
            'kelurahanid' => $request->kelurahanid,
            'keterangan' => $request->keterangan,
            'dataPendukung' => 'storage/'.$path,
            'is_active' => $request->is_active,
            'dibuatOleh' => $request->dibuatOleh, 
        ]);
    
        return redirect()->route('HalamanDokument')->with('success', 'Dokumen berhasil ditambahkan!');
    } 

    public function updateDokumenKelurahan(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_suratid' => 'required|string|max:255',
            'kelurahanid' => 'required|string|max:255',
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
    
        $dokumen = DokumenKelurahan::findOrFail($id);
    
        // Simpan data baru
        $data = [
            'nama' => $request->nama,
            'kelurahanid' => $request->kelurahanid,
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
            $file->storeAs('dokumen-kelurahan', $fileName, 'public');
            $path = $file->storeAs('dokumen-kelurahan', $fileName, 'public');

            // Simpan nama FILE baru ke database
            $data['dataPendukung'] = 'storage/' . $path;
        }   
                
        // Update dokumen
        $dokumen->update($data);
    
        return redirect()->route('HalamanDokument')->with('success', 'Dokumen berhasil diperbarui!');
    }
    public function destroyDokumenKelurahan($id)
    {
        $dokumen = DokumenKelurahan::findOrFail($id);
        
        if ($dokumen->dataPendukung) {
            // Konversi path dari 'storage/' ke 'public/' untuk Storage::delete
            $filePath = str_replace('storage/', 'public/', $dokumen->dataPendukung);
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
        }

        $dokumen->delete();

        return redirect()->route('HalamanDokument')->with('success', 'Dokumen berhasil dihapus!');
    }
// END CRUD KEGIATAN KELURAHAN











// CRUD KEGIATAN KELURAHAN
    public function KegiatanKelurahanAnak() {

        $user = Auth::user();
        if ($user instanceof \App\Models\User && $user->hasPermissionTo('super admin-Full Control')) {
            // Jika user punya izin 'super admin', ambil semua data
            $kegiatans = KegiatanKelurahan::orderBy('created_at', 'desc')->get();
        } else {
            // Jika bukan 'super admin', hanya ambil data yang dibuat oleh user
            $kegiatans = KegiatanKelurahan::whereHas('user', function ($query) {
                    $query->where('name', Auth::user()->name);
                })
                ->orderBy('created_at', 'desc')->get();
        }
        $kelurahans = Kelurahan::all();
        return view('admin.KegiatanKelurahan',compact('kegiatans','kelurahans'));  
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
            'gambar.mimes'=>'File harus JPEG ,JPG atau PNG',

            'keterangan.required' => 'Keterangan wajib diisi.',
            'keterangan.max' => 'Keterangan maksimal 500 karakter.',
            
        ]);
    
        $file = $request->file('gambar');
        $filename = date('Y-m-d-His') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('kegiatan-kelurahan', $filename, 'public'); // Disimpan di storage/app/public/sub-kegiatan
    
        KegiatanKelurahan::create([
            'nama' => $request->nama,
            'kelurahanid' => $request->kelurahanid,
            'keterangan' => $request->keterangan,
            'gambar' => 'storage/'.$path,
            'is_active' => $request->is_active,
            'dibuatOleh' => $request->dibuatOleh, 
        ]);
    
        return redirect()->route('Kegiatankelurahan')->with('success', 'Kegiatan berhasil ditambahkan!');
    } 

    public function updateKegiatanKelurahan(Request $request, $id)
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
    
        $kegiatan = KegiatanKelurahan::findOrFail($id);
    
        // Simpan data baru
        $data = [
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
            'kelurahanid' => $request->kelurahanid,
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
            $photo->storeAs('kegiatan-kelurahan', $gambarName, 'public');
            $path = $photo->storeAs('kegiatan-kelurahan', $gambarName, 'public');

            // Simpan nama gambar baru ke database
            $data['gambar'] = 'storage/' . $path;
        }
    
        // Update slider
        $kegiatan->update($data);
    
        return redirect()->route('Kegiatankelurahan')->with('success', 'Kegiatan berhasil diperbarui!');
    }

    public function destroyKegiatanKelurahan($id)
    {
        $kegiatan = KegiatanKelurahan::findOrFail($id);
        
        if ($kegiatan->gambar) {
            // Konversi path dari 'storage/' ke 'public/' untuk Storage::delete
            $filePath = str_replace('storage/', 'public/', $kegiatan->gambar);
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
        }

        $kegiatan->delete();

        return redirect()->route('Kegiatankelurahan')->with('success', 'Kegiatan berhasil dihapus!');
    }
// END CRUD KEGIATAN KELURAHAN
    
}
