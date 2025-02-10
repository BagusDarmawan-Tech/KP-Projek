<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebManagementController extends Controller
{
    public function slider() {
        return view('admin.Slider'); 
    }

    public function subKegiatan() {
        return view('admin.SubKegiatan'); 
    }

    public function forumAnak() {
        return view('admin.ForumAnak'); 
    }

    public function galeri() {
        return view('admin.Galeri'); 
    }

    public function kategoriArtikel() {
        return view('admin.KategoriArtikel'); 
    }   

    public function klaster1() {
        return view('admin.Klaster'); 
    }

    public function pemantauanUsulan() {
        return view('admin.PemantauanUsulan'); 
    }

    public function bagianHalaman() {
        return view('admin.HalamanWebMan'); 
    }

    public function bagianArtikel() {
        return view('admin.Artikel'); 
    }
}
