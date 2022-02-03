<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Acoes;
use App\Models\Audit;
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
use Livewire\WithFileUploads;
use \Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;

ini_set('memory_limit', '7096M');
ini_set('max_execution_time', 9900);
set_time_limit(900000000);

class ShowObjetivoEstrategicoLivewire extends Component
{

    use WithPagination;
    use WithFileUploads;

    public $pdf;

    public $anoSelecionado = null;

    public $metaAno = null;

    public $dataChartMetaPrevista = null;
    public $dataChartMetaRealizada = null;

    public $pei = [];
    public $cod_pei = null;
    public $perspectiva = [];
    public $cod_perspectiva = null;
    public $planosAcao = [];
    public $planoAcao = [];
    public $cod_plano_de_acao = null;

    public $dsc_unidade_medida = null;

    public $vlr_realizado = null;
    public $txt_avaliacao = null;

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

    public $grafico;

    public $editarForm = false;
    public $deleteForm = false;
    public $audit = false;
    public $showModalInformacao = false;
    public $mensagemInformacao = null;
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

    public function grafico($cod_indicador = '') {

        $grafico = "<script>
        am4core.ready(function() {

            am4core.useTheme(am4themes_animated);

            var chart = am4core.create('chartdiv', am4charts.XYChart)
            chart.colors.step = 2;

            chart.legend = new am4charts.Legend()
            chart.legend.position = 'top'
            chart.legend.paddingBottom = 20
            chart.legend.labels.template.maxWidth = 95

            var xAxis = chart.xAxes.push(new am4charts.CategoryAxis())
            xAxis.dataFields.category = 'category'
            xAxis.renderer.cellStartLocation = 0.1
            xAxis.renderer.cellEndLocation = 0.9
            xAxis.renderer.grid.template.location = 0;

            var yAxis = chart.yAxes.push(new am4charts.ValueAxis());
            yAxis.min = 0;

            function createSeries(value, name) {
                var series = chart.series.push(new am4charts.ColumnSeries())
                series.dataFields.valueY = value
                series.dataFields.categoryX = 'category'
                series.name = name

                series.events.on('hidden', arrangeColumns);
                series.events.on('shown', arrangeColumns);

                var bullet = series.bullets.push(new am4charts.LabelBullet())
                bullet.interactionsEnabled = false
                bullet.dy = 30;
                bullet.label.text = '{valueY}'
                bullet.label.fill = am4core.color('#ffffff')

                return series;
            }

            chart.data = [
            {
                category: 'Place #1',
                first: 40,
                second: 55,
                third: 60
                },
                {
                    category: 'Place #2',
                    first: 30,
                    second: 78,
                    third: 69
                    },
                    {
                        category: 'Place #3',
                        first: 27,
                        second: 40,
                        third: 45
                        },
                        {
                            category: 'Place #4',
                            first: 50,
                            second: 33,
                            third: 22
                        }
                        ]


                        createSeries('first', 'The First');
                        createSeries('second', 'The Second');
                        createSeries('third', 'The Third');

                        function arrangeColumns() {

                            var series = chart.series.getIndex(0);

                            var w = 1 - xAxis.renderer.cellStartLocation - (1 - xAxis.renderer.cellEndLocation);
                            if (series.dataItems.length > 1) {
                                var x0 = xAxis.getX(series.dataItems.getIndex(0), 'categoryX');
                                var x1 = xAxis.getX(series.dataItems.getIndex(1), 'categoryX');
                                var delta = ((x1 - x0) / chart.series.length) * w;
                                if (am4core.isNumber(delta)) {
                                    var middle = chart.series.length / 2;

                                    var newIndex = 0;
                                    chart.series.each(function(series) {
                                        if (!series.isHidden && !series.isHiding) {
                                            series.dummyData = newIndex;
                                            newIndex++;
                                        }
                                        else {
                                            series.dummyData = chart.series.indexOf(series);
                                        }
                                        })
                                        var visibleCount = newIndex;
                                        var newMiddle = visibleCount / 2;

                                        chart.series.each(function(series) {
                                            var trueIndex = chart.series.indexOf(series);
                                            var newIndex = series.dummyData;

                                            var dx = (newIndex - trueIndex + middle - newMiddle) * delta

                                            series.animate({ property: 'dx', to: dx }, series.interpolationDuration, series.interpolationEasing);
                                            series.bulletsContainer.animate({ property: 'dx', to: dx }, series.interpolationDuration, series.interpolationEasing);
                                            })
                                        }
                                    }
                                }

                                })
                                </script><div id='chartdiv'></div>";

                                return $grafico;

                            }

