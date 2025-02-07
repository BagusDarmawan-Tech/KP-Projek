<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class forumanakController extends Controller
{
    // HALAMAN FORUM ANAK/SK KECAMATAN 
    public function skkec() {
        
        // $documents = skkec::paginate(10);

        
        return view('frontend.content.SkFasKecamatan'); 
    }

    public function skkel() {
        
        // $documents = skkel::paginate(10);

        
        return view('frontend.content.SkFasKelurahan'); 
    }

    public function pemantauananak()
    {
        // $documents = skkel::paginate(10);

        return view('frontend.content.Pemantauananak'); 
    }

    public function kegareksby()
    {
        return view('frontend.content.kegareksby'); 
    }

    public function kegiatanforumanakkelurahan()
    {
        return view('frontend.content.KegiatanForumAnakKelurahan'); 
    }

    public function kegiatanforumanakkecamatan()
    {
        return view('frontend.content.KegiatanForumAnakKecamatan'); 
    }
}
