<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabArquivosTable extends Migration
{
    
    public function up()
    {
        Schema::create('pei.tab_arquivos', function (Blueprint $table) {
            $table->uuid('cod_arquivo')->primary();
            $table->foreignUuid('cod_evolucao_indicador')->references('cod_evolucao_indicador')->on('pei.tab_evolucao_indicador');
            $table->text('txt_assunto')->nullable(false);
            $table->text('data')->nullable(false);
            $table->text('dsc_nome_arquivo')->nullable(false);
            $table->string('dsc_tipo')->nullable(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pei.tab_arquivos');
    }
}
