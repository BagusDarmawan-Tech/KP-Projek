<?php

namespace App\Http\Controllers;
use App\Models\SubKegiatan;
use Illuminate\Http\Request;

class KlasterController extends Controller
{
    public function haksipildankebebasan() {

        $datas = SubKegiatan::where('is_active', true)
        ->whereHas('klaster', function ($query) {
            $query->where('nama', 'Hak Sipil dan Kebebasan');
        })
        ->get();

        return view('frontend.content.HakSipilDanKebebasan', compact('datas')); 
    }

    public function kelembagaan() {

        $datas = SubKegiatan::where('is_active', true)
        ->whereHas('klaster', function ($query) {
            $query->where('nama', 'Kelembagaan');
        })
        ->get();

        return view('frontend.content.kelembagaan', compact('datas')); 
    }
    
    public function kesehatandasar() {
        $datas = SubKegiatan::where('is_active', true)
        ->whereHas('klaster', function ($query) {
            $query->where('nama', 'Kesehatan Dasar dan Kesejahteraan');
        })
        ->get();
        return view('frontend.content.KesehatanDasar', compact('datas')); 
    }
    
    public function lingkungankeluarga() {
        $datas = SubKegiatan::where('is_active', true)
        ->whereHas('klaster', function ($query) {
            $query->where('nama', 'Lingkungan Keluarga dan Pengasuhan Alternatif');
        })
        ->get();
        return view('frontend.content.LingkunganKeluarga', compact('datas')); 
    }

    public function pendidikanpemanfaatan() {
        
        $datas = SubKegiatan::where('is_active', true)
        ->whereHas('klaster', function ($query) {
            $query->where('nama', 'Pendidikan, Pemanfaatan Waktu Luang dan Kegiatan Budaya');
        })
        ->get();
        return view('frontend.content.PendidikanPemanfaatan', compact('datas')); 
    }

    
    
    public function perlindungankhusus() {
        
        $datas = SubKegiatan::where('is_active', true)
        ->whereHas('klaster', function ($query) {
            $query->where('nama', 'Perlindungan Khusus');
        })
        ->get();
        
        return view('frontend.content.PerlindunganKhusus', compact('datas')); 
    }
}
