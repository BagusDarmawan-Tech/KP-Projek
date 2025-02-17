<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\KaryaAnak;
use App\Models\SuaraAnak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class UsulanKegiatanController extends Controller
{
// ================================= CRUD suara anak
    public function pemantauansuara() {
        $suaras = SuaraAnak::all();
        return view('admin.pemantauanSuaraAnak',compact(('suaras'))); 
    }

    public function storePemantauanSuara(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'perihal' => 'required|string|max:500',
            'deskripsi' => 'required|string|max:500'
,
        ]);

        // dd($path);
        $tanggal = Carbon::now()->toDateString(); // Format: YYYY-MM-DD

        // Format nomor suara: KLA-YYYY-MM-DD
        $nomorSuara = 'KLA-' . Carbon::now()->format('Y-m-d');
    
        // Simpan ke database
        SuaraAnak::create([
            'perihal' => $request->perihal,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $tanggal,
            'nomorSuara' => $nomorSuara,
            'pemohon' => $request->pemohon,
        ]);;

        return redirect()->route('pemantauan-suara')->with('success', 'Kategori berhasil ditambahkan!');
    }

    
    public function storeTindakLanjut(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'nama' => 'required|string|max:255',
            'klusterid' => 'required|integer', // Sesuai dengan tipe data integer
            'dataPendukung' => 'required|mimes:pdf,doc,docx|max:10048', // Hanya PDF, DOC, DOCX, max 2MB
            'keterangan' => 'required|string|max:500',
            'is_active' => 'required|in:0,1', // Pastikan hanya 0 atau 1 yang diterima
        ]);
    
        // Simpan file ke storage/public/forum-anak
        $file = $request->file('dataPendukung');
        $filename = date('Y-m-d-His') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('sub-kegiatan', $filename, 'public'); // Disimpan di storage/app/public/sub-kegiatan
    
        SuaraAnak::create([
            'nama' => $request->nama,
            'klusterid' => $request->klusterid,
            'keterangan' => $request->keterangan,
            'dataPendukung' => $path, // Hanya menyimpan path yang benar
            'is_active' => $request->is_active,
            'dibuatOleh' => $request->dibuatOleh, // Pastikan dibuatOleh tidak null
        ]);
    
        return redirect()->route('sub-kegiatan')->with('success', 'Kategori berhasil ditambahkan!');
    }  
// =================================END CRUD suara anak



// =================================CRUD Karya Anak
    public function karyaanak() {
        $karyas = KaryaAnak::all();
        return view('admin.karyaAnak',compact(('karyas'))); 
    }

    public function storeKaryaAnak(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'kreator' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'gambar' => 'required|mimes:png,jpg,jpeg|max:2048',
            'deskripsi' => 'required|string|max:500'
        ],[
            'judul.required' => 'judul wajib diisi.',
            'judul.max' => 'judul maksimal 255 karakter.',

            'kreator.required' => 'kreator wajib diisi.',
            'kreator.max' => 'kreator maksimal 255 karakter.',

            'deskripsi.required' => 'deskripsi wajib diisi.',
            'deskripsi.max' => 'deskripsi maksimal 500 karakter.',
            
            'gambar.required' => 'Gambar wajib diisi.',
            'gambar.mimes' => 'Gambar harus berformat JPG, PNG, atau JPEG.',
            'gambar.max' => 'Ukuran gambar maksimal 6 MB.',
            
        ]);

        if ($request->hasFile('gambar')) {
            $photo = $request->file('gambar');
            $filename = date('Y-m-d-His') . '-' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $path = $photo->storeAs('karya-anak', $filename, 'public'); // Simpan di storage/public/forum-anak
        } else {
            return redirect()->back()->with('error', 'Gambar tidak ditemukan');
        }
        $tanggal = Carbon::now()->toDateString();
        $status = 0;
        KaryaAnak::create([
            'kreator' => $request->kreator,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'gambar' => 'storage/' . $path, 
            'pemohon' => $request->pemohon,
            'tanggal' => $tanggal,
            'status' => $status
        ]);

        return redirect()->route('karya-anak')->with('success', 'Kategori berhasil ditambahkan!');
    }
    
    public function updateKaryaAnak(Request $request, $id)
    {
       // dd($request->all());
       $request->validate([
        'judul' => 'required|string|max:255',
        'tag' => 'required|string|max:255',
        'slug' => 'required|string|max:255',
        'gambar' => 'mimes:png,jpg,jpeg|max:2048',
        'konten' => 'required|string|max:500',
    ],[
        'judul.required' => 'judul wajib diisi.',
        'judul.max' => 'judul maksimal 255 karakter.',

        'tag.required' => 'tag wajib diisi.',
        'tag.max' => 'tag maksimal 255 karakter.',

        'slug.required' => 'slug wajib diisi.',
        'slug.max' => 'slug maksimal 255 karakter.',

        'konten.required' => 'konten wajib diisi.',
        'konten.max' => 'konten maksimal 500 karakter.',

        'gambar.mimes' => 'Gambar harus berformat JPG, PNG, atau JPEG.',
        'gambar.max' => 'Ukuran gambar maksimal 6 MB.',
        
    ]);
    
        $kegiatan = KaryaAnak::findOrFail($id);

    
        // Simpan data baru
        $data = [
            'judul' => $request->judul,
            'tag' => $request->tag,
            'slug' => $request->slug,
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
// =================================END CRUD Karya Anak

}
