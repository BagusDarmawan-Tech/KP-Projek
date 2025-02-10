<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebManagementController extends Controller
{
    public function slider() {
        
        // $documents = Rpa::paginate(10);

       
        return view('admin.Slider'); 
    }
}
