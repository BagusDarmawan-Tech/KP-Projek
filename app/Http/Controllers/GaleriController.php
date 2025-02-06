<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function galeri()
    {
        return view('frontend.content.galeri'); 
    }

    public function galeriKotaLayakAnak()
    {
        return view('frontend.content.GaleriKota'); 
    }


    public function GaleriAnak()
    {
        return view('frontend.content.GaleriAnak'); 
    }

}

