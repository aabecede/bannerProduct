<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use App\Http\Requests\Login\LoginRequest;
use App\Http\Requests\Login\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DeliverLogin extends Controller
{
    protected $path_file_save = 'users';

    public function register(RegisterRequest $request){

        if(empty($request->via_kamera) && empty($request->selfie)){
            return back()->withInput()->with('validator', ['selfie' => ['Selfie Required or fill via kamera']]);
        }

        try {

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

                $path_foto = (new \App\Http\Controllers\Functions\ImageUpload())->imageUpload('file', $config_file)['path_gambar'];
            }
            else{
                $encoded_data   = $request->via_kamera;
                $image_parts    = explode(";base64,", $encoded_data);
                $file_path = public_path('uploads/users');
                if (!file_exists($file_path)){
                    mkdir($file_path, 0775, true);
                }
                $image_base64   = base64_decode($image_parts[1]);
                $filename       = uniqid() . '.jpg';
                $file           = $file_path . '/' . $filename;
                $path_foto      = 'uploads/'.$this->path_file_save.'/' . $filename;
                // $file_thumbnail = $file.'_300x300.jpeg';
                // $folder_thumbnail = '300x300';
                // $size = 300;
                // $thumbnail_dir = rtrim($file_path, '/').'/'.$folder_thumbnail.'/';
                // if (!file_exists($thumbnail_dir) && !is_dir($thumbnail_dir)) {
                //     mkdir($thumbnail_dir, 0777, true);
                // }
                // $img = Image::make($file);
                // $img->fit($size);
                // $img->save($thumbnail_dir.$file_thumbnail);
                // $file_thumb = $thumbnail_dir.$file_thumbnail;
                // $path_thumbnail = 'upload/pasien/300x300/'.$file_thumbnail;
                $result = file_put_contents($file, $image_base64);
                // $result->fit($size);
                // $result->save($thumbnail_dir.$file_thumbnail);
                // $result_thumb = file_put_contents($file_thumbnail, $image_base64);
                if (!$result) {
                    return $result;
                }

            }
            DB::connection('mysql')->beginTransaction();
            $register = (new SetLogin())->setRegister(
                $name = $request->name,
                $email = $request->email,
                $password = $request->password,
                $phone = $request->phone,
                $gender = $request->gender,
                $path_foto
            );

            if($register){
                DB::connection('mysql')->commit();
                return redirect('/login')->with('success', 'Berhasil Registrasi');
            }else{
                DB::connection('mysql')->rollback();
                return back()->withInput()->with('error', 'Gagal');
            }

        } catch (\Throwable $th) {
            DB::connection('mysql')->rollBack();
            return $this->exceptionView($th);
        }
    }

    public function login(LoginRequest $request){
        try {

            $credentials = $request->only(['email', 'password']);
            if (Auth::attempt($credentials)) {
                if(Auth::user()->is_admin == 1){
                    return redirect('admin/dashboard');
                }
                else if(auth()->user()->is_verified){
                    return redirect('/');
                }
                else{
                    Auth::logout();
                    return redirect('login')->withInput()->with('error', 'Akun Belum Aktif, Silahkan hubungi Admin');
                }
            }
            else{
                Auth::logout();
                return redirect('login')->withInput()->with('error', 'Password Atau Email Salah');
            }
        } catch (\Throwable $th) {
            return $this->exceptionView($th);
        }
    }
}
