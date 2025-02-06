<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuaraAnakController extends Controller
{
    public function PsuaraAnak(){
        return view('frontend.content.PsuaraAnakk'); 
    }

    public function karyaAnak(){
        return view('frontend.content.Karyaanak'); 
    }
}
