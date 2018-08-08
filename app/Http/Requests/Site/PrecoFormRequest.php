<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class PrecoFormRequest extends FormRequest
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
            'tabela_preco_id' => 'required',
            'hora_inicio' => 'required',
            'hora_fim' => 'required',
            'valor' => 'required|numeric'
        ];
    }
    public function messages()
    {
        return [
            'tabela_preco_id.required' => 'O campo (Tabela) é de preenchimento obrigatório.',
        'hora_inicio.required' => 'O campo (De) é de preenchimento obrigatório.',
        'hora_fim.required' => 'O campo (Até) é de preenchimento obrigatório.',
            'valor.required' => 'O campo (Valor) é de preenchimento obrigatório.',
            'valor.numeric' => 'O campo (Valor) recebe apenas numeros.'
        
        ];
    }
}
