<?php

namespace App\Http\Controllers\Gender;

use App\Http\Controllers\Controller;

class DeliverGender extends Controller
{
    public function getAllGender(){
        try {
            $gender = (new ServiceGender())->getAll(
                $select = 'id,name'
            );

            $result = [
                'data' => $gender
            ];
            return $this->successJson(
                $result
            );
        } catch (\Throwable $th) {
            return $this->exceptionJson($th);
        }
    }
}
