<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;
use \App\Models\Login;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $logins = Login::with('user')->orderBy('login_time', 'desc')->get();
        $users = User::orderBy('last_login', 'desc')->get();
        return view('admin', compact('users', 'logins'));
    }
}
