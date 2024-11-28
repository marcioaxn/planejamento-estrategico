<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateAuditableIdToUuidOnAuditsTable extends Migration
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

        // Usando comando SQL para alterar o tipo com a cláusula USING
        DB::connection($connection)->statement("
            ALTER TABLE {$table}
            ALTER COLUMN auditable_id TYPE UUID USING auditable_id::text::UUID
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

        // Reverter o tipo para BIGINT
        DB::connection($connection)->statement("
            ALTER TABLE {$table}
            ALTER COLUMN auditable_id TYPE BIGINT USING auditable_id::text::BIGINT
        ");
    }
}
