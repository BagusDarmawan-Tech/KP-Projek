<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArtikelLandingPageController extends Controller
{
    public function ArtikelMitraAnak() {

        return view('frontend.content.ArtikelMitraAnak'); 
    }

    public function KegiatanMitraAnak() {

        return view('frontend.content.KegiatanMitraAnak'); 
    }
}
