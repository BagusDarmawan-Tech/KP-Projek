<?php

namespace App\Http\Controllers;
use App\Models\HakSipilDanKebebasan;
use App\Models\Kelembagaan;
use App\Models\KesehatanDasar;
use App\Models\LingkunganKeluarga;
use App\Models\PendidikanPemanfaatan;
use App\Models\perlindungankhusus;

use Illuminate\Http\Request;

class KlasterController extends Controller
{
    public function haksipildankebebasan() {
        
        $documents = haksipildankebebasan::paginate(10);

        
        return view('frontend.content.HakSipilDanKebebasan', compact('documents')); 
    }

    public function kelembagaan() {
        
        $documents = kelembagaan::paginate(10);

        
        return view('frontend.content.kelembagaan', compact('documents')); 
    }

    public function kesehatandasar() {
        
        $documents = kesehatandasar::paginate(10);

        
        return view('frontend.content.KesehatanDasar', compact('documents')); 
    }

    public function lingkungankeluarga() {
        
        $documents = lingkungankeluarga::paginate(10);

        
        return view('frontend.content.LingkunganKeluarga', compact('documents')); 
    }

    public function pendidikanpemanfaatan() {
        
        $documents = pendidikanpemanfaatan::paginate(10);

        
        return view('frontend.content.PendidikanPemanfaatan', compact('documents')); 
    }

    public function perlindungankhusus() {
        
        $documents = perlindungankhusus::paginate(10);

        
        return view('frontend.content.PerlindunganKhusus', compact('documents')); 
    }
}
