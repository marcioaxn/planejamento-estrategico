<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\PlanejamentoEstrategicoIntegrado;
use Livewire\WithPagination;
use App\Models\Acoes;
use DB;
Use Auth;

ini_set('memory_limit', '7096M');
ini_set('max_execution_time', 9900);
set_time_limit(900000000);

class PlanejamentoEstrategicoIntegrado extends Component
{

    public $dsc_pei = null;
    public $num_ano_inicio_pei = null;
    public $num_ano_fim_pei = null;

    public function render()
    {

        $estruturaTable = $this->estruturaTable();

        $pei = PlanejamentoEstrategicoIntegrado::orderBy('num_ano_inicio_pei','desc')
        ->get();

        return view('livewire.planejamento-estrategico-integrado');
    }

    protected function estruturaTable() {

        $estrutura = DB::select("SELECT
            column_name,ordinal_position,is_nullable,data_type
            FROM
            information_schema.columns
            WHERE
            table_schema = 'public'
            AND table_name = 'tab_pei' 
            AND column_name NOT IN ('cod_pei','created_at','updated_at','deleted_at');");

        return $estrutura;

    }
}
