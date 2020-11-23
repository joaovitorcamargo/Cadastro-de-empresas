<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\EmpresaRequest;
use Illuminate\Support\Facades\Log;
use App\Models\Empresa;
use Illuminate\Support\Facades\DB;

class EmpresaController extends Controller
{

  public function cadastraEmpresa(EmpresaRequest $empresa_request, Empresa $empresa)
  {
    $empresa = new Empresa($this->validateForm($empresa_request));
    if (DB::table('empresas')->where('cnpj', $empresa_request->cnpj)->count() > 0) {
      return response()->json(['error' => 'Empresa Já Cadastrada']);
    } else {
      $empresa->save();
      $empresa->segmentos()->attach($empresa_request->segmentos);
      return response()->json(['msg' => 'Empresa Cadastrada com sucesso']);
    }
  }

  public function listarEmpresa(Empresa $empresa)
  {
    return response()->json([
      "data" => $empresa::latest()->get()
    ]);
  }

  public function mostrarEmpresa(Request $request, Empresa $empresa)
  {
    $value_responses = $empresa->where('id', $request->id)->first();
    return response()->json([
      'data' => [$value_responses, $value_responses->segmentos[0]],
    ]);
  }

  public function editarEmpresa(EmpresaRequest $empresa_request)
  {
    $empresa = new Empresa($this->validateForm($empresa_request));
    $value_responses = $empresa->where('cnpj', $empresa_request->cnpj)->first();
    Log::info($value_responses);
    $value_responses->update($this->validateForm($empresa_request));
    $value_responses->segmentos()->sync($empresa_request->segmentos);
  }
  public function deletarEmpresa(Request $request)
  {

    $deletar = Empresa::find($request->id);
    $deletar->delete();
  }
  public function validateForm(EmpresaRequest $empresa_request)
  {
    $validate_form = [
      'cnpj' => $empresa_request->cnpj,
      'nome' => $empresa_request->nome,
      'nome_fantasia' => $empresa_request->nome_fantasia,
      'cep' => $empresa_request->cep,
      'logradouro' => $empresa_request->logradouro,
      'numero' => $empresa_request->numero,
      'telefone' => $empresa_request->telefone,
      "email" => $empresa_request->email,
      "complemento" => $empresa_request->complemento,
      "bairro" => $empresa_request->bairro,
      "cidade" => $empresa_request->cidade,
      "estado" => $empresa_request->estado,
      "inscricao_municipal" => $empresa_request->inscricao_municipal,
      "inscricao_estadual" => $empresa_request->inscricao_estadual
    ];
    return $validate_form;
  }
}
