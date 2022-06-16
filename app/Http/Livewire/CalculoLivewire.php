<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Organization;
use App\Models\Pei;
use App\Models\Perspectiva;
use App\Models\ObjetivoEstrategico;
use App\Models\PlanoAcao;
use App\Models\Indicador;
use App\Models\LinhaBase;
use App\Models\MetaAno;
use App\Models\EvolucaoIndicador;
use App\Models\GrauSatisfacao;
use Illuminate\Support\Facades\DB;
use App\Http\Livewire\IndicadoresLivewire;
use App\Http\Livewire\GrauSatisfacaoLivewire;
use App\Http\Livewire\EvolucaoIndicadorLivewire;

ini_set('memory_limit', '7096M');
ini_set('max_execution_time', 9900);
set_time_limit(900000000);

class CalculoLivewire extends Component
{

    // Início do cálculo para encontrar o percentual alcançado por uma determinada unidade
    // considerando os planos de ações num ano, num mês e se o resultado será acumulado no ano ou por um período que compreende o início do ano até o mês selecionado

    public function calcularPercentualUnidade($cod_organizacao = '',$ano = '',$anoVigente = '',$mesSelecionado = '',$acumuladoAno = false,$acumuladoPeriodo = false)
    {
        if(isset($cod_organizacao) && !is_null($cod_organizacao) && $cod_organizacao != '') {

            // Início da consulta para pegar os planos de ações vinculados ao $cod_organizacao

            $consultarPlanosAcoesPorCodOrganizacao = PlanoAcao::where('cod_organizacao',$cod_organizacao)
            ->whereYear('dte_inicio','>=',$ano)
            ->get();

            // Início do IF para verificar se houve retorno da consulta $consultarPlanosAcoesPorCodOrganizacao

            if($consultarPlanosAcoesPorCodOrganizacao) {

                // Início do loop da consulta dos Planos de Ações

                $contPlanoAcao = 0;
                $totalPercentual = 0;

                foreach($consultarPlanosAcoesPorCodOrganizacao as $planoAcao) {

                    // Início da consulta para pegar os indicadores ligados ao plano de ação

                    $consultarIndicadoresPorCodPlanoAcao = Indicador::where('cod_plano_de_acao',$planoAcao->cod_plano_de_acao)
                    ->get();

                    // Início do IF para verificar se houve retorno da consulta $consultarIndicadoresPorCodPlanoAcao

                    if($consultarIndicadoresPorCodPlanoAcao) {

                        // Início do loop da consulta $consultarIndicadoresPorCodPlanoAcao

                        foreach($consultarIndicadoresPorCodPlanoAcao as $indicador) {

                            // dd($indicador->cod_indicador,$ano,$mesSelecionado,$acumuladoAno,$acumuladoPeriodo);

                            // Início da instância do componente EvolucaoIndicadorLivewire

                            $evolucaoIndicadorLivewire = new EvolucaoIndicadorLivewire;

                            // Fim da instância do componente EvolucaoIndicadorLivewire

                            $calcularPercentualExecutado = $evolucaoIndicadorLivewire->calcularPercentualExecutado($indicador->cod_indicador,$ano,$mesSelecionado,$acumuladoAno,$acumuladoPeriodo);

                            $prc_alcancado = $this->prc_alcancado($indicador->dsc_tipo,$calcularPercentualExecutado->vlr_realizado,$calcularPercentualExecutado->vlr_previsto);

                            $totalPercentual = $totalPercentual + $prc_alcancado;

                        }

                        // Fim do loop da consulta $consultarIndicadoresPorCodPlanoAcao

                    }

                    // Fim do IF para verificar se houve retorno da consulta $consultarIndicadoresPorCodPlanoAcao

                    $contPlanoAcao++;

                    // Fim da consulta para pegar os indicadores ligados ao plano de ação

                }

                // Fim do loop da consulta dos Planos de Ações

            }

            // Fim do IF para verificar se houve retorno da consulta $consultarPlanosAcoesPorCodOrganizacao

            $calculo = 0;

            if($contPlanoAcao > 0) {

                $calculo = ($totalPercentual/$contPlanoAcao);

            }

            return $calculo;

            // Fim da consulta para pegar os planos de ações vinculados ao $cod_organizacao

        }
    }
    
