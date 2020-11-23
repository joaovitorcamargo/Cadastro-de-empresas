<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpresaRequest extends FormRequest
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
            'nome' => 'required',
            'nome_fantasia' => 'nullable',
            'cep' => 'required',
            'logradouro' => 'required',
            'numero' => 'required',
            'telefone' => "required",
            "email" => 'required',
            "complemento" => "nullable",
            "bairro" => "required",
            "cidade" => "required",
            "estado" => 'required',
            "cnpj" => "required",
            "segmentos" => "required|exists:segmentos,id",
            "inscricao_municipal" => "required",
            "inscricao_estadual" => "nullable"
        ];
    }
}
