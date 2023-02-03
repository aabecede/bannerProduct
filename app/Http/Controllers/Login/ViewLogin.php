<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ViewLogin extends Controller
{
    public function index(){
        if(!empty(auth()->user())){
            if(auth()->user()->is_admin == 1){
                return redirect('admin/dashboard');
            }
            elseif(auth()->user()->is_verified == 0){
                Auth::logout();
                return redirect('login')->with('error', 'Akun Belum Aktif, Silahkan hubungi Admin');
            }
            else{
                return redirect('/profile/'.auth()->id().'/edit');
            }
        }

        return view('login.index');
    }

    public function register(){
        return view('login.register');
    }
}
