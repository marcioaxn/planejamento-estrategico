<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UpdateUserTypeToVarcharOnAuditsTable extends Migration
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

        // Alterando o tipo da coluna user_type para character varying(255)
        DB::connection($connection)->statement("
            ALTER TABLE {$table}
            ALTER COLUMN user_type TYPE character varying(255)
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

        // Revertendo para UUID
        DB::connection($connection)->statement("
            ALTER TABLE {$table}
            ALTER COLUMN user_type TYPE uuid USING user_type::uuid
        ");
    }
}
