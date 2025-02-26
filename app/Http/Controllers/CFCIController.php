<?php

namespace App\Http\Controllers;

use App\Models\DokumenKecamatan;
use Illuminate\Http\Request;
use League\CommonMark\Node\Block\Document;
use App\Models\Artikel;
use App\Models\KategoriArtikel; 
use App\Models\KegiatanCfci; 
class CFCIController extends Controller
{


public function CFCIArtikel(){
    $categories = KategoriArtikel::where('is_active', true)->get(); // Hanya kategori aktif
    $articles = Artikel::where('is_active', true)->with('kategori')->get(); // Artikel aktif dengan relasi kategori

    return view('frontend.content.artikel-kegiatan', compact('categories', 'articles'));
    }
    
    public function artikelDetail($slug)
{
    $article = Artikel::where('slug', $slug)->with('kategori')->first(); // Cari artikel berdasarkan slug

    if (!$article) {
        abort(404); // Jika artikel tidak ditemukan, tampilkan halaman 404
    }

    return view('frontend.content.artikel-detail', compact('article'));
}

public function CFCIKecamatann(){
    $datas = DokumenKecamatan::all();

    return view('frontend.content.CFCISkecam' ,compact('datas'));
}

public function CFCIKelurahan (){
    // $documents = cfcisk::paginate(10);
    return view('frontend.content.CFCIKELUR');
}
public function Kegiatan(){
    $datas = KegiatanCfci::where('is_active', true)->get();
    return view('frontend.content.KegiatanCFCI', compact('datas'));
}

public function galeri(){
    // $documents = cfcisk::paginate(10);
    return view('frontend.content.GaleriCFCI');
}
}