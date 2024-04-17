<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTabPerfilAcessoTable extends Migration
{
    
    public function up()
    {
        Schema::create('tab_perfil_acesso', function (Blueprint $table) {
            $table->uuid('cod_perfil')->primary();
            $table->text('dsc_perfil')->nullable(false);
            $table->text('dsc_permissao')->nullable(false);
            $table->timestamps();
            $table->softDeletes();
        });

        DB::select("INSERT INTO tab_perfil_acesso (cod_perfil, dsc_perfil, dsc_permissao, deleted_at, created_at, updated_at) VALUES ('c00b9ebc-7014-4d37-97dc-7875e55fff2a', 'Super Administrador', 'Servidor(a) com todos os privilégios de administração do sistema', NULL, '2021-11-14 23:21:21', '2021-11-14 23:21:21');");

        DB::select("INSERT INTO tab_perfil_acesso (cod_perfil, dsc_perfil, dsc_permissao, deleted_at, created_at, updated_at) VALUES ('c00b9ebc-7014-4d37-97dc-7875e55fff3b', 'Administrador da Unidade', 'Servidor(a) com todos os privilégios de administração do sistema somente dentro da Unidade que está cadastrado', NULL, '2021-11-14 23:21:21', '2021-11-14 23:21:21');");

        DB::select("INSERT INTO tab_perfil_acesso (cod_perfil, dsc_perfil, dsc_permissao, deleted_at, created_at, updated_at) VALUES ('c00b9ebc-7014-4d37-97dc-7875e55fff4c', 'Gestor(a) Responsável', 'Servidor(a) que tem como responsabilidade manter a atualização do Plano de Ação ao qual está como responsável', NULL, '2021-11-14 23:21:21', '2021-11-14 23:21:21');");

        DB::select("INSERT INTO tab_perfil_acesso (cod_perfil, dsc_perfil, dsc_permissao, deleted_at, created_at, updated_at) VALUES ('c00b9ebc-7014-4d37-97dc-7875e55fff5d', 'Gestor(a) Substituto(a)', 'Servidor(a) que tem como responsabilidade manter a atualização do Plano de Ação ao qual está como substituto(a)', NULL, '2021-11-14 23:21:21', '2021-11-14 23:21:21');");

    }

    public function down()
    {
        Schema::dropIfExists('tab_perfil_acesso');
    }
}
