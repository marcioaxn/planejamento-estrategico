<?php

namespace App\Http\Livewire;

use \Illuminate\Session\SessionManager;
use Illuminate\Http\Request;
use App\Models\Pei;
use App\Models\Organization;
use App\Models\RelOrganization;
use App\Models\MissaoVisao;
use App\Models\Perspectiva;
use App\Models\PlanoAcao;
use App\Models\ObjetivoEstrategico;
use App\Models\GrauSatisfacao;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use App\Http\Livewire\CalculoLivewire;
use App\Models\Valores;
use Livewire\Component;

ini_set('memory_limit', '7096M');
ini_set('max_execution_time', 9900);
set_time_limit(900000000);

class RelatorioLivewire extends Component
{

    use WithPagination;

    public $periodo = null;
    public $ano = null;
    public $mes = null;

    public $grau_satisfacao = null;

    public $calcularAcumuladoIndicadoresObjetivoEstrategico;

    public $calcularAcumuladoObjetivoEstrategico;

    public $calculoPorArea = null;

    public $existePei = false;
    public $pei = null;
    public $cod_pei = null;
    public $organization = null;
    public $cod_organizacao = null;
    public $cod_organizacao_select = null;
    public $MissaoVisao = null;

    public $valores = null;

    public $perspectivas = null;
    public $cod_perspectiva = null;
    public $objetivoEstragico = null;
    public $cod_objetivo_estrategico = null;

    public $anoSelecionado = null;

    public $nom_organizacao = null;
    public $hierarquiaUnidade = null;

    public function mount(SessionManager $session, Request $request, $periodo, $ano, $mes = null)
    {

        $this->periodo = $periodo;

        $this->ano = $ano;

        $this->mes = $mes;
    }

    public function render()
    {

        if (isset($this->ano) && !is_null($this->ano) && $this->ano != '' && is_numeric($this->ano)) {

            $this->ano = $this->ano;
        } else {

            $this->ano = date('Y');
        }

        /** 1º passo encontrar o PEI relativo ao ano da consulta */

        $this->pei = Pei::where('num_ano_inicio_pei', '<=', $this->ano)
            ->where('num_ano_fim_pei', '>=', $this->ano)
            ->first();

        /** 2º passo encontrar as perspectivas relacionadas ao PEI encontrato */

        $this->perspectivas = Perspectiva::where('cod_pei', $this->pei->cod_pei)
            ->with('objetivosEstrategicos', 'objetivosEstrategicos.indicadores', 'objetivosEstrategicos.planosDeAcao')
            ->orderBy('num_nivel_hierarquico_apresentacao', 'desc')
            ->get();

        return view('livewire.relatorio-livewire');
    }
}
