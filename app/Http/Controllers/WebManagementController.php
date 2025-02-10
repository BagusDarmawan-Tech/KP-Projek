<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebManagementController extends Controller
{

    public function slider() {
        
        // $documents = Rpa::paginate(10);

       
        return view('admin.Slider'); 
    }

    public function subkegiatan() {
        
        // $documents = Rpa::paginate(10);

       
        return view('admin.SubKegiatan'); 
    }

    public function forumanak() {
        
        // $documents = Rpa::paginate(10);

       
        return view('admin.ForumAnak'); 
    }

    public function galeri() {
        
        // $documents = Rpa::paginate(10);

       
        return view('admin.Galeri'); 
    }

    
}
