<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\ConfigApp;
use App\Models\klaster;
use App\Models\KategoriArtikel;
use App\Models\ForumAnakSurabaya;
use App\Models\SubKegiatan;
use App\Models\ArtikelMitraAnak;

class landingpagescontroller extends Controller
{
    public function slider()
    {
        $gambars = Slider::where('is_active', true)->get();
        
        $kotaLayakAnak = ConfigApp::whereIn('nama', ['deskripsi_kota_layak_anak', 'Judul_kota_layak_anak'])->get();
        $configApps = ConfigApp::whereIn('nama', [
            'footer',
            'head_office',
            'phone',
            'maps',
        ])->pluck('detail', 'nama');
        
        $galeri = ForumAnakSurabaya::where('is_active', true)->take(6)->get();

        $kategoriArtikel = KategoriArtikel::where('is_active', true)
        ->take(4) 
        ->get();

        $karyaAnak = ArtikelMitraAnak::where('is_active', true)
            ->with('kategori') 
            ->orderBy('created_at', 'desc')
            ->take(12) 
            ->get();

            

        return view('frontend.content.landing-page', compact('gambars', 'configApps', 'galeri', 'kotaLayakAnak', 'kategoriArtikel', 'karyaAnak' ));
    }
    

}
