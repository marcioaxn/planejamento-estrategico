<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Pei;
use App\Models\Perspectiva;
use App\Models\PlanoAcao;
use App\Models\ObjetivoEstrategico;
use App\Models\NumNivelHierarquico;
use App\Models\TipoExecucao;
use App\Models\Organization;
use App\Models\Acoes;
use DB;
Use Auth;
use Illuminate\Support\Str;

class PlanoAcaoLivewire extends Component
{

    public $planoAcao = null;
    public $cod_plano_de_acao = null;
    public $cod_objetivo_estrategico = null;
    public $cod_tipo_execucao = null;
    public $cod_organizacao = null;
    public $num_nivel_hierarquico_apresentacao = null;
    public $dsc_plano_de_acao = null;
    public $periodicidade_medicao = null;
    public $txt_principais_entregas = null;
    public $vlr_orcamento_previsto = null;
    public $dte_inicio = null;
    public $dte_fim = null;
    public $status = null;

    public $pei = null;
    public $cod_pei = null;
    public $perspectiva = null;
    public $cod_perspectiva = null;
    public $objetivoEstragico = null;
    public $tipoExecucao = null;


    public $estruturaTable = null;
    
    public $editarForm = false;
    public $deleteForm = false;
    public $showModalResultadoEdicao = false;
    public $mensagemResultadoEdicao = null;
    public $showModalDelete = false;
    public $mensagemDelete = null;

    public $abrirFecharForm = 'none';
    public $iconAbrirFechar = 'fas fa-plus text-xs';
    public $iconFechar = 'fas fa-minus text-xs';

    protected function pesquisarCodigo($cod_objetivo_estrategico = '') {

        $this->num_nivel_hierarquico_apresentacao = '';

        if(isset($cod_objetivo_estrategico) && !is_null($cod_objetivo_estrategico) && $cod_objetivo_estrategico != '') {

            $planoAcao = PlanoAcao::select('num_nivel_hierarquico_apresentacao')
            ->where('cod_objetivo_estrategico',$cod_objetivo_estrategico)
            ->orderBy('num_nivel_hierarquico_apresentacao','desc')
            ->first();

            if($planoAcao) {

                $this->num_nivel_hierarquico_apresentacao = (($planoAcao->num_nivel_hierarquico_apresentacao) + 1);

            } else {

                $this->num_nivel_hierarquico_apresentacao = 1;

            }

        }

        return $this->num_nivel_hierarquico_apresentacao;

    }

    public function abrirFecharForm() {

        if($this->abrirFecharForm === 'none') {

            $this->cod_perspectiva = null;
            $this->cod_pei = null;
            $this->dsc_perspectiva = null;
            $this->num_nivel_hierarquico_apresentacao = null;
            $this->editarForm = false;

            $this->abrirFecharForm = 'block';
            $this->iconAbrirFechar = 'fas fa-minus text-xs';

        } else {

            $this->cod_perspectiva = null;
            $this->cod_pei = null;
            $this->dsc_perspectiva = null;
            $this->num_nivel_hierarquico_apresentacao = null;
            $this->editarForm = false;

            $this->abrirFecharForm = 'none';
            $this->iconAbrirFechar = 'fas fa-plus text-xs';

        }

    }

