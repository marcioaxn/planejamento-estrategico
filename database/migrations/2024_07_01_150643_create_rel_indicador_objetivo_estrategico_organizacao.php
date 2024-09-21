<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelIndicadorObjetivoEstrategicoOrganizacao extends Migration
{
    public function up()
    {
        Schema::create('pei.rel_indicador_objetivo_estrategico_organizacao', function (Blueprint $table) {
            $table->foreignUuid('cod_indicador')->references('cod_indicador')->on('pei.tab_indicador');
            $table->foreignUuid('cod_organizacao')->references('cod_organizacao')->on('tab_organizacoes');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pei.rel_indicador_objetivo_estrategico_organizacao');
    }
}
