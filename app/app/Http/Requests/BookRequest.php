<?php

namespace App\Http\Requests;

use App\Rules\FullYear;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:40'],
            'publisher' => ['required', 'string', 'max:40'],
            'edition' => ['required', 'numeric', 'min:0'],
            'publication_year' => ['required', 'date_format:Y', new FullYear],
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
            'title.required' => 'O título é obrigatório.',
            'title.string' => 'Tipo de dado inválido para o título.',
            'title.max' => 'O título não pode ter mais de 40 caracteres.',

            'publisher.required' => 'A editora é obrigatório.',
            'publisher.string' => 'Tipo de dado inválido para editora.',
            'publisher.max' => 'A editora não pode ter mais de 40 caracteres.',

            'edition.required' => 'O campo edição é obrigatório.',
            'edition.numeric' => 'Tipo de dado inválido para o campo edição.',
            'edition.min' => 'O campo edição não pode ser menor que zero.',

            'publication_year.required' => 'O ano de publicação é obrigatório.',
            'publication_year.*' => 'O ano de publicação não é válido.',
        ];
    }
}
