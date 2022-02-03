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

class ShowDashboard extends Component
{

    use WithPagination;

    public $grau_satisfacao = null;

    public $calculoPorArea = null;

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

    public function calculoPorArea($cod_objetivo_estrategico = '') {

        $anoVigente = date("Y");
        $mesVigente = date("n");

        $anoSelecionado = ($this->ano)*1;

        $resultado = [];

        $resultado['quantidade_plano_de_acao'] = 0;
        $resultado['percentual_alcancado'] = 0;
        $resultado['grau_de_satisfacao'] = 'gray';

        $time = strtotime(date('Y-m-d'));
        $mesAnterior = (date("n", strtotime("-1 month", $time)))*1;
        $ano = date("Y", strtotime("+1 month", $time));

        // --------------------------------------------

        if(isset($this->cod_organizacao) && !is_null($this->cod_organizacao) && $this->cod_organizacao != '') {

            $organizacoes = [];

            $organization = Organization::where('cod_organizacao',$this->cod_organizacao)
            ->get();

            $organizationChild = Organization::orderBy('nom_organizacao')
            ->get();

            foreach ($organization as $result) {

                $organizacoes[$result->cod_organizacao] = $this->codOrganizacaoPorHieraquia($result->cod_organizacao);

                foreach($organizationChild as $resultChild1) {

                    if($result->cod_organizacao == $resultChild1->rel_cod_organizacao) {

                        $organizacoes[$resultChild1->cod_organizacao] = $this->codOrganizacaoPorHieraquia($resultChild1->cod_organizacao);

                        foreach ($resultChild1->deshierarquia as $resultChild2) {

                            if($resultChild1->cod_organizacao == $resultChild2->rel_cod_organizacao) {

                                $organizacoes[$resultChild2->cod_organizacao] = $this->codOrganizacaoPorHieraquia($resultChild2->cod_organizacao);

                                foreach ($resultChild2->deshierarquia as $resultChild3) {

                                    if($resultChild2->cod_organizacao == $resultChild3->rel_cod_organizacao) {

                                        $organizacoes[$resultChild3->cod_organizacao] = $this->codOrganizacaoPorHieraquia($resultChild3->cod_organizacao);

                                        foreach ($resultChild3->deshierarquia as $resultChild4) {

                                            if($resultChild3->cod_organizacao == $resultChild4->rel_cod_organizacao) {

                                                $organizacoes[$resultChild4->cod_organizacao] = $this->codOrganizacaoPorHieraquia($resultChild4->cod_organizacao);

                                                foreach ($resultChild4->deshierarquia as $resultChild5) {

                                                    if($resultChild4->cod_organizacao == $resultChild5->rel_cod_organizacao) {

                                                        $organizacoes[$resultChild5->cod_organizacao] = $this->codOrganizacaoPorHieraquia($resultChild5->cod_organizacao);

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

            Session()->put('cod_organizacao', $organizacoes);

        } else {

            Session()->forget('cod_organizacao');

        }

        $consultarObjetivoEstrategico = [];

        if(isset($this->cod_organizacao) && !is_null($this->cod_organizacao) && $this->cod_organizacao != '' && isset($cod_objetivo_estrategico) && !is_null($cod_objetivo_estrategico) && $cod_objetivo_estrategico != '') {

            $consultarObjetivoEstrategico = ObjetivoEstrategico::with('planosDeAcaoPorArea','planosDeAcaoPorArea.indicadores','planosDeAcaoPorArea.indicadores.metaAno','planosDeAcaoPorArea.indicadores.evolucaoIndicador')
            ->where('cod_objetivo_estrategico',$cod_objetivo_estrategico)
            ->get();

            $somaResultado = 0;
            $calculo = 0;

            foreach($consultarObjetivoEstrategico AS $objetivoEstragico) {

                foreach($objetivoEstragico->planosDeAcaoPorArea as $planoDeAcao) {

                    $anoInicio = date('Y', strtotime($planoDeAcao->dte_inicio));
                    $anoConclusao = date('Y', strtotime($planoDeAcao->dte_fim));

                    if($anoSelecionado >= $anoInicio && $anoSelecionado <= $anoConclusao) {

                        // Início para pegar a quantidade de plano de ação por objetivo estratégico e por área

                        $resultado['quantidade_plano_de_acao'] = $objetivoEstragico->planosDeAcaoPorArea->count();

                        // Fim para pegar a quantidade de plano de ação por objetivo estratégico e por área

                    }

                    // Iniciar o acesso ao indicador

                    $contIndicador = 0;

                    if($planoDeAcao->indicadores->count() > 0) {

                        foreach($planoDeAcao->indicadores as $indicador) {

                            $unidadeMedida = $indicador->dsc_unidade_medida;
                            $bln_acumulado = $indicador->bln_acumulado;
                            $dsc_tipo = $indicador->dsc_tipo;

                            $flg_metaAno = false;

                            foreach($indicador->metaAno as $metaAno) {

                                if($metaAno->num_ano == $anoSelecionado) {

                                    $flg_metaAno = true;

                                    $vlr_meta_ano = $metaAno->meta;

                                    $metaAno = $metaAno->num_ano;

                                }

                            }

                            if($flg_metaAno && isset($metaAno) && !is_null($metaAno) && $metaAno != '' && $metaAno == $anoVigente) {

                                $contIndicador = $contIndicador + 1;

                            // Início do cálculo para o ano vigente

                                $valorMetaPrevista = 0;
                                $valorMetaRealizada = 0;

                                if($mesVigente > 1) {

                                    $contEvolucaoIndicador = 1;

                                    foreach($indicador->evolucaoIndicador as $evolucaoIndicador) {

                                        if($bln_acumulado === "Sim") {

                                            for ($contMes=1;$contMes<=$mesAnterior;$contMes++) {

                                                $column_name_mes = 'metaMes_'.$contMes.'_'.$anoSelecionado;

                                                if($evolucaoIndicador->num_mes == $contMes && $evolucaoIndicador->num_ano == $anoSelecionado) {

                                                    $valorMetaPrevista = $valorMetaPrevista + $evolucaoIndicador->vlr_previsto;

                                                    $valorMetaRealizada = $valorMetaRealizada + $evolucaoIndicador->vlr_realizado;

                                                }

                                                if($contEvolucaoIndicador == 12) {

                                                    $contEvolucaoIndicador = 1;

                                                }

                                                $contEvolucaoIndicador = $contEvolucaoIndicador + 1;

                                            }

                                            if($dsc_tipo === "+") {

                                                if($valorMetaPrevista > 0) {

                                                    $somaResultado = ($valorMetaRealizada/$vlr_meta_ano)*100;

                                                }

                                            }

                                            if($dsc_tipo === "-") {

                                                if($valorMetaPrevista > 0) {

                                                    $somaResultado = ($valorMetaRealizada/$vlr_meta_ano)*100;

                                                }

                                            }

                                        }

                                        if($bln_acumulado === "Não") {

                                            for ($contMes=1;$contMes<=$mesAnterior;$contMes++) {

                                                $column_name_mes = 'metaMes_'.$contMes.'_'.$anoSelecionado;

                                                if($evolucaoIndicador->num_mes == $contMes && $evolucaoIndicador->num_ano == $anoSelecionado) {

                                                    $valorMetaPrevista = $evolucaoIndicador->vlr_previsto;

                                                    $valorMetaRealizada = $evolucaoIndicador->vlr_realizado;

                                                }

                                                if($contEvolucaoIndicador == 12) {

                                                    $contEvolucaoIndicador = 1;

                                                }

                                                $contEvolucaoIndicador = $contEvolucaoIndicador + 1;

                                            }

                                            if($dsc_tipo === "+") {

                                                if($valorMetaPrevista > 0) {

                                                    $somaResultado = ($valorMetaRealizada/$vlr_meta_ano)*100;

                                                }

                                            }

                                            if($dsc_tipo === "-") {

                                                if($valorMetaPrevista > 0) {

                                                    $somaResultado = ((1-($valorMetaRealizada-$vlr_meta_ano)/$vlr_meta_ano)*100)-100;

                                                }

                                            }

                                        }

                                    }

                                }

                                $calculo = $calculo + $somaResultado;

                            // print("<br />Unidade de Medida: ".$unidadeMedida."<br />Acumulado: ".$bln_acumulado."<br />Tipo: ".$dsc_tipo."<br />Ano selecionado: ".$anoSelecionado."<br />Ano meta: ".$metaAno."<br />Mês vigente: ".$mesVigente."<br />Mês anterior: ".$mesAnterior."<br />Soma Valor Previsto: ".$valorMetaPrevista."<br />Soma Valor Realizado: ".$valorMetaRealizada."<br />Resultado: ".$somaResultado."<br />Total de indicadores: ".$contIndicador."<br />");

                            // Fim do cálculo para o ano vigente

                            // print("<br />Cáculo: ".$calculo/$contIndicador."<br /><br />");

                                $resultado['percentual_alcancado'] = $calculo/$contIndicador;

                                $consultarGrauSatisfacao = GrauSatisfacao::where('vlr_maximo','>=',$resultado['percentual_alcancado'])
                                ->where('vlr_minimo','<=',$resultado['percentual_alcancado'])
                                ->first();

                                $resultado['grau_de_satisfacao'] = $consultarGrauSatisfacao->cor;

                                

                            } else {

                            // Início do cálculo para o ano selecionado diferete do ano vigente

                            // Fim do cálculo para o ano selecionado diferete do ano vigente

                            }

                        }

                    }

                    // Fim do acesso ao indicador

                }

            }

        }

        

        // dd("Unidade de Medida: ".$unidadeMedida,"Acumulado: ".$bln_acumulado,"Tipo: ".$dsc_tipo,"Ano selecionado: ".$anoSelecionado,"Ano meta: ".$metaAno,"Mês vigente: ".$mesVigente,"Mês anterior: ".$mesAnterior,"Soma Valor Previsto: ".$valorMetaPrevista,"Soma Valor Realizado: ".$valorMetaRealizada,"Resultado: ".$somaResultado,"Total de indicadores: ".$contIndicador);

        return $resultado;

    }

    public function render($ano = '',$cod_organizacao = '')
    {

        Session()->forget('cod_organizacao');
        Session()->forget('cod_objetivo_estrategico');

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

        // $resultCalculo = $this->calculoPorArea('5f6d7967-d3ba-4abd-9b42-e596cd029821');

        // dd($resultCalculo);

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

            $this->grau_satisfacao = $this->grauSatisfacao();

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

    protected function codOrganizacaoPorHieraquia($cod_organizacao) {

        return $cod_organizacao;

        $organizacao = Organization::with('hierarquia')
        ->where('cod_organizacao',$cod_organizacao)
        ->get();

        $hierarquiaSuperior = [];

        array_push($hierarquiaSuperior,$cod_organizacao);

        foreach($organizacao as $result1) {

            if($result1->hierarquia) {

                foreach($result1->hierarquia as $result2) {

                    if(!in_array($result2->cod_organizacao, $hierarquiaSuperior)) {

                        array_push($hierarquiaSuperior,$result2->cod_organizacao);

                    }

                    $organizacao2 = Organization::with('hierarquia')
                    ->where('cod_organizacao',$result2->cod_organizacao)
                    ->get();

                    foreach($organizacao2 as $result3) {

                        if($result3->hierarquia) {

                            foreach($result3->hierarquia as $result4) {

                                if(!in_array($result4->cod_organizacao, $hierarquiaSuperior)) {

                                    array_push($hierarquiaSuperior,$result4->cod_organizacao);

                                }

                                $organizacao3 = Organization::with('hierarquia')
                                ->where('cod_organizacao',$result4->cod_organizacao)
                                ->get();

                                foreach($organizacao3 as $result5) {

                                    if($result5->hierarquia) {

                                        foreach($result5->hierarquia as $result6) {

                                            if(!in_array($result6->sgl_organizacao, $hierarquiaSuperior)) {

                                                array_push($hierarquiaSuperior,$result6->sgl_organizacao);

                                            }

                                            $organizacao4 = Organization::with('hierarquia')
                                            ->where('cod_organizacao',$result6->cod_organizacao)
                                            ->get();

                                            foreach($organizacao4 as $result7) {

                                                if($result7->hierarquia) {

                                                    foreach($result7->hierarquia as $result8) {

                                                        if(!in_array($result8->sgl_organizacao, $hierarquiaSuperior)) {

                                                            array_push($hierarquiaSuperior,$result8->sgl_organizacao);

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

        }

        return $hierarquiaSuperior;

    }

    public function grauSatisfacao() {

        $consultarGrauSatisfacao = GrauSatisfacao::orderBy('vlr_minimo')
        ->get();

        $montagemGrauSatisfacao = '';

        foreach($consultarGrauSatisfacao as $grauSatisfacao) {

            $color = 'white';

            if($grauSatisfacao->cor === 'yellow') {

                $color = 'white';

            }

            $montagemGrauSatisfacao .= '<div class="px-1 py-1 pl-3 font-semibold rounded-md border-1 text-'.$color.' bg-'.$grauSatisfacao->cor.'-500 text-sm antialiased sm:subpixel-antialiased md:antialiased">'.$grauSatisfacao->dsc_grau_satisfcao.' de '.converteValor('MYSQL','PTBR',$grauSatisfacao->vlr_minimo).'% a '.converteValor('MYSQL','PTBR',$grauSatisfacao->vlr_maximo).'%</div>';

        }

        // $montagemGrauSatisfacao .= '<div class="px-1 py-1 pl-3 font-semibold rounded-md border-1 text-white bg-gray-500 text-sm antialiased sm:subpixel-antialiased md:antialiased">Sem meta prevista para o período</div>';

        // $montagemGrauSatisfacao .= '<div class="px-1 py-1 pl-3 font-semibold rounded-md border-1 text-white bg-pink-800 text-sm antialiased sm:subpixel-antialiased md:antialiased">Não houve o preenchimento</div>';

        return $montagemGrauSatisfacao;

    }
}
