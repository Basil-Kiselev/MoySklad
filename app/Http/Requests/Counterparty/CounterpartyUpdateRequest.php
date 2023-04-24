<?php

namespace App\Http\Requests\Counterparty;

use Illuminate\Foundation\Http\FormRequest;

class CounterpartyUpdateRequest extends FormRequest
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
            'id' => 'integer|exists:App\Models\Counterparty,id',
            'name' => 'required|string',
            'email' => 'required|email',
            'code' => 'required|string',
            'actual_adress' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'id.integer' => 'Id должен быть целым числом',
            'id.exists' => 'Контрагент не найден',
            'name.required' => 'Наименование обязательно',
            'name.string' => 'Наименование должно быть строкой',
            'email.required' => 'Email обязателен',
            'email.email' => 'Email должен быть формата почты',
            'code.required' => 'Код обязателен',
            'code.string' => 'Код должен быть строкой',
            'actual_adress.required' => 'Адрес обязателен',
            'actual_adress.string' => 'Адрес должен быть строкой',
        ];
    }

    public function getId(): int
    {
        return $this->input('id');
    }

    public function getName(): string
    {
        return $this->input('name');
    }

    public function getEmail(): string
    {
        return $this->input('email');
    }

    public function getCode(): string
    {
        return $this->input('code');
    }

    public function getAdress(): string
    {
        return $this->input('actual_adress');
    }
}
