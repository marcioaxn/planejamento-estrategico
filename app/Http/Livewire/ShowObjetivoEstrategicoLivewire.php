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
use App\Models\Arquivo;
use App\Models\RelArquivoOrigem;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use \Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Livewire\CalculoLivewire;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

ini_set('memory_limit', '7096M');
ini_set('max_execution_time', 9900);
set_time_limit(900000000);

class ShowObjetivoEstrategicoLivewire extends Component
{

    use WithPagination,WithFileUploads;

    public $formIncluirPdf = null;
    public $txt_assunto = null;
    public $pdf;

    public $organization = null;
    public $cod_organizacao = null;
    public $cod_organizacao_select = null;

    public $cod_plano_de_acao_identificado = null;

    public $anoSelecionado = null;

    public $metaAno = null;

    public $totalRealizado = null;

    public $abrirIndicador = false;

    public $dataChartMetaPrevista = null;
    public $dataChartMetaRealizada = null;
    public $dataChartLinhaBase = null;

    public $linhaBase = null;

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

    public $calcularAcumuladoPlanoDeAcao;
    public $calcularAcumuladoIndicador;
    public $obterResultadoComValorRealizadoEValorPrevisto;

    public $calculoMensal = null;

    public $cod_evolucao_indicador = null;

    public $liberarAcessoParaAtualizar = false;

    public $getGrauSatisfacao = null;

    public $grau_satisfacao = null;

    public $hierarquiaUnidade = null;

    public $grafico;

    public $showModalIncluirPdf = false;

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

