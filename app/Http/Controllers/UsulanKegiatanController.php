<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\KaryaAnak;
use App\Models\SuaraAnak;
use Illuminate\Http\Request;
use App\Models\PemantauanUsulan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class UsulanKegiatanController extends Controller
{
// ================================= CRUD suara anak
    public function pemantauansuara() {
        $user = Auth::user();
        if ($user instanceof \App\Models\User && $user->hasPermissionTo('super admin-Full Control')) {
            // Jika user punya izin 'super admin', ambil semua data
            $suaras = SuaraAnak::orderBy('created_at', 'desc')->get();
        } else {
            // Jika bukan 'super admin', hanya ambil data yang dibuat oleh user
            $suaras = SuaraAnak::whereHas('user', function ($query) {
                    $query->where('name', Auth::user()->name);
                })
                ->orderBy('created_at', 'desc')
                ->get();
        }
        
        return view('admin.pemantauanSuaraAnak',compact(('suaras'))); 
    }

    public function storePemantauanSuara(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'perihal'   => 'required|string|max:1000',
            'deskripsi' => 'required|string|max:1000',
        ], [
            'perihal.required'   => 'Perihal wajib diisi.',
            'perihal.string'     => 'Perihal harus berupa teks.',
            'perihal.max'        => 'Perihal tidak boleh lebih dari 500 karakter.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'deskripsi.string'   => 'Deskripsi harus berupa teks.',
            'deskripsi.max'      => 'Deskripsi tidak boleh lebih dari 500 karakter.',
        ]);
        ;

        // Ambil tanggal hari ini
        $tanggalHariIni = Carbon::now()->format('Y-m-d');

        // Hitung jumlah data yang sudah ada di hari ini
        $jumlahHariIni = SuaraAnak::whereDate('created_at', Carbon::today())->count() + 1;

        // Format nomor suara: KLA-YYYY-MM-DD-XX
        $nomorSuara = 'KLA-' . $tanggalHariIni . '-' . str_pad($jumlahHariIni, 2, '0', STR_PAD_LEFT);
    
        // Simpan ke database
        SuaraAnak::create([
            'perihal' => $request->perihal,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $tanggalHariIni,
            'nomorSuara' => $nomorSuara,
            'pemohon' => $request->pemohon,
        ]);;

        return redirect()->route('pemantauan-suara')->with('success', 'Suara usulan berhasil ditambahkan!');
    }

    public function destroyPemantauanSuara($id)
    {
        $suara = SuaraAnak::findOrFail($id);

        $suara->delete();

        return redirect()->route('pemantauan-suara')->with('success', 'Suara berhasil dihapus!');
    }
//=================crud pemnatauan suara

    public function updatePemantauanSuara(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'perihal' => 'required|string|max:500',
            'deskripsi' => 'required|string|max:500'
        ],[
            'perihal.required' => 'perihal wajib diisi.',
            'perihal.max' => 'perihal maksimal 500 karakter.',

            'deskripsi.required' => 'deskripsi wajib diisi.',
            'deskripsi.max' => 'deskripsi maksimal 500 karakter.',
            
        ]);
    
        $karya = SuaraAnak::findOrFail($id);

    
        // Simpan data baru
        $data = [
            'perihal' => $request->perihal,
            'deskripsi' => $request->deskripsi,
        ];
    
        // Update slider
        $karya->update($data);
    
        return redirect()->route('pemantauan-suara')->with('success', 'Usulan berhasil diperbarui!');
    }
    public function updateTindakLanjut(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'tindakLanjut' => 'required|string|max:500',
            'tanggalTindakLanjut' => 'required|date',
            'file' => 'nullable|mimes:pdf|max:10048'
        ], [
            'tindakLanjut.required' => 'Tindak lanjut wajib diisi.',
            'tindakLanjut.max' => 'Tindak lanjut maksimal 500 karakter.',
        
            'tanggalTindakLanjut.required' => 'Tanggal tindak lanjut wajib diisi.',
            'tanggalTindakLanjut.date' => 'Format tanggal tindak lanjut tidak valid.',
        
            'file.mimes' => 'Data pendukung harus berupa file PDF.',
            'file.max' => 'Ukuran data pendukung maksimal 10MB.'
        ]);
        
    
        $dokumen = SuaraAnak::findOrFail($id);
    
        // Simpan data baru
        $data = [
            'tindakLanjut' => $request->tindakLanjut,
            'tanggalTindakLanjut' => $request->tanggalTindakLanjut,
        ];
    
        // Jika ada gambar baru
        // Jika ada file baru
        if ($request->hasFile('file')) {
            // Hapus file lama
            if ($dokumen->file && Storage::exists('public/' . $dokumen->file)) {
                Storage::delete('public/' . $dokumen->file);
            }

            // Simpan file baru
            $file = $request->file('file');
            $fileName = date('Y-m-d-His') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/suara-anak', $fileName);
            $data['file'] = 'storage/suara-anak/' . $fileName;

            
        }
    
        // Update dokumen
        $dokumen->update($data);
    
        return redirect()->route('pemantauan-suara')->with('success', 'Suara anak berhasil ditindak Lanjut!');
    }

    public function updateVerifikasiUsulan(Request $request, $id)
    {
        // dd($request->all());
        $suara = SuaraAnak::findOrFail($id);
        $data = [
            'is_active' => $request->is_active,
        ];
        // dd($suara);
        $suara->update($data);
        // dd($suara);
    
        return redirect()->route('pemantauan-suara')->with('success', 'Suara Anak berhasil diverifikasi!');

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
    
        return redirect()->route('pemantauan-suara')->with('success', 'Berhasil tindak lanjut!');
    }  

    public function destroySuara($id)
    {
        $kegiatan = SuaraAnak::findOrFail($id);

        $kegiatan->delete();

        return redirect()->route('pemantauan-suara')->with('success', 'Suara berhasil dihapus!');
    }

