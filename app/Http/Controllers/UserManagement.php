<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserManagement extends Controller
{
    public function UserManagement() {
        $user = User::latest()->paginate(10);
        return view('admin.UserManagement', compact('user'));
    }   
}