    // Fim do cálculo para encontrar o percentual alcançado por uma determinada unidade

    public function calcularAcumuladoObjetivoEstrategico($cod_organizacao = '', $cod_objetivo_estrategico = '',$anoSelecionado = '') {

        $resultado = [];

        $prc_alcancado = 0;

        if(isset($cod_organizacao) && !is_null($cod_organizacao) && $cod_organizacao != '' && isset($cod_objetivo_estrategico) && !is_null($cod_objetivo_estrategico) && $cod_objetivo_estrategico != '' && isset($anoSelecionado) && !is_null($anoSelecionado) && $anoSelecionado != '') {

            if(isset($cod_organizacao) && !is_null($cod_organizacao) && $cod_organizacao != '') {

                $organizacoes = [];

                $organization = Organization::where('cod_organizacao',$cod_organizacao)
                ->get();

                $organizationChild = Organization::orderBy('nom_organizacao')
                ->get();

                foreach ($organization as $result) {

                    $organizacoes[$result->cod_organizacao] = $result->cod_organizacao;

                    foreach($organizationChild as $resultChild1) {

                        if($result->cod_organizacao == $resultChild1->rel_cod_organizacao) {

                            $organizacoes[$resultChild1->cod_organizacao] = $resultChild1->cod_organizacao;

                            foreach ($resultChild1->deshierarquia as $resultChild2) {

                                if($resultChild1->cod_organizacao == $resultChild2->rel_cod_organizacao) {

                                    $organizacoes[$resultChild2->cod_organizacao] = $resultChild2->cod_organizacao;

                                    foreach ($resultChild2->deshierarquia as $resultChild3) {

                                        if($resultChild2->cod_organizacao == $resultChild3->rel_cod_organizacao) {

                                            $organizacoes[$resultChild3->cod_organizacao] = $resultChild3->cod_organizacao;

                                            foreach ($resultChild3->deshierarquia as $resultChild4) {

                                                if($resultChild3->cod_organizacao == $resultChild4->rel_cod_organizacao) {

                                                    $organizacoes[$resultChild4->cod_organizacao] = $resultChild4->cod_organizacao;

                                                    foreach ($resultChild4->deshierarquia as $resultChild5) {

                                                        if($resultChild4->cod_organizacao == $resultChild5->rel_cod_organizacao) {

                                                            $organizacoes[$resultChild5->cod_organizacao] = $resultChild5->cod_organizacao;

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

                $objetivoEstrategico = ObjetivoEstrategico::find($cod_objetivo_estrategico);

                $planosAcao = PlanoAcao::where('cod_objetivo_estrategico',$cod_objetivo_estrategico)
                ->whereIn('cod_organizacao',$organizacoes)
                ->whereYear('dte_inicio','<=',$anoSelecionado)
                ->whereYear('dte_fim','>=',$anoSelecionado)
                ->get();

                $resultadoGeralCalculo = 0;

                $contPlanoAcao = 0;

                foreach($planosAcao as $planoAcao) {

                    $resultadoCalculo = 0;

                    $cod_plano_de_acao = $planoAcao->cod_plano_de_acao;

                    if(isset($cod_plano_de_acao) && !is_null($cod_plano_de_acao) && $cod_plano_de_acao != '' && isset($anoSelecionado) && !is_null($anoSelecionado) && $anoSelecionado != '') {

                        $planoAcao = PlanoAcao::find($cod_plano_de_acao);

                        $indicadores = Indicador::where('cod_plano_de_acao',$cod_plano_de_acao)
                        ->with('metaAno');

                        $indicadores = $indicadores->whereHas('metaAno', function ($query) use($anoSelecionado) {
                            $query->where('num_ano',$anoSelecionado);
                        });

                        $indicadores = $indicadores->get();

                        $totalResultado = 0;

                        foreach($indicadores as $indicador) {

                            $anoVigente = date('Y');

                            $time = strtotime(date('Y-m-d'));
                            $mesAnterior = (date("n", strtotime("-1 month", $time)))*1;

                            $totalRealizado = 0;
                            $totalPrevisto = 0;
                            $totalPrevistoAnual = 0;

                            if(!is_null($indicador)) {

                                $evolucaoIndicador = EvolucaoIndicador::where('cod_indicador',$indicador->cod_indicador)
                                ->where('num_ano',$anoSelecionado)
                                ->orderBy('num_mes')
                                ->get();

                                $consultarMetaAno = MetaAno::where('cod_indicador',$indicador->cod_indicador)
                                ->where('num_ano',$anoSelecionado)
                                ->first();

                                $totalPrevistoAnual = $consultarMetaAno->meta;

                                foreach($evolucaoIndicador as $evolucaoIndicador) {

                                    if($anoSelecionado == $anoVigente) {

                                        if($mesAnterior != 12) {

                                            if($evolucaoIndicador->num_mes <= $mesAnterior) {

                                                if($indicador->bln_acumulado === 'Sim') {

                                                    // $totalPrevisto = $totalPrevistoAnual;

                                                    $totalRealizado = $totalRealizado + $evolucaoIndicador->vlr_realizado;

                                                } else {

                                                    // $totalPrevisto = $totalPrevistoAnual;

                                                    $totalRealizado = $evolucaoIndicador->vlr_realizado;

                                                }

                                            }

                                        }

                                    } else {

                                        if($indicador->bln_acumulado === 'Sim') {

                                            // $totalPrevisto = $totalPrevistoAnual;

                                            $totalRealizado = $totalRealizado + $evolucaoIndicador->vlr_realizado;

                                        } else {

                                            // $totalPrevisto = $totalPrevistoAnual;

                                            $totalRealizado = $evolucaoIndicador->vlr_realizado;

                                        }

                                    }

                                }

                            }

                            // print($totalRealizado." - ".$totalPrevistoAnual."<br>");

                            $totalResultado = $totalResultado+$this->prc_alcancado($indicador->dsc_tipo,$totalRealizado,$totalPrevistoAnual);

                        }

                        if($indicadores->count() > 0) {

                            // print("Quantidade de Indicadores: ".$planosAcao->count()."<br>");

                            $resultadoCalculo = ($totalResultado)/$indicadores->count();

                            // print("Geral: ".$resultadoCalculo."<br>");

                            $resultadoGeralCalculo = $resultadoGeralCalculo + $resultadoCalculo;

                        }

                    }

                }

                if($planosAcao->count() > 0) {

                    $prc_alcancado = $resultadoGeralCalculo/$planosAcao->count();

                } else {

                    $prc_alcancado = 0;

                }

                $grauSatisfacao = new GrauSatisfacaoLivewire;

                $getgrauSatisfacao = $grauSatisfacao->obterGrauSatisfacao($prc_alcancado);

                $resultado['quantidadePlanosDeAcao'] = $planosAcao->count();
                $resultado['percentual_alcancado'] = $prc_alcancado;

                if($planosAcao->count() > 0) {

                    $resultado['grau_de_satisfacao'] = $getgrauSatisfacao['grau_de_satisfacao'];

                } else {

                    $resultado['grau_de_satisfacao'] = 'gray';

                }

                
                $resultado['color'] = $getgrauSatisfacao['color'];

            } else {

                $resultado['quantidadePlanosDeAcao'] = 0;
                $resultado['percentual_alcancado'] = 0;

                $resultado['grau_de_satisfacao'] = 'red';
                $resultado['color'] = 'white';

            }

        }

        return $resultado;

    }

    public function calcularAcumuladoPlanoDeAcao($cod_plano_de_acao = '',$anoSelecionado = '') {

        $result = [];

        $resultadoCalculo = 0;

        if(isset($cod_plano_de_acao) && !is_null($cod_plano_de_acao) && $cod_plano_de_acao != '' && isset($anoSelecionado) && !is_null($anoSelecionado) && $anoSelecionado != '') {

            $planoAcao = PlanoAcao::find($cod_plano_de_acao);

            $indicadores = Indicador::where('cod_plano_de_acao',$cod_plano_de_acao)
            ->with('metaAno');

            $indicadores = $indicadores->whereHas('metaAno', function ($query) use($anoSelecionado) {
                $query->where('num_ano',$anoSelecionado);
            });

            $indicadores = $indicadores->get();

            $totalResultado = 0;

            foreach($indicadores as $indicador) {

                $anoVigente = date('Y');

                $time = strtotime(date('Y-m-d'));
                $mesAnterior = (date("n", strtotime("-1 month", $time)))*1;

                $totalRealizado = 0;
                $totalPrevisto = 0;

                if(!is_null($indicador)) {

                    $evolucaoIndicador = EvolucaoIndicador::where('cod_indicador',$indicador->cod_indicador)
                    ->where('num_ano',$anoSelecionado)
                    ->orderBy('num_mes')
                    ->get();

                    foreach($evolucaoIndicador as $evolucaoIndicador) {

                        if($anoSelecionado == $anoVigente) {

                            if($mesAnterior != 12) {

                                if($evolucaoIndicador->num_mes <= $mesAnterior) {

                                    if($indicador->bln_acumulado === 'Sim') {

                                        $totalPrevisto = $totalPrevisto + $evolucaoIndicador->vlr_previsto;

                                        $totalRealizado = $totalRealizado + $evolucaoIndicador->vlr_realizado;

                                    } else {

                                        $totalPrevisto = $evolucaoIndicador->vlr_previsto;

                                        $totalRealizado = $evolucaoIndicador->vlr_realizado;

                                    }

                                }

                            }

                        } else {

                            if($indicador->bln_acumulado === 'Sim') {

                                $totalPrevisto = $totalPrevisto + $evolucaoIndicador->vlr_previsto;

                                $totalRealizado = $totalRealizado + $evolucaoIndicador->vlr_realizado;

                            } else {

                                $totalPrevisto = $evolucaoIndicador->vlr_previsto;

                                $totalRealizado = $evolucaoIndicador->vlr_realizado;

                            }

                        }

                    }

                }

                $totalResultado = $totalResultado+$this->prc_alcancado($indicador->dsc_tipo,$totalRealizado,$totalPrevisto);

            }

            if($indicadores->count() > 0) {

                // print("Total: ".$totalResultado."<br>");

                $resultadoCalculo = ($totalResultado)/$indicadores->count();

                // print("Geral: ".$resultadoCalculo);

                $grauSatisfacao = new GrauSatisfacaoLivewire;

                $getgrauSatisfacao = $grauSatisfacao->obterGrauSatisfacao($resultadoCalculo);

                $result['grau_de_satisfacao'] = $getgrauSatisfacao['grau_de_satisfacao'];
                $result['color'] = $getgrauSatisfacao['color'];

            }

        }

        return $result;

    }

    public function calcularAcumuladoIndicador($cod_indicador = '',$anoSelecionado = '') {

        // Tipo de conteúdo esperado de cada variável:
        // $tipoCalculo => texto;
        // $dsc_tipo => texto;
        // $cod_perspectiva => código uuid;
        // $cod_objetivo_estrategico => código uuid;
        // $cod_plano_de_acao => código uuid;
        // $cod_indicador => código uuid;
        // $anoSelecionado => numeric;

        // Possíveis tipos de cálculo:
        // 1. acumuladoIndicador => acumulado do indicador, neste caso é necessário que as variáveis $cod_indicador, $mes, $ano e $anoSelecionado estejam com o conteúdo necessário;

        // O retorno dessa função será um array contendo:
        // 1. percentual alcançado;
        // 2. cor obtida pelo grau de satisfação conforme o percentual alcançado ou conforme os aspectos derivados de não ter o percentual alcançado, como não ter o valor realizado por falta de preechimento dos getores ou não ter uma meta prevista (valor previsto para o cálculo);
        // 3. cor do texto, para manter o contraste na visualização e leitura é passada para black quando cor obtida pelo grau de satisfação seja yellow;

        $result = [];

        if(isset($cod_indicador) && !is_null($cod_indicador) && $cod_indicador != '' && isset($anoSelecionado) && !is_null($anoSelecionado) && $anoSelecionado != '') {

            $indicador = Indicador::find($cod_indicador);

            $anoVigente = date('Y');

            $time = strtotime(date('Y-m-d'));
            $mesAnterior = (date("n", strtotime("-1 month", $time)))*1;

            $totalRealizado = 0;
            $totalPrevisto = 0;

            if(!is_null($indicador)) {

                $evolucaoIndicador = EvolucaoIndicador::where('cod_indicador',$cod_indicador)
                ->where('num_ano',$anoSelecionado)
                ->orderBy('num_mes')
                ->get();

                foreach($evolucaoIndicador as $evolucaoIndicador) {

                    if($anoSelecionado == $anoVigente) {

                        if($mesAnterior != 12) {

                            if($evolucaoIndicador->num_mes <= $mesAnterior) {

                                if($indicador->bln_acumulado === 'Sim') {

                                    $totalPrevisto = $totalPrevisto + $evolucaoIndicador->vlr_previsto;

                                    $totalRealizado = $totalRealizado + $evolucaoIndicador->vlr_realizado;

                                } else {

                                    $totalPrevisto = $evolucaoIndicador->vlr_previsto;

                                    $totalRealizado = $evolucaoIndicador->vlr_realizado;

                                }

                            }

                        }

                    } else {

                        if($indicador->bln_acumulado === 'Sim') {

                            $totalPrevisto = $totalPrevisto + $evolucaoIndicador->vlr_previsto;

                            $totalRealizado = $totalRealizado + $evolucaoIndicador->vlr_realizado;

                        } else {

                            $totalPrevisto = $evolucaoIndicador->vlr_previsto;

                            $totalRealizado = $evolucaoIndicador->vlr_realizado;

                        }

                    }

                }

            } else {

                $totalRealizado = 0;
                $totalPrevisto = 0;

            }

            $result = $this->obterResultadoComValorRealizadoEValorPrevisto($indicador->dsc_tipo,$totalRealizado,$totalPrevisto);

            return $result;

        } else {

            $result['grau_de_satisfacao'] = 'gray';
            $result['color'] = 'white';

            return $result;

        }

    }

    public function obterResultadoComValorRealizadoEValorPrevisto($dsc_tipo = '',$vlr_realizado = '',$vlr_previsto = '') {

        // Tipo de conteúdo esperado de cada variável:
        // $vlr_realizado => numeric;
        // $vlr_previsto => numeric;

        // O retorno dessa função será um array contendo:
        // 1. percentual alcançado;
        // 2. cor obtida pelo grau de satisfação conforme o percentual alcançado ou conforme os aspectos derivados de não ter o percentual alcançado, como não ter o valor realizado por falta de preechimento dos getores ou não ter uma meta prevista (valor previsto para o cálculo);
        // 3. cor do texto, para manter o contraste na visualização e leitura é passada para black quando cor obtida pelo grau de satisfação seja yellow;

        $result = [];
        $prc_alcancado = 0;

        if(isset($dsc_tipo) && !is_null($dsc_tipo) && $dsc_tipo != '') {

            if(isset($vlr_previsto) && !is_null($vlr_previsto) && $vlr_previsto != '') {

                if(isset($vlr_realizado) && !is_null($vlr_realizado) && $vlr_realizado != '') {

                    if($dsc_tipo == '+') {

                        if($vlr_previsto > 0) {

                            $prc_alcancado = (($vlr_realizado/$vlr_previsto)*100);

                            $grauSatisfacao = new GrauSatisfacaoLivewire;

                            $getgrauSatisfacao = $grauSatisfacao->obterGrauSatisfacao($prc_alcancado);

                            $result['grau_de_satisfacao'] = $getgrauSatisfacao['grau_de_satisfacao'];
                            $result['color'] = $getgrauSatisfacao['color'];

                        }

                    }

                    if($dsc_tipo == '-') {

                        if($vlr_previsto > 0) {

                            $prc_alcancado = ((1-($vlr_realizado-$vlr_previsto)/$vlr_previsto)*100)-100;

                            $grauSatisfacao = new GrauSatisfacaoLivewire;

                            $getgrauSatisfacao = $grauSatisfacao->obterGrauSatisfacao($prc_alcancado);

                            $result['grau_de_satisfacao'] = $getgrauSatisfacao['grau_de_satisfacao'];
                            $result['color'] = $getgrauSatisfacao['color'];

                        }

                    }

                    if($dsc_tipo == '=') {

                        if($vlr_previsto > 0) {

                            $prc_alcancado = 100-(100-($vlr_realizado/$vlr_previsto)*100);

                            $grauSatisfacao = new GrauSatisfacaoLivewire;

                            $getgrauSatisfacao = $grauSatisfacao->obterGrauSatisfacao($prc_alcancado);

                            $result['grau_de_satisfacao'] = $getgrauSatisfacao['grau_de_satisfacao'];
                            $result['color'] = $getgrauSatisfacao['color'];

                        }

                    }

                } else {

                    // O resultado será a cor relativa para 'Não houve o preenchimento';

                    $result['grau_de_satisfacao'] = 'pink';
                    $result['color'] = 'white';

                }

            } else {

                // O resultado será a cor relativa para 'Sem meta prevista para o período';

                $result['grau_de_satisfacao'] = 'gray';
                $result['color'] = 'white';

            }

        }

        return $result;

    }

    public function prc_alcancado($dsc_tipo = '',$vlr_realizado = '',$vlr_previsto = '') {

        // Tipo de conteúdo esperado de cada variável:
        // $vlr_realizado => numeric;
        // $vlr_previsto => numeric;

        // O retorno dessa função será um array contendo:
        // 1. percentual alcançado;
        // 2. cor obtida pelo grau de satisfação conforme o percentual alcançado ou conforme os aspectos derivados de não ter o percentual alcançado, como não ter o valor realizado por falta de preechimento dos getores ou não ter uma meta prevista (valor previsto para o cálculo);
        // 3. cor do texto, para manter o contraste na visualização e leitura é passada para black quando cor obtida pelo grau de satisfação seja yellow;

        $result = [];
        $prc_alcancado = 0;

        if(isset($dsc_tipo) && !is_null($dsc_tipo) && $dsc_tipo != '') {

            if(isset($vlr_previsto) && !is_null($vlr_previsto) && $vlr_previsto != '') {

                if(isset($vlr_realizado) && !is_null($vlr_realizado) && $vlr_realizado != '') {

                    if($dsc_tipo == '+') {

                        if($vlr_previsto > 0) {

                            $prc_alcancado = (($vlr_realizado/$vlr_previsto)*100);

                        }

                    }

                    if($dsc_tipo == '-') {

                        if($vlr_previsto > 0) {

                            $prc_alcancado = ((1-($vlr_realizado-$vlr_previsto)/$vlr_previsto)*100)-100;

                        }

                    }

                    if($dsc_tipo == '=') {

                        if($vlr_previsto > 0) {

                            $prc_alcancado = 100-(100-($vlr_realizado/$vlr_previsto)*100);

                        }

                    }

                } else {

                    $prc_alcancado = 0;

                }

            } else {

                $prc_alcancado = 0;

            }

        }

        return $prc_alcancado;

    }

}
