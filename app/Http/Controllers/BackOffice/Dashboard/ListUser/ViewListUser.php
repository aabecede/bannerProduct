<?php

namespace App\Http\Controllers\BackOffice\Dashboard\ListUser;

use App\Http\Controllers\Controller;

class ViewListUser extends Controller
{
    public function index()
    {
        abort(201, 'Belum ada halaman menyusul');
        return view('login.index');
    }
}
