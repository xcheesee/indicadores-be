<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjetoRequest extends FormRequest
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
            'departamento' => 'required',
            'descricao' => 'required',
            'visivel' => 'required',
            'imagem' => 'required_if:visivel,==,1',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'descricao.required' => 'O campo descrição é obrigatório',
            'imagem.required_if' => 'O campo imagem é obrigatório',
            'visivel.required' => 'O campo publicado é obrigatório',
        ];
    }
}
