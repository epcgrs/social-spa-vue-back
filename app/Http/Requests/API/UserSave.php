<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class UserSave extends FormRequest
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
            'name' => 'required|string|max:200',
            'email' => 'required|unique:users|string|email|max:200',
            'password'  => 'required|string|min:4|confirmed'
        ];
    }

    public function attributes()
    {
        return [
            'name'      =>   'Nome',
            'email'     => 'Email',
            'password'  => 'Senha'
        ];
    }

}
