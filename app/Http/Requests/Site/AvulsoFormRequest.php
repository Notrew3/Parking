<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class AvulsoFormRequest extends FormRequest
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
            'placa' => 'required|min:8',
            'carro_id' => 'required'
        ];
    }
    
    public function messages()
    {
        return [
            'placa.required' => 'Campo (Placa) é obrigatório!',
            'placa.min' => 'Campo (Placa) precisa no minimo 8 caracteres!',
            'carro_id.required' => 'Campo (Carro) é obrigatório!'            
        ];
    }
}
