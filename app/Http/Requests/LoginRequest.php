<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class LoginRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'email|required|exists:App\Models\User,email',
            'password' => 'string|required',
        ];
    }

    public function messages(): array
    {
        return [
            'email.email' => 'Email не корректен',
            'email.required' => 'Введите Email', 
            'email.exists' => 'Пользователь не существует',           
            'password.string' => 'Пароль должен быть строкой',
            'password.required' => 'Введите пароль',           
        ];
    }

    public function getEmail(): string
    {
        return $this->input('email'); 
    }

    public function getPass(): string
    {
        return $this->input('password'); 
    }
}
