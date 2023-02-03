<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use App\Models\User;

class SetLogin extends Controller
{
    public function setRegister(
        String $name,
        String $email,
        String $password,
        String $phone,
        String $gender,
        String $path_foto
    )
    {
        $register = new User();
        $register->name = $name;
        $register->email = $email;
        $register->password = bcrypt($password);
        $register->phone = $phone;
        $register->gender = $gender;
        $register->path_foto = $path_foto;
        $register->save();
        return $register;
    }
}
