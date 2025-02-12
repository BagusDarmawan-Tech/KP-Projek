<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MitraAnakController extends Controller
{

    public function ArtikelMitra() {
        return view('frontend.content.ArtikelMitraAnak'); 
    }


    public function KegiatanMitra() {
        return view('frontend.content.KegiatanMitraAnak'); 
    }

    public function kegiatanCfci() {
        
        // $documents = Rpa::paginate(10);

       
        return view('admin.kegiatanCfci'); 
    }



    public function artikelmitraanak() {
        
       
        return view('admin.artikelMitraAnak'); 
    }

    public function kegiatanMitraAnak() {
        
       
        return view('admin.kegiatanMitraAnak'); 
    }


}
