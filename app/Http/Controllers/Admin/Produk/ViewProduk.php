<?php

namespace App\Http\Controllers\Admin\Dashboard\Produk;

use App\Http\Controllers\Controller;

class ViewProduk extends Controller
{
    public function index()
    {
        return view('admin.produk.index');
    }
}
