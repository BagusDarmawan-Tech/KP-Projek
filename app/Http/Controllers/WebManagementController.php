<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriArtikel;
use App\Models\Slider;

class WebManagementController extends Controller
{
    //CRUD SLider
    public function slider() {
        return view('admin.Slider'); 
    }

    public function storeSlider(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:kategori_artikel,nama',
            'is_active' => 'required|boolean',
            'dibuatOleh' => 'required|string|max:255',
        ]);

        // dd($request);
        Slider::create($request->all());

        return redirect()->route('/')->with('success', 'Kategori berhasil ditambahkan!');
    }

    //END CRUD SLider

    public function subKegiatan() {
        return view('admin.SubKegiatan'); 
    }

    public function forumAnak() {
        return view('admin.ForumAnak'); 
    }

    public function galeri() {
        return view('admin.Galeri'); 
    }

    //CRUD KategoriArtikel
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

        // dd($request);
        KategoriArtikel::create($request->all());

        return redirect()->route('kategoriArtikel')->with('success', 'Kategori berhasil ditambahkan!');
    }

    //END CRUD KategoriArtikel

    
    public function klaster1() {
        return view('admin.Klaster'); 
    }

    public function pemantauanUsulan() {
        return view('admin.PemantauanUsulan'); 
    }

    public function bagianHalaman() {
        return view('admin.HalamanWebMan'); 
    }

    public function bagianArtikel() {
        return view('admin.Artikel'); 
    }
}
