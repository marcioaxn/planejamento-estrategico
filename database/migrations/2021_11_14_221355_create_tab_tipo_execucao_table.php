<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabTipoExecucaoTable extends Migration
{
    
    public function up()
    {
        Schema::create('pei.tab_tipo_execucao', function (Blueprint $table) {
            $table->uuid('cod_tipo_execucao')->primary();
            $table->string('dsc_tipo_execucao')->nullable(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pei.tab_tipo_execucao');
    }
}
