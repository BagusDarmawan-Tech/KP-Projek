<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KelurahanLayakAnakController extends Controller
{
    public function HalamanDokumenLayakAnak() {
        return view('admin.dokumenKelurahan'); 
    }


    public function KegiatanKelurahanAnak() {
        return view('admin.KegiatanKelurahan'); 
    }

    
}
