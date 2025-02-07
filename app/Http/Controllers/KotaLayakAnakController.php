<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KotaLayakAnakController extends Controller
{
    public function kasrpa() {
        
        // $documents = Rpa::paginate(10);

       
        return view('frontend.content.KasRpa'); 
    }

    public function kegiatankecamatanlayakanak() {
        
        // $documents = Rpa::paginate(10);

       
        return view('frontend.content.KegiatanKecamatanLayakAnak'); 
    }

    public function kegiatankelurahanlayakanak() {
        
        // $documents = Rpa::paginate(10);

       
        return view('frontend.content.KegiatanKelurahanLayakAnak'); 
    }

}
