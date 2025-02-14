<?php

namespace App\Http\Controllers;

use App\Models\KaryaAnak;
use Carbon\Carbon;
use App\Models\SuaraAnak;
use Illuminate\Http\Request;


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
// =================================END CRUD Karya Anak

}
