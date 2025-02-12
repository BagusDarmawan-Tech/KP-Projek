<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\ForumAnak;
use App\Models\Galeri;
use App\Models\Halaman;
use App\Models\Klaster;
use App\Models\PemantauanUsulan;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Models\KategoriArtikel;
use App\Models\SubKegiatan;
use Illuminate\Support\Facades\Storage;

class WebManagementController extends Controller
{
    //=====================CRUD SLider
    //tampilkan data
    public function slider() {
        $sliders = Slider::all();
        return view('admin.Slider', compact('sliders'));
    }

    // Simpan gambar
    public function storeSlider(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'caption' => 'required|string|max:500',
            'deskripsi' => 'required|string',
            'gambar' => 'required|mimes:png,jpg,jpeg|max:2048',
            'is_active' => 'required|boolean',
            'dibuatOleh' => 'required|string|max:255',
        ]);
    
        
        if ($request->hasFile('gambar')) {
            $photo = $request->file('gambar');
            $filename = date('Y-m-d-His') . '-' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $path = $photo->storeAs('slider', $filename, 'public'); // Simpan di storage/public/slider
        } else {
            return redirect()->back()->with('error', 'Gambar tidak ditemukan');
        }
    
        Slider::create([
            'nama' => $request->nama,
            'caption' => $request->caption,
            'deskripsi' => $request->deskripsi,
            'is_active' => $request->is_active,
            'dibuatOleh' => $request->dibuatOleh,
            'gambar' => 'storage/' . $path, 
        ]);
    
        return redirect()->route('slider')->with('success', 'Slider berhasil ditambahkan!');
    }
    //====================================END CRUD SLider


    //===========CRUD Sub Kegiatan
    public function subKegiatan() {
        $subKegiatans = SubKegiatan::all();
        $klasters = Klaster::all();
        return view('admin.SubKegiatan', compact('subKegiatans','klasters'));
    }

    public function storeSubKegiatan(Request $request)
    {
        // dd($request->all());
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
    
        SubKegiatan::create([
            'nama' => $request->nama,
            'klusterid' => $request->klusterid,
            'keterangan' => $request->keterangan,
            'dataPendukung' => $path, // Hanya menyimpan path yang benar
            'is_active' => $request->is_active,
            'dibuatOleh' => $request->dibuatOleh, // Pastikan dibuatOleh tidak null
        ]);
    
        return redirect()->route('sub-kegiatan')->with('success', 'Kategori berhasil ditambahkan!');
    }    
    //===========END CRUD Sub Kegiatan



    //===========CRUD FORUMANAK
    public function forumAnak() {
        $forumAnaks = ForumAnak::all();
        return view('admin.ForumAnak', compact('forumAnaks'));
    }

    public function storeForumAnak(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama' => 'required|string|max:255',
            'caption' => 'required|string|max:255',
            'gambar' => 'required|mimes:png,jpg,jpeg|max:2048',
            'deskripsi' => 'required|string|max:500',
            'is_active' => 'required|boolean',
        ]);

        if ($request->hasFile('gambar')) {
            $photo = $request->file('gambar');
            $filename = date('Y-m-d-His') . '-' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $path = $photo->storeAs('forum-anak', $filename, 'public'); // Simpan di storage/public/forum-anak
        } else {
            return redirect()->back()->with('error', 'Gambar tidak ditemukan');
        }

        ForumAnak::create([
            'nama' => $request->nama,
            'caption' => $request->caption,
            'deskripsi' => $request->deskripsi,
            'gambar' => 'storage/' . $path, 
            'is_active' => $request->is_active,
            'dibuatOleh' => $request->dibuatOleh
        ]);

        return redirect()->route('forum-anak')->with('success', 'Kategori berhasil ditambahkan!');
    }
    //===========CRUD FORUMANAK
    

    //=============== CRUD Galeri
    public function galeri() {
        $galeris = Galeri::all();
        return view('admin.Galeri', compact('galeris'));
    }

    public function storeGaleri(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama' => 'required|string|max:255',
            'caption' => 'required|string|max:255',
            'gambar' => 'required|mimes:png,jpg,jpeg|max:2048',
            'deskripsi' => 'required|string|max:500',
            'is_active' => 'required|boolean',
        ]);

        if ($request->hasFile('gambar')) {
            $photo = $request->file('gambar');
            $filename = date('Y-m-d-His') . '-' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $path = $photo->storeAs('galeri', $filename, 'public'); // Simpan di storage/public/galeri
        } else {
            return redirect()->back()->with('error', 'Gambar tidak ditemukan');
        }

        Galeri::create([
            'nama' => $request->nama,
            'caption' => $request->caption,
            'deskripsi' => $request->deskripsi,
            'gambar' => 'storage/' . $path, 
            'is_active' => $request->is_active,
            'dibuatOleh' => $request->dibuatOleh
        ]);

        return redirect()->route('galeri')->with('success', 'Kategori berhasil ditambahkan!');
    }
     //=================END CRUD Galeri

    //=================CRUD KategoriArtikel
    public function kategoriArtikel() {
        $kategori_artikel = KategoriArtikel::latest()->paginate(10);
        return view('admin.KategoriArtikel', compact('kategori_artikel'));
    }   

    public function storeKategoriArtikel(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:kategori_artikel,nama',
            'is_active' => 'required|boolean',
            'dibuatOleh' => 'required|string|max:255',
        ]);
        KategoriArtikel::create($request->all());

        return redirect()->route('kategoriArtikel')->with('success', 'Kategori berhasil ditambahkan!');
    }
    //============================END CRUD KategoriArtikel

    //================= CRUD klaster
    public function klaster1() {
        $klasters = Klaster::all();
        return view('admin.Klaster', compact('klasters'));
       
    }
    public function storeKlaster(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama' => 'required|string|max:255',
            'gambar' => 'required|mimes:png,jpg,jpeg|max:2048',
            'icon' => 'required|string|max:30',
            'slug' => 'required|string|max:100',
            'is_active' => 'required|boolean',
        ]);

        if ($request->hasFile('gambar')) {
            $photo = $request->file('gambar');
            $filename = date('Y-m-d-His') . '-' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $path = $photo->storeAs('klaster', $filename, 'public'); // Simpan di storage/public/klaster
        } else {
            return redirect()->back()->with('error', 'Gambar tidak ditemukan');
        }

        // dd($path);
        Klaster::create([
            'nama' => $request->nama,
            'icon' => $request->icon,
            'slug' => $request->slug,
            'gambar' => 'storage/' . $path, 
            'is_active' => $request->is_active,
            'dibuatOleh' => $request->dibuatOleh
        ]);

        return redirect()->route('Klaster')->with('success', 'Kategori berhasil ditambahkan!');
    }
     //=================END CRUD klaster


     //=================CRUD PemantauanUsulan
    public function pemantauanUsulan() {
        $usulans = PemantauanUsulan::all();
        return view('admin.PemantauanUsulan',compact(('usulans'))); 
    }

    public function storepemantauanUsulan(Request $request)
    {
        $request->validate([
            'namaUsulan' => 'required|string|max:255',
            'keterangan' => 'required|string|max:500',
        ]);

        $is_active = 1;
        $tindakLanjut = 'Diproses';
        PemantauanUsulan::create([
            'namaUsulan' => $request->namaUsulan,
            'keterangan' => $request->keterangan,
            'is_active' =>  $is_active,
            'userid' => $request->userid,
            'tindakLanjut' => $tindakLanjut
        ]);

        return redirect()->route('PemantauanUsulanAnak')->with('success', 'Kategori berhasil ditambahkan!');
    }
     //=================END CRUD PemantauanUsulan


     //=================CRUD Halaman
    public function bagianHalaman() {
        $halamans = Halaman::all();
        return view('admin.HalamanWebMan',compact(('halamans'))); 
    }
    public function storeHalaman(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'required|mimes:png,jpg,jpeg|max:2048',
            'konten' => 'required|string|max:500',
            'slug' => 'required|string|max:100',
            'is_active' => 'required|boolean',
        ]);

        if ($request->hasFile('gambar')) {
            $photo = $request->file('gambar');
            $filename = date('Y-m-d-His') . '-' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $path = $photo->storeAs('halaman', $filename, 'public'); // Simpan di storage/public/halaman
        } else {
            return redirect()->back()->with('error', 'Gambar tidak ditemukan');
        }

        // dd($path);
        Halaman::create([
            'judul' => $request->judul,
            'konten' => $request->konten,
            'slug' => $request->slug,
            'gambar' => 'storage/' . $path, 
            'is_active' => $request->is_active,
            'dibuatOleh' => $request->dibuatOleh
        ]);

        return redirect()->route('Halamandong')->with('success', 'Kategori berhasil ditambahkan!');
    }
    //================== END CRUD Halaman 


    //================== CRUD Artikel
    public function bagianArtikel() {
        $artikels = Artikel::all();
        $kategoris = KategoriArtikel::all();
        $klasters = Klaster::all();
        $subKegiatans = SubKegiatan::all();
        return view('admin.Artikel', compact('artikels','kategoris','subKegiatans','klasters'));

    }
    public function storeArtikel(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'judul' => 'required|string|max:255',
            'slug' => 'required|string|max:100',
            'tag' => 'required|string|max:255',
            'gambar' => 'required|mimes:png,jpg,jpeg|max:6048',
            'subkegiatanid' => 'required|integer',
            'konten' => 'required|string|max:500',
            'kategoriartikelid' => 'required|integer',
            'dibuatOleh' => 'required|string|max:255',
            'is_active' => 'required|boolean',
        ]);

        if ($request->hasFile('gambar')) {
            $photo = $request->file('gambar');
            $filename = date('Y-m-d-His') . '-' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $path = $photo->storeAs('artikel', $filename, 'public'); // Simpan di storage/public/artikel
        } else {
            return redirect()->back()->with('error', 'Gambar tidak ditemukan');
        }

        // dd($path);
        Artikel::create([
            'judul' => $request->judul,
            'slug' => $request->slug,
            'tag' => $request->tag,
            'gambar' => 'storage/' . $path, 
            'subkegiatanid' => $request->subkegiatanid,
            'konten' => $request->konten,
            'kategoriartikelid' => $request->kategoriartikelid,
            'dibuatOleh' => $request->dibuatOleh,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('Artikel')->with('success', 'Kategori berhasil ditambahkan!');
    }
    //================== END CRUD Artikel

}
