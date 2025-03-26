<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class UserManagement extends Controller
{
    public function UserManagement() {
        $roles = Role::all();
        $user = User::orderBy('created_at', 'desc')->get();
        return view('admin.UserManagement', compact('user','roles'));
    }   
}
