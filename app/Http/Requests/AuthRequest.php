<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return \string[][]
     */
    public function rules()
    {
        return [
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:6', 'confirmed'],
        ];
    }

    /**
     * @return string[]
     */
    public function attributes()
    {
        return [
            'name' => 'Nombre',
            'email' => 'Correo electrónico',
            'password' => 'Contraseña',
        ];
    }
}
