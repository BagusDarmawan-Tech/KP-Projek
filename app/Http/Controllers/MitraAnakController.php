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
}
