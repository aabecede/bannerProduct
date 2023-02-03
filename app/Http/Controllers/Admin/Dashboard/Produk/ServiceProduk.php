<?php

namespace App\Http\Controllers\Admin\Dashboard\Produk;

use App\Http\Controllers\Controller;
use App\Models\MasterProduk;

class ServiceProduk extends Controller
{
    public function paginate(Int $number = 10)
    {
        return MasterProduk::paginate($number);
    }

    public function getFind(Int $id, $eager = []){
        return MasterProduk::with($eager)->find($id);
    }
}
