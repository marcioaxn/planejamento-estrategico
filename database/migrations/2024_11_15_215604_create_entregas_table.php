<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntregasTable extends Migration
{
    public function up()
    {
        Schema::create('entregas', function (Blueprint $table) {
            // Chave Primária UUID
            $table->uuid('cod_entrega')->primary();

            // Relacionamentos com Planos de Ação e Objetivos Estratégicos
            $table->foreignUuid('cod_plano_de_acao')
                ->nullable()
                ->references('cod_plano_de_acao')
                ->on('pei.tab_plano_de_acao')
                ->onDelete('cascade');

            $table->foreignUuid('cod_objetivo_estrategico')
                ->nullable()
                ->references('cod_objetivo_estrategico')
                ->on('pei.tab_objetivo_estrategico')
                ->onDelete('cascade');

            // Campos para a entrega
            $table->string('dsc_entrega');  // Descrição da entrega
            $table->decimal('prc_entrega', 5, 2)->default(0);  // Percentual de conclusão

            // Timestamps e SoftDeletes
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('entregas');
    }
}