// =================================END CRUD suara anak



// =================================CRUD Karya Anak
    public function karyaanak() {
        $user = Auth::user();
        if ($user instanceof \App\Models\User && $user->hasPermissionTo('super admin-Full Control')) {
            // Jika user punya izin 'super admin', ambil semua data
            $karyas = KaryaAnak::orderBy('created_at', 'desc')->get();
        } else {
            // Jika bukan 'super admin', hanya ambil data yang dibuat oleh user
            $karyas = KaryaAnak::whereHas('user', function ($query) {
                    $query->where('name', Auth::user()->name);
                })
                ->orderBy('created_at', 'desc')
                ->get();
        }
        
        return view('admin.karyaAnak',compact(('karyas'))); 
    }

    
    public function verifikasiKaryaAnak(Request $request, $id)
    {
        // dd($request->all());
        $karya = KaryaAnak::findOrFail($id);
        $data = [
            'status' => $request->status,
        ];

        $karya->update($data);
    
        return redirect()->route('karya-anak')->with('success', 'Karya Anak berhasil diverifikasi!');

    }
    public function storeKaryaAnak(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'kreator' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'gambar' => 'required|mimes:png,jpg,jpeg|max:2048',
            'deskripsi' => 'required|string|max:500',
            'tingkatKarya' => 'required||string'
        ],[
            'judul.required' => 'Judul wajib diisi.',
            'judul.max' => 'Judul maksimal 255 karakter.',

            'kreator.required' => 'Kreator wajib diisi.',
            'kreator.max' => 'Kreator maksimal 255 karakter.',

            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'deskripsi.max' => 'Deskripsi maksimal 500 karakter.',
            
            'gambar.required' => 'Gambar wajib diisi.',
            'gambar.mimes' => 'Gambar harus berformat JPG, PNG, atau JPEG.',
            'gambar.max' => 'Ukuran gambar maksimal 6 MB.',

            'tingkatKarya' => 'Tingkatan wajib dipilih'
            
        ]);

        if ($request->hasFile('gambar')) {
            $photo = $request->file('gambar');
            $filename = date('Y-m-d-His') . '-' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $path = $photo->storeAs('karya-anak', $filename, 'public'); // Simpan di storage/public/forum-anak
        } else {
            return redirect()->back()->with('error', 'Gambar tidak ditemukan');
        }
        $tanggal = Carbon::now()->toDateString();
        $status = NULL;
        KaryaAnak::create([
            'kreator' => $request->kreator,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'gambar' => 'storage/' . $path, 
            'pemohon' => $request->pemohon,
            'tanggal' => $tanggal,
            'tingkatKarya' => $request->tingkatKarya,
            'status' => $status
        ]);

        return redirect()->route('karya-anak')->with('success', 'Karya berhasil ditambahkan!');
    }
    
    public function updateKaryaAnak(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'kreator' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'gambar' => 'mimes:png,jpg,jpeg|max:2048',
            'deskripsi' => 'required|string|max:500',
            'tingkatKarya' => 'required||string'
        ],[
            'judul.required' => 'Judul wajib diisi.',
            'judul.max' => 'Judul maksimal 255 karakter.',

            'kreator.required' => 'Kreator wajib diisi.',
            'kreator.max' => 'Kreator maksimal 255 karakter.',

            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'deskripsi.max' => 'Deskripsi maksimal 500 karakter.',
            
            'gambar.mimes' => 'Gambar harus berformat JPG, PNG, atau JPEG.',
            'gambar.max' => 'Ukuran gambar maksimal 6 MB.',
            
            'tingkatKarya' => 'Tingkatan wajib dipilih'
        ]);
    
        $karya = KaryaAnak::findOrFail($id);

        // Simpan data baru
        $data = [
            'judul' => $request->judul,
            'kreator' => $request->kreator,
            'deskripsi' => $request->deskripsi,
            'tingkatKarya' => $request->tingkatKarya,
        ];
    
        // Jika ada gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($karya->gambar) {
                // Hapus gambar berdasarkan path lengkap yang disimpan di database
                if (Storage::exists(str_replace('storage/', 'public/', $karya->gambar))) {
                    Storage::delete(str_replace('storage/', 'public/', $karya->gambar));
                }
            }
            // Simpan gambar baru dengan nama format "YYYY-MM-DD-nama-baru.jpg"
            $photo = $request->file('gambar');
            $gambarName = date('Y-m-d-His') . '-' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('karya-anak', $gambarName, 'public');
            $path = $photo->storeAs('karya-anak', $gambarName, 'public');

            // Simpan nama gambar baru ke database
            $data['gambar'] = 'storage/' . $path;
        }
    
        // Update slider
        $karya->update($data);
    
        return redirect()->route('karya-anak')->with('success', 'Karya Anak berhasil diperbarui!');
    }

    public function destroyKaryaAnak($id)
    {
        $kegiatan = KaryaAnak::findOrFail($id);
        
        if ($kegiatan->gambar) {
            // Konversi path dari 'storage/' ke 'public/' untuk Storage::delete
            $filePath = str_replace('storage/', 'public/', $kegiatan->gambar);
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
        }

        $kegiatan->delete();

        return redirect()->route('karya-anak')->with('success', 'Karya berhasil dihapus!');
    }
// =================================END CRUD Karya Anak

}
