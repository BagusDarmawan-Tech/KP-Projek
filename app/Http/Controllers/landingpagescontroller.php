<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\ConfigApp;
use App\Models\klaster;
use App\Models\SubKegiatan;

class landingpagescontroller extends Controller
{
    public function slider(){
        $gambars = Slider::where('is_active', true)->get();

        // Mengambil semua data dari ConfigApp
        $configApps = ConfigApp::all();
    
        return view('frontend.content.landing-page', compact('gambars', 'configApps'));
    }

    public function klaster(){
        $gambars = klaster::where('is_active', true)->get();

        $subKegiatans = SubKegiatan::all();
    
      
    return view('frontend.content.landing-page', compact('gambars', 'subKegiatans'));
  

    }
    public function haksipil(){
        $subkegiatans = SubKegiatan::join('kluster', 'sub_kegiatan.klusterid', '=', 'kluster.id')
        ->where('kluster.nama', 'Hak Sipil dan Kebebasan')
        ->where('sub_kegiatan.kategori', 'Hak Sipil dan Kebebasan')
        ->select('sub_kegiatan.*') // Pastikan hanya memilih kolom yang diperlukan
        ->get();
    
      
    return view('frontend.content.landing-page', compact('subKegiatans'));
    }

}
