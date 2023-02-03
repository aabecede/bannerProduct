<?php

namespace App\Http\Controllers\Admin\Dashboard\Produk;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MasterProduk\EditMasterProdukRequest;
use App\Models\MasterProduk;

class SetProduk extends Controller
{
    public function setCreate(
        String $name,
        Int $harga,
        String $path_gambar,
        String $deskripsi
    ){
        $master_produk = new MasterProduk;
        $master_produk->name = $name;
        $master_produk->harga = $harga;
        $master_produk->deskripsi = $deskripsi;
        $master_produk->path_gambar = $path_gambar;
        $master_produk->created_by = auth()->id();

        $master_produk->save();

        return $master_produk;
    }

    public function setEdit(
        Int $id,
        String $name,
        Int $harga,
        String $path_gambar = null,
        String $deskripsi
    ){
        $master_produk = (new ServiceProduk())->getFind($id);
        $master_produk->name = $name;
        $master_produk->harga = $harga;
        $master_produk->deskripsi = $deskripsi;

        if(!empty($path_gambar)){
            $master_produk->path_gambar = $path_gambar;
        }

        $master_produk->save();

        return $master_produk;
    }

    public function setDelete(Int $id){
        $master_produk = (new ServiceProduk())->getFind($id);

        if (!empty($master_produk->path_gambar)) {
            if (file_exists($master_produk->path_gambar)) {
                unlink($master_produk->path_gambar);
            }
        }

        $master_produk->deleted_by = auth()->id();
        $master_produk->deleted_at = now();
        $master_produk->save();

        return $master_produk;
    }
}
