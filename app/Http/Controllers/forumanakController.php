<?php

namespace App\Http\Controllers;
use App\Models\Skkec;
use App\Models\Skkel;
use App\Models\pemantauananak;

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
        $documents = skkel::paginate(10);

        return view('frontend.content.pemantauananak', compact('documents')); 
    }

    public function kegareksby()
    {
        return view('frontend.content.kegareksby'); 
    }
}
