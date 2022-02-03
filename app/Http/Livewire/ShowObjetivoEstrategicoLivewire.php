<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Pei;
use App\Models\Organization;
use App\Models\RelOrganization;
use App\Models\MissaoVisaoValores;
use App\Models\Perspectiva;
use App\Models\ObjetivoEstrategico;
use App\Models\PlanoAcao;
use App\Models\Indicador;
use App\Models\EvolucaoIndicador;
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

    public $anoSelecionado = null;

    public $pei = [];
    public $cod_pei = null;
    public $perspectiva = [];
    public $cod_perspectiva = null;
    public $planosAcao = [];
    public $planoAcao = [];
    public $cod_plano_de_acao = null;

    public $vlr_realizado = null;

    public $objetivoEstragico = [];

    public $indicador = [];
    public $cod_indicador_selecionado = null;
    public $cod_indicador = null;

    public $mesAnterior = null;

    public $calculoMensal = null;

    public $cod_evolucao_indicador = null;

    public $liberarAcessoParaAtualizar = false;

    public $getGrauSatisfacao = null;

    public $grau_satisfacao = null;

    public $hierarquiaUnidade = null;

    public $editarForm = false;
    public $deleteForm = false;
    public $audit = false;
    public $showModalResultadoEdicao = false;
    public $showModalImportant = false;
    public $mensagemResultadoEdicao = null;
    public $mensagemImportant = null;
    public $showModalDelete = false;
    public $showModalAudit = false;
    public $mensagemDelete = null;

    public $abrirFecharForm = 'none';
    public $iconAbrirFechar = 'fas fa-plus text-xs';
    public $iconFechar = 'fas fa-minus text-xs';

    public function mount(SessionManager $session, Request $request, $ano,$cod_perspectiva = '',$cod_objetivo_estrategico = '',$cod_plano_de_acao = '')
    {
        $this->ano = $ano;

        $this->anoSelecionado = $ano;

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

    public function editForm($cod_evolucao_indicador = '') {

        $singleData = EvolucaoIndicador::find($cod_evolucao_indicador);

        $this->cod_evolucao_indicador = $singleData->cod_evolucao_indicador;

        $consultarIndicador = Indicador::find($singleData->cod_indicador);

        $dsc_unidade_medida = $consultarIndicador->dsc_unidade_medida;

        $num_ano = $singleData->num_ano;
        $num_mes = $singleData->num_mes;
        $this->vlr_realizado = formatarValorConformeUnidadeMedida($dsc_unidade_medida,'MYSQL','PTBR',$singleData->vlr_realizado);

        $mensagemResultadoEdicao = '<div class="flex flex-wrap w-full"><div class="w-full md:w-1/3 px-3 mb-1 md:mb-0 pt-3"><div class="col-span-6 sm:col-span-4"><label class="block font-medium text-sm text-gray-700 mb-2">Valor realizado de '.mesNumeralParaExtenso($num_mes).'/'.$num_ano.'</label><input type="text" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-0 pt-2 pl-2 h-9 text-right" id="vlr_realizado" name="vlr_realizado" wire:model="vlr_realizado" /></div></div></div></form>';

        $this->showModalResultadoEdicao = true;

        $this->mensagemResultadoEdicao = $mensagemResultadoEdicao;

        $this->editarForm = false;

    }

    public function create() {

        dd($this->cod_evolucao_indicador);

        $this->mensagemResultadoEdicao = null;

        $this->showModalResultadoEdicao = false;

    }

    public function render()
    {

        $time = strtotime(date('Y-m-d'));
        $this->mesAnterior = (date("n", strtotime("-1 month", $time)))*1;

        Session()->forget('anoSelecionado');

        if(isset($this->anoSelecionado) && !is_null($this->anoSelecionado) && $this->anoSelecionado != '') {

            Session()->put('anoSelecionado', $this->anoSelecionado);

        } else {

            Session()->forget('anoSelecionado');

        }

        $perspectiva = Perspectiva::find($this->cod_perspectiva);

        $this->perspectiva = $perspectiva;

        $pei = Pei::find($perspectiva->cod_pei);

        $this->pei = $pei;

        $objetivoEstrategico = ObjetivoEstrategico::select(DB::raw("num_nivel_hierarquico_apresentacao||'. '||dsc_objetivo_estrategico AS dsc_objetivo_estrategico, cod_objetivo_estrategico"));

        if(isset($this->cod_perspectiva) && !is_null($this->cod_perspectiva) && $this->cod_perspectiva != '' && $perspectiva->count() > 0) {

            $objetivoEstrategico = $objetivoEstrategico->where('cod_perspectiva',$this->cod_perspectiva);

        } else {

            $objetivoEstrategico = $objetivoEstrategico->whereNull('cod_perspectiva');

        }

        $anoSelecionado = $this->anoSelecionado;

        $objetivoEstrategico = $objetivoEstrategico->orderBy('num_nivel_hierarquico_apresentacao')
        ->with('perspectiva')
        ->pluck('dsc_objetivo_estrategico','cod_objetivo_estrategico');

        $this->objetivoEstragico = $objetivoEstrategico;

        $objetivoEstrategico = ObjetivoEstrategico::find($this->cod_objetivo_estrategico);

        $this->objetivoEstrategico = $objetivoEstrategico;

        $planosAcao = PlanoAcao::orderBy('num_nivel_hierarquico_apresentacao')
        ->where('cod_objetivo_estrategico',$this->cod_objetivo_estrategico)
        ->get();

        $this->planosAcao = $planosAcao;

        $planoAcao = PlanoAcao::orderBy('num_nivel_hierarquico_apresentacao')
        ->with('tipoExecucao','servidorResponsavel','servidorSubstituto','indicadores','indicadores.evolucaoIndicador')
        ->where('cod_objetivo_estrategico',$this->cod_objetivo_estrategico);

        if(isset($this->cod_plano_de_acao) && !is_null($this->cod_plano_de_acao) && $this->cod_plano_de_acao != '') {

            $planoAcao = $planoAcao->find($this->cod_plano_de_acao);

        } else {

            $planoAcao = $planoAcao->first();

        }

        $this->planoAcao = $planoAcao;

        if(is_null($this->cod_indicador_selecionado)) {

            $contIndicador = 1;

            // dd($this->planoAcao);

            if($planoAcao->indicadores) {

                foreach($planoAcao->indicadores as $indicador) {

                    if($contIndicador == 1) {

                        $this->cod_indicador = $indicador->cod_indicador;

                    }

                    $contIndicador = $contIndicador + 1;

                }

            }

        } else {

            $this->cod_indicador = $this->cod_indicador_selecionado;

        }

        $indicador = Indicador::with('linhaBase','metaAno','evolucaoIndicador')
        ->orderBy('dsc_indicador');

        $indicador = $indicador->whereHas('evolucaoIndicador', function ($query) use($anoSelecionado) {
            $query->where('num_ano',$anoSelecionado);
        });

        if(isset($this->cod_plano_de_acao) && !is_null($this->cod_plano_de_acao) && $this->cod_plano_de_acao != '') {

            $indicador = $indicador->where('cod_plano_de_acao',$this->cod_plano_de_acao);

        }

        if(isset($this->cod_indicador) && !is_null($this->cod_indicador) && $this->cod_indicador != '') {

            $indicador = $indicador->find($this->cod_indicador);

            if($indicador) {

                $this->indicador = $indicador;

            } else {

                $this->indicador = [];

            }

        }

        $this->grau_satisfacao = $this->grauSatisfacao();

        return view('livewire.show-objetivo-estrategico-livewire');
    }

    protected function calculoMensal($dsc_unidade_medida = '',$dsc_tipo = '',$vlr_previsto = 0,$vlr_realizado = 0) {

        $resultado = [];

        $resultado['percentual_alcancado'] = 0;
        $resultado['grau_de_satisfacao'] = 'gray';

        $calculo = 0;

        if(isset($dsc_tipo) && !is_null($dsc_tipo) && $dsc_tipo != '') {

            if($dsc_tipo == '+') {

                if($vlr_previsto > 0) {

                    $calculo = ($vlr_realizado/$vlr_previsto)*100;

                }

            }

            if($dsc_tipo == '-') {

                if($vlr_previsto > 0) {

                    $calculo = ((1-($vlr_realizado-$vlr_previsto)/$vlr_previsto)*100)-100;

                }

            }

            $resultado['percentual_alcancado'] = $calculo;

            $consultarGrauSatisfacao = GrauSatisfacao::where('vlr_maximo','>=',$calculo)
            ->where('vlr_minimo','<=',$calculo)
            ->first();

            $resultado['grau_de_satisfacao'] = $consultarGrauSatisfacao->cor;

            $resultado['color'] = 'white';

            if($consultarGrauSatisfacao->cor === 'yellow') {

                $resultado['color'] = 'black';

            }

        }

        return $resultado;

    }

    protected function getGrauSatisfacao($percentual = 0) {

        $resultado = [];

        $resultado['grau_de_satisfacao'] = 'gray';

        $consultarGrauSatisfacao = GrauSatisfacao::where('vlr_maximo','>=',$percentual)
        ->where('vlr_minimo','<=',$percentual)
        ->first();

        $resultado['grau_de_satisfacao'] = $consultarGrauSatisfacao->cor;

        $resultado['color'] = 'white';

        if($consultarGrauSatisfacao->cor === 'yellow') {

            $resultado['color'] = 'black';

        }

        return $resultado;

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

    public function grauSatisfacao() {

        $consultarGrauSatisfacao = GrauSatisfacao::orderBy('vlr_minimo')
        ->get();

        $montagemGrauSatisfacao = '';

        foreach($consultarGrauSatisfacao as $grauSatisfacao) {

            $color = 'white';

            if($grauSatisfacao->cor === 'yellow') {

                $color = 'black';

            }

            $montagemGrauSatisfacao .= '<div class="px-1 py-1 pl-3 font-semibold rounded-md border-1 text-'.$color.' bg-'.$grauSatisfacao->cor.'-500 text-sm antialiased sm:subpixel-antialiased md:antialiased">'.$grauSatisfacao->dsc_grau_satisfcao.' de '.converteValor('MYSQL','PTBR',$grauSatisfacao->vlr_minimo).'% a '.converteValor('MYSQL','PTBR',$grauSatisfacao->vlr_maximo).'%</div>';

        }

        $montagemGrauSatisfacao .= '<div class="px-1 py-1 pl-3 font-semibold rounded-md border-1 text-white bg-gray-500 text-sm antialiased sm:subpixel-antialiased md:antialiased">Sem meta prevista para o período</div>';

        $montagemGrauSatisfacao .= '<div class="px-1 py-1 pl-3 font-semibold rounded-md border-1 text-white bg-pink-800 text-sm antialiased sm:subpixel-antialiased md:antialiased">Não houve o preenchimento</div>';

        return $montagemGrauSatisfacao;

    }
}
