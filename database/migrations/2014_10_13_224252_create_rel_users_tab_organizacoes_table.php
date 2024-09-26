<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelUsersTabOrganizacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rel_users_tab_organizacoes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->references('id')->on('users');
            $table->foreignUuid('cod_organizacao')->references('cod_organizacao')->on('tab_organizacoes');
            $table->foreignUuid('cod_perfil')->references('cod_perfil')->on('tab_perfil_acesso');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::insert(
            "INSERT INTO rel_users_tab_organizacoes (id, user_id, cod_organizacao, cod_perfil, created_at, updated_at) 
                VALUES (?, ?, ?, ?, ?, ?)",
            [
                'cfea2bdd-89c5-458f-b5fb-f4956f3280c0',
                '1b9839fd-464e-45cd-8700-0b964a92e358',
                '3834910f-66f7-46d8-9104-2904d59e1241',
                'c00b9ebc-7014-4d37-97dc-7875e55fff2a',
                '2021-12-03 23:03:33',
                '2021-12-03 23:03:33'
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rel_users_tab_organizacoes');
    }
}
