<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KecamatanLayakController extends Controller
{
    public function dokumenkec() {
        
        // $documents = Rpa::paginate(10);

       
        return view('admin.DokumenKecamatan'); 
    }
}
