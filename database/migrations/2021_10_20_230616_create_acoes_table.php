<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcoesTable extends Migration
{
    public function up()
    {
        Schema::create('acoes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('id_table')->nullable(false);
            $table->uuid('id_user')->nullable(false);
            $table->string('table')->nullable(false);
            $table->string('acao')->nullable(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('acoes');
    }
}
