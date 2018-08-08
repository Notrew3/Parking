<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class AddressFormRequest extends FormRequest
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
        'rua' => 'required',
        'bairro' => 'required',
        'cidade' => 'required',
        'estado' => 'required|max:2',
        'cep' => 'min:9',
        'numero' => 'required|numeric'        
    ];
    }
    public function messages()
    {
        return [
            'rua.required' => 'Campo (Rua) é obrigatório!',
            'bairro.required' => 'Campo (Bairro) é obrigatório!',
            'cidade.required' => 'Campo (Cidade) é obrigatório!',
            'estado.required' => 'Campo (Estado) é obrigatório!',
            'estado.max' => 'Campo (Estado) recebe apenas 2 caracteres!',
            'cep.min' => 'Campo (Cep) recebe no mínimo 9 caracteres!',
            'numero.required' => 'Campo (Numero) é obrigatório!',
            'numero.numeric' => 'Campo (Numero) recebe apenas números!'
        ];
    }
}
