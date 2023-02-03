<?php

namespace App\Http\Controllers\Admin\Dashboard\Produk;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MasterProduk\CreateMasterProdukRequest;
use App\Http\Requests\Admin\MasterProduk\EditMasterProdukRequest;
use Illuminate\Support\Facades\DB;

class DeliverProduk extends Controller
{
    protected $redirect_path = '/admin/produk';
    protected $path_file_save = 'produk';

    public function create(CreateMasterProdukRequest $request){
        try {
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
            $master_produk = (new SetProduk())->setCreate(
                $name = $request->name,
                $harga = $request->harga,
                $path_gambar,
                $deskripsi = $request->deskripsi
            );


            if($master_produk){
                return redirect($this->redirect_path)->with('success', 'Berhasil Buat Produk');
            }
            else{
                return back()->withInput()->with('error', 'Gagal Edit');
            }


        } catch (\Throwable $th) {
            DB::connection('mysql')->rollback();
            return $this->exceptionView($th);
        }
    }

    public function edit(EditMasterProdukRequest $request, $id){
        try {
            DB::connection('mysql')->beginTransaction();
            $path_gambar = null;
            if(!empty($request->file())){
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
            $master_produk = (new SetProduk())->setEdit(
                $id = $id,
                $name = $request->name,
                $harga = $request->harga,
                $path_gambar,
                $deskripsi = $request->deskripsi
            );


            if($master_produk){
                return redirect($this->redirect_path)->with('success', 'Berhasil Ubah Produk '.$id);
            }
            else{
                return back()->withInput()->with('error', 'Gagal Edit');
            }


        } catch (\Throwable $th) {
            DB::connection('mysql')->rollback();
            return $this->exceptionView($th);
        }
    }

    public function delete(Int $id){
        try {

            $master_produk = (new SetProduk())->setDelete($id);
            if($master_produk){
                return $this->successJson(
                    $result = [
                        'url' => url($this->redirect_path)
                    ],
                    'Delete Produk '.$id
                );
            }
            else{
                return $this->errorJson();
            }

        } catch (\Throwable $th) {
            return $this->exceptionView($th);
        }
    }
}
