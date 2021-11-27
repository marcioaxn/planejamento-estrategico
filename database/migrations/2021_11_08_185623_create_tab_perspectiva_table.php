<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabPerspectivaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pei.tab_perspectiva', function (Blueprint $table) {
            $table->uuid('cod_perspectiva')->primary();
            $table->text('dsc_perspectiva')->nullable(false);
            $table->smallInteger('num_nivel_hierarquico_apresentacao')->nullable(false);
            $table->foreignUuid('cod_pei')->references('cod_pei')->on('pei.tab_pei');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pei.tab_perspectiva');
    }
}
