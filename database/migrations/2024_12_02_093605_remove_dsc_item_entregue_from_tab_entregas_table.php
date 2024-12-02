<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveDscItemEntregueFromTabEntregasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pei.tab_entregas', function (Blueprint $table) {
            $table->dropColumn('dsc_item_entregue');
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
            $table->text('dsc_item_entregue')->nullable();
        });
    }
}