                            public function editForm($cod_evolucao_indicador = '') {

                                $singleData = EvolucaoIndicador::find($cod_evolucao_indicador);

                                $this->cod_evolucao_indicador = $singleData->cod_evolucao_indicador;

                                $consultarIndicador = Indicador::find($singleData->cod_indicador);

                                $dsc_unidade_medida = $consultarIndicador->dsc_unidade_medida;

                                $this->dsc_unidade_medida = $consultarIndicador->dsc_unidade_medida;

                                $num_ano = $singleData->num_ano;
                                $num_mes = $singleData->num_mes;
                                $this->vlr_realizado = formatarValorConformeUnidadeMedida($dsc_unidade_medida,'MYSQL','PTBR',$singleData->vlr_realizado);

                                $this->txt_avaliacao = $singleData->txt_avaliacao;

                                $mensagemResultadoEdicao = '<div class="flex flex-wrap w-full"><div class="w-full md:w-1/4 px-3 mb-1 md:mb-0 pt-3"><div class="col-span-6 sm:col-span-4"><label class="block font-medium text-sm text-gray-700 mb-2">Valor realizado de '.mesNumeralParaExtenso($num_mes).'/'.$num_ano.'</label><input type="text" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-0 pt-2 pl-2 h-9 text-right" id="vlr_realizado" name="vlr_realizado" wire:model="vlr_realizado" required><script type="text/javascript">var unidadeMedida = "'.$this->dsc_unidade_medida.'";if(unidadeMedida == "Quantidade") {$("#vlr_realizado").mask("000.000.000.000.000",{reverse: true, selectOnFocus: true});} else if(unidadeMedida == "Porcentagem") {$("#vlr_realizado").mask("000,00",{reverse: true, selectOnFocus: true});} else if(unidadeMedida == "Dinheiro") {$("#vlr_realizado").mask("000.000.000.000.000,00",{reverse: true, selectOnFocus: true});}</script></div></div>

                                <div class="w-full md:w-3/4 px-3 mb-1 md:mb-0 pt-3"><div class="col-span-6 sm:col-span-4"><label class="block font-medium text-sm text-gray-700 mb-2">Avaliação qualitativa</label><textarea class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm pt-2 pl-2" id="txt_avaliacao" name="txt_avaliacao" rows="5" wire:model="txt_avaliacao" style="width: 100%"></textarea></div></div>

                                </div></form>';

                                $this->showModalResultadoEdicao = true;

                                $this->mensagemResultadoEdicao = $mensagemResultadoEdicao;

                                $this->editarForm = false;

                            }

                            protected $rules = [
                                'vlr_realizado' => 'required',
                            ];

                            protected $messages = [
                                'vlr_realizado.required' => 'O campo Valor realizado é de preenchimento obrigatório.',
                            ];

                            public function updated($propertyName)
                            {
                                $this->validateOnly($propertyName);
                            }

