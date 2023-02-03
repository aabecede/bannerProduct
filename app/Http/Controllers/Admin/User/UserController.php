<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    protected $redirect_path = '/admin/list-user';
    protected $path_file_save = 'user';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(2);
        return view('admin.user.index', compact('users'));
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
    public function show(Int $id)
    {
        $user = User::with(['creator'])->find($id);
        return view('admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
            DB::connection('mysql')->beginTransaction();
            $user = (new SetUser())->setDelete($id);
            if ($user) {
                DB::connection('mysql')->commit();
                return $this->successJson(
                    $result = [
                        'url' => url($this->redirect_path)
                    ],
                    'Delete Account ' . $id
                );
            } else {
                DB::connection('mysql')->rollBack();
                return $this->errorJson();
            }
        } catch (\Throwable $th) {
            DB::connection('mysql')->rollback();
            return $this->exceptionJson($th);
        }

    }

    public function verifikasi(Int $id){
        try {
            DB::connection('mysql')->beginTransaction();
            $user = (new SetUser())->setUserVerified($id);
            if($user){
                DB::connection('mysql')->commit();
                return $this->successJson(
                    $result = [
                        'url' => url($this->redirect_path)
                    ],
                    'Verifikasi Account ' . $id
                );
            }else{
                DB::connection('mysql')->rollBack();
                return $this->errorJson();
            }
        } catch (\Throwable $th) {
            DB::connection('mysql')->rollback();
            return $this->exceptionJson($th);
        }
    }
}
