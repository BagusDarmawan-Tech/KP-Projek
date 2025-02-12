<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KegiatanArekSuroboyoController extends Controller
{


    public function kegiatanarek() {

        return view('admin.kegiatanArekSuroboyo'); 
    }
}
