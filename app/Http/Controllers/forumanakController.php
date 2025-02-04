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

        
        return view('frontend.forumanak.skkec', compact('documents')); 
    }

    public function skkel() {
        
        $documents = skkel::paginate(10);

        
        return view('frontend.forumanak.skkel', compact('documents')); 
    }

    public function pemantauananak()
    {
        return view('forumanak.pemantauananak'); 
    }

    public function kegareksby()
    {
        return view('forumanak.kegareksby'); 
    }
}
