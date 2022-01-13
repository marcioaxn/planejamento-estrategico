<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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

        DB::select("INSERT INTO pei.tab_tipo_execucao (cod_tipo_execucao, dsc_tipo_execucao, deleted_at, created_at, updated_at) VALUES ('c00b9ebc-7014-4d37-97dc-7875e55fff1b', 'Ação', NULL, '2021-11-14 23:21:21', '2021-11-14 23:21:21');");

        DB::select("INSERT INTO pei.tab_tipo_execucao (cod_tipo_execucao, dsc_tipo_execucao, deleted_at, created_at, updated_at) VALUES ('ecef6a50-c010-4cda-afc3-cbda245b55b0', 'Iniciativa', NULL, '2021-11-14 23:21:21', '2021-11-14 23:21:21');");

        DB::select("INSERT INTO pei.tab_tipo_execucao (cod_tipo_execucao, dsc_tipo_execucao, deleted_at, created_at, updated_at) VALUES ('57518c30-3bc5-4305-a998-8ce8b11550ed', 'Projeto', NULL, '2021-11-14 23:21:21', '2021-11-14 23:21:21');");

    }

    public function down()
    {
        Schema::dropIfExists('pei.tab_tipo_execucao');
    }
}
