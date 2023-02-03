<?php

namespace App\Http\Requests\Admin\MasterProduk;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class EditMasterProdukRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
            'path_gambar' => [
                'mimes:jpg,bmp,png,jpeg',
                'max:2000'
            ],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $warning = $validator->errors()->messages();
        throw new HttpResponseException(
            back()->withInput()->with('validator', $warning)
        );
    }
}
