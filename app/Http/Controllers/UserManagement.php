<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserManagement extends Controller
{
    public function UserManagement() {
        $user = User::all();
        return view('admin.UserManagement', compact('user'));
    }   
}
