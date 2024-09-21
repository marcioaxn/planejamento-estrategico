<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Acoes;
use App\Models\Audit;
use App\Models\Pei;
use App\Models\Organization;
use App\Models\RelOrganization;
use App\Models\MissaoVisao;
use App\Models\Perspectiva;
use App\Models\ObjetivoEstrategico;
use App\Models\IndicadorObjetivoEstrategico;
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

use App\Http\Livewire\PlanejamentoEstrategicoIntegrado;
use App\Http\Livewire\PerspectivaLivewire;

ini_set('memory_limit', '7096M');
ini_set('max_execution_time', 9900);
set_time_limit(900000000);

class ShowObjetivoEstrategicoLivewire extends Component
{

    use WithFileUploads;

    public $cod_origem = null;

    public $formIncluirPdf = null;
    public $txt_assunto = null;
    public $pdf;

    public $organization = null;
    public $cod_organizacao = null;
    public $cod_organizacao_select = null;

    public $cod_plano_de_acao_identificado = null;

    public $anoSelecionado = null;

    public $getUserAuth = null;

    public $metaAno = null;

    public $totalRealizado = null;

    public $abrirIndicador = false;

    public $dataChartMetaPrevista = null;
    public $dataChartMetaRealizada = null;
    public $dataChartLinhaBase = null;

    public $linhaBase = null;

    public $pei = null;
    public $cod_pei = null;
    public $perspectiva = null;
    public $cod_perspectiva = null;
    public $collectionPlanosAcao = null;
    public $planoAcao = null;
    public $collectionPlanoAcao = null;
    public $cod_plano_de_acao = null;

    public $dsc_unidade_medida = null;

    public $vlr_realizado = null;
    public $txt_avaliacao = null;

    public $objetivoEstragicoPluck = null;

    public $objetivoEstragico = null;

    public $indicadoresObjetivoEstrategico = null;

    public $cod_indicador_objetivo_estrategico_selecionado = null;

    public $indicador = null;
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

    public function mount(SessionManager $session, Request $request, $ano, $cod_origem, $cod_organizacao = '', $cod_perspectiva = '', $cod_objetivo_estrategico = '', $cod_plano_de_acao = '')
    {
        $this->ano = $ano;

        $this->anoSelecionado = $ano;

        /** $cod_origem:
         * e37b40bf-4852-4fc7-8d0a-1cb6243ae9b6 a origem é indicadores do objetivo estratégico
         * 3ac5e10e-8960-4b7c-a1cf-455597c875a7 a origem é plano de ação
         */

        if (isset($cod_origem) && !empty($cod_origem)) {

            $this->cod_origem = $cod_origem;

        }

        if (isset($cod_organizacao) && !is_null($cod_organizacao) && $cod_organizacao != '') {

            $this->cod_organizacao = $cod_organizacao;

            $this->cod_plano_de_acao = null;

            Session()->forget('cod_plano_de_acao_identificado');

        } else {

            $this->cod_organizacao = null;

            $this->cod_plano_de_acao = null;

            Session()->forget('cod_plano_de_acao_identificado');

        }

        if (isset($cod_perspectiva) && !is_null($cod_perspectiva) && $cod_perspectiva != '') {

            $this->cod_perspectiva = $cod_perspectiva;

        } else {

            $this->cod_perspectiva = null;

        }

        if (isset($cod_objetivo_estrategico) && !is_null($cod_objetivo_estrategico) && $cod_objetivo_estrategico != '') {

            $this->cod_objetivo_estrategico = $cod_objetivo_estrategico;

        } else {

            $this->cod_objetivo_estrategico = null;

        }

        if (isset($cod_plano_de_acao) && !is_null($cod_plano_de_acao) && $cod_plano_de_acao != '') {

            $this->cod_plano_de_acao = $cod_plano_de_acao;

        } else {

            $this->cod_plano_de_acao = null;

        }

        $session->put("ano", $this->ano);

    }

    public function getObjetivoEstrategico($codObjetivoEstrategico = null)
    {
        if (isset($codObjetivoEstrategico) && !empty($codObjetivoEstrategico)) {
            return ObjetivoEstrategico::with('fututosAlmejados', 'primeiroIndicador', 'primeiroIndicador.linhaBase', 'primeiroIndicador.metaAno', 'primeiroIndicador.evolucaoIndicador')
                ->find($codObjetivoEstrategico);
        } else {
            return null;
        }
    }

    public function instanciarPlanejamentoEstrategicoIntegrado()
    {
        return new PlanejamentoEstrategicoIntegrado;
    }

    public function instanciarPerspectivaLivewire()
    {
        return new PerspectivaLivewire;
    }

