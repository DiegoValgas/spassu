<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubjectRequest extends FormRequest
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
            'description' => [
                'required',
                'string',
                'max:20',
                Rule::unique('subjects')->withoutTrashed()->ignore($this->subject->id ?? 0)
            ],
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
            'description.required' => 'A descrição é obrigatório.',
            'description.string' => 'Tipo de dado inválido para a descrição.',
            'description.max' => 'A descrição não pode ter mais de 20 caracteres.',
            'description.unique' => 'A descrição informada já está em uso.',
        ];
    }
}
