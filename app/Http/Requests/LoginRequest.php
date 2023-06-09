<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'email'=>'required|email',
            'password'=>'required|min:6'
        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json($validator->errors(),422));
    }
}
