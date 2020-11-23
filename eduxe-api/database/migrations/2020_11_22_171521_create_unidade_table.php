<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnidadeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidades', function (Blueprint $table) {
            $table->id();
            $table->string('cep');
            $table->text('logradouro');
            $table->text('complemento')->nullable();
            $table->text('bairro');
            $table->text('localidade');
            $table->text('numero');
            $table->char('estado', 2);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
        Schema::create('empresa_unidade', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->constrained();
            $table->foreignId('unidade_id')->constrained();
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
        Schema::dropIfExists('empresa_unidade');
        Schema::dropIfExists('unidades');
    }
}
