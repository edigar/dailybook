<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|between:3,255',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'password' => 'required|between:3,255|confirmed',
            'password_confirmation' => 'required',
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
            'email.unique' => 'E-mail já cadastrado.',
            'password.required' => 'Senha é obrigatória.',
            'password.min' => 'Senha deve ter ao menos 3 letras.',
            'password.confirmed' => 'As senhas devem ser iguais.',
            'password_confirmation.required' => 'Confirmação de senha é obrigatório.',
        ];
    }
}
