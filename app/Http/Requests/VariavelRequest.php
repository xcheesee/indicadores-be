<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VariavelRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'codigo' => 'required',
            'departamento' => 'required',
            'tipo_dado' => 'required',
            'fonte' => 'required',
            'metadados_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'tipo_dado.required' => 'O campo tipo do dado é obrigatório',
        ];
    }
}
