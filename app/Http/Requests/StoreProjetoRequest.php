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
            'nome' => 'required|unique',
            'departamento' => 'required',
            'descricao' => 'required',
            'visivel' => 'required',
            'imagem' => 'required_if:visivel,==,1|mimes:png,jpg,jpeg,gif',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'nome.unique' => 'Este no nome já existe',
            'descricao.required' => 'O campo descrição é obrigatório',
            'imagem.required_if' => 'O campo imagem é obrigatório',
            'imagem.mimes' => 'Favor usar um arquivo de imagem válido (png, jpg, jpeg ou gif)',
            'visivel.required' => 'O campo publicado é obrigatório',
        ];
    }
}
