<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabPlanoDeAcaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pei.tab_plano_de_acao', function (Blueprint $table) {
            $table->uuid('cod_plano_de_acao')->primary();
            $table->foreignUuid('cod_objetivo_estrategico')->references('cod_objetivo_estrategico')->on('pei.tab_objetivo_estrategico');
            $table->foreignUuid('cod_organizacao')->references('cod_organizacao')->on('tab_organizacoes');
            $table->foreignUuid('cod_tipo_execucao')->references('cod_tipo_execucao')->on('pei.tab_tipo_execucao');
            $table->smallInteger('num_nivel_hierarquico_apresentacao')->nullable(false);
            $table->text('dsc_plano_de_acao')->nullable(false);
            $table->text('txt_principais_entregas')->nullable(false);
            $table->decimal('vlr_orcamento_previsto',8, 2);
            $table->date('dte_inicio')->nullable(false);
            $table->date('dte_fim')->nullable(false);
            $table->string('status')->nullable(false);
            $table->softDeletes();
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
        Schema::dropIfExists('pei.tab_plano_de_acao');
    }
}
