<?php

namespace App\Http\Controllers;
use App\Models\SubKegiatan;
use Illuminate\Http\Request;

class KlasterController extends Controller
{
    public function haksipildankebebasan() {

        $datas = SubKegiatan::where('is_active', true)
        ->where('klusterid', 16)
        ->get();        
        return view('frontend.content.HakSipilDanKebebasan', compact('datas')); 
    }

    public function kelembagaan() {
        $datas = SubKegiatan::where('is_active', true)
        ->where('klusterid', 17)
        ->get();
        return view('frontend.content.kelembagaan', compact('datas')); 
    }

    public function kesehatandasar() {
        $datas = SubKegiatan::where('is_active', true)
        ->where('klusterid', 18)
        ->get();
        return view('frontend.content.KesehatanDasar', compact('datas')); 
    }

    public function lingkungankeluarga() {
        $datas = SubKegiatan::where('is_active', true)
        ->where('klusterid', 19)
        ->get();
        return view('frontend.content.LingkunganKeluarga', compact('datas')); 
    }

    public function pendidikanpemanfaatan() {
        
        $datas = SubKegiatan::where('is_active', true)
        ->where('klusterid', 20)
        ->get();
        return view('frontend.content.PendidikanPemanfaatan', compact('datas')); 
    }

    public function perlindungankhusus() {
        
        $datas = SubKegiatan::where('is_active', true)
        ->where('klusterid', 21)
        ->get();
        
        return view('frontend.content.PerlindunganKhusus', compact('datas')); 
    }
}
