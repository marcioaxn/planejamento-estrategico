<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabLinhaBaseIndicadorTable extends Migration
{
    
    public function up()
    {
        Schema::create('pei.tab_linha_base_indicador', function (Blueprint $table) {
            $table->uuid('cod_linha_base')->primary();
            $table->foreignUuid('cod_indicador')->references('cod_indicador')->on('pei.tab_indicador');
            $table->decimal('num_linha_base', $precision = 1000, $scale = 2);
            $table->smallInteger('num_ano')->nullable(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pei.tab_linha_base_indicador');
    }
}
