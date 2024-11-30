<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabEntregasTable extends Migration
{
    public function up()
    {
        Schema::create('tab_entregas', function (Blueprint $table) {
            // Chave Primária UUID
            $table->uuid('cod_entrega')->primary();

            // Relacionamentos com Planos de Ação e Objetivos Estratégicos
            $table->foreignUuid('cod_plano_de_acao')
                ->nullable()
                ->references('cod_plano_de_acao')
                ->on('pei.tab_plano_de_acao')
                ->onDelete('cascade');

            // Campos para a entrega
            $table->text('dsc_entrega');  // Descrição da entrega
            $table->string('bln_status')->nullable(false);
            $table->string('dsc_periodo_medicao')->nullable(false);

            // Timestamps e SoftDeletes
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tab_entregas');
    }
}
