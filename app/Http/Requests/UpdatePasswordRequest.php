<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
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
            'password' => 'required',
            'new_password' => 'required|between:3,255|confirmed',
            'new_password_confirmation' => 'required',
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
            'password.required' => 'Senha é obrigatória.',
            'new_password.required' => 'Senha é obrigatória.',
            'new_password.min' => 'Senha deve ter ao menos 3 letras.',
            'new_password.confirmed' => 'A nova senha e confirmação de senha devem ser iguais.',
            'new_password_confirmation.required' => 'Confirmação de senha é obrigatório.',
        ];
    }
}
