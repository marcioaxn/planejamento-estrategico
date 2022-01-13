<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateOrganizacaosTable extends Migration
{
    
    public function up()
    {
        Schema::create('tab_organizacoes', function (Blueprint $table) {
            $table->uuid('cod_organizacao')->primary();
            $table->string('sgl_organizacao')->nullable(false);
            $table->text('nom_organizacao')->nullable(false);
            $table->uuid('rel_cod_organizacao')->nullable(true);
            $table->softDeletes();
            $table->timestamps();
        });

        DB::select("INSERT INTO public.tab_organizacoes (cod_organizacao, sgl_organizacao, nom_organizacao, rel_cod_organizacao, deleted_at, created_at, updated_at) VALUES ('3834910f-66f7-46d8-9104-2904d59e1241', 'MDR', 'Ministério do Desenvolvimento Regional', '3834910f-66f7-46d8-9104-2904d59e1241', NULL, '2021-10-21 10:38:09', '2021-10-21 13:20:45');");
    }

    public function down()
    {
        Schema::dropIfExists('tab_organizacoes');
    }
}
