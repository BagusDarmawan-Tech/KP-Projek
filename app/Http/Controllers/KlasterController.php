<?php

namespace App\Http\Controllers;
use App\Models\HakSipilDanKebebasan;

use Illuminate\Http\Request;

class KlasterController extends Controller
{
    public function haksipildankebebasan() {
        
        $documents = haksipildankebebasan::paginate(10);

        
        return view('frontend.content.HakSipilDanKebebasan', compact('documents')); 
    }
}
