<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PusatInformasiSahabatController extends Controller
{

    // =========== CRUD dokumen pisa
    public function HalamanDokumen() {
        return view('admin.DokumenPisaa'); 
    }

    
    // =========== END CRUD dokumen pisa


    // =========== CRUD kegiatan pisa
    public function HalamanKegiatan() {
        return view('admin.KegiatanPisaa'); 
    }
    // =========== CRUD kegiatan pisa
}
