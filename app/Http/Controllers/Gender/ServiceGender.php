<?php

namespace App\Http\Controllers\Gender;

use App\Http\Controllers\Controller;
use App\Models\Gender;

class ServiceGender extends Controller
{
    public function getAll(
        String $select = '*'
    ){
        return Gender::selectRaw($select)->get();
    }

}
