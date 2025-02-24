<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KegiatanKecamatan;
use App\Models\KegiatanKelurahan;

class KotaLayakAnakController extends Controller
{
    public function kasrpa() {
        
        // $documents = Rpa::paginate(10);

       
        return view('frontend.content.KasRpa'); 
    }

    public function kegiatankecamatanlayakanak() {
        
        // $documents = Rpa::paginate(10);

        $gambars = KegiatanKecamatan::where('is_active', true)->get();
        return view('frontend.content.KegiatanKecamatanLayakAnak',compact('gambars'));
    }

    public function kegiatankelurahanlayakanak() {
        
        $gambars = KegiatanKelurahan::where('is_active', true)->get();
        return view('frontend.content.KegiatanKelurahanLayakAnak',compact('gambars'));
    }

}