    public function abrirModalIncluirPdf($cod_evolucao_indicador = '')
    {

        $consultarEvolucaoIndicador = EvolucaoIndicador::find($cod_evolucao_indicador);

        $this->cod_evolucao_indicador = $cod_evolucao_indicador;

        $this->formIncluirPdf = '<div class="flex flex-wrap w-full"><div class="w-full md:w-1/4 px-3 mb-1 md:mb-0 pt-3"><div class="col-span-6 sm:col-span-4"><label class="block font-medium text-sm text-gray-700 mb-2">Selecione o PDF o qual deseja inserir para ' . mesNumeralParaExtenso($consultarEvolucaoIndicador->num_mes) . '/' . $this->anoSelecionado . '</label><input type="file" wire:model="pdf"></div></div>

        <div class="w-full md:w-3/4 px-3 mb-1 md:mb-0 pt-3"><div class="col-span-6 sm:col-span-4"><label class="block font-medium text-sm text-gray-700 mb-2">Assunto de que trata o arquivo PDF</label><input type="text" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-right pl-3" name="txt_assunto" id="txt_assunto" wire:model="txt_assunto" ></div></div>

        </div></form>';

        $this->showModalIncluirPdf = true;

    }

    public function downloadPdf(Arquivo $pdf)
    {

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

        if (isset($data) && !is_null($data) && $data != '') {

            $up->save();
        }

        $this->showModalIncluirPdf = false;

        $this->showModalInformacao = true;
        $this->mensagemInformacao = "Aquivo " . $nome . " foi gravado com sucesso.";
    }

