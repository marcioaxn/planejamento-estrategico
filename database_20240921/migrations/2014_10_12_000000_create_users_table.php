<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateUsersTable extends Migration
{

    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('cpf', 11)->nullable()->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->smallInteger('ativo')->default(1);
            $table->smallInteger('adm')->default(2);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->smallInteger('trocarsenha')->default(1);
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
        });

        // DB::select("INSERT INTO users (id, name, email, ativo, adm, password, trocarsenha, created_at, updated_at) VALUES ('1b9839fd-464e-45cd-8700-0b964a92e358', 'Administrador', 'adm@adm.gov.br', 1, 1, '$2y$10$.DECeyGFcxARoKLI6cqkAuUfTE09lnLa6Ku21ERohMBbkneaxnA6y', 0, '2021-10-21 13:20:45', '2021-10-21 13:20:45'););");
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
