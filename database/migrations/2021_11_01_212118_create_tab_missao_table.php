<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabMissaoTable extends Migration
{
    public function up()
    {
        Schema::create('pei.tab_missao_visao_valores', function (Blueprint $table) {
            $table->uuid('cod_missao_visao_valores')->primary();
            $table->text('dsc_missao')->nullable(false);
            $table->text('dsc_visao')->nullable(false);
            $table->text('dsc_valores')->nullable(false);
            $table->foreignUuid('cod_pei')->references('cod_pei')->on('pei.tab_pei');
            $table->foreignUuid('cod_organizacao')->references('cod_organizacao')->on('tab_organizacoes');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pei.tab_missao_visao_valores');
    }
}
