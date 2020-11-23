<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class segmento extends Model
{
    protected $fillable = ['tipo'];

    public function empresas()
    {
        return $this->belongsToMany(Empresa::class);
    }
}
