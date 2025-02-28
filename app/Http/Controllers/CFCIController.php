<?php

namespace App\Http\Controllers;

use App\Models\DokumenKecamatan;
use Illuminate\Http\Request;
use League\CommonMark\Node\Block\Document;
use App\Models\Artikel;
use App\Models\DokumenKelurahan;
use App\Models\KategoriArtikel; 
use App\Models\KegiatanArekSuroboyo;
use App\Models\KegiatanCfci; 
class CFCIController extends Controller
{


public function CFCIArtikel(){
    $categories = KategoriArtikel::where('is_active', true)->get(); 
    $articles = Artikel::where('is_active', true)->with('kategori')->get(); 

    return view('frontend.content.artikel-kegiatan', compact('categories', 'articles'));
    }
    
    public function artikelDetail($slug)
{
    $article = Artikel::where('slug', $slug)->with('kategori')->first(); // Cari artikel berdasarkan slug

    if (!$article) {
        abort(404); 
    }
    return view('frontend.content.artikel-detail', compact('article'));
}

public function CFCIKecamatann(){
    $dataAktif = DokumenKecamatan::whereHas('surat', function ($query) {
        $query->where('nama', 'SK');
    })->where('is_active', true) ->get();

    return view('frontend.content.CFCISkecam' ,compact('dataAktif'));
}

public function CFCIKelurahan (){
    $dataAktif = DokumenKelurahan::whereHas('surat', function ($query) {
        $query->where('nama', 'SK');
    })->where('is_active', true) ->get();

    return view('frontend.content.CFCIKELUR', compact('dataAktif'));
}
public function Kegiatan(){
    $datas = KegiatanCfci::where('is_active', true)->get();
    return view('frontend.content.KegiatanCFCI', compact('datas'));
}

public function kegiatanSuroboyo(){
    $dataAktif = KegiatanArekSuroboyo::where('is_active', true)->get();
    return view('frontend.content.GaleriCFCI', compact('dataAktif'));
}
}