<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\FlareClient\View;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function create()
    {
        return view('auth.login');
    }
    
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
