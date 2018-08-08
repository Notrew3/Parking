<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class ClienteFormRequest extends FormRequest
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
        'nome'          => 'required|min:3|max:100',
        'mensalidade'   => 'required|numeric',
        'vencimento'    => 'required'            
        ];
    }
    
    public function messages()
    {
        return [
            'nome.required' => 'O campo (Nome) é de preenchimento obrigatório.',
        'nome.min' => 'O campo (Nome) espera no mínimo 3 caracteres.',
        'nome.max' => 'O campo (Nome) tem a capacidade de apenas 100 caracteres',
        'mensalidade.required' => 'O campo (Mensalidade) é de preenchimento obrigatório.',
        'mensalidade.numeric' => 'O campo (Mensalidade) espera valores numericos.',
        'vencimento.required' => 'O campo (Vencimento) é de preenchimento obrigatório'
        ];
    }
}
