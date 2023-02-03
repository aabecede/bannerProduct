<?php

namespace App\Http\Controllers\Admin\BannerProduk;

use App\Http\Controllers\Controller;
use App\Models\BannerProduk;

class ServiceBannerProduk extends Controller
{
    public function getBanner(Int $take){
        $banner_produk = BannerProduk::take($take);

        return $banner_produk->get();
    }
}
