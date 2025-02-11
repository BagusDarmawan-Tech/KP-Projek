<?php

namespace App\Http\Controllers;

use App\Models\PemantauanUsulan;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Models\KategoriArtikel;
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

    public function subKegiatan() {
        return view('admin.SubKegiatan'); 
    }

    public function forumAnak() {
        return view('admin.ForumAnak'); 
    }

    public function galeri() {
        return view('admin.Galeri'); 
    }

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

    
    public function klaster1() {
        return view('admin.Klaster'); 
    }

     //=================CRUD PemantauanUsulan
    public function pemantauanUsulan() {
        return view('admin.PemantauanUsulan'); 
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

    public function bagianHalaman() {
        return view('admin.HalamanWebMan'); 
    }

    public function bagianArtikel() {
        return view('admin.Artikel'); 
    }
}
