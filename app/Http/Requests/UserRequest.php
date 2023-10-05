<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $method = strtolower($this->method());
        $user_id = $this->route()->user;

        $rules = [];
        switch ($method) {
            case 'post':
                $rules = [
                    'name' => ['required', 'max:255'],
                    'email' => ['required', 'email', 'unique:users'],
                    'password' => ['required', 'min:6', 'confirmed'],
                ];
                break;
            case 'put':
                $rules = [
                    'name' => ['required', 'max:255'],
                    'email' => ['required', 'email', 'unique:users,email,' . $user_id],
                    'password' => ['nullable', 'min:6', 'confirmed'],
                ];
                break;
        }

        return $rules;
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
