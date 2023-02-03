<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SetUser extends Controller
{
    public function setUserVerified(Int $id){
        $user = User::find($id);
        $user->is_verified = 1;
        $user->save();

        return $user;
    }

    public function setDelete(Int $id){
        $user = User::find($id);
        $user->delete();

        return $user;
    }

    public function setUpdateUser(
        Int $id,
        String $name,
        String $email,
        String $phone,
        String $path_foto = null,
        String $gender
    ){
        $user = User::find($id);
        $user->name = $name;
        $user->email = $email;
        $user->phone = $phone;
        if(!empty($path_foto)){
            $user->path_foto = $path_foto;
        }
        $user->gender = $gender;
        $user->save();

        return $user;
    }
}
