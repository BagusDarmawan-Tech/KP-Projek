<?php

namespace App\Http\Controllers;
use App\Models\ArtikelMitraAnak;
use App\Models\KegiatanMitraAnak;
use App\Models\KategoriArtikel;
use Illuminate\Http\Request;

class ArtikelLandingPageController extends Controller
{
    public function ArtikelMitraAnak() {
    $categories = KategoriArtikel::where('is_active', true)->get(); 
    $datas = ArtikelMitraAnak::where('is_active', true)->with('kategori')->get(); 
    return view('frontend.content.ArtikelMitraAnak', compact('datas', 'categories'));
  }

  
    public function KegiatanMitraAnak() {
        $datas = KegiatanMitraAnak::where('is_active', true)->get();
        return view('frontend.content.KegiatanMitraAnak',compact('datas')); 
    }
}
