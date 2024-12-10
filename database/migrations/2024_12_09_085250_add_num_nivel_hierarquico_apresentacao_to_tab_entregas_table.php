<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNumNivelHierarquicoApresentacaoToTabEntregasTable extends Migration
{
    public function up()
    {
        Schema::table('pei.tab_entregas', function (Blueprint $table) {
            $table->smallInteger('num_nivel_hierarquico_apresentacao')->notNullable();
        });
    }

    public function down()
    {
        Schema::table('pei.tab_entregas', function (Blueprint $table) {
            $table->dropColumn('num_nivel_hierarquico_apresentacao');
        });
    }
}
