<?php

namespace App\Http\Controllers;
use App\Models\CFCIsKecam;
use Illuminate\Http\Request;
use League\CommonMark\Node\Block\Document;

class CFCIController extends Controller
{
    public function HalamanCFCI(){
        return view('frontend.content.CFCIKegiatan');
    }



    public function HalamanCFCISk(){
        return view('frontend.content.CFCISk');
    }

    // public function skkel() {
        
    //     $documents = skkel::paginate(10);

        
    //     return view('frontend.content.skkel', compact('documents')); 
    // }
    public function ArtikelKegiatan(){
        return view('frontend.content.CFCISk');
    }

    public function GaleriCFCI(){
        return view('frontend.content.CFCISk');
    }

    public function SkKecamatan(){
        $documents = CFCISkecam::paginate(10);
        return view('frontend.content.CFCISkecam', compact('documents'));
    }

    public function Ckecamatan(){
        // $documents = CFCISkecam::paginate(10);
        return view('frontend.content.Ckecamatan');
    }

    public function SkKelurahan(){
        return view('frontend.content.CFCISk');
    }
}

