<?php

namespace App\Http\Controllers;

use App\Models\DokumenKecamatan;
use Illuminate\Http\Request;
use League\CommonMark\Node\Block\Document;

class CFCIController extends Controller
{


public function CFCIArtikel(){
    return view('frontend.content.artikel-kegiatan');
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
    // $documents = cfcisk::paginate(10);
    return view('frontend.content.KegiatanCFCI');
}

public function galeri(){
    // $documents = cfcisk::paginate(10);
    return view('frontend.content.GaleriCFCI');
}
}