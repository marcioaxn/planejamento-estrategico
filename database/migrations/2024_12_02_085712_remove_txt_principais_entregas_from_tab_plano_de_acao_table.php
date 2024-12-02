<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveTxtPrincipaisEntregasFromTabPlanoDeAcaoTable extends Migration
{
    public function up()
    {
        Schema::table('pei.tab_plano_de_acao', function (Blueprint $table) {
            $table->dropColumn('txt_principais_entregas');
        });
    }

    public function down()
    {
        Schema::table('pei.tab_plano_de_acao', function (Blueprint $table) {
            $table->text('txt_principais_entregas')->nullable();
        });
    }
}
