<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabGrauSatisfcaoTable extends Migration
{
    
    public function up()
    {
        Schema::create('pei.tab_grau_satisfcao', function (Blueprint $table) {
            $table->uuid('cod_grau_satisfcao')->primary();
            $table->text('dsc_grau_satisfcao')->nullable(false);
            $table->string('cor')->nullable(false);
            $table->decimal('vlr_minimo', $precision = 1000, $scale = 2)->nullable(false);
            $table->decimal('vlr_maximo', $precision = 1000, $scale = 2)->nullable(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pei.tab_grau_satisfcao');
    }
}
