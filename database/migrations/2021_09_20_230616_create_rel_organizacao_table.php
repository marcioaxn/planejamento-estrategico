<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelOrganizacaoTable extends Migration
{

    public function up()
    {
        Schema::create('rel_organizacao', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('cod_organizacao')->references('cod_organizacao')->on('tab_organizacoes');
            $table->foreignUuid('rel_cod_organizacao')->references('cod_organizacao')->on('tab_organizacoes');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rel_organizacao');
    }
}
