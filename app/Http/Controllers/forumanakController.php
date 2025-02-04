<?php

namespace App\Http\Controllers;
use App\Models\Skkec;
use App\Models\Skkel;


use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class forumanakController extends Controller
{
    public function skkec() {
        
        $documents = skkec::paginate(10);

        
        return view('frontend.content.skkec', compact('documents')); 
    }

    public function skkel() {
        
        $documents = skkel::paginate(10);

        
        return view('frontend.content.skkel', compact('documents')); 
    }

    public function pemantauananak()
    {
        return view('frontend.content.pemantauananak'); 
    }

    public function kegareksby()
    {
        return view('frontend.content.kegareksby'); 
    }
}
