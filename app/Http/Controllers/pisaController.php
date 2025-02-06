<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pisaController extends Controller
{
    public function dokumenPisa(){
        return view('frontend.content.HalamanPisa'); 
    }

    public function KegiatanPisa(){
        return view('frontend.content.KegiatanPisa'); 
    }
}
