<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabMetaPorAnoTable extends Migration
{

    public function up()
    {
        Schema::create('pei.tab_meta_por_ano', function (Blueprint $table) {
            $table->uuid('cod_meta_por_ano')->primary();
            $table->foreignUuid('cod_indicador')->references('cod_indicador')->on('pei.tab_indicador');
            $table->smallInteger('num_ano')->nullable(false);
            $table->decimal('meta', $precision = 1000, $scale = 2)->nullable(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pei.tab_meta_por_ano');
    }
}
