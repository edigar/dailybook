<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|between:3,255',
            'email' => 'required|email:rfc,dns',
            'password' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nome é obrigatório.',
            'name.min' => 'Nome deve ter ao menos 3 letras.',
            'name.max' => 'Nome deve ter no máximo 255 letras.',
            'email.required' => 'E-mail é orbrigatório.',
            'email.email' => 'O e-mail deve ser válido.',
            'password.required' => 'Senha é obrigatória.',
        ];
    }
}
