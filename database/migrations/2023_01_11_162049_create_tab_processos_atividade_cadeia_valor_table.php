<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabProcessosAtividadeCadeiaValorTable extends Migration
{
    public function up()
    {
        Schema::create('pei.tab_processos_atividade_cadeia_valor', function (Blueprint $table) {
            $table->uuid('cod_processo_atividade_cadeia_valor')->primary();
            $table->foreignUuid('cod_atividade_cadeia_valor')->references('cod_atividade_cadeia_valor')->on('pei.tab_atividade_cadeia_valor');
            $table->text('dsc_entrada')->nullable(false);
            $table->text('dsc_transformacao')->nullable(false);
            $table->text('dsc_saida')->nullable(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pei.tab_processos_atividade_cadeia_valor');
    }
}
