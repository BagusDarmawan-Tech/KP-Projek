<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function galeri()
    {
        $gambars = Galeri::where('is_active', true)->get();
        return view('frontend.content.galeri',compact('gambars')); 
    }


    ///contoh
    public function galeriKotaLayakAnak()
    {
        $gambars = Galeri::where('is_active', true)->get();
        return view('frontend.content.GaleriKota',compact('gambars')); 
    }


    public function GaleriAnak()
    {
        return view('frontend.content.GaleriAnak'); 
    }

}
 
