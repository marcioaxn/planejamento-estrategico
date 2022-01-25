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
            $table->string('table_id')->nullable(false);
            $table->foreignUuid('user_id')->references('id')->on('users');
            $table->string('table')->nullable(false);
            $table->text('acao')->nullable(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('acoes');
    }
}
