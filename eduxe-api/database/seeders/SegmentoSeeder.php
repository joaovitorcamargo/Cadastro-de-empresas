<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Segmento;

class SegmentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Segmento::create([
            "tipo" => "Produto",
            "tipo" => "Produto e Servico"
        ]);
        Segmento::create([
            "tipo" => "Servico",
        ]);
        Segmento::create([
            "tipo" => "Produto e Servico"
        ]);
    }
}
