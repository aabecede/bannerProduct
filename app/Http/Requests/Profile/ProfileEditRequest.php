<?php

namespace App\Http\Requests\Profile;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class ProfileEditRequest extends FormRequest
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
            'name' => 'required',
            'gender' => 'required',
            'email' => [
                'required',
                Rule::unique('users', 'email')->using(function($q){
                    $q->where('id', '!=', auth()->user()->id);
                }),
            ],
            'phone' => [
                'required',
                Rule::unique('users', 'phone')->using(function($q){
                    $q->where('id', '!=', auth()->user()->id);
                })
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
