<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Pei;
use App\Models\Perspectiva;
use App\Models\ObjetivoEstrategico;
use App\Models\NumNivelHierarquico;
use App\Models\PlanoAcao;
use App\Models\Organization;
use App\Models\TabEntregas;
use App\Models\TabStatus;
use App\Models\User;
use App\Models\RelUsersTabOrganizacoesTabPerfilAcesso;
use App\Models\Acoes;
use App\Models\TabAudit;
use App\Models\Audit;
use DB;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Session;

use App\Http\Livewire\UsuariosLivewire;
use App\Http\Livewire\ShowOrganization;

use App\Http\Controllers\AtualizarOuCriarPorModeloDadosController;

use App\Models\RelTabEntregasObjetivoEstrategicoOrganizacao;

class EntregasLivewire extends Component
{

    public $ano = null;

    public $cod_pei = null;
    public $pei = [];
    public $cod_perspectiva = null;
    public $perspectiva = [];
    public $cod_objetivo_estrategico = null;
    public $objetivoEstragico = [];

    public $cod_plano_de_acao = null;
    public $planoAcao = [];

    public $tabEntregas = [];

    public $cod_entrega = null;

    public $niveis_hierarquico_apresentacao = [];

    public $num_nivel_hierarquico_apresentacao = null;

    public $dsc_entrega = null;

    public $status = [];

    public $bln_status = 'Não iniciado';

    public $unidadesMedida = [
        'Quantidade' => 'Quantidade',
        'Porcentagem' => 'Porcentagem',
        'Dinheiro' => 'Dinheiro R$ 0,00 (real)'
    ];

    public $dsc_periodo_medicao = null;

    public $unidadeMedidaAnterior = null;

    // public $dsc_unidade_medida = null;

    // public $dsc_item_entregue = null;

    // public $num_quantidade_prevista_original = null;

    // public $num_quantidade_prevista = null;

    public $estruturaTable = null;

    public $habilitarCampoInserirMetas = 'none';

    public $primeiroAnoDoPeiSelecionado = null;
    public $ultimoAnoDoPeiSelecionado = null;

    public $estruturaTableParaEditar = null;

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

    public function mount(Request $request, $ano)
    {

        $this->ano = $ano;

        $this->unidadesMedida = ['Quantidade' => 'Quantidade', 'Porcentagem' => 'Porcentagem', 'Dinheiro' => 'Dinheiro R$ 0,00 (real)'];
    }

    public function instanciarShowOrganization()
    {
        return new ShowOrganization;
    }

    public function instanciarAtualizarOuCriarPorModeloDadosController()
    {
        return new AtualizarOuCriarPorModeloDadosController;
    }

    protected function pesquisarCodigo($codPlanoAcao = '')
    {

        $this->num_nivel_hierarquico_apresentacao = '';

        if (isset($codPlanoAcao) && !is_null($codPlanoAcao) && $codPlanoAcao != '') {

            $entrega = TabEntregas::select('num_nivel_hierarquico_apresentacao')
                ->where('cod_plano_de_acao', $codPlanoAcao)
                ->orderBy('num_nivel_hierarquico_apresentacao', 'desc')
                ->first();

            if ($entrega) {

                $this->num_nivel_hierarquico_apresentacao = (($entrega->num_nivel_hierarquico_apresentacao) + 1);
            } else {

                $this->num_nivel_hierarquico_apresentacao = 1;
            }
        }

        return $this->num_nivel_hierarquico_apresentacao;
    }

