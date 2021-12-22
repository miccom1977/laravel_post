<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'description' => "required|string|max:255",
            "categories"    => "required|array",
            "categories.*"  => "required|integer|min:1",
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Wpisz tytuł posta.',
            'description.required' => 'Podaj tresć posta.',
            'title.string' => 'Tytuł musi być tekstem',
            'title.max' => 'Tytuł może mieć max. 225 znaków',
            'description.string' => 'Opis musi być tekstem',
            'description.max' => 'Opis może mieć max. 225 znaków',
            'categories.required' => 'Wybierz kategorie dla twojego posta',
            'categories.array' => 'Wybierz przynajmniej jedną opcję',
            'categories.*.required' => 'Nieprawidłowe dane wejściowe',
            'categories.*.integer' => 'Nieprawidłowe dane wejściowe',
            'categories.*.min' => 'Wybierz przynajmniej jedną kategorię',
        ];
    }
}