    public function mount(SessionManager $session, Request $request, $ano, $cod_organizacao = '',$cod_perspectiva = '',$cod_objetivo_estrategico = '',$cod_plano_de_acao = '')
    {
        $this->ano = $ano;

        $this->anoSelecionado = $ano;

        if(isset($cod_organizacao) && !is_null($cod_organizacao) && $cod_organizacao != '') {

            $this->cod_organizacao = $cod_organizacao;

            $this->cod_plano_de_acao = null;

            Session()->forget('cod_plano_de_acao_identificado');

        } else {

            $this->cod_organizacao = null;

            $this->cod_plano_de_acao = null;

            Session()->forget('cod_plano_de_acao_identificado');

        }

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

    public function abrirModalIncluirPdf($cod_evolucao_indicador = '') {

        $consultarEvolucaoIndicador = EvolucaoIndicador::find($cod_evolucao_indicador);

        $this->cod_evolucao_indicador = $cod_evolucao_indicador;

        $this->formIncluirPdf = '<div class="flex flex-wrap w-full"><div class="w-full md:w-1/4 px-3 mb-1 md:mb-0 pt-3"><div class="col-span-6 sm:col-span-4"><label class="block font-medium text-sm text-gray-700 mb-2">Selecione o PDF o qual deseja inserir para '.mesNumeralParaExtenso($consultarEvolucaoIndicador->num_mes).'/'.$this->anoSelecionado.'</label><input type="file" wire:model="pdf"></div></div>

        <div class="w-full md:w-3/4 px-3 mb-1 md:mb-0 pt-3"><div class="col-span-6 sm:col-span-4"><label class="block font-medium text-sm text-gray-700 mb-2">Assunto de que trata o arquivo PDF</label><input type="text" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-right pl-3" name="txt_assunto" id="txt_assunto" wire:model="txt_assunto" ></div></div>

        </div></form>';

        $this->showModalIncluirPdf = true;

    }

    public function downloadPdf(Arquivo $pdf) {

        $content = base64_decode($pdf->data);
        return response($content)->header('Content-Type', $pdf->dsc_tipo);

    }

    protected $validationAttributes = [
        'pdf' => 'arquivo',
        'txt_assunto' => 'Assunto de que trata o arquivo PDF'
    ];

    public function savePdf(Request $request)
    {

        $this->validate([
            'pdf' => 'required|mimes:pdf|max:30000',
            'txt_assunto' => 'required'
        ]);

        $nome = $this->pdf->hashName();
        $tipo = $this->pdf->getMimeType();
        $data = base64_encode(file_get_contents($this->pdf->getRealPath()));

        $up = new Arquivo;

        $up->dsc_nome_arquivo = $nome;
        $up->dsc_tipo = $tipo;
        $up->data = $data;
        $up->txt_assunto = $this->txt_assunto;
        $up->cod_evolucao_indicador = $this->cod_evolucao_indicador;

        if(isset($data) && !is_null($data) && $data != '') {

            $up->save();
        }

        $this->showModalIncluirPdf = false;

        $this->showModalInformacao = true;
        $this->mensagemInformacao = "Aquivo ".$nome." foi gravado com sucesso.";
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

        Session()->forget('cod_plano_de_acao_identificado');

        $this->cod_plano_de_acao = $this->cod_plano_de_acao;

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
        ->where('cod_organizacao',$this->cod_organizacao)
        ->whereYear('dte_inicio','<=',$anoSelecionado)
        ->whereYear('dte_fim','>=',$anoSelecionado)
        ->get();

        $cods_plano_de_acao = '';

        foreach($planosAcao as $result) {

            $cods_plano_de_acao = $cods_plano_de_acao.$result->cod_plano_de_acao.',';

        }

        $cods_plano_de_acao = trim($cods_plano_de_acao,',');

        $cods_plano_de_acao = explode(',', $cods_plano_de_acao);

        if(!in_array($this->cod_plano_de_acao, $cods_plano_de_acao)) {

            $this->cod_plano_de_acao = null;

        }

        $this->planosAcao = $planosAcao;

        if(!is_null($this->planosAcao)) {

            $contPlanoAcaoInterno = 0;

            foreach($this->planosAcao as $resultPlanosAcao) {

                if($contPlanoAcaoInterno == 0) {

                    $this->cod_plano_de_acao_identificado = $resultPlanosAcao->cod_plano_de_acao;

                    Session()->put('cod_plano_de_acao_identificado', $this->cod_plano_de_acao_identificado);

                }

            }

        } else {

            Session()->forget('cod_plano_de_acao_identificado');

        }

        $planoAcao = PlanoAcao::orderBy('num_nivel_hierarquico_apresentacao')
        ->with('tipoExecucao','servidorResponsavel','servidorSubstituto','indicadores','indicadores.evolucaoIndicador')
        ->where('cod_organizacao',$this->cod_organizacao)
        ->where('cod_objetivo_estrategico',$this->cod_objetivo_estrategico)
        ->whereYear('dte_inicio','<=',$anoSelecionado)
        ->whereYear('dte_fim','>=',$anoSelecionado);

        if(isset($this->cod_plano_de_acao) && !is_null($this->cod_plano_de_acao) && $this->cod_plano_de_acao != '') {

            $planoAcao = $planoAcao->find($this->cod_plano_de_acao);

        } else {

            $planoAcao = $planoAcao->first();

        }

        $this->planoAcao = $planoAcao;

        if($planoAcao) {

            if($planoAcao->indicadores->count() > 0) {

                $this->abrirIndicador = true;

            }

        }

        if(!is_null($planoAcao) && !is_null($planoAcao->indicadores)) {

            if(is_null($this->cod_indicador_selecionado)) {

                $contIndicador = 1;

                if(!is_null($planoAcao)) {

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

            if(isset($this->cod_indicador) && !is_null($this->cod_indicador) && $this->cod_indicador != '') {

                $indicador = Indicador::with('linhaBase','metaAno','evolucaoIndicador','evolucaoIndicador.arquivos')
                ->orderBy('dsc_indicador');

                if(isset($this->cod_plano_de_acao) && !is_null($this->cod_plano_de_acao) && $this->cod_plano_de_acao != '') {

                    $indicador = $indicador->where('cod_plano_de_acao',$this->cod_plano_de_acao);

                }

            }

            if(!is_null($this->cod_indicador)) {

                $indicador = $indicador->find($this->cod_indicador);

                if($indicador) {

                    $this->indicador = $indicador;

                } else {

                    $this->indicador = [];

                }

                $num_linha_base = '';

                if($indicador) {

                    foreach($indicador->linhaBase as $linhaBase) {

                        $num_linha_base = $linhaBase->num_linha_base;
    
                    }

                }
                
                $this->linhaBase = $num_linha_base;

                $dataChartMetaPrevista = '';
                $dataChartMetaRealizada = '';
                $dataChartLinhaBase = '';

                if(!is_null($planoAcao)) {

                    if($indicador) {

                        if($indicador->evolucaoIndicador->count() > 0) {

                            foreach($indicador->metaAno as $metaAno) {

                                if($metaAno->num_ano == $this->ano) {

                                    $this->metaAno = $metaAno->meta;

                                }

                            }

                            $somaPrevisto = 0;
                            $somaRealizado = 0;

                            $anoVigente = date('Y');

                            $time = strtotime(date('Y-m-d'));
                            $mesAnterior = (date("n", strtotime("-1 month", $time)))*1;

                            foreach($indicador->evolucaoIndicador as $evolucaoIndicador) {

                                if($evolucaoIndicador->num_ano == $this->ano) {

                                    $dataChartLinhaBase = $dataChartLinhaBase.$num_linha_base.',';

                                    if($indicador->bln_acumulado === 'Sim') {

                                        $somaPrevisto = $somaPrevisto + $evolucaoIndicador->vlr_previsto;

                                        if(isset($evolucaoIndicador->bln_atualizado) && !is_null($evolucaoIndicador->bln_atualizado && $evolucaoIndicador->bln_atualizado != '')) {

                                            $somaRealizado = $somaRealizado + $evolucaoIndicador->vlr_realizado;

                                            $dataChartMetaRealizada = $dataChartMetaRealizada.$somaRealizado.',';

                                        } else {

                                            if($anoVigente != $this->anoSelecionado) {

                                                $somaRealizado = $somaRealizado + $evolucaoIndicador->vlr_realizado;

                                                $dataChartMetaRealizada = $dataChartMetaRealizada.$somaRealizado.',';

                                            }

                                        }

                                        $dataChartMetaPrevista = $dataChartMetaPrevista.$somaPrevisto.',';



                                    } else {

                                        $dataChartMetaPrevista = $dataChartMetaPrevista.$evolucaoIndicador->vlr_previsto.',';

                                        $dataChartMetaRealizada = $dataChartMetaRealizada.$evolucaoIndicador->vlr_realizado.',';

                                    }

                                }

                            }

                            $this->dataChartMetaPrevista = trim($dataChartMetaPrevista,',');
                            $this->dataChartMetaRealizada = trim($dataChartMetaRealizada,',');
                            $this->dataChartLinhaBase = trim($dataChartLinhaBase,',');

                        }

                    }

                }

            } else {

                $this->indicador = [];

            }

        }

        $this->grau_satisfacao = $this->grauSatisfacao();

        return view('livewire.show-objetivo-estrategico-livewire',['ano' => $this->ano,'cod_organizacao' => $this->cod_organizacao]);
    }

    protected function calcularAcumuladoPlanoDeAcao($cod_plano_de_acao = '',$anoSelecionado = '') {

        $calcular = new CalculoLivewire;

        $result = $calcular->calcularAcumuladoPlanoDeAcao($cod_plano_de_acao,$anoSelecionado);

        return $result;

    }

    protected function calcularAcumuladoIndicador($cod_indicador = '',$anoSelecionado = '') {

        $calcular = new CalculoLivewire;

        $result = $calcular->calcularAcumuladoIndicador($cod_indicador,$anoSelecionado);

        return $result;

    }

    protected function obterResultadoComValorRealizadoEValorPrevisto($dsc_tipo = '',$vlr_realizado = '',$vlr_previsto = '') {

        // Possíveis variáveis para o emitir o resultado:
        // $tipoCalculo,$cod_perspectiva,$cod_objetivo_estrategico,$cod_plano_de_acao,$cod_indicador,$mes

        $obterResultadoComValorRealizadoEValorPrevisto = new CalculoLivewire;

        $result = $obterResultadoComValorRealizadoEValorPrevisto->obterResultadoComValorRealizadoEValorPrevisto($dsc_tipo,$vlr_realizado,$vlr_previsto);

        return $result;

    }

    protected function getGrauSatisfacao($percentual = 0) {

        $resultado = [];

        $resultado['grau_de_satisfacao'] = 'gray';

        $consultarGrauSatisfacao = GrauSatisfacao::where('vlr_maximo','>=',$percentual)
        ->where('vlr_minimo','<=',$percentual)
        ->first();

        if(!is_null($consultarGrauSatisfacao)) {

            if($percentual < 0) {

                $resultado['grau_de_satisfacao'] = 'red';

            } elseif($percentual > 100) {

                $resultado['grau_de_satisfacao'] = 'green';

            } else {

                $resultado['grau_de_satisfacao'] = $consultarGrauSatisfacao->cor;

            }

        } else {

            if($percentual < 0) {

                $resultado['grau_de_satisfacao'] = 'red';

            } elseif($percentual > 100) {

                $resultado['grau_de_satisfacao'] = 'green';

            } else {

                $resultado['grau_de_satisfacao'] = $consultarGrauSatisfacao->cor;

            }

        }

        $resultado['color'] = 'white';

        if(!is_null($consultarGrauSatisfacao)) {

            if($consultarGrauSatisfacao->cor === 'yellow') {

                $resultado['color'] = 'black';

            }

        } else {

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

                $color = 'black';

            }

            $montagemGrauSatisfacao .= '<div class="px-1 py-1 pl-3 font-semibold rounded-md border-1 text-'.$color.' bg-'.$grauSatisfacao->cor.'-500 text-sm antialiased sm:subpixel-antialiased md:antialiased">'.$grauSatisfacao->dsc_grau_satisfcao.' de '.converteValor('MYSQL','PTBR',$grauSatisfacao->vlr_minimo).'% a '.converteValor('MYSQL','PTBR',$grauSatisfacao->vlr_maximo).'%</div>';

        }

        $montagemGrauSatisfacao .= '<div class="px-1 py-1 pl-3 font-semibold rounded-md border-1 text-white bg-gray-500 text-sm antialiased sm:subpixel-antialiased md:antialiased">Sem meta prevista para o período</div>';

        $montagemGrauSatisfacao .= '<div class="px-1 py-1 pl-3 font-semibold rounded-md border-1 text-white bg-pink-800 text-sm antialiased sm:subpixel-antialiased md:antialiased">Não houve o preenchimento</div>';

        return $montagemGrauSatisfacao;

    }
}