    public function create()
    {

        $atualizarOuCriarPorModeloDados = $this->instanciarAtualizarOuCriarPorModeloDadosController();

        $this->cod_plano_de_acao;
        $this->dsc_entrega;
        // $this->dsc_unidade_medida;
        // $this->dsc_item_entregue;
        // $this->num_quantidade_prevista;
        $this->bln_status;
        $this->dsc_periodo_medicao;

        /** Início do IF para limpar o conteúdo de $this->num_quantidade_prevista */
        // if ($this->dsc_unidade_medida === 'Porcentagem' || $this->dsc_unidade_medida === 'Dinheiro') {

        //     // Início da parte de verificação se a soma já atingiu a meta proposta do Ano 1 com a unidade de medida porcentagem

        //     $this->num_quantidade_prevista_original = $this->num_quantidade_prevista;
        //     $this->num_quantidade_prevista = converteValor('PTBR', 'MYSQL', $this->num_quantidade_prevista);
        // }
        /** Fim do IF para limpar o conteúdo de $this->num_quantidade_prevista */

        $table = 'tab_entregas';
        $model = 'App\Models\\' . transformarNomeTabelaParaNomeModel($table);

        $id = [];
        $campos = [];

        $modificacoes = null;

        $this->estruturaTableParaEditar = $this->estruturaTableParaEditar();

        $planoAcao = PlanoAcao::find($this->cod_plano_de_acao);

        if ($this->editarForm) {

            /** Alterar */

            $id['cod_entrega'] = $this->cod_entrega;

            $entrega = TabEntregas::find($this->cod_entrega);

            foreach ($this->estruturaTableParaEditar as $table) {

                $column_name = $table->column_name;
                $data_type = $table->data_type;

                if ($column_name != 'num_quantidade_prevista') {

                    if ($column_name === 'cod_plano_de_acao') {

                        $consultarValorAntigo = PlanoAcao::find($entrega->$column_name);

                        $consultarValorAtualizado = PlanoAcao::find($this->$column_name);

                        $modificacoes = $modificacoes . 'Alterou o(a) <b>' . nomeCampoTabelaNormalizado($column_name) . '</b> de <span style="color:#CD3333;">( ' . $consultarValorAntigo->num_nivel_hierarquico_apresentacao . '. ' . $consultarValorAntigo->dsc_plano_de_acao . ' )</span> para <span style="color:#28a745;">( ' . $consultarValorAtualizado->num_nivel_hierarquico_apresentacao . '. ' . $consultarValorAtualizado->dsc_plano_de_acao . ' )</span>;<br>';

                        $audit = TabAudit::create(array(
                            'table' => 'tab_indicador',
                            'table_id' => $this->cod_plano_de_acao,
                            'column_name' => $column_name,
                            'data_type' => $data_type,
                            'ip' => $_SERVER['REMOTE_ADDR'],
                            'user_id' => Auth::user()->id,
                            'acao' => 'Editou',
                            'antes' => $consultarValorAntigo->num_nivel_hierarquico_apresentacao . '. ' . $consultarValorAntigo->dsc_plano_de_acao,
                            'depois' => $consultarValorAtualizado->num_nivel_hierarquico_apresentacao . '. ' . $consultarValorAtualizado->dsc_plano_de_acao
                        ));
                    } else {

                        if ($this->$column_name != $entrega->$column_name) {

                            $campos[$column_name] = $this->$column_name;

                            $modificacoes = $modificacoes . 'Alterou o(a) <b>' . nomeCampoNormalizado($column_name) . '</b> de <span style="color:#CD3333;">( ' . $entrega->$column_name . ' )</span> para <span style="color:#28a745;">( ' . $this->$column_name . ' )</span>;<br>';

                            $audit = TabAudit::create(array(
                                'table' => 'tab_indicador',
                                'table_id' => $this->cod_plano_de_acao,
                                'column_name' => $column_name,
                                'data_type' => $data_type,
                                'ip' => $_SERVER['REMOTE_ADDR'],
                                'user_id' => Auth::user()->id,
                                'acao' => 'Editou',
                                'antes' => $entrega->$column_name,
                                'depois' => $this->$column_name
                            ));
                        }
                    }
                } else {

                    // if ($this->$column_name != $entrega->$column_name) {

                    //     $campos['num_quantidade_prevista'] = $this->num_quantidade_prevista;

                    //     $modificacoes = $modificacoes . 'Alterou o(a) <b>' . nomeCampoNormalizado($column_name) . '</b> de <span style="color:#CD3333;">( ' . converteValor('MYSQL', 'PTBR', $entrega->$column_name) . ' )</span> para <span style="color:#28a745;">( ' . $this->num_quantidade_prevista_original . ' )</span>;<br>';

                    // }
                }
            }

            if (isset($modificacoes) && !empty($modificacoes)) {

                $cabecalhoModificacoes = '';

                $cabecalhoModificacoes = 'Alterou os dados relacionados a seguir da Entrega (' . $this->dsc_entrega . ') relacionada com o Plano de Ação: <strong>' . $planoAcao->num_nivel_hierarquico_apresentacao . '. ' . $planoAcao->dsc_plano_de_acao . '</strong><br><br>';

                $this->showModalResultadoEdicao = true;

                $this->mensagemResultadoEdicao = $cabecalhoModificacoes . $modificacoes;

                $atualizarOuCriarPorModeloDados->atualizarOuCriarPorModeloDados($model, $id, $campos);
            } else {

                $this->showModalResultadoEdicao = true;

                $this->mensagemResultadoEdicao = 'Por não ter nenhuma modificação nada foi feito.';
            }
        } else {

            /** Inserir */

            $campos['cod_plano_de_acao'] = $this->cod_plano_de_acao;

            foreach ($this->estruturaTableParaEditar as $table) {

                $column_name = $table->column_name;
                $data_type = $table->data_type;

                if ($column_name != 'num_quantidade_prevista') {

                    $campos[$column_name] = $this->$column_name;

                    $modificacoes = $modificacoes . nomeCampoNormalizado($column_name) . ": <span class='text-green-800'>" . $this->$column_name . "</span><br>";
                } else {

                    // $campos['num_quantidade_prevista'] = $this->num_quantidade_prevista;

                    // $modificacoes = $modificacoes . nomeCampoNormalizado($column_name) . ": <span class='text-green-800'>" . $this->num_quantidade_prevista_original . "</span><br>";
                }
            }

            if (isset($modificacoes) && !empty($modificacoes)) {

                $cabecalhoModificacoes = '';

                $cabecalhoModificacoes = 'Inserção dos dados relacionados a seguir para uma nova Entrega relacionada com o Plano de Ação: <strong>' . $planoAcao->num_nivel_hierarquico_apresentacao . '. ' . $planoAcao->dsc_plano_de_acao . '</strong><br><br>';

                $this->showModalResultadoEdicao = true;

                $this->mensagemResultadoEdicao = $cabecalhoModificacoes . $modificacoes;

                $atualizarOuCriarPorModeloDados->atualizarOuCriarPorModeloDados($model, $id, $campos);
            }
        }

        $this->abrirFecharForm = 'none';
        $this->iconAbrirFechar = 'fas fa-plus text-xs';

        $this->editarForm = false;
    }

