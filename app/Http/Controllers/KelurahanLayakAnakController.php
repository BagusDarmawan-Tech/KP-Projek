<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KelurahanLayakAnakController extends Controller
{
    public function HalamanDokumen() {
        return view('admin.dokumenKelurahan'); 
    }
    
}
