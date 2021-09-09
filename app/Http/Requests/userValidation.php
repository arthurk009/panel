<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class userValidation extends FormRequest
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
            'name' => 'required|min:3:max:50',
            'email' => 'required|email',
            'password' => 'required|min:6|max:50|confirmed',
            'role'      =>'required'
        ];
    }

    // public function messages(){
    //     return [
    //         'nombre.required' => 'El campo nombre es requerido',
    //         'url.required' => 'El campo url es requerido'
    //     ];

    // }
}
