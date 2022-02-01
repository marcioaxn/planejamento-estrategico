<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Pei;
use App\Models\Organization;
use App\Models\RelOrganization;
use App\Models\MissaoVisaoValores;
use App\Models\Perspectiva;
use App\Models\PlanoAcao;
use App\Models\ObjetivoEstrategico;
use App\Models\GrauSatisfacao;
use Livewire\WithPagination;
use \Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

ini_set('memory_limit', '7096M');
ini_set('max_execution_time', 9900);
set_time_limit(900000000);

class ShowObjetivoEstrategicoLivewire extends Component
{

    use WithPagination;

    public $pei = [];
    public $cod_pei = null;
    public $perspectiva = [];
    public $cod_perspectiva = null;
    public $planosAcao = [];
    public $planoAcao = [];
    public $cod_plano_de_acao = null;

    public $hierarquiaUnidade = null;

    public function mount(SessionManager $session, Request $request, $ano,$cod_perspectiva = '',$cod_objetivo_estrategico = '',$cod_plano_de_acao = '')
    {
        $this->ano = $ano;

        if(isset($cod_perspectiva) && !is_null($cod_perspectiva) && $cod_perspectiva != '') {

            $this->cod_perspectiva = $cod_perspectiva;

        } else {

            $this->cod_perspectiva = null;

        }

        if(isset($cod_objetivo_estrategico) && !is_null($cod_objetivo_estrategico) && $cod_objetivo_estrategico != '') {

            $this->cod_objetivo_estrategico = $cod_objetivo_estrategico;

        } else {

            $this->cod_objetivo_estrategico = null;

        }

        if(isset($cod_plano_de_acao) && !is_null($cod_plano_de_acao) && $cod_plano_de_acao != '') {

            $this->cod_plano_de_acao = $cod_plano_de_acao;

        } else {

            $this->cod_plano_de_acao = null;

        }

        $session->put("ano", $this->ano);

    }

    public function render()
    {

        $perspectiva = Perspectiva::find($this->cod_perspectiva);

        $this->perspectiva = $perspectiva;

        $pei = Pei::find($perspectiva->cod_pei);

        $this->pei = $pei;

        $objetivoEstrategico = ObjetivoEstrategico::find($this->cod_objetivo_estrategico);

        $this->objetivoEstrategico = $objetivoEstrategico;

        $planosAcao = PlanoAcao::orderBy('num_nivel_hierarquico_apresentacao')
        ->where('cod_objetivo_estrategico',$this->cod_objetivo_estrategico)
        ->get();

        $this->planosAcao = $planosAcao;

        $planoAcao = PlanoAcao::orderBy('num_nivel_hierarquico_apresentacao')
        ->with('tipoExecucao','servidorResponsavel','servidorSubstituto','indicadores')
        ->where('cod_objetivo_estrategico',$this->cod_objetivo_estrategico);

        if(isset($this->cod_plano_de_acao) && !is_null($this->cod_plano_de_acao) && $this->cod_plano_de_acao != '') {

            $planoAcao = $planoAcao->find($this->cod_plano_de_acao);

        } else {

            $planoAcao = $planoAcao->first();

        }

        $this->planoAcao = $planoAcao;

        return view('livewire.show-objetivo-estrategico-livewire');
    }

    protected function hierarquiaUnidade($cod_organizacao) {

        $organizacao = Organization::with('hierarquia')
        ->where('cod_organizacao',$cod_organizacao)
        ->get();

        $hierarquiaSuperior = null;

        foreach($organizacao as $result1) {

            if($result1->hierarquia) {

                foreach($result1->hierarquia as $result2) {

                    $hierarquiaSuperior = $hierarquiaSuperior.'/'.$result2->sgl_organizacao;

                    $organizacao2 = Organization::with('hierarquia')
                    ->where('cod_organizacao',$result2->cod_organizacao)
                    ->get();

                    foreach($organizacao2 as $result3) {

                        if($result3->hierarquia) {

                            foreach($result3->hierarquia as $result4) {

                                $hierarquiaSuperior = $hierarquiaSuperior.'/'.$result4->sgl_organizacao;

                                $organizacao3 = Organization::with('hierarquia')
                                ->where('cod_organizacao',$result4->cod_organizacao)
                                ->get();

                                foreach($organizacao3 as $result5) {

                                    if($result5->hierarquia) {

                                        foreach($result5->hierarquia as $result6) {

                                            $hierarquiaSuperior = $hierarquiaSuperior.'/'.$result6->sgl_organizacao;

                                            $organizacao4 = Organization::with('hierarquia')
                                            ->where('cod_organizacao',$result6->cod_organizacao)
                                            ->get();

                                            foreach($organizacao4 as $result7) {

                                                if($result7->hierarquia) {

                                                    foreach($result7->hierarquia as $result8) {

                                                        $hierarquiaSuperior = $hierarquiaSuperior.'/'.$result8->sgl_organizacao;

                                                    }

                                                }

                                            }

                                        }

                                    }

                                }

                            }

                        }

                    }

                }

            }

        }

        return $hierarquiaSuperior;

    }
}
