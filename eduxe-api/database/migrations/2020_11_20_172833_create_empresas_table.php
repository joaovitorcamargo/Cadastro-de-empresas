<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('cnpj');
            $table->string('nome');
            $table->string('nome_fantasia')->nullable();
            $table->string('cep');
            $table->text('logradouro');
            $table->text('numero');
            $table->text('telefone');
            $table->string('email');
            $table->text('complemento')->nullable();
            $table->text('bairro');
            $table->text('cidade');
            $table->char('estado', 2);
            $table->text('inscricao_municipal');
            $table->text('inscricao_estadual')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
        Schema::create('empresa_segmento', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->constrained();
            $table->foreignId('segmento_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('empresa_segmento');
        Schema::dropIfExists('empresas');
    }
}
