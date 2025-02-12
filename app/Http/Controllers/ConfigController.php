<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function RoleManagementt() {
        return view('admin.RoleManagement'); 
    }

    public function ConfigurasiAPP() {
        return view('admin.ConfigurasiAPP'); 
    }
}
