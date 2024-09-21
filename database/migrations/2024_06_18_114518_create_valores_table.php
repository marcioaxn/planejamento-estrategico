<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValoresTable extends Migration
{
    public function up()
    {
        Schema::create('pei.tab_valores', function (Blueprint $table) {
            $table->uuid('cod_valor')->primary();
            $table->text('nom_valor')->nullable(false);
            $table->text('dsc_valor')->nullable(false);
            $table->foreignUuid('cod_pei')->references('cod_pei')->on('pei.tab_pei');
            $table->foreignUuid('cod_organizacao')->references('cod_organizacao')->on('tab_organizacoes');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pei.tab_valores');
    }
}
