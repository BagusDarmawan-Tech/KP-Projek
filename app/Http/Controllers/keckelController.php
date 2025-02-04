<?php

namespace App\Http\Controllers;
use App\Models\Rpa;

use Illuminate\Http\Request;

class keckelController extends Controller
{
    public function kasrpa() {
        
        $documents = Rpa::paginate(10);

       
        return view('frontend.keckellayanananak.kasrpa', compact('documents')); 
    }
}
