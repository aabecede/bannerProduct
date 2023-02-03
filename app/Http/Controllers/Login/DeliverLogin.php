<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use App\Http\Requests\Login\LoginRequest;
use App\Http\Requests\Login\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DeliverLogin extends Controller
{
    public function register(RegisterRequest $request){
        try {
            DB::connection('mysql')->beginTransaction();
            $register = (new SetLogin())->setRegister(
                $name = $request->name,
                $email = $request->email,
                $password = $request->password,
                $phone = $request->phone
            );

            if($register){
                DB::connection('mysql')->commit();
                return redirect('/login')->with('success', 'Berhasil Registrasi');
            }else{
                DB::connection('mysql')->rollback();
                return back()->withInput()->with('error', 'Gagal');
            }

        } catch (\Throwable $th) {
            DB::connection('mysql')->rollBack();
            return $this->exceptionView($th);
        }
    }

    public function login(LoginRequest $request){
        try {

            $credentials = $request->only(['email', 'password']);
            if (Auth::attempt($credentials) && Auth::user()->is_verified == 1) {
                return redirect('admin/dashboard');
            }
            else{
                return back()->withInput()->with('error', 'Password Atau Email Salah');
            }
        } catch (\Throwable $th) {
            return $this->exceptionView($th);
        }
    }
}
