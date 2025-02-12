<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsulanKegiatanController extends Controller
{

    public function pemantauansuara() {
        
       
        return view('admin.pemantauanSuaraAnak'); 
    }
    public function karyaanak() {
        
       
        return view('admin.karyaAnak'); 
    }

}
