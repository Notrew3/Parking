<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class TabelaPrecoFormRequest extends FormRequest
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
            'nome' => 'required|min:5|max:30',
            'demais' => 'required|numeric'
        ];
    }
    public function messages()
    {
        return [
            'nome.required' => 'O campo (Tabela) é de preenchimento obrigatório!',
            'nome.min' => 'O campo (Tabela) espera no mínimo 5 caracteres!',
            'nome.max' => 'O campo (Tabela) tem a capacidade de apenas 30 caracteres!',
            'demais.required' => 'O campo (Demais) é de preenchimento obrigatório!',
            'demais.numeric' => 'O campo (Demais) é de tipo numérico!'
        
        ];
    }
}