    public function editForm($cod_evolucao_indicador = '')
    {

        $singleData = EvolucaoIndicador::find($cod_evolucao_indicador);

        $this->cod_evolucao_indicador = $singleData->cod_evolucao_indicador;

        $consultarIndicador = Indicador::find($singleData->cod_indicador);

        $dsc_unidade_medida = $consultarIndicador->dsc_unidade_medida;

        $this->dsc_unidade_medida = $consultarIndicador->dsc_unidade_medida;

        $num_ano = $singleData->num_ano;
        $num_mes = $singleData->num_mes;
        $this->vlr_realizado = formatarValorConformeUnidadeMedida($dsc_unidade_medida, 'MYSQL', 'PTBR', $singleData->vlr_realizado);

        $this->txt_avaliacao = $singleData->txt_avaliacao;

        $mensagemResultadoEdicao = '<div class="flex flex-wrap w-full"><div class="w-full md:w-1/4 px-3 mb-1 md:mb-0 pt-3"><div class="col-span-6 sm:col-span-4"><label class="block font-medium text-sm text-gray-700 mb-2">Valor realizado de ' . mesNumeralParaExtenso($num_mes) . '/' . $num_ano . '</label><input type="text" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-0 pt-2 pl-2 h-9 text-right" id="vlr_realizado" name="vlr_realizado" wire:model.defer="vlr_realizado" required><script type="text/javascript">var unidadeMedida = "' . $this->dsc_unidade_medida . '";if(unidadeMedida == "Quantidade") {$("#vlr_realizado").mask("000.000.000.000.000",{reverse: true, selectOnFocus: true});} else if(unidadeMedida == "Porcentagem") {$("#vlr_realizado").mask("000,00",{reverse: true, selectOnFocus: true});} else if(unidadeMedida == "Dinheiro") {$("#vlr_realizado").mask("000.000.000.000.000,00",{reverse: true, selectOnFocus: true});}</script></div></div>


        <div class="w-full md:w-3/4 px-3 mb-1 md:mb-0 pt-3"><div class="col-span-6 sm:col-span-4"><label class="block font-medium text-sm text-gray-700 mb-2">Avaliação qualitativa</label><textarea class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm pt-2 pl-2" id="txt_avaliacao" name="txt_avaliacao" rows="5" wire:model.defer="txt_avaliacao" style="width: 100%"></textarea></div></div>

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

    public function create()
    {

        $validatedData = Validator::make(
            ['vlr_realizado' => $this->vlr_realizado],
            ['vlr_realizado' => 'required'],
            ['required' => 'O campo Valor realizado é de preenchimento obrigatório.'],
        )->validate();

        if (isset($this->cod_evolucao_indicador) && !is_null($this->cod_evolucao_indicador) && $this->cod_evolucao_indicador != '') {

            $consultarEvolucaoIndicador = EvolucaoIndicador::find($this->cod_evolucao_indicador);

            $alteracao = null;
            $modificacoes = '';

            if (is_null($consultarEvolucaoIndicador->vlr_realizado)) {

                $alteracao['vlr_realizado'] = formatarValorConformeUnidadeMedida($this->dsc_unidade_medida, 'PTBR', 'MYSQL', $this->vlr_realizado);

                $modificacoes = $modificacoes . "Inseriu para " . mesNumeralParaExtenso($consultarEvolucaoIndicador->num_mes) . "/" . $consultarEvolucaoIndicador->num_ano . " o valor realizado de <span class='text-green-800'>" . $this->vlr_realizado . "</span><br /><br />";

            } else {

                if ($consultarEvolucaoIndicador->vlr_realizado != formatarValorConformeUnidadeMedida($this->dsc_unidade_medida, 'PTBR', 'MYSQL', $this->vlr_realizado)) {

                    $alteracao['vlr_realizado'] = formatarValorConformeUnidadeMedida($this->dsc_unidade_medida, 'PTBR', 'MYSQL', $this->vlr_realizado);

                    $audit = Audit::create(
                        array(
                            'table' => 'tab_evolucao_indicador',
                            'table_id' => $this->cod_evolucao_indicador,
                            'column_name' => 'vlr_realizado',
                            'data_type' => 'numeric',
                            'ip' => $_SERVER['REMOTE_ADDR'],
                            'user_id' => Auth::user()->id,
                            'acao' => 'Editou',
                            'antes' => formatarValorConformeUnidadeMedida($this->dsc_unidade_medida, 'MYSQL', 'PTBR', $consultarEvolucaoIndicador->vlr_realizado),
                            'depois' => $this->vlr_realizado
                        )
                    );

                    $modificacoes = $modificacoes . "Alterou o valor realizado de <span class='text-green-800'><strong>" . formatarValorConformeUnidadeMedida($this->dsc_unidade_medida, 'MYSQL', 'PTBR', $consultarEvolucaoIndicador->vlr_realizado) . "</strong></span> para <span class='text-green-800'><strong>" . $this->vlr_realizado . "</strong></span> no mês de " . mesNumeralParaExtenso($consultarEvolucaoIndicador->num_mes) . "/" . $consultarEvolucaoIndicador->num_ano . "<br /><br />";

                }

            }

            if (is_null($consultarEvolucaoIndicador->txt_avaliacao) && is_null($this->txt_avaliacao)) {

                //

            } elseif (is_null($consultarEvolucaoIndicador->txt_avaliacao) && !is_null($this->txt_avaliacao)) {

                $alteracao['txt_avaliacao'] = $this->txt_avaliacao;

                $modificacoes = $modificacoes . "Inseriu para " . mesNumeralParaExtenso($consultarEvolucaoIndicador->num_mes) . "/" . $consultarEvolucaoIndicador->num_ano . " a seguinte Avaliação Qualitativa<br /><br /><span class='text-green-800'>" . nl2br($this->txt_avaliacao) . "</span><br /><br />";

            } else {

                if ($consultarEvolucaoIndicador->txt_avaliacao != $this->txt_avaliacao) {

                    $alteracao['txt_avaliacao'] = $this->txt_avaliacao;

                    $audit = Audit::create(
                        array(
                            'table' => 'tab_evolucao_indicador',
                            'table_id' => $this->cod_evolucao_indicador,
                            'column_name' => 'txt_avaliacao',
                            'data_type' => 'numeric',
                            'ip' => $_SERVER['REMOTE_ADDR'],
                            'user_id' => Auth::user()->id,
                            'acao' => 'Editou',
                            'antes' => $consultarEvolucaoIndicador->txt_avaliacao,
                            'depois' => $this->txt_avaliacao
                        )
                    );

                    $modificacoes = $modificacoes . "Alterou a Avaliação Qualitativa do mês de " . mesNumeralParaExtenso($consultarEvolucaoIndicador->num_mes) . "/" . $consultarEvolucaoIndicador->num_ano . "<br /><br />De <span class='text-red-600'>" . nl2br($consultarEvolucaoIndicador->txt_avaliacao) . "</span><br /><br />Para <span class='text-green-600'>" . nl2br($this->txt_avaliacao) . "</span><br /><br />";

                }

            }

        }

        if (isset($modificacoes) && !is_null($modificacoes) && $modificacoes != '') {

            $alteracao['bln_atualizado'] = '1';

            $consultarEvolucaoIndicador->update($alteracao);

            $acao = Acoes::create(
                array(
                    'table' => 'tab_evolucao_indicador',
                    'table_id' => $this->cod_evolucao_indicador,
                    'user_id' => Auth::user()->id,
                    'acao' => $modificacoes
                )
            );

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

        /**
         * Nesta página será visualizada quatro partes necessárias:
         * 1ª parte de cabeçalho contendo o título, a Unidade da Organização, a perspectiva e os atributos
         * do objetivo estratégico selecionado;
         *
         * 2ª parte contendo o Plano de Ação e todos os seus atributos, que contempla as Ações, as Iniciativas e os Projetos relacionados
         * ao Objetivo Estratégico;
         *
         * 3ª é uma sub parte dentro da 2ª parte e dentro dela estará contido os indicadores do Plano de Ação;
         *
         * 4ª parte contendo os indicadores relacionados ao Objetivo Estratégico e todos os atributos desses indicadores.
         *
         * Necessário garantir que a página e todos os componentes possam ser
         * visualizados na maioria dos devices disponíveis.
         */

        /**
         * Início da 1ª parte
         */

        Session()->forget('cod_plano_de_acao_identificado');

        $perspectivaLivewire = $this->instanciarPerspectivaLivewire();

        $this->perspectiva = $perspectivaLivewire->getPerspectiva($this->cod_perspectiva);

        $pei = $this->instanciarPlanejamentoEstrategicoIntegrado();

        $this->pei = $pei->getPei($this->perspectiva->cod_pei);

        $organization = Organization::whereRaw('cod_organizacao = rel_cod_organizacao')->get();
        $organizationChild = Organization::whereRaw('cod_organizacao != rel_cod_organizacao')->orderBy('nom_organizacao')->get();

        $organizacoes = null;

        foreach ($organization as $result) {
            $this->processarOrganizacao($result, $organizacoes, $organizationChild);
        }

        $this->organization = $organizacoes;

        $objetivoEstrategico = ObjetivoEstrategico::select('nom_objetivo_estrategico', 'cod_objetivo_estrategico');

        if (isset($this->cod_perspectiva) && !is_null($this->cod_perspectiva) && $this->cod_perspectiva != '' && $this->perspectiva->count() > 0) {

            $objetivoEstrategico = $objetivoEstrategico->where('cod_perspectiva', $this->cod_perspectiva);

        } else {

            $objetivoEstrategico = $objetivoEstrategico->whereNull('cod_perspectiva');

        }

        $anoSelecionado = $this->anoSelecionado;

        // Tirar este trecho
        $objetivoEstrategico = $objetivoEstrategico->orderBy('num_nivel_hierarquico_apresentacao')
            ->with('perspectiva')
            ->pluck('nom_objetivo_estrategico', 'cod_objetivo_estrategico');
        // Tirar esse trecho

        $this->objetivoEstragicoPluck = $objetivoEstrategico;

        $this->objetivoEstrategico = $this->getObjetivoEstrategico($this->cod_objetivo_estrategico);

        /**
         * Fim da 1ª parte
         */

        /**
         * Início da 2ª parte
         */

        $planosAcao = PlanoAcao::orderBy('num_nivel_hierarquico_apresentacao')
            ->with('tipoExecucao', 'servidorResponsavel', 'servidorSubstituto', 'indicadores', 'indicadores.evolucaoIndicador')
            ->where('cod_objetivo_estrategico', $this->cod_objetivo_estrategico)
            ->where('cod_organizacao', $this->cod_organizacao)
            ->whereYear('dte_inicio', '<=', $anoSelecionado)
            ->whereYear('dte_fim', '>=', $anoSelecionado)
            ->get();

        $cods_plano_de_acao = '';

        foreach ($planosAcao as $result) {

            $cods_plano_de_acao = $cods_plano_de_acao . $result->cod_plano_de_acao . ',';

        }

        $cods_plano_de_acao = trim($cods_plano_de_acao, ',');

        $cods_plano_de_acao = explode(',', $cods_plano_de_acao);

        if (!in_array($this->cod_plano_de_acao, $cods_plano_de_acao)) {

            $this->cod_plano_de_acao = null;

        }

        $this->collectionPlanosAcao = $planosAcao;

        if (!is_null($this->collectionPlanosAcao)) {

            $contPlanoAcaoInterno = 0;

            foreach ($this->collectionPlanosAcao as $resultPlanosAcao) {

                if ($contPlanoAcaoInterno == 0) {

                    $this->cod_plano_de_acao_identificado = $resultPlanosAcao->cod_plano_de_acao;

                    Session()->put('cod_plano_de_acao_identificado', $this->cod_plano_de_acao_identificado);

                }

            }

        } else {

            Session()->forget('cod_plano_de_acao_identificado');

        }

        $planoAcao = PlanoAcao::orderBy('num_nivel_hierarquico_apresentacao')
            ->with('tipoExecucao', 'servidorResponsavel', 'servidorSubstituto', 'indicadores', 'indicadores.evolucaoIndicador')
            ->where('cod_organizacao', $this->cod_organizacao)
            ->where('cod_objetivo_estrategico', $this->cod_objetivo_estrategico)
            ->whereYear('dte_inicio', '<=', $anoSelecionado)
            ->whereYear('dte_fim', '>=', $anoSelecionado);

        if (isset($this->cod_plano_de_acao) && !is_null($this->cod_plano_de_acao) && $this->cod_plano_de_acao != '') {

            $planoAcao = $planoAcao->find($this->cod_plano_de_acao);

            $this->collectionPlanoAcao = $planoAcao;

        } else {

            $planoAcao = $planoAcao->first();

            $this->collectionPlanoAcao = $planoAcao;

        }

        if ($planoAcao) {

            if ($planoAcao->indicadores->count() > 0) {

                $this->abrirIndicador = true;

            }

        }

        if (!is_null($planoAcao) && !is_null($planoAcao->indicadores)) {

            if (is_null($this->cod_indicador_selecionado)) {

                $contIndicador = 1;

                if (!is_null($planoAcao)) {

                    foreach ($planoAcao->indicadores as $indicador) {

                        if ($contIndicador == 1) {

                            $this->cod_indicador = $indicador->cod_indicador;

                        }

                        $contIndicador = $contIndicador + 1;

                    }

                }

            } else {

                $this->cod_indicador = $this->cod_indicador_selecionado;

            }

            if (isset($this->cod_indicador) && !is_null($this->cod_indicador) && $this->cod_indicador != '') {

                $indicador = Indicador::with('linhaBase', 'metaAno', 'evolucaoIndicador', 'evolucaoIndicador.arquivos')
                    ->orderBy('dsc_indicador');

                if (isset($this->cod_plano_de_acao) && !is_null($this->cod_plano_de_acao) && $this->cod_plano_de_acao != '') {

                    $indicador = $indicador->where('cod_plano_de_acao', $this->cod_plano_de_acao);

                }

            }

            if (!is_null($this->cod_indicador)) {

                $indicador = $indicador->find($this->cod_indicador);

                if ($indicador) {

                    $this->indicador = $indicador;

                } else {

                    $this->indicador = null;

                }

                $num_linha_base = '';

                if ($indicador) {

                    foreach ($indicador->linhaBase as $linhaBase) {

                        $num_linha_base = $linhaBase->num_linha_base;

                    }

                }

                $this->linhaBase = $num_linha_base;

                $dataChartMetaPrevista = '';
                $dataChartMetaRealizada = '';
                $dataChartLinhaBase = '';

                if (!is_null($planoAcao)) {

                    if ($indicador) {

                        if ($indicador->evolucaoIndicador->count() > 0) {

                            foreach ($indicador->metaAno as $metaAno) {

                                if ($metaAno->num_ano == $this->ano) {

                                    $this->metaAno = $metaAno->meta;

                                }

                            }

                            $somaPrevisto = 0;
                            $somaRealizado = 0;

                            $anoVigente = date('Y');

                            $time = strtotime(date('Y-m-d'));
                            $mesAnterior = (date("n", strtotime("-1 month", $time))) * 1;

                            $this->mesAnterior = $mesAnterior;

                            foreach ($indicador->evolucaoIndicador as $evolucaoIndicador) {

                                if ($evolucaoIndicador->num_ano == $this->ano) {

                                    $dataChartLinhaBase = $dataChartLinhaBase . $num_linha_base . ',';

                                    if ($indicador->bln_acumulado === 'Sim') {

                                        $somaPrevisto = $somaPrevisto + $evolucaoIndicador->vlr_previsto;

                                        if ($anoVigente != $this->anoSelecionado) {

                                            $somaRealizado = $somaRealizado + $evolucaoIndicador->vlr_realizado;

                                            $dataChartMetaRealizada = $dataChartMetaRealizada . $somaRealizado . ',';

                                        } else {

                                            if ($evolucaoIndicador->num_mes <= $mesAnterior) {

                                                $somaRealizado = $somaRealizado + $evolucaoIndicador->vlr_realizado;

                                                $dataChartMetaRealizada = $dataChartMetaRealizada . $somaRealizado . ',';

                                            }

                                        }

                                        $dataChartMetaPrevista = $dataChartMetaPrevista . $somaPrevisto . ',';

                                    } else {

                                        if (isset($evolucaoIndicador->vlr_previsto) && !is_null($evolucaoIndicador->vlr_previsto) && $evolucaoIndicador->vlr_previsto != '') {

                                            $dataChartMetaPrevista = $dataChartMetaPrevista . $evolucaoIndicador->vlr_previsto . ',';

                                        } else {
                                            $dataChartMetaPrevista = $dataChartMetaPrevista . 0 . ',';
                                        }

                                        if (isset($evolucaoIndicador->vlr_realizado) && !is_null($evolucaoIndicador->vlr_realizado) && $evolucaoIndicador->vlr_realizado != '') {

                                            $dataChartMetaRealizada = $dataChartMetaRealizada . $evolucaoIndicador->vlr_realizado . ',';

                                        } else {
                                            $dataChartMetaRealizada = $dataChartMetaRealizada . 0 . ',';
                                        }

                                    }

                                }

                            }

                            $this->dataChartMetaPrevista = trim($dataChartMetaPrevista, ',');
                            $this->dataChartMetaRealizada = trim($dataChartMetaRealizada, ',');
                            $this->dataChartLinhaBase = trim($dataChartLinhaBase, ',');

                        }

                    }

                }

            } else {

                $this->indicador = null;

            }

        }

        /**
         * Fim da 2ª parte
         */

        $this->grau_satisfacao = $this->grauSatisfacao();

        if ($this->cod_origem === '3ac5e10e-8960-4b7c-a1cf-455597c875a7') {
            return view('livewire.show-objetivo-estrategico-livewire', ['ano' => $this->ano, 'cod_organizacao' => $this->cod_organizacao]);
        } elseif ($this->cod_origem === 'e37b40bf-4852-4fc7-8d0a-1cb6243ae9b6') {

            if ($this->objetivoEstrategico) {

                if ($this->objetivoEstrategico->indicadores->count() > 0) {

                    $this->abrirIndicador = true;

                }

            }

            if (!is_null($this->objetivoEstrategico) && !is_null($this->objetivoEstrategico->indicadores)) {

                if (is_null($this->cod_indicador_selecionado)) {

                    $contIndicador = 1;

                    if (!is_null($planoAcao)) {

                        foreach ($this->objetivoEstrategico->indicadores as $indicador) {

                            if ($contIndicador == 1) {

                                $this->cod_indicador = $indicador->cod_indicador;

                            }

                            $contIndicador = $contIndicador + 1;

                        }

                    }

                } else {

                    $this->cod_indicador = $this->cod_indicador_selecionado;

                }

                if (isset($this->cod_indicador) && !is_null($this->cod_indicador) && $this->cod_indicador != '') {

                    $indicador = Indicador::with('linhaBase', 'metaAno', 'evolucaoIndicador', 'evolucaoIndicador.arquivos', 'organizacoes')
                        ->orderBy('dsc_indicador');

                    if (isset($this->cod_plano_de_acao) && !is_null($this->cod_plano_de_acao) && $this->cod_plano_de_acao != '') {

                        $indicador = $indicador->where('cod_plano_de_acao', $this->cod_plano_de_acao);

                    }

                }

                $clienteLogado = Auth::user()->id;

                $this->getUserAuth = User::with('organizacao')
                    ->find(Auth::user()->id);

                if (!is_null($this->cod_indicador)) {

                    $indicador = $indicador->find($this->cod_indicador);

                    if ($indicador) {

                        $this->indicador = $indicador;

                    } else {

                        $this->indicador = null;

                    }

                    $num_linha_base = '';

                    if ($indicador) {

                        foreach ($indicador->linhaBase as $linhaBase) {

                            $num_linha_base = $linhaBase->num_linha_base;

                        }

                    }

                    $this->linhaBase = $num_linha_base;

                    $dataChartMetaPrevista = '';
                    $dataChartMetaRealizada = '';
                    $dataChartLinhaBase = '';

                    if (!is_null($planoAcao)) {

                        if ($indicador) {

                            if ($indicador->evolucaoIndicador->count() > 0) {

                                foreach ($indicador->metaAno as $metaAno) {

                                    if ($metaAno->num_ano == $this->ano) {

                                        $this->metaAno = $metaAno->meta;

                                    }

                                }

                                $somaPrevisto = 0;
                                $somaRealizado = 0;

                                $anoVigente = date('Y');

                                $time = strtotime(date('Y-m-d'));
                                $mesAnterior = (date("n", strtotime("-1 month", $time))) * 1;

                                $this->mesAnterior = $mesAnterior;

                                foreach ($indicador->evolucaoIndicador as $evolucaoIndicador) {

                                    if ($evolucaoIndicador->num_ano == $this->ano) {

                                        $dataChartLinhaBase = $dataChartLinhaBase . $num_linha_base . ',';

                                        if ($indicador->bln_acumulado === 'Sim') {

                                            $somaPrevisto = $somaPrevisto + $evolucaoIndicador->vlr_previsto;

                                            if ($anoVigente != $this->anoSelecionado) {

                                                $somaRealizado = $somaRealizado + $evolucaoIndicador->vlr_realizado;

                                                $dataChartMetaRealizada = $dataChartMetaRealizada . $somaRealizado . ',';

                                            } else {

                                                if ($evolucaoIndicador->num_mes <= $mesAnterior) {

                                                    $somaRealizado = $somaRealizado + $evolucaoIndicador->vlr_realizado;

                                                    $dataChartMetaRealizada = $dataChartMetaRealizada . $somaRealizado . ',';

                                                }

                                            }

                                            $dataChartMetaPrevista = $dataChartMetaPrevista . $somaPrevisto . ',';

                                        } else {

                                            if (isset($evolucaoIndicador->vlr_previsto) && !is_null($evolucaoIndicador->vlr_previsto) && $evolucaoIndicador->vlr_previsto != '') {

                                                $dataChartMetaPrevista = $dataChartMetaPrevista . $evolucaoIndicador->vlr_previsto . ',';

                                            } else {
                                                $dataChartMetaPrevista = $dataChartMetaPrevista . 0 . ',';
                                            }

                                            if (isset($evolucaoIndicador->vlr_realizado) && !is_null($evolucaoIndicador->vlr_realizado) && $evolucaoIndicador->vlr_realizado != '') {

                                                $dataChartMetaRealizada = $dataChartMetaRealizada . $evolucaoIndicador->vlr_realizado . ',';

                                            } else {
                                                $dataChartMetaRealizada = $dataChartMetaRealizada . 0 . ',';
                                            }

                                        }

                                    }

                                }

                                $this->dataChartMetaPrevista = trim($dataChartMetaPrevista, ',');
                                $this->dataChartMetaRealizada = trim($dataChartMetaRealizada, ',');
                                $this->dataChartLinhaBase = trim($dataChartLinhaBase, ',');

                            }

                        }

                    }

                } else {

                    $this->indicador = null;

                }

            }

            if (Auth::check()) {
                $clienteLogado = Auth::user()->id;

                $this->getUserAuth = User::with('organizacao')
                    ->find(Auth::user()->id);
            } else {
                $clienteLogado = null;
            }

            return view('livewire.indicador-objetivo-estrategico-livewire', ['ano' => $this->ano, 'cod_organizacao' => $this->cod_organizacao]);
        }

    }

    protected function calcularAcumuladoPlanoDeAcao($cod_plano_de_acao = '', $anoSelecionado = '')
    {

        $calcular = new CalculoLivewire;

        $result = $calcular->calcularAcumuladoPlanoDeAcao($cod_plano_de_acao, $anoSelecionado);

        return $result;

    }

    protected function calcularAcumuladoIndicador($cod_indicador = '', $anoSelecionado = '')
    {

        $calcular = new CalculoLivewire;

        $result = $calcular->calcularAcumuladoIndicador($cod_indicador, $anoSelecionado);

        return $result;

    }

    protected function obterResultadoComValorRealizadoEValorPrevisto($dsc_tipo = '', $vlr_realizado = '', $vlr_previsto = '')
    {

        // Possíveis variáveis para o emitir o resultado:
        // $tipoCalculo,$cod_perspectiva,$cod_objetivo_estrategico,$cod_plano_de_acao,$cod_indicador,$mes

        $obterResultadoComValorRealizadoEValorPrevisto = new CalculoLivewire;

        $result = $obterResultadoComValorRealizadoEValorPrevisto->obterResultadoComValorRealizadoEValorPrevisto($dsc_tipo, $vlr_realizado, $vlr_previsto);

        return $result;

    }

    protected function getGrauSatisfacao($percentual = 0)
    {

        $resultado = null;

        $resultado['grau_de_satisfacao'] = 'gray';

        $consultarGrauSatisfacao = GrauSatisfacao::where('vlr_maximo', '>=', $percentual)
            ->where('vlr_minimo', '<=', $percentual)
            ->first();

        if (!is_null($consultarGrauSatisfacao)) {

            if ($percentual < 0) {

                $resultado['grau_de_satisfacao'] = 'red';

            } elseif ($percentual > 100) {

                $resultado['grau_de_satisfacao'] = 'green';

            } else {

                $resultado['grau_de_satisfacao'] = $consultarGrauSatisfacao->cor;

            }

        } else {

            if ($percentual < 0) {

                $resultado['grau_de_satisfacao'] = 'red';

            } elseif ($percentual > 100) {

                $resultado['grau_de_satisfacao'] = 'green';

            } else {

                $resultado['grau_de_satisfacao'] = $consultarGrauSatisfacao->cor;

            }

        }

        $resultado['color'] = 'white';

        if (!is_null($consultarGrauSatisfacao)) {

            if ($consultarGrauSatisfacao->cor === 'yellow') {

                $resultado['color'] = 'black';

            }

        } else {

            $resultado['color'] = 'black';

        }

        return $resultado;

    }

    protected function hierarquiaUnidade($cod_organizacao)
    {

        $organizacao = Organization::with('hierarquia')
            ->where('cod_organizacao', $cod_organizacao)
            ->get();

        $hierarquiaSuperior = null;

        foreach ($organizacao as $result1) {

            if ($result1->hierarquia) {

                foreach ($result1->hierarquia as $result2) {

                    $hierarquiaSuperior = $hierarquiaSuperior . '/' . $result2->sgl_organizacao;

                    $organizacao2 = Organization::with('hierarquia')
                        ->where('cod_organizacao', $result2->cod_organizacao)
                        ->get();

                    foreach ($organizacao2 as $result3) {

                        if ($result3->hierarquia) {

                            foreach ($result3->hierarquia as $result4) {

                                $hierarquiaSuperior = $hierarquiaSuperior . '/' . $result4->sgl_organizacao;

                                $organizacao3 = Organization::with('hierarquia')
                                    ->where('cod_organizacao', $result4->cod_organizacao)
                                    ->get();

                                foreach ($organizacao3 as $result5) {

                                    if ($result5->hierarquia) {

                                        foreach ($result5->hierarquia as $result6) {

                                            $hierarquiaSuperior = $hierarquiaSuperior . '/' . $result6->sgl_organizacao;

                                            $organizacao4 = Organization::with('hierarquia')
                                                ->where('cod_organizacao', $result6->cod_organizacao)
                                                ->get();

                                            foreach ($organizacao4 as $result7) {

                                                if ($result7->hierarquia) {

                                                    foreach ($result7->hierarquia as $result8) {

                                                        $hierarquiaSuperior = $hierarquiaSuperior . '/' . $result8->sgl_organizacao;

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

    protected function processarOrganizacao($result, &$organizacoes, $organizationChild)
    {
        $organizacoes[$result->cod_organizacao] = $result->sgl_organizacao . ' - ' . $result->nom_organizacao . $this->hierarquiaUnidade($result->cod_organizacao);

        foreach ($organizationChild as $resultChild) {
            if ($result->cod_organizacao == $resultChild->rel_cod_organizacao) {
                $this->processarOrganizacao($resultChild, $organizacoes, $resultChild->deshierarquia);
            }
        }
    }

    protected function codOrganizacaoPorHieraquia($cod_organizacao)
    {
        $organizacao = Organization::with('hierarquia')->where('cod_organizacao', $cod_organizacao)->first();
        if (!$organizacao)
            return [];

        $hierarquiaSuperior = [$cod_organizacao];

        $this->adicionarHierarquia($organizacao->hierarquia, $hierarquiaSuperior);

        return $hierarquiaSuperior;
    }

    protected function adicionarHierarquia($hierarquias, &$hierarquiaSuperior)
    {
        foreach ($hierarquias as $hierarquia) {
            if (!in_array($hierarquia->cod_organizacao, $hierarquiaSuperior)) {
                array_push($hierarquiaSuperior, $hierarquia->cod_organizacao);
                $organizacao = Organization::with('hierarquia')->where('cod_organizacao', $hierarquia->cod_organizacao)->first();
                if ($organizacao) {
                    $this->adicionarHierarquia($organizacao->hierarquia, $hierarquiaSuperior);
                }
            }
        }
    }

    public function grauSatisfacao()
    {

        $consultarGrauSatisfacao = GrauSatisfacao::orderBy('vlr_minimo')
            ->get();

        $montagemGrauSatisfacao = '';

        foreach ($consultarGrauSatisfacao as $grauSatisfacao) {

            $color = 'white';

            if ($grauSatisfacao->cor === 'yellow') {

                $color = 'black';

            }

            $montagemGrauSatisfacao .= '<div class="px-1 py-1 pl-3 font-semibold rounded-md border-1 text-' . $color . ' bg-' . $grauSatisfacao->cor . '-500 text-sm antialiased sm:subpixel-antialiased md:antialiased">' . $grauSatisfacao->dsc_grau_satisfcao . ' de ' . converteValor('MYSQL', 'PTBR', $grauSatisfacao->vlr_minimo) . '% a ' . converteValor('MYSQL', 'PTBR', $grauSatisfacao->vlr_maximo) . '%</div>';

        }

        $montagemGrauSatisfacao .= '<div class="px-1 py-1 pl-3 font-semibold rounded-md border-1 text-white bg-gray-500 text-sm antialiased sm:subpixel-antialiased md:antialiased">Sem meta prevista para o período</div>';

        $montagemGrauSatisfacao .= '<div class="px-1 py-1 pl-3 font-semibold rounded-md border-1 text-white bg-pink-800 text-sm antialiased sm:subpixel-antialiased md:antialiased">Não houve o preenchimento</div>';

        return $montagemGrauSatisfacao;

    }
}
