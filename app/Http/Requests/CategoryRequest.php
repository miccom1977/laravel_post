<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'title'       => "required|string|max:255",
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Wpisz Nazwę kategorii.',
            'title.string' => 'kategoria musi być tekstem',
            'title.max' => 'Kategoria może mieć max. 225 znaków',
        ];
    }
}
