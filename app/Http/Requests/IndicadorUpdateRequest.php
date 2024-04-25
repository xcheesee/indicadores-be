<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndicadorUpdateRequest extends FormRequest
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
            'nome' => 'required|unique:indicadores,nome,'.$this->id,
            'departamento' => 'required',
            'projeto' => 'required',
            'fonte' => 'required',
            'periodicidade' => 'required',
            'imagem' => 'mimes:png,jpg,jpeg,gif',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'nome.unique' => 'Já existe indicador com esse nome',
            'departamento.required' => 'O campo departamento é obrigatório',
            'projeto.required' => 'O campo projeto é obrigatório',
            'fonte.required' => 'O campo fonte é obrigatório',
            'periodicidade.required' => 'O campo periodicidade é obrigatório',
            'imagem.mimes' => 'Favor usar um arquivo de imagem válido (png, jpg, jpeg ou gif)',
        ];
    }
}
