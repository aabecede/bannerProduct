<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Admin\User\SetUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\ProfileEditRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    protected $path_file_save = 'users';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Int $id)
    {
        $user = User::find($id);
        return view('landing-page.profile.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileEditRequest $request, $id)
    {

        try {
            $path_foto = null;
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
            } else if(!empty($request->via_kamera)) {
                $encoded_data   = $request->via_kamera;
                $image_parts    = explode(";base64,", $encoded_data);
                $file_path = public_path('uploads/users');
                if (!file_exists($file_path)) {
                    mkdir($file_path, 0775, true);
                }
                $image_base64   = base64_decode($image_parts[1]);
                $filename       = uniqid() . '.jpg';
                $file           = $file_path . '/' . $filename;
                $path_foto      = 'uploads/' . $this->path_file_save . '/' . $filename;
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
            $user = (new SetUser())->setUpdateUser(
                $id,
                $name = $request->name,
                $email = $request->email,
                $phone = $request->phone,
                $path_foto,
                $gender = $request->gender
            );

            if($user){

                DB::connection('mysql')->commit();
                return back()->with('success', 'Berhasil Update Data');
            }
            else{
                DB::connection('mysql')->rollback();
                return back()->with('error', 'Gagal Update Data');
            }

        } catch (\Throwable $th) {
            DB::connection('mysql')->rollback();
            return $this->exceptionView($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
