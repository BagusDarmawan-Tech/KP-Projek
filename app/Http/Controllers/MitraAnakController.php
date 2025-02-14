<?php

namespace App\Http\Controllers;

use App\Models\ArtikelMitraAnak;
use App\Models\KategoriArtikel;
use App\Models\KegiatanCfci;
use App\Models\KegiatanMitraAnak;
use Illuminate\Http\Request;

class MitraAnakController extends Controller
{

// ================================ CRUD Kegiatan CFCI
    public function kegiatanCfci() {
        
        $cfcis = KegiatanCfci::all();
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
            'dibuatOleh' => 'required|string|max:255',
            'is_active' => 'required|boolean',
        ]);

        if ($request->hasFile('gambar')) {
            $photo = $request->file('gambar');
            $filename = date('Y-m-d-His') . '-' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $path = $photo->storeAs('kegiatan_mitra_anak', $filename, 'public'); // Simpan di storage/public/kegiatan_mitra_anak
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
// ================================ END CRUD Kegiatan CFCI



//========================CRUD ArtikelMitra ANAk
    public function artikelmitraanak() {
        $kategoris = KategoriArtikel::all();
        $artikels = ArtikelMitraAnak::all();
        return view('admin.artikelMitraAnak', compact('kategoris', 'artikels'));        
    }

    public function storeArtikelMitra(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'judul' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'tag' => 'required|string|max:255',
            'konten' => 'required|string|max:500',
            'gambar' => 'required|mimes:png,jpg,jpeg|max:6048',
            'is_active' => 'required|boolean',
        ]);

        if ($request->hasFile('gambar')) {
            $photo = $request->file('gambar');
            $filename = date('Y-m-d-His') . '-' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $path = $photo->storeAs('artikel_mitra_anak', $filename, 'public'); // Simpan di storage/public/artikel_mitra_anak
        } else {
            return redirect()->back()->with('error', 'Gambar tidak ditemukan');
        }

        // dd($path);
        ArtikelMitraAnak::create([
            'judul' => $request->judul,
            'kategoriartikelid' => $request->kategoriartikelid,
            'slug' => $request->slug,
            'tag' => $request->tag,
            'konten' => $request->konten,
            'gambar' => 'storage/' . $path, 
            'dibuatOleh' => $request->dibuatOleh,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('artikel-mitraanak')->with('success', 'Kategori berhasil ditambahkan!');
    }
      //========================END CRUD ArtikelMitra ANAK 

    


    //========================CRUD KEGIATAN MITRA ANAK 
    public function kegiatanMitraAnak() {
        $mitras = KegiatanMitraAnak::all();
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
  //======================== END CRUD KEGIATAN MITRA ANAK 

}
