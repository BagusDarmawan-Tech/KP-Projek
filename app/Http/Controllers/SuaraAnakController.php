<?php

namespace App\Http\Controllers;
use App\Models\KaryaAnak;
use App\Models\SuaraAnak;
use Illuminate\Http\Request;
class SuaraAnakController extends Controller
{
    public function PsuaraAnak(){
        $datas = SuaraAnak::where('is_active', true)
        ->where('is_active', '1') 
        ->orderBy('created_at', 'desc')
        ->get();

        return view('frontend.content.PsuaraAnakk', compact('datas')); 
    }

    public function karyaAnak(){

        $datas = KaryaAnak::where('status', 1)
        ->orderBy('created_at', 'desc')
        ->get();        
        $filters = ['Kota', 'Kecamatan', 'Kelurahan'];
        return view('frontend.content.Karyaanak', compact('datas', 'filters'));
    }
}
