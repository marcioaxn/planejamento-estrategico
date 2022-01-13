<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabIndicadorTable extends Migration
{
    
    public function up()
    {
        Schema::create('pei.tab_indicador', function (Blueprint $table) {
            $table->uuid('cod_indicador')->primary();
            $table->foreignUuid('cod_plano_de_acao')->references('cod_plano_de_acao')->on('pei.tab_plano_de_acao');
            $table->text('dsc_tipo')->nullable(false);
            $table->text('dsc_indicador')->nullable(false);
            $table->decimal('vlr_meta', $precision = 1000, $scale = 2);
            $table->text('dsc_unidade_medida')->nullable(false);
            $table->smallInteger('num_peso')->nullable(false);
            $table->string('bln_acumulado')->nullable(false);
            $table->text('dsc_formula')->nullable(false);
            $table->string('dsc_fonte')->nullable(false);
            $table->string('dsc_periodo_medicao')->nullable(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pei.tab_indicador');
    }
}
