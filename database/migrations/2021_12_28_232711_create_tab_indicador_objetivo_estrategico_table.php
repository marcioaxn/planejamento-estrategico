<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabIndicadorObjetivoEstrategicoTable extends Migration
{

    public function up()
    {
        Schema::create('pei.tab_indicador_objetivo_estrategico', function (Blueprint $table) {
            $table->uuid('cod_indicador')->primary();
            $table->foreignUuid('cod_objetivo_estrategico')->references('cod_objetivo_estrategico')->on('pei.tab_objetivo_estrategico');
            $table->text('dsc_tipo')->nullable(false);
            $table->text('dsc_indicador')->nullable(false);
            $table->text('dsc_unidade_medida')->nullable(false);
            $table->smallInteger('num_peso')->nullable(true);
            $table->string('bln_acumulado')->nullable(false);
            $table->text('dsc_formula')->nullable(true);
            $table->string('dsc_fonte')->nullable(false);
            $table->string('dsc_periodo_medicao')->nullable(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pei.tab_indicador');
    }
}
