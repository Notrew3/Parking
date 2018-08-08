<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class CarroFormRequest extends FormRequest
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
            'nome' => 'required|min:3|max:30',
            'marcas_id' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'nome.required' => 'O campo (Marca) é de preenchimento obrigatório.',
            'nome.min' => 'O campo (Marca) espera no mínimo 3 caracteres.',
            'nome.max' => 'O campo (Marca) tem a capacidade de apenas 30 caracteres',
            'marcas_id.required' => 'Selecione uma Marca!'
        
        ];
    }
}
