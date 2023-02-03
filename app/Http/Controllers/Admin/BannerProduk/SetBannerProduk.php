<?php

namespace App\Http\Controllers\Admin\BannerProduk;

use App\Http\Controllers\Controller;
use App\Models\BannerProduk;

class SetBannerProduk extends Controller
{
    public function setCreate(
        String $path_gambar
    ) {
        $banner_produk = new BannerProduk;
        $banner_produk->path_gambar = $path_gambar;
        $banner_produk->created_by = auth()->id();
        $banner_produk->save();
        return $banner_produk;
    }

    public function setEdit(
        Int $id,
        String $path_gambar = null
    ) {
        $banner_produk = BannerProduk::find($id);

        if (!empty($path_gambar)) {
            $banner_produk->path_gambar = $path_gambar;
        }

        $banner_produk->save();

        return $banner_produk;
    }

    public function setDelete(Int $id)
    {
        $banner_produk = BannerProduk::find($id);

        if (!empty($banner_produk->path_gambar)) {
            if (file_exists($banner_produk->path_gambar)) {
                unlink($banner_produk->path_gambar);
            }
        }

        $banner_produk->deleted_by = auth()->id();
        $banner_produk->deleted_at = now();
        $banner_produk->save();

        return $banner_produk;
    }
}
