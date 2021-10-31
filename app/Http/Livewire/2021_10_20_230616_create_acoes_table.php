<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tab_organizacoes', function (Blueprint $table) {
            $table->uuid('cod_organizacao')->primary();
            $table->string('sgl_organizacao')->nullable(false);
            $table->string('nom_organizacao')->nullable(false);
            $table->uuid('cod_organizacao_child')->nullable(true);
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
        Schema::dropIfExists('tab_organizacoes');
    }
}