    public function create() {

        // Necessário incluir a parte de validação

        $modificacoes = '';
        $alteracao = array();

        if(!$this->editarForm) {

            $modificacoes = "Inseriu os seguintes dados em relação a Missão, Visão e Valores:<br><br>";

            $save = new MissaoVisaoValores;

            $save->cod_pei = $this->cod_pei;

            $consultarPei = Pei::find($this->cod_pei);

            if(isset($this->dsc_missao) && !is_null($this->dsc_missao) && $this->dsc_missao != '') {

                $save->dsc_missao = $this->dsc_missao;

                $modificacoes = $modificacoes . "Missão: <span class='text-green-800'>".$this->dsc_missao."</span><br>";

            }

            if(isset($this->dsc_visao) && !is_null($this->dsc_visao) && $this->dsc_visao != '') {

                $save->dsc_visao = $this->dsc_visao;

                $modificacoes = $modificacoes . "Visão: <span class='text-green-800'>".$this->dsc_visao."</span><br>";

            }

            if(isset($this->dsc_valores) && !is_null($this->dsc_valores) && $this->dsc_valores != '') {

                $save->dsc_valores = $this->dsc_valores;

                $modificacoes = $modificacoes . "Valores: <span class='text-green-800'>".$this->dsc_valores."</span><br>";

            }

            $modificacoes = $modificacoes . "PEI: <span class='text-green-800'>".$consultarPei->dsc_pei."</span><br>";

            $save->cod_organizacao = $this->cod_organizacao;

            $consultarOrganizacao = Organization::find($this->cod_organizacao);

            $modificacoes = $modificacoes . "Unidade: <span class='text-green-800'>".$consultarOrganizacao->sgl_organizacao." - ".$consultarOrganizacao->nom_organizacao."</span><br><br>";

            $save->save();

            $acao = Acoes::create(array(
                'table' => 'tab_pei',
                'id_table' => $save->cod_missao_visao_valores,
                'id_user' => Auth::user()->id,
                'acao' => $modificacoes
            ));

            $this->showModalResultadoEdicao = true;

            $this->mensagemResultadoEdicao = $modificacoes;

        } else {

            $editar = MissaoVisaoValores::find($this->cod_missao_visao_valores);

            $estruturaTable = $this->estruturaTableParaEditar();

            foreach($estruturaTable as $result) {

                $column_name = $result->column_name;

                if($editar->$column_name != $this->$column_name) {

                    $alteracao[$column_name] = $this->$column_name;

                    if($column_name != 'cod_pei' && $column_name != 'cod_organizacao') {

                        $modificacoes = $modificacoes.'Alterou o(a) <b>'.nomeCampoTabelaNormalizado($column_name).'</b> de <span style="color:#CD3333;">( '.$editar->$column_name.' )</span> para <span style="color:#28a745;">( '.$this->$column_name.' )</span>;<br>';

                    } elseif($column_name == 'cod_pei' || $column_name == 'cod_organizacao') {

                        if($column_name == 'cod_pei') {

                            $consultarAntigo = Pei::find($editar->cod_pei);

                            $consultarNovo = Pei::find($this->$column_name);

                            $modificacoes = $modificacoes.'Alterou o(a) <b>Planejamento Estratégico Integrado - PEI</b> de <span style="color:#CD3333;">( '.$consultarAntigo->dsc_pei.' )</span> para <span style="color:#28a745;">( '.$consultarNovo->dsc_pei.' )</span>;<br>';

                        }

                        if($column_name == 'cod_organizacao') {

                            $consultarAntigo = Organization::find($editar->cod_organizacao);

                            $consultarNovo = Organization::find($this->$column_name);

                            $modificacoes = $modificacoes.'Alterou o(a) <b>A unidade</b> de <span style="color:#CD3333;">( '.$consultarAntigo->nom_organizacao.' )</span> para <span style="color:#28a745;">( '.$consultarNovo->nom_organizacao.' )</span>;<br>';

                        }

                    }

                }

            }

            if(isset($modificacoes) && !is_null($modificacoes) && $modificacoes != '') {

                $editar->update($alteracao);

                $acao = Acoes::create(array(
                    'table' => 'tab_missao_visao_valores',
                    'id_table' => $this->cod_missao_visao_valores,
                    'id_user' => Auth::user()->id,
                    'acao' => $modificacoes
                ));

                $this->showModalResultadoEdicao = true;

                $this->mensagemResultadoEdicao = $modificacoes;

            } else {

                $this->showModalResultadoEdicao = true;

                $this->mensagemResultadoEdicao = 'Por não ter nenhuma modificação nada foi feito.';

            }

        }

        $this->cod_missao_visao_valores = null;
        $this->cod_pei = null;
        $this->cod_organizacao = null;
        $this->dsc_missao = null;
        $this->dsc_visao = null;
        $this->dsc_valores = null;

        $this->abrirFecharForm = 'none';
        $this->iconAbrirFechar = 'fas fa-plus text-xs';
        
        $this->editarForm = false;

    }

