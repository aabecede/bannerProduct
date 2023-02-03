<?php

namespace App\Http\Controllers\Admin\BannerProduk;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BannerProduk\CreateBannerProduk;
use App\Models\BannerProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BannerProdukController extends Controller
{
    protected $redirect_path = '/admin/banner-produk';
    protected $path_file_save = 'banner-produk';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banner_produk = BannerProduk::paginate(10);
        return view('admin.banner-produk.index' , compact('banner_produk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banner-produk.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBannerProduk $request)
    {
        try {
            //code...
            DB::connection('mysql')->beginTransaction();
            $slug      = slugCustom($request->name);
            $file      = $request->file() ?? [];
            $path      = 'uploads/' . $this->path_file_save . '/';
            $config_file = [
                'patern_filename'   => $slug,
                'is_convert'        => true,
                'file'              => $file,
                'path'              => $path,
                'convert_extention' => 'jpeg'
            ];

            $path_gambar = (new \App\Http\Controllers\Functions\ImageUpload())->imageUpload('file', $config_file)['path_gambar'];
            $master_produk = (new SetBannerProduk())->setCreate(
                $path_gambar
            );


            if ($master_produk) {
                return redirect($this->redirect_path)->with('success', 'Berhasil Buat Banner Produk');
            } else {
                return back()->withInput()->with('error', 'Gagal Edit');
            }

        } catch (\Throwable $th) {
            return $this->exceptionView($th);
        }
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Int $id)
    {
        $banner_produk = BannerProduk::find($id);
        return view('admin.banner-produk.show', compact('banner_produk'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Int $id)
    {
        $banner_produk = BannerProduk::find($id);
        return view('admin.banner-produk.create', compact('banner_produk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            DB::connection('mysql')->beginTransaction();
            $path_gambar = null;
            if (!empty($request->file())) {
                $slug      = slugCustom($request->name);
                $file      = $request->file() ?? [];
                $path      = 'uploads/' . $this->path_file_save . '/';
                $config_file = [
                    'patern_filename'   => $slug,
                    'is_convert'        => true,
                    'file'              => $file,
                    'path'              => $path,
                    'convert_extention' => 'jpeg'
                ];

                $path_gambar = (new \App\Http\Controllers\Functions\ImageUpload())->imageUpload('file', $config_file)['path_gambar'];
            }
            $master_produk = (new SetBannerProduk())->setEdit(
                $id = $id,
                $path_gambar
            );


            if ($master_produk) {
                return redirect($this->redirect_path)->with('success', 'Berhasil Ubah Banner Produk ' . $id);
            } else {
                return back()->withInput()->with('error', 'Gagal Edit');
            }
        } catch (\Throwable $th) {
            return $this->exceptionView($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Int $id)
    {
        try {

            $master_produk = (new SetBannerProduk())->setDelete($id);
            if ($master_produk) {
                return $this->successJson(
                    $result = [
                        'url' => url($this->redirect_path)
                    ],
                    'Delete Banner Produk ' . $id
                );
            } else {
                return $this->errorJson();
            }
        } catch (\Throwable $th) {
            return $this->exceptionView($th);
        }
    }
}
