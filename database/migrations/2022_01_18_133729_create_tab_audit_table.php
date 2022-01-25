<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabAuditTable extends Migration
{

    public function up()
    {
        Schema::create('tab_audit', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('acao')->nullable(false);
            $table->text('antes')->nullable(true);
            $table->text('depois')->nullable(true);
            $table->string('table')->nullable(false);
            $table->string('column_name')->nullable(false);
            $table->string('data_type')->nullable(false);
            $table->string('table_id')->nullable(false);
            $table->string('ip')->nullable(false);
            $table->foreignUuid('user_id')->references('id')->on('users');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tab_audit');
    }
}
