<?php

namespace App\Http\Requests\Admin\BannerProduk;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateBannerProduk extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'path_gambar' => [
                'mimes:jpg,bmp,png,jpeg',
                'max:2000',
                'required'
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
