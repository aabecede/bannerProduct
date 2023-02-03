<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ViewLogin extends Controller
{
    public function index(){
        return view('login.index');
    }

    public function register(){
        return view('login.register');
    }
}
