<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnidadeRequest extends FormRequest
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
            'id' => 'nullable',
            'cep' => 'required',
            'logradouro' => 'required',
            'complemento' => 'nullable',
            'bairro' => 'required',
            'localidade' => 'required',
            'uf' => 'required',
            'numero' => 'nullable',
            'primaria' => 'required',
            'secundaria' => 'required',
        ];
    }
}
