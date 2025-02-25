<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DokumenPisa;
use App\Models\KegiatanPisa;

class pisaController extends Controller
{
    public function dokumenPisa(){
        $details = DokumenPisa::where('is_active', true)->get();
        return view('frontend.content.HalamanPisa', compact('details')); 
    }
    public function KegiatanPisa(){
        $details = KegiatanPisa::where('is_active', true)->get();
        return view('frontend.content.KegiatanPisa', compact('details')); 
    }
}
