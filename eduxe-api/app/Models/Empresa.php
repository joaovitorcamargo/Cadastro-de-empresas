<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends Model
{
    use SoftDeletes;

    protected $fillable = ['cnpj', 'nome', 'nome_fantasia', 'cep', 'logradouro', 'numero', 'telefone', 'email', 'complemento', 'bairro', 'cidade', 'estado', 'inscricao_municipal', 'inscricao_estadual'];

    public function segmentos()
    {
        return $this->belongsToMany(Segmento::class);
    }
    public function unidades()
    {
        return $this->belongsToMany(Unidade::class);
    }
}
