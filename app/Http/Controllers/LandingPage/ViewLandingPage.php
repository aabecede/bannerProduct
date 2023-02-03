<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Admin\Dashboard\Produk\ServiceProduk;
use App\Http\Controllers\Controller;

class ViewLandingPage extends Controller
{
    //
    public function index()
    {
        $produk = (new ServiceProduk())->paginate(8);
        return view('landing-page.index', compact('produk'));
    }
}
