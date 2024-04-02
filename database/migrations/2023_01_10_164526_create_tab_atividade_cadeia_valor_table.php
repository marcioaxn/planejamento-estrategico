<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabAtividadeCadeiaValorTable extends Migration
{
    public function up()
    {
        Schema::create('pei.tab_atividade_cadeia_valor', function (Blueprint $table) {
            $table->uuid('cod_atividade_cadeia_valor')->primary();
            $table->foreignUuid('cod_pei')->references('cod_pei')->on('pei.tab_pei');
            $table->foreignUuid('cod_perspectiva')->references('cod_perspectiva')->on('pei.tab_perspectiva');
            $table->text('dsc_atividade')->nullable(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pei.tab_atividade_cadeia_valor');
    }
}
