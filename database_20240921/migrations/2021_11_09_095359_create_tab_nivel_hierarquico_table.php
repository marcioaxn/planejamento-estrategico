<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTabNivelHierarquicoTable extends Migration
{
    public function up()
    {
        Schema::create('pei.tab_nivel_hierarquico', function (Blueprint $table) {
            $table->smallInteger('num_nivel_hierarquico_apresentacao')->primary();
            $table->timestamps();
            $table->softDeletes();
        });

        for($cont=1;$cont<=100;$cont++) {

            DB::select("INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES ($cont, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');");

        }
    }

    public function down()
    {
        Schema::dropIfExists('pei.tab_nivel_hierarquico');
    }
}
