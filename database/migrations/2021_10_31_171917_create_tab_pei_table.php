<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabPeiTable extends Migration
{

    public function up()
    {
        Schema::create('tab_pei', function (Blueprint $table) {
            $table->uuid('cod_pei')->primary();
            $table->string('dsc_pei')->nullable(false);
            $table->smallInteger('num_ano_inicio_pei')->nullable(false);
            $table->smallInteger('num_ano_fim_pei')->nullable(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tab_pei');
    }
}
