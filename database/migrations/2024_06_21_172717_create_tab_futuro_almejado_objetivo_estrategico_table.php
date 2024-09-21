<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabFuturoAlmejadoObjetivoEstrategicoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pei.tab_futuro_almejado_objetivo_estrategico', function (Blueprint $table) {
            $table->uuid('cod_futuro_almejado')->primary();
            $table->text('dsc_futuro_almejado')->nullable(false);
            $table->foreignUuid('cod_objetivo_estrategico')->references('cod_objetivo_estrategico')->on('pei.tab_objetivo_estrategico');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pei.tab_futuro_almejado_objetivo_estrategico');
    }
}
