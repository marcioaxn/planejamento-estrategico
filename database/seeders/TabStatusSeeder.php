<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TabStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Inserir 6 registros na tabela tab_status
        DB::table('tab_status')->insert([
            [
                'cod_status' => Str::uuid(),
                'dsc_status' => 'Cancelado',
            ],
            [
                'cod_status' => Str::uuid(),
                'dsc_status' => 'Concluído',
            ],
            [
                'cod_status' => Str::uuid(),
                'dsc_status' => 'Em andamento',
            ],
            [
                'cod_status' => Str::uuid(),
                'dsc_status' => 'Iniciado',
            ],
            [
                'cod_status' => Str::uuid(),
                'dsc_status' => 'Não iniciado',
            ],
            [
                'cod_status' => Str::uuid(),
                'dsc_status' => 'Suspenso',
            ],
        ]);
    }
}
