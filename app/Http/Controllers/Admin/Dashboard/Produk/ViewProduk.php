<?php

namespace App\Http\Controllers\Admin\Dashboard\Produk;

use App\Http\Controllers\Controller;

class ViewProduk extends Controller
{
    public function index()
    {
        try {
            $produk = (new ServiceProduk())->paginate(10);
            return view('admin.produk.index', compact('produk'));
        } catch (\Throwable $th) {
            return $this->exceptionView($th);
        }
    }

    public function detail(Int $id){
        try {
            $produk = (new ServiceProduk())->getFind($id);
            return view('admin.produk.show', compact('produk'));
        } catch (\Throwable $th) {
            return $this->exceptionView($th);
        }
    }

    public function landingPageDetail(Int $id){
        try {
            $produk = (new ServiceProduk())->getFind($id);
            return view('landing-page.produk.detail', compact('produk'));
        } catch (\Throwable $th) {
            return $this->exceptionView($th);
        }
    }

    public function create(){
        try {
            return view('admin.produk.create');
        } catch (\Throwable $th) {
            return $this->exceptionView($th);
        }
    }
    public function edit(Int $id){
        try {
            $produk = (new ServiceProduk())->getFind($id);
            return view('admin.produk.create', compact('produk'));
        } catch (\Throwable $th) {
            return $this->exceptionView($th);
        }
    }
}