    public function editForm(MissaoVisaoValores $singleData) {

        $this->cod_pei = $singleData->cod_pei;
        $this->cod_organizacao = $singleData->cod_organizacao;
        $this->dsc_missao = $singleData->dsc_missao;
        $this->dsc_visao = $singleData->dsc_visao;
        $this->dsc_valores = $singleData->dsc_valores;
        $this->cod_missao_visao_valores = $singleData->cod_missao_visao_valores;

        $organizacoes = [];

        $organization = Organization::whereRaw('cod_organizacao = rel_cod_organizacao')
        ->get();

        $organizationChild = Organization::whereRaw('cod_organizacao != rel_cod_organizacao')
        ->orderBy('nom_organizacao')
        ->get();

        foreach ($organization as $result) {

            $organizacoes[$result->cod_organizacao] = $result->nom_organizacao.$this->hierarquiaUnidade($result->cod_organizacao);

            foreach($organizationChild as $resultChild1) {

                if($result->cod_organizacao == $resultChild1->rel_cod_organizacao) {

                    $organizacoes[$resultChild1->cod_organizacao] = $resultChild1->nom_organizacao.$this->hierarquiaUnidade($resultChild1->cod_organizacao);

                    foreach ($resultChild1->deshierarquia as $resultChild2) {

                        if($resultChild1->cod_organizacao == $resultChild2->rel_cod_organizacao) {

                            $organizacoes[$resultChild2->cod_organizacao] = $resultChild2->nom_organizacao.$this->hierarquiaUnidade($resultChild2->cod_organizacao);

                            foreach ($resultChild2->deshierarquia as $resultChild3) {

                                if($resultChild2->cod_organizacao == $resultChild3->rel_cod_organizacao) {

                                    $organizacoes[$resultChild3->cod_organizacao] = $resultChild3->nom_organizacao.$this->hierarquiaUnidade($resultChild3->cod_organizacao);

                                    foreach ($resultChild3->deshierarquia as $resultChild4) {

                                        if($resultChild3->cod_organizacao == $resultChild4->rel_cod_organizacao) {

                                            $organizacoes[$resultChild4->cod_organizacao] = $resultChild4->nom_organizacao.$this->hierarquiaUnidade($resultChild4->cod_organizacao);

                                            foreach ($resultChild4->deshierarquia as $resultChild5) {

                                                if($resultChild4->cod_organizacao == $resultChild5->rel_cod_organizacao) {

                                                    $organizacoes[$resultChild5->cod_organizacao] = $resultChild5->nom_organizacao.$this->hierarquiaUnidade($resultChild5->cod_organizacao);

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

        $this->abrirFecharForm = 'block';
        $this->iconAbrirFechar = 'fas fa-minus text-xs';

        $this->editarForm = true;

    }

    public function deleteForm(MissaoVisaoValores $singleData) {

        $this->cod_missao_visao_valores = $singleData->cod_missao_visao_valores;

        $consultarPei = Pei::find($singleData->cod_pei);

        $consultarOrganizacao = Organization::find($singleData->cod_organizacao);

        $texto = '';

        $texto .= '<p class="my-2 text-gray-500 text-xs leading-relaxed">Missão: <strong>'.$singleData->dsc_missao.'</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">Visão: <strong>'.$singleData->dsc_visao.'</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">Valores: <strong>'.$singleData->dsc_valores.'</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">Planejamento: <strong>'.$consultarPei->dsc_pei.'</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">Unidade: <strong>'.$consultarOrganizacao->nom_organizacao.'</strong></p><p class="my-2 text-gray-500 text-xs font-semibold leading-relaxed text-red-600">Quer, realmente, excluir?</p>';

        $this->mensagemDelete = $texto;

        $this->showModalDelete = true;

        $this->dsc_missao = null;
        $this->cod_pei = null;
        $this->cod_organizacao = null;
        $this->editarForm = false;

    }

    public function delete(MissaoVisaoValores $singleData) {

        $this->showModalDelete = false;

        $consultarPei = Pei::find($singleData->cod_pei);

        $consultarOrganizacao = Organization::find($singleData->cod_organizacao);

        $modificacoes = '';

        $this->dsc_missao = $singleData->dsc_missao;
        $this->cod_pei = $singleData->cod_pei;
        $this->cod_organizacao = $singleData->cod_organizacao;
        $this->cod_missao_visao_valores = $singleData->cod_missao_visao_valores;

        $modificacoes = $modificacoes.'<p class="my-2 text-gray-500 text-xs leading-relaxed">A Missão <strong>'.$singleData->dsc_missao.'</strong>, a Visão <strong>'.$singleData->dsc_visao.'</strong> e os Valores <strong>'.$singleData->dsc_valores.'</strong> da Unidade <strong>'.$consultarOrganizacao->nom_organizacao.'</strong> e do Planejamento Estratégico Integrado <strong>'.$consultarPei->dsc_pei.'</strong> foi excluído com sucesso.</p>';

        $acao = Acoes::create(array(
            'table' => 'tab_pei',
            'id_table' => $singleData->cod_missao_visao_valores,
            'id_user' => Auth::user()->id,
            'acao' => $modificacoes
        ));

        $singleData->delete();

        $this->dsc_missao = null;
        $this->cod_pei = null;
        $this->cod_organizacao = null;
        $this->editarForm = false;


        $this->showModalResultadoEdicao = true;

        $this->mensagemResultadoEdicao = $modificacoes;

    }

    public function cancelar() {

        $this->cod_missao_visao_valores = null;
        $this->cod_pei = null;
        $this->cod_organizacao = null;
        $this->dsc_missao = null;
        $this->dsc_visao = null;
        $this->dsc_valores = null;
        $this->editarForm = false;

    }

    public function render()
    {

        $this->estruturaTable = $this->estruturaTable();

        $this->pei = Pei::select(db::raw("dsc_pei||' ( '||num_ano_inicio_pei||' a '||num_ano_fim_pei||' )' as dsc_pei, cod_pei"))
        ->where('dsc_pei','!=','')
        ->whereNotNull('dsc_pei')
        ->orderBy('dsc_pei')
        ->pluck('dsc_pei', 'cod_pei');

        if($this->editarForm == false) {

            $perspectiva = Perspectiva::select(db::raw("num_nivel_hierarquico_apresentacao||'. '||dsc_perspectiva as dsc_perspectiva, cod_perspectiva"))
            ->where('cod_pei',$this->cod_pei)
            ->orderBy('num_nivel_hierarquico_apresentacao','desc')
            ->pluck('dsc_perspectiva','cod_perspectiva');

            $this->objetivoEstragico = ObjetivoEstrategico::select(DB::raw("num_nivel_hierarquico_apresentacao||'. '||dsc_objetivo_estrategico AS dsc_objetivo_estrategico, cod_objetivo_estrategico"))
            ->where('cod_perspectiva',$this->cod_perspectiva)
            ->orderBy('num_nivel_hierarquico_apresentacao')
            ->with('perspectiva')
            ->pluck('dsc_objetivo_estrategico','cod_objetivo_estrategico');

            $this->perspectiva = $perspectiva;

            if(isset($this->cod_objetivo_estrategico) && !is_null($this->cod_objetivo_estrategico) && $this->cod_objetivo_estrategico != '' && $this->editarForm == false) {

                $this->num_nivel_hierarquico_apresentacao = $this->num_nivel_hierarquico_apresentacao;

            }

            if(isset($this->cod_objetivo_estrategico) && !is_null($this->cod_objetivo_estrategico) && $this->cod_objetivo_estrategico != '') {

                $this->num_nivel_hierarquico_apresentacao = $this->pesquisarCodigo($this->cod_objetivo_estrategico);

            }

        } else {

            $perspectiva = Perspectiva::select(db::raw("num_nivel_hierarquico_apresentacao||'. '||dsc_perspectiva as dsc_perspectiva, cod_perspectiva"));

            if(isset($this->cod_pei) && !is_null($this->cod_pei) && $this->cod_pei != '') {

                $perspectiva = $perspectiva->where('cod_pei',$this->cod_pei);

            }

            $perspectiva = $perspectiva->orderBy('num_nivel_hierarquico_apresentacao','desc')
            ->pluck('dsc_perspectiva','cod_perspectiva');

            $this->perspectiva = $perspectiva;

            $this->num_nivel_hierarquico_apresentacao = $this->num_nivel_hierarquico_apresentacao;

        }

        $this->niveis_hierarquico_apresentacao = NumNivelHierarquico::pluck('num_nivel_hierarquico_apresentacao','num_nivel_hierarquico_apresentacao');

        $this->tipoExecucao = TipoExecucao::orderBy('dsc_tipo_execucao')
        ->pluck('dsc_tipo_execucao','cod_tipo_execucao');

        $organization = Organization::whereRaw('cod_organizacao = rel_cod_organizacao')
        ->get();

        $organizationChild = Organization::whereRaw('cod_organizacao != rel_cod_organizacao')
        ->orderBy('nom_organizacao')
        ->get();

        foreach ($organization as $result) {

            if($this->editarForm == false) {

                $organizacoes[$result->cod_organizacao] = $result->nom_organizacao.$this->hierarquiaUnidade($result->cod_organizacao);

            } else {

                $organizacoes[$result->cod_organizacao] = $result->nom_organizacao.$this->hierarquiaUnidade($result->cod_organizacao);

            }

            foreach($organizationChild as $resultChild1) {

                if($result->cod_organizacao == $resultChild1->rel_cod_organizacao) {

                    if($this->editarForm == false) {

                        $organizacoes[$resultChild1->cod_organizacao] = $resultChild1->nom_organizacao.$this->hierarquiaUnidade($resultChild1->cod_organizacao);

                    } else {

                        $organizacoes[$resultChild1->cod_organizacao] = $resultChild1->nom_organizacao.$this->hierarquiaUnidade($resultChild1->cod_organizacao);

                    }

                    foreach ($resultChild1->deshierarquia as $resultChild2) {

                        if($resultChild1->cod_organizacao == $resultChild2->rel_cod_organizacao) {

                            if($this->editarForm == false) {

                                $organizacoes[$resultChild2->cod_organizacao] = $resultChild2->nom_organizacao.$this->hierarquiaUnidade($resultChild2->cod_organizacao);

                            } else {

                                $organizacoes[$resultChild2->cod_organizacao] = $resultChild2->nom_organizacao.$this->hierarquiaUnidade($resultChild2->cod_organizacao);

                            }

                            foreach ($resultChild2->deshierarquia as $resultChild3) {

                                if($resultChild2->cod_organizacao == $resultChild3->rel_cod_organizacao) {

                                    if($this->editarForm == false) {

                                        $organizacoes[$resultChild3->cod_organizacao] = $resultChild3->nom_organizacao.$this->hierarquiaUnidade($resultChild3->cod_organizacao);

                                    } else {

                                        $organizacoes[$resultChild3->cod_organizacao] = $resultChild3->nom_organizacao.$this->hierarquiaUnidade($resultChild3->cod_organizacao);

                                    }

                                    foreach ($resultChild3->deshierarquia as $resultChild4) {

                                        if($resultChild3->cod_organizacao == $resultChild4->rel_cod_organizacao) {

                                            if($this->editarForm == false) {

                                                $organizacoes[$resultChild4->cod_organizacao] = $resultChild4->nom_organizacao.$this->hierarquiaUnidade($resultChild4->cod_organizacao);

                                            } else {

                                                $organizacoes[$resultChild4->cod_organizacao] = $resultChild4->nom_organizacao.$this->hierarquiaUnidade($resultChild4->cod_organizacao);

                                            }

                                            foreach ($resultChild4->deshierarquia as $resultChild5) {

                                                if($resultChild4->cod_organizacao == $resultChild5->rel_cod_organizacao) {

                                                    if($this->editarForm == false) {

                                                        $organizacoes[$resultChild5->cod_organizacao] = $resultChild5->nom_organizacao.$this->hierarquiaUnidade($resultChild5->cod_organizacao);

                                                    } else {

                                                        $organizacoes[$resultChild5->cod_organizacao] = $resultChild5->nom_organizacao.$this->hierarquiaUnidade($resultChild5->cod_organizacao);

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

        $this->organization = $organizacoes;

        $this->planoAcao = PlanoAcao::get();

        return view('livewire.plano-acao-livewire');
        
    }

    protected function estruturaTable() {

        $estrutura = DB::select("SELECT
            column_name,ordinal_position,is_nullable,data_type
            FROM
            information_schema.columns
            WHERE
            table_schema = 'pei'
            AND table_name = 'tab_plano_de_acao' 
            AND column_name NOT IN ('cod_plano_de_acao','cod_objetivo_estrategico','cod_organizacao','created_at','updated_at','deleted_at');");

        return $estrutura;

    }

    protected function estruturaTableParaEditar() {

        $estrutura = DB::select("SELECT
            column_name,ordinal_position,is_nullable,data_type
            FROM
            information_schema.columns
            WHERE
            table_schema = 'pei'
            AND table_name = 'tab_plano_de_acao' 
            AND column_name NOT IN ('cod_plano_de_acao','created_at','updated_at','deleted_at');");

        return $estrutura;

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
