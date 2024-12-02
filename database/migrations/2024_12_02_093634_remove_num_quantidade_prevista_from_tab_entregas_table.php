<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveNumQuantidadePrevistaFromTabEntregasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pei.tab_entregas', function (Blueprint $table) {
            $table->dropColumn('num_quantidade_prevista');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pei.tab_entregas', function (Blueprint $table) {
            $table->text('num_quantidade_prevista')->nullable();
        });
    }
}