    public function setBlnStatus($codEntrega = null, $blnStatus = null)
    {

        $entrega = TabEntregas::find($codEntrega);

        $entrega->bln_status = $blnStatus;

        $entrega->save();
    }

    public function adequarMascara()
    {
        // if (
        //     isset($this->num_quantidade_prevista) &&
        //     !is_null($this->num_quantidade_prevista) &&
        //     $this->num_quantidade_prevista != ''
        // ) {
        //     if (
        //         is_null($this->dsc_unidade_medida) ||
        //         $this->dsc_unidade_medida == '' ||
        //         $this->dsc_unidade_medida !== $this->unidadeMedidaAnterior
        //     ) {
        //         $valorOriginalVlrMeta = $this->num_quantidade_prevista;

        //         $this->num_quantidade_prevista = null;

        //         $this->mensagemResultadoEdicao = "Você alterou a Unidade de Medida.<br>Dessa forma o valor informado da Meta que era (" . $valorOriginalVlrMeta . ") será apagado para que digite o valor correspondente a Unidade de Medida selecionada (" . $this->dsc_unidade_medida . ")";

        //         $this->showModalResultadoEdicao = true;
        //     }
        // }

        // $this->unidadeMedidaAnterior = $this->dsc_unidade_medida;
    }

    public function editForm($cod_entrega = '')
    {

        $this->zerarVariaveis();

        $this->cod_entrega = $cod_entrega;

        $singleData = TabEntregas::with('planoAcao')
            ->find($this->cod_entrega);

        $this->cod_plano_de_acao = $singleData->cod_plano_de_acao;

        $planoAcao = PlanoAcao::find($this->cod_plano_de_acao);

        $this->cod_objetivo_estrategico = $planoAcao->cod_objetivo_estrategico;

        $consultarObjetivoEstrategico = ObjetivoEstrategico::find($this->cod_objetivo_estrategico);

        $consultarPerspectiva = Perspectiva::find($consultarObjetivoEstrategico->cod_perspectiva);

        $this->cod_perspectiva = $consultarObjetivoEstrategico->cod_perspectiva;

        $this->cod_pei = $consultarPerspectiva->cod_pei;

        $this->num_nivel_hierarquico_apresentacao = $singleData->num_nivel_hierarquico_apresentacao;

        $this->dsc_entrega = $singleData->dsc_entrega;
        // $this->dsc_unidade_medida = $singleData->dsc_unidade_medida;
        // $this->dsc_item_entregue = $singleData->dsc_item_entregue;

        // if (
        //     $this->dsc_unidade_medida === 'Porcentagem' ||
        //     $this->dsc_unidade_medida === 'Dinheiro'
        // ) {

        //     $this->num_quantidade_prevista = converteValor('MYSQL', 'PTBR', $singleData->num_quantidade_prevista);
        // } else {

        //     $this->num_quantidade_prevista = $singleData->num_quantidade_prevista;
        // }


        $this->bln_status = $singleData->bln_status;
        $this->dsc_periodo_medicao = $singleData->dsc_periodo_medicao;

        $this->abrirFecharForm = 'block';
        $this->iconAbrirFechar = 'fas fa-minus text-xs';

        $this->editarForm = true;
    }

