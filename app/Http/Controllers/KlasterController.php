<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KlasterController extends Controller
{
    public function haksipildankebebasan() {

        
        return view('frontend.content.HakSipilDanKebebasan'); 
    }

    public function kelembagaan() {
 
        return view('frontend.content.kelembagaan'); 
    }

    public function kesehatandasar() {

        return view('frontend.content.KesehatanDasar'); 
    }

    public function lingkungankeluarga() {
        
        //$documents = lingkungankeluarga::paginate(10);

        
        return view('frontend.content.LingkunganKeluarga'); 
    }

    public function pendidikanpemanfaatan() {
        
        // $documents = pendidikanpemanfaatan::paginate(10);

        
        return view('frontend.content.PendidikanPemanfaatan'); 
    }

    public function perlindungankhusus() {
        
        // $documents = perlindungankhusus::paginate(10);

        
        return view('frontend.content.PerlindunganKhusus'); 
    }
}
