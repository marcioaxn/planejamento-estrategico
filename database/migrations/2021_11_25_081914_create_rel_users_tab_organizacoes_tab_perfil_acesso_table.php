<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateRelUsersTabOrganizacoesTabPerfilAcessoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rel_users_tab_organizacoes_tab_perfil_acesso', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->references('id')->on('users');
            $table->foreignUuid('cod_organizacao')->references('cod_organizacao')->on('tab_organizacoes');
            $table->foreignUuid('cod_plano_de_acao')->references('cod_plano_de_acao')->on('pei.tab_plano_de_acao');
            $table->foreignUuid('cod_perfil')->references('cod_perfil')->on('tab_perfil_acesso');
            $table->timestamps();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rel_users_tab_organizacoes_tab_perfil_acesso');
    }
}