    public function deleteForm($cod_entrega = '')
    {

        $this->cod_entrega = $cod_entrega;

        $singleData = TabEntregas::with('planoAcao')
            ->find($cod_entrega);

        $texto = '';

        $texto .= '<p class="my-2 text-gray-900 text-xs leading-relaxed"><strong>Dados da Entrega para confirmar a exclusão</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">Plano de Ação: <strong>' . $singleData->planoAcao->num_nivel_hierarquico_apresentacao . '. ' . $singleData->planoAcao->dsc_plano_de_acao . '</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">_________________________________</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">Detalhamento da Entrega: <strong>' . $singleData->dsc_entrega . '</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">Status de Execução: <strong>' . $singleData->bln_status . '</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">Período de medição <strong>' . $singleData->dsc_periodo_medicao . '</strong></p><p class="my-2 text-gray-500 text-xs font-semibold leading-relaxed text-red-600">Quer realmente excluir?</p>';

        $this->mensagemDelete = $texto;

        $this->showModalDelete = true;

        // Incluir aqui o reset dos objetos

        $this->editarForm = false;
    }

    public function delete($cod_entrega = '')
    {

        $this->showModalDelete = false;

        $singleData = TabEntregas::with('planoAcao')
            ->find($cod_entrega);

        $texto = '';

        $texto .= '<p class="my-2 text-gray-900 text-xs leading-relaxed"><strong>Excluiu com sucesso a seguinte Entrega</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">Plano de Ação: <strong>' . $singleData->planoAcao->num_nivel_hierarquico_apresentacao . '. ' . $singleData->planoAcao->dsc_plano_de_acao . '</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">_________________________________</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">Detalhamento da Entrega: <strong>' . $singleData->dsc_entrega . '</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">Status de Execução: <strong>' . $singleData->bln_status . '</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">Período de medição <strong>' . $singleData->dsc_periodo_medicao . '</strong></p>';

        $this->cod_entrega = $singleData->cod_entrega;

        $acao = Acoes::create(array(
            'table' => 'tab_entregas',
            'table_id' => $this->cod_entrega,
            'user_id' => Auth::user()->id,
            'acao' => $texto
        ));

        $singleData->delete();

        $this->zerarVariaveis();

        $this->editarForm = false;

        $this->showModalResultadoEdicao = true;

        $this->mensagemResultadoEdicao = $texto;
    }

    public function abrirFecharForm()
    {

        if ($this->abrirFecharForm === 'none') {

            $this->zerarVariaveis();

            $this->editarForm = false;

            $this->abrirFecharForm = 'block';
            $this->iconAbrirFechar = 'fas fa-minus text-xs';
        } else {

            $this->zerarVariaveis();

            $this->editarForm = false;

            $this->abrirFecharForm = 'none';
            $this->iconAbrirFechar = 'fas fa-plus text-xs';
        }
    }

