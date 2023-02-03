<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ViewLandingPage extends Controller
{
    //
    public function index()
    {
        return view('landing-page.index');
    }
}
