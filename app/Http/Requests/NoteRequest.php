<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoteRequest extends FormRequest
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

        $rules = [];
        switch ($method) {
            case 'post':
                $rules = [
                    'department_id' => ['required', 'integer'],
                    'description' => ['required', 'string'],
                    'client_name' => ['required', 'max:255'],
                    'client_company' => ['required', 'max:255'],
                    'client_phone_number' => ['required', 'max:255'],
                ];
                break;
            case 'put':
                $rules = [
                    'description' => ['required', 'string'],
                    'observations' => ['nullable', 'string'],
                    'status' => ['required'],
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
            'department_id' => 'Departamento',
            'description' => 'Descripción',
            'client_name' => 'Nombre de cliente',
            'client_company' => 'Empresa cliente',
            'client_phone_number' => 'Teléfono cliente',
            'observations' => 'Observaciones',
            'status' => 'Estado',
        ];
    }
}
