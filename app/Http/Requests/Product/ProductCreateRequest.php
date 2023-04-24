<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
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
            'article' => 'string|required',
            'code' => 'string|required',
            'name' => 'string|required',
            'min_price' => 'numeric|required|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'article.string' => 'Артикл должен быть строкой',
            'article.required' => 'Введите артикл',
            'code.string' => 'Код должен быть строкой',
            'code.required' => 'Введите код',
            'name.string' => 'Наименование должно быть строкой',
            'name.required' => 'Введите наименование',
            'min_price.numeric' => 'Цена должна быть числом',
            'min_price.required' => 'Цена обязательна',
            'min_price.min' => 'Цена не может быть меньше нуля',
        ];
    }

    public function getArticle(): string
    {
        return $this->input('article');
    }

    public function getCode(): string
    {
        return $this->input('code');
    }

    public function getName(): string
    {
        return $this->input('name');
    }

    public function getPrice(): string
    {
        return $this->input('min_price');
    }
}
