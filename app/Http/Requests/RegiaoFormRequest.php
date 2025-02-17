<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegiaoFormRequest extends FormRequest
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
            'nome' => 'required',
            'sigla' => 'required',
            'tipo_regiao_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'tipo_regiao_id.required' => 'O campo tipo região é obrigatório' 
        ];
    }
}
