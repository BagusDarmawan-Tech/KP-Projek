<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PusatInformasiSahabatController extends Controller
{
    public function HalamanDokumen() {
        return view('admin.DokumenPisaa'); 
    }

    public function HalamanKegiatan() {
        return view('admin.KegiatanPisaa'); 
    }
}
