<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabEvolucaoIndicadorTable extends Migration
{
    
    public function up()
    {
        Schema::create('pei.tab_evolucao_indicador', function (Blueprint $table) {
            $table->uuid('cod_evolucao_indicador')->primary();
            $table->foreignUuid('cod_indicador')->references('cod_indicador')->on('pei.tab_indicador');
            $table->smallInteger('num_ano')->nullable(false);
            $table->smallInteger('num_mes')->nullable(false);
            $table->decimal('vlr_previsto', $precision = 1000, $scale = 2)->nullable(true);
            $table->decimal('vlr_realizado', $precision = 1000, $scale = 2)->nullable(true);
            $table->text('txt_avaliacao')->nullable(true);
            $table->string('bln_atualizado')->nullable(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pei.tab_evolucao_indicador');
    }
}
