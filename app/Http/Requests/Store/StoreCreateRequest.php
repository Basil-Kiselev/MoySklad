<?php

namespace App\Http\Requests\Store;

use Illuminate\Foundation\Http\FormRequest;

class StoreCreateRequest extends FormRequest
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
            'name' => 'required|string',
            'code' => 'required|string',
            'adress' => 'required|string',
            'description' => 'required|string',            
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Наименование обязательно',
            'name.string' => 'Наименование должно быть строкой',
            'code.required' => 'код обязателен',
            'code.string' => 'Код должен быть строкой',
            'adress.required' => 'Адрес обязателен',
            'adress.string' => 'Адрес должен быть строкой',
            'description.required' => 'Комментарий обязателен',
            'description.string' => 'Комментарий должен быть строкой',
        ];
    }

    public function getName(): string
    {
        return $this->input('name');
    }

    public function getCode(): string
    {
        return $this->input('code');
    }

    public function getAdress(): string
    {
        return $this->input('adress');
    }

    public function getDescription(): string
    {
        return $this->input('description');
    }
}