    public function audit($texto = '')
    {

        $this->mensagemDelete = $texto;

        $this->showModalAudit = true;

        $this->editarForm = false;
    }

    public function cancelar()
    {

        $this->zerarVariaveis();

        $this->editarForm = false;
    }

    public function render()
    {

        $this->pei = Pei::select(DB::raw("dsc_pei||' ( '||num_ano_inicio_pei||' a '||num_ano_fim_pei||' )' as dsc_pei, cod_pei"))
            ->where('dsc_pei', '!=', '')
            ->whereNotNull('dsc_pei')
            ->orderBy('dsc_pei')
            ->pluck('dsc_pei', 'cod_pei');

        $perspectiva = Perspectiva::select(DB::raw("num_nivel_hierarquico_apresentacao||'. '||dsc_perspectiva as dsc_perspectiva, cod_perspectiva"));

        if (isset($this->cod_pei) && !is_null($this->cod_pei) && $this->cod_pei != '') {

            $perspectiva = $perspectiva->where('cod_pei', $this->cod_pei);
        } else {

            $perspectiva = $perspectiva->whereNull('cod_pei');
        }

        $perspectiva = $perspectiva->orderBy('num_nivel_hierarquico_apresentacao', 'desc')
            ->pluck('dsc_perspectiva', 'cod_perspectiva');

        $this->perspectiva = $perspectiva;

        $objetivoEstrategico = ObjetivoEstrategico::select(DB::raw("num_nivel_hierarquico_apresentacao||'. '||nom_objetivo_estrategico AS dsc_objetivo_estrategico, cod_objetivo_estrategico"));

        if (isset($this->cod_perspectiva) && !is_null($this->cod_perspectiva) && $this->cod_perspectiva != '') {

            Session()->put('cod_perspectiva', $this->cod_perspectiva);
        } else {

            Session()->forget('cod_perspectiva');
        }

        if (isset($this->cod_pei) && !is_null($this->cod_pei) && $this->cod_pei != '' && isset($this->cod_perspectiva) && !is_null($this->cod_perspectiva) && $this->cod_perspectiva != '' && $perspectiva->count() > 0) {

            $objetivoEstrategico = $objetivoEstrategico->where('cod_perspectiva', $this->cod_perspectiva);
        } else {

            $objetivoEstrategico = $objetivoEstrategico->whereNull('cod_perspectiva');
        }

        $objetivoEstrategico = $objetivoEstrategico->orderBy('num_nivel_hierarquico_apresentacao')
            ->with('perspectiva')
            ->pluck('dsc_objetivo_estrategico', 'cod_objetivo_estrategico');

        $this->objetivoEstragico = $objetivoEstrategico;

        if (isset($this->cod_objetivo_estrategico) && !empty($this->cod_objetivo_estrategico)) {

            $this->planoAcao = PlanoAcao::select(DB::raw("num_nivel_hierarquico_apresentacao||'. '||dsc_plano_de_acao AS dsc_plano_de_acao, cod_plano_de_acao"))
                ->where('cod_objetivo_estrategico', $this->cod_objetivo_estrategico)
                ->pluck('dsc_plano_de_acao', 'cod_plano_de_acao');
        }


        if (isset($this->cod_pei) && !is_null($this->cod_pei) && $this->cod_pei != '') {

            $consultarPei = Pei::select('num_ano_inicio_pei', 'num_ano_fim_pei')
                ->find($this->cod_pei);

            if ($perspectiva->count() > 0) {

                $this->habilitarCampoInserirMetas = 'block';

                $primeiroAnoDoPeiSelecionado = $consultarPei->num_ano_inicio_pei;

                $ultimoAnoDoPeiSelecionado = $consultarPei->num_ano_fim_pei;

                $this->primeiroAnoDoPeiSelecionado = $primeiroAnoDoPeiSelecionado . '-01-01';

                $this->ultimoAnoDoPeiSelecionado = $ultimoAnoDoPeiSelecionado . '-12-31';
            } else {

                $this->habilitarCampoInserirMetas = 'none';
            }
        } else {

            $this->primeiroAnoDoPeiSelecionado = '2020-01-01';

            $this->ultimoAnoDoPeiSelecionado = '2051-12-31';
        }

        if ($this->editarForm == false) {

            if (isset($this->cod_plano_de_acao) && !is_null($this->cod_plano_de_acao) && $this->cod_plano_de_acao != '') {

                $this->num_nivel_hierarquico_apresentacao = $this->pesquisarCodigo($this->cod_plano_de_acao);
            }
        } else {

            if (isset($this->cod_plano_de_acao) && !is_null($this->cod_plano_de_acao) && $this->cod_plano_de_acao != '' && $this->editarForm == false) {

                $this->num_nivel_hierarquico_apresentacao = $this->num_nivel_hierarquico_apresentacao;
            }
        }

        $this->status = TabStatus::orderBy('dsc_status')
            ->pluck('dsc_status', 'dsc_status');

        $this->tabEntregas = TabEntregas::with('planoAcao', 'acoesRealizadas')
            ->join('tab_plano_de_acao', 'tab_entregas.cod_plano_de_acao', '=', 'tab_plano_de_acao.cod_plano_de_acao') // Ajuste o nome da tabela e chave se necessário
            ->orderBy('tab_plano_de_acao.num_nivel_hierarquico_apresentacao', 'asc') // Ordena pela coluna desejada
            ->select('tab_entregas.*') // Garante que você trará apenas os campos de TabEntregas
            ->get();

        $this->niveis_hierarquico_apresentacao = NumNivelHierarquico::pluck('num_nivel_hierarquico_apresentacao', 'num_nivel_hierarquico_apresentacao');

        return view('livewire.entregas-livewire');
    }

