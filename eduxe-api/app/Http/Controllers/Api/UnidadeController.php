<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\UnidadeRequest;
use App\Models\Unidade;
use Illuminate\Support\Facades\DB;

class UnidadeController extends Controller
{
    public function cadastraUnidade(UnidadeRequest $request)
    {
        $unidade = new Unidade($this->validateForm($request));
        if (DB::table('unidades')->where('cep', $request->cep)->count() > 0) {
            return response()->json(['error' => 'Unidade Já Cadastrada']);
        } else {
            $unidade->save();
            $empresas = [$request->primaria, $request->secundaria];
            $unidade->empresas()->attach($empresas);
            return response()->json(['msg' => 'Unidade Cadastrada com sucesso']);
        }
    }
    public function listarUnidades(Unidade $unidade)
    {
        return response()->json([
            "data" => $unidade::latest()->get()
        ]);
    }
    public function mostrarUnidade(Request $request, Unidade $unidade)
    {
        $value_responses = $unidade->where('id', $request->id)->first();
        return response()->json([
            'data' => [$value_responses, $value_responses->empresas],
        ]);
    }
    public function editarUnidade(UnidadeRequest $request, Unidade $unidade)
    {
        $unidade = new Unidade($this->validateForm($request));
        $value_responses = $unidade->where('id', $request->id)->first();
        Log::info($value_responses);
        $value_responses->update($this->validateForm($request));
        $empresas = [$request->primaria, $request->secundaria];
        $value_responses->empresas()->detach($empresas);
        $value_responses->empresas()->sync([$request->primaria, $request->secundaria]);
    }
    public function deletarUnidade(Request $request)
    {
        $deletar = Unidade::find($request->id);
        $deletar->delete();
    }
    public function validateForm(UnidadeRequest $unidade_request)
    {
        $validate_form = [
            'id' => $unidade_request->id,
            'cep' => $unidade_request->cep,
            'logradouro' => $unidade_request->logradouro,
            'numero' => $unidade_request->numero,
            "complemento" => $unidade_request->complemento,
            "bairro" => $unidade_request->bairro,
            "localidade" => $unidade_request->localidade,
            "estado" => $unidade_request->uf,
            "primaria" => $unidade_request->primaria,
            "secundaria" => $unidade_request->secundaria,
        ];

        return $validate_form;
    }
}
