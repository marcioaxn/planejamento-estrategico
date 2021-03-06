<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