    protected function estruturaTable()
    {

        $estrutura = DB::select("SELECT
            column_name,ordinal_position,is_nullable,data_type
            FROM
            information_schema.columns
            WHERE
            table_schema = 'pei'
            AND table_name = 'tab_entregas'
            AND column_name NOT IN ('cod_entrega','cod_objetivo_estrategico','created_at','updated_at','deleted_at');");

        return $estrutura;
    }

    public function estruturaTableParaEditar()
    {

        $estrutura = DB::select("SELECT
            column_name,ordinal_position,is_nullable,data_type
            FROM
            information_schema.columns
            WHERE
            table_schema = 'pei'
            AND table_name = 'tab_entregas'
            AND column_name NOT IN ('cod_entrega', 'num_nivel_hierarquico_apresentacao', 'cod_plano_de_acao','created_at','updated_at','deleted_at');");

        return $estrutura;
    }

    protected function hierarquiaUnidade($cod_organizacao)
    {
        $organizacao = Organization::with('hierarquia')
            ->where('cod_organizacao', $cod_organizacao)
            ->get();

        $hierarquiaSuperior = null;

        $this->processHierarquia($organizacao, $hierarquiaSuperior);

        return $hierarquiaSuperior;
    }

    private function processHierarquia($organizacao, &$hierarquiaSuperior)
    {
        foreach ($organizacao as $result) {
            if ($result->hierarquia) {
                foreach ($result->hierarquia as $subOrganizacao) {
                    $hierarquiaSuperior .= '/' . $subOrganizacao->sgl_organizacao;
                    $this->processHierarquia(
                        Organization::with('hierarquia')
                            ->where('cod_organizacao', $subOrganizacao->cod_organizacao)
                            ->get(),
                        $hierarquiaSuperior
                    );
                }
            }
        }
    }

    protected function zerarVariaveis()
    {

        $this->cod_pei = null;
        $this->pei = [];
        $this->cod_perspectiva = null;
        $this->perspectiva = [];
        $this->cod_objetivo_estrategico = null;
        $this->objetivoEstragico = [];

        $this->cod_plano_de_acao = null;
        $this->planoAcao = [];
        $this->tabEntregas = [];
        $this->cod_entrega = null;
        $this->num_nivel_hierarquico_apresentacao = null;
        $this->dsc_entrega = null;
        $this->status = [];
        $this->bln_status = 'Não iniciado';

        $this->dsc_periodo_medicao = null;
    }
}
