<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabObjetivoEstrategicoTable extends Migration
{

    public function up()
    {
        Schema::create('pei.tab_objetivo_estrategico', function (Blueprint $table) {
            $table->uuid('cod_objetivo_estrategico')->primary();
            $table->text('nom_objetivo_estrategico')->nullable(false);
            $table->text('dsc_objetivo_estrategico')->nullable(false);
            $table->smallInteger('num_nivel_hierarquico_apresentacao')->nullable(false);
            $table->foreignUuid('cod_perspectiva')->references('cod_perspectiva')->on('pei.tab_perspectiva');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pei.tab_objetivo_estrategico');
    }
}
