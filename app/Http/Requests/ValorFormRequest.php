<?php

namespace App\Http\Requests;

use App\Rules\CategoriaRequestRule;
use Illuminate\Foundation\Http\FormRequest;

class ValorFormRequest extends FormRequest
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
            'regiao' => 'required',
            'periodo' => 'required',
            'valor' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'regiao.required' => 'O campo região é obrigatório',
            'periodo.required' => 'O campo período é obrigatório',
        ];
    }
}
