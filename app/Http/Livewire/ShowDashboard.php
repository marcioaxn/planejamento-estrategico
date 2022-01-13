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
use Livewire\WithPagination;
use \Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

ini_set('memory_limit', '7096M');
ini_set('max_execution_time', 9900);
set_time_limit(900000000);

class ShowDashboard extends Component
{

    use WithPagination;

    public $existePei = false;
    public $pei = null;
    public $cod_pei = null;
    public $organization = null;
    public $cod_organizacao = null;
    public $cod_organizacao_select = null;
    public $missaoVisaoValores = null;
    public $perspectiva = null;
    public $cod_perspectiva = null;
    public $objetivoEstragico = null;
    public $cod_objetivo_estrategico = null;

    public $nom_organizacao = null;
    public $hierarquiaUnidade = null;

    public $ano = null;

    public $detalharObjetivoEstrategico = null;

    public function mount(SessionManager $session, Request $request, $ano,$cod_organizacao = '')
    {
        $this->ano = $ano;

        if(isset($cod_organizacao) && !is_null($cod_organizacao) && $cod_organizacao != '') {

            $this->cod_organizacao = $cod_organizacao;

        } else {

            $this->cod_organizacao = null;

        }

        $session->put("ano", $this->ano);

    }

    public function detalharObjetivoEstrategico(ObjetivoEstrategico $objetivoEstragico) {

        dd($objetivoEstragico);

    }

    public function render($ano = '',$cod_organizacao = '')
    {

        $ano = $this->ano;

        $cod_organizacao = $this->cod_organizacao;

        $this->pei = Pei::where('num_ano_inicio_pei','<=',$ano)
        ->where('num_ano_fim_pei','>=',$ano)
        ->first();

        $nom_organizacao = $this->nom_organizacao;

        if(isset($cod_organizacao) && !is_null($cod_organizacao) && $cod_organizacao != '') {

            // $this->cod_organizacao = $cod_organizacao;

        } else {

            $consultarOrganizacaoDeVisualizacao = Organization::select('cod_organizacao')
            ->whereColumn('cod_organizacao', 'rel_cod_organizacao')
            ->first();

            $this->cod_organizacao = $consultarOrganizacaoDeVisualizacao->cod_organizacao;

        }

        $organizacoes = [];

        $organization = Organization::whereRaw('cod_organizacao = rel_cod_organizacao')
        ->get();

        $organizationChild = Organization::whereRaw('cod_organizacao != rel_cod_organizacao')
        ->orderBy('nom_organizacao')
        ->get();

        foreach ($organization as $result) {

            $organizacoes[$result->cod_organizacao] = $result->sgl_organizacao.' - '.$result->nom_organizacao.$this->hierarquiaUnidade($result->cod_organizacao);

            foreach($organizationChild as $resultChild1) {

                if($result->cod_organizacao == $resultChild1->rel_cod_organizacao) {

                    $organizacoes[$resultChild1->cod_organizacao] = $resultChild1->sgl_organizacao.' - '.$resultChild1->nom_organizacao.$this->hierarquiaUnidade($resultChild1->cod_organizacao);

                    foreach ($resultChild1->deshierarquia as $resultChild2) {

                        if($resultChild1->cod_organizacao == $resultChild2->rel_cod_organizacao) {

                            $organizacoes[$resultChild2->cod_organizacao] = $resultChild2->sgl_organizacao.' - '.$resultChild2->nom_organizacao.$this->hierarquiaUnidade($resultChild2->cod_organizacao);

                            foreach ($resultChild2->deshierarquia as $resultChild3) {

                                if($resultChild2->cod_organizacao == $resultChild3->rel_cod_organizacao) {

                                    $organizacoes[$resultChild3->cod_organizacao] = $resultChild3->sgl_organizacao.' - '.$resultChild3->nom_organizacao.$this->hierarquiaUnidade($resultChild3->cod_organizacao);

                                    foreach ($resultChild3->deshierarquia as $resultChild4) {

                                        if($resultChild3->cod_organizacao == $resultChild4->rel_cod_organizacao) {

                                            $organizacoes[$resultChild4->cod_organizacao] = $resultChild4->sgl_organizacao.' - '.$resultChild4->nom_organizacao.$this->hierarquiaUnidade($resultChild4->cod_organizacao);

                                            foreach ($resultChild4->deshierarquia as $resultChild5) {

                                                if($resultChild4->cod_organizacao == $resultChild5->rel_cod_organizacao) {

                                                    $organizacoes[$resultChild5->cod_organizacao] = $resultChild5->sgl_organizacao.' - '.$resultChild5->nom_organizacao.$this->hierarquiaUnidade($resultChild5->cod_organizacao);

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

        $this->organization = $organizacoes;

        if($this->pei) {

            $this->existePei = true;

            $missaoVisaoValores = MissaoVisaoValores::where('cod_pei',$this->pei->cod_pei);

            if(isset($this->cod_organizacao) && !is_null($this->cod_organizacao) && $this->cod_organizacao != '') {

                $missaoVisaoValores = $missaoVisaoValores->where('cod_organizacao',$this->cod_organizacao);

            }

            $this->missaoVisaoValores = $missaoVisaoValores->first();

            $this->perspectiva = Perspectiva::where('cod_pei',$this->pei->cod_pei)
            ->with('objetivosEstrategicos')
            ->orderBy('num_nivel_hierarquico_apresentacao','desc')
            ->get();

            return view('livewire.show-dashboard',['ano' => $ano,'cod_organizacao' => $this->cod_organizacao]);

        } else {

            $this->existePei = false;

            return view('livewire.show-dashboard',['ano' => $ano,'cod_organizacao' => $this->cod_organizacao]);

        }
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
