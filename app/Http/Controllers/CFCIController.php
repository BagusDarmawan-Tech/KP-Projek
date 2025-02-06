<?php

namespace App\Http\Controllers;
use App\Models\cfcisk;
use Illuminate\Http\Request;
use League\CommonMark\Node\Block\Document;

class CFCIController extends Controller
{


public function CFCIArtikel(){
    return view('frontend.content.artikel-kegiatan');
}

public function CFCIKecamatann(){
    // $documents = cfcisk::paginate(10);
    return view('frontend.content.CFCISkecam');
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