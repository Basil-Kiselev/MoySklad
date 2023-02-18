<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
            'email' => 'email|required|unique:App\Models\User,email',
            'password' => 'string|required|min:6',
            'name' => 'string|required',
        ];
    }

    public function messages(): array
    {
        return [
            'email.email' => 'Email не корректен',
            'email.required' => 'Email обязателен',
            'email.unique' => 'Email занят',
            'password.string' => 'Пароль должен быть строкой',
            'password.required' => 'Пароль обязателен',
            'name.string' => 'Имя должно быть строкой',
            'name.required' => 'Имя обязательно',
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

    public function getName(): string
    {
        return $this->input('name'); 
    }
}
