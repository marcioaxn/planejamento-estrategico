<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class UpdateUserIdToUuidOnAuditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $connection = config('audit.drivers.database.connection', config('database.default'));
        $table = config('audit.drivers.database.table', 'audits');

        // Alterando o tipo de coluna user_id para UUID
        DB::connection($connection)->statement("
            ALTER TABLE {$table}
            ALTER COLUMN user_id TYPE UUID USING user_id::text::UUID
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $connection = config('audit.drivers.database.connection', config('database.default'));
        $table = config('audit.drivers.database.table', 'audits');

        // Revertendo para BIGINT
        DB::connection($connection)->statement("
            ALTER TABLE {$table}
            ALTER COLUMN user_id TYPE BIGINT USING user_id::text::BIGINT
        ");
    }
}
