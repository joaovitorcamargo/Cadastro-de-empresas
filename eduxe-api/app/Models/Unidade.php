<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unidade extends Model
{
    use SoftDeletes;
    protected $fillable = ['id', 'cep', 'logradouro', 'complemento', 'bairro', 'localidade', 'numero', 'estado'];
    public function empresas()
    {
        return $this->belongsToMany(Empresa::class);
    }
}