                            public function create() {

                                $validatedData = Validator::make(
                                    ['vlr_realizado' => $this->vlr_realizado],
                                    ['vlr_realizado' => 'required'],
                                    ['required' => 'O campo Valor realizado é de preenchimento obrigatório.'],
                                )->validate();

                                if(isset($this->cod_evolucao_indicador) && !is_null($this->cod_evolucao_indicador) && $this->cod_evolucao_indicador != '') {

                                    $consultarEvolucaoIndicador = EvolucaoIndicador::find($this->cod_evolucao_indicador);

                                    $alteracao = [];
                                    $modificacoes = '';

                                    if(is_null($consultarEvolucaoIndicador->vlr_realizado)) {

                                        $alteracao['vlr_realizado'] = formatarValorConformeUnidadeMedida($this->dsc_unidade_medida,'PTBR','MYSQL',$this->vlr_realizado);

                                        $modificacoes = $modificacoes . "Inseriu para ".mesNumeralParaExtenso($consultarEvolucaoIndicador->num_mes)."/".$consultarEvolucaoIndicador->num_ano." o valor realizado de <span class='text-green-800'>".$this->vlr_realizado."</span><br /><br />";

                                    } else {

                                        if($consultarEvolucaoIndicador->vlr_realizado != formatarValorConformeUnidadeMedida($this->dsc_unidade_medida,'PTBR','MYSQL',$this->vlr_realizado)) {

                                            $alteracao['vlr_realizado'] = formatarValorConformeUnidadeMedida($this->dsc_unidade_medida,'PTBR','MYSQL',$this->vlr_realizado);

                                            $audit = Audit::create(array(
                                                'table' => 'tab_evolucao_indicador',
                                                'table_id' => $this->cod_evolucao_indicador,
                                                'column_name' => 'vlr_realizado',
                                                'data_type' => 'numeric',
                                                'ip' => $_SERVER['REMOTE_ADDR'],
                                                'user_id' => Auth::user()->id,
                                                'acao' => 'Editou',
                                                'antes' => formatarValorConformeUnidadeMedida($this->dsc_unidade_medida,'MYSQL','PTBR',$consultarEvolucaoIndicador->vlr_realizado),
                                                'depois' => $this->vlr_realizado
                                            ));

                                            $modificacoes = $modificacoes . "Alterou o valor realizado de <span class='text-green-800'><strong>".formatarValorConformeUnidadeMedida($this->dsc_unidade_medida,'MYSQL','PTBR',$consultarEvolucaoIndicador->vlr_realizado)."</strong></span> para <span class='text-green-800'><strong>".$this->vlr_realizado."</strong></span> no mês de ".mesNumeralParaExtenso($consultarEvolucaoIndicador->num_mes)."/".$consultarEvolucaoIndicador->num_ano."<br /><br />";

                                        }

                                    }

                                    if(is_null($consultarEvolucaoIndicador->txt_avaliacao) && is_null($this->txt_avaliacao)) {

                // 

                                    } elseif(is_null($consultarEvolucaoIndicador->txt_avaliacao) && !is_null($this->txt_avaliacao)) {

                                        $alteracao['txt_avaliacao'] = $this->txt_avaliacao;

                                        $modificacoes = $modificacoes . "Inseriu para ".mesNumeralParaExtenso($consultarEvolucaoIndicador->num_mes)."/".$consultarEvolucaoIndicador->num_ano." a seguinte Avaliação Qualitativa<br /><br /><span class='text-green-800'>".nl2br($this->txt_avaliacao)."</span><br /><br />";

                                    } else {

                                        if($consultarEvolucaoIndicador->txt_avaliacao != $this->txt_avaliacao) {

                                            $alteracao['txt_avaliacao'] = $this->txt_avaliacao;

                                            $audit = Audit::create(array(
                                                'table' => 'tab_evolucao_indicador',
                                                'table_id' => $this->cod_evolucao_indicador,
                                                'column_name' => 'txt_avaliacao',
                                                'data_type' => 'numeric',
                                                'ip' => $_SERVER['REMOTE_ADDR'],
                                                'user_id' => Auth::user()->id,
                                                'acao' => 'Editou',
                                                'antes' => $consultarEvolucaoIndicador->txt_avaliacao,
                                                'depois' => $this->txt_avaliacao
                                            ));

                                            $modificacoes = $modificacoes . "Alterou a Avaliação Qualitativa do mês de ".mesNumeralParaExtenso($consultarEvolucaoIndicador->num_mes)."/".$consultarEvolucaoIndicador->num_ano."<br /><br />De <span class='text-red-600'>".nl2br($consultarEvolucaoIndicador->txt_avaliacao)."</span><br /><br />Para <span class='text-green-600'>".nl2br($this->txt_avaliacao)."</span><br /><br />";

                                        }

                                    }

                                }

                                if(isset($modificacoes) && !is_null($modificacoes) && $modificacoes != '') {

                                    $alteracao['bln_atualizado'] = '1';

                                    $consultarEvolucaoIndicador->update($alteracao);

                                    $acao = Acoes::create(array(
                                        'table' => 'tab_evolucao_indicador',
                                        'table_id' => $this->cod_evolucao_indicador,
                                        'user_id' => Auth::user()->id,
                                        'acao' => $modificacoes
                                    ));

                                    $this->showModalInformacao = true;
                                    $this->mensagemInformacao = $modificacoes;

                                } else {

                                    $this->showModalInformacao = true;

                                    $this->mensagemInformacao = 'Nada foi feito, por não ter nenhuma modificação.';

                                }

                                $this->vlr_realizado = null;

                                $this->txt_avaliacao = null;

                                $this->mensagemResultadoEdicao = null;

                                $this->showModalResultadoEdicao = false;

                                $this->editarForm = false;

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

                                $dataChartMetaPrevista = '';
                                $dataChartMetaRealizada = '';

                                if($indicador) {

                                    if($indicador->evolucaoIndicador->count() > 0) {

                                        foreach($indicador->metaAno as $metaAno) {

                                            if($metaAno->num_ano == $this->ano) {

                                                $this->metaAno = $metaAno->meta;

                                            }

                                        }

                                        foreach($indicador->evolucaoIndicador as $evolucaoIndicador) {

                                            if($evolucaoIndicador->num_ano == $this->ano) {

                                                $dataChartMetaPrevista = $dataChartMetaPrevista.$evolucaoIndicador->vlr_previsto.',';

                                                $dataChartMetaRealizada = $dataChartMetaRealizada.$evolucaoIndicador->vlr_realizado.',';

                                            }

                                        }

                                        $this->dataChartMetaPrevista = trim($dataChartMetaPrevista,',');
                                        $this->dataChartMetaRealizada = trim($dataChartMetaRealizada,',');

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
