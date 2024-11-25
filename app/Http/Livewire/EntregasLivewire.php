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

    public $dsc_entrega = null;

    public $status = [];

    public $bln_status = 'Não iniciado';

    public $unidadesMedida = [
        'Quantidade' => 'Quantidade',
        'Porcentagem' => 'Porcentagem',
        'Dinheiro' => 'Dinheiro R$ 0,00 (real)'
    ];

    public $unidadeMedidaAnterior = null;

    public $dsc_unidade_medida = null;

    public $dsc_item_entregue = null;

    public $num_quantidade_prevista_original = null;

    public $num_quantidade_prevista = null;

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

        $this->status = TabStatus::orderBy('dsc_status')
            ->pluck('dsc_status', 'dsc_status');

        $this->unidadesMedida = ['Quantidade' => 'Quantidade', 'Porcentagem' => 'Porcentagem', 'Dinheiro' => 'Dinheiro R$ 0,00 (real)'];
    }

    public function hydrate()
    {
        $this->emit('select2Hydrate');
    }

    public function instanciarShowOrganization()
    {
        return new ShowOrganization;
    }

    public function instanciarAtualizarOuCriarPorModeloDadosController()
    {
        return new AtualizarOuCriarPorModeloDadosController;
    }

    public function create()
    {

        $atualizarOuCriarPorModeloDados = $this->instanciarAtualizarOuCriarPorModeloDadosController();

        $this->cod_plano_de_acao;
        $this->dsc_entrega;
        $this->dsc_unidade_medida;
        $this->dsc_item_entregue;
        $this->num_quantidade_prevista;
        $this->bln_status;
        $this->dsc_periodo_medicao;

        /** Início do IF para limpar o conteúdo de $this->num_quantidade_prevista */
        if ($this->dsc_unidade_medida === 'Porcentagem' || $this->dsc_unidade_medida === 'Dinheiro') {

            // Início da parte de verificação se a soma já atingiu a meta proposta do Ano 1 com a unidade de medida porcentagem

            $this->num_quantidade_prevista_original = $this->num_quantidade_prevista;
            $this->num_quantidade_prevista = converteValor('PTBR', 'MYSQL', $this->num_quantidade_prevista);
        }
        /** Fim do IF para limpar o conteúdo de $this->num_quantidade_prevista */

        $table = 'tab_entregas';
        $model = 'App\Models\\' . transformarNomeTabelaParaNomeModel($table);

        $id = [];
        $campos = [];

        $modificacoes = null;

        $this->estruturaTableParaEditar = $this->estruturaTableParaEditar();

        $planoAcao = PlanoAcao::find($this->cod_plano_de_acao);

        if (isset($this->cod_entrega) && !empty($this->cod_entrega)) {

            /** Alterar */
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

                    $campos['num_quantidade_prevista'] = $this->num_quantidade_prevista;

                    $modificacoes = $modificacoes . nomeCampoNormalizado($column_name) . ": <span class='text-green-800'>" . $this->num_quantidade_prevista_original . "</span><br>";
                }
            }

            if (isset($modificacoes) && !empty($modificacoes)) {

                $cabecalhoModificacoes = '';

                $cabecalhoModificacoes = 'Inserção dos dados relacionados a seguir para uma nova Entrega relacionada com o Plano de Ação: <strong>' . $planoAcao->num_nivel_hierarquico_apresentacao . '. ' . $planoAcao->dsc_plano_de_acao . '</strong><br><br>';

                $this->showModalResultadoEdicao = true;

                $this->mensagemResultadoEdicao = $cabecalhoModificacoes . $modificacoes;
            }

            $atualizarOuCriarPorModeloDados->atualizarOuCriarPorModeloDados($model, $id, $campos);
        }

        $this->abrirFecharForm = 'none';
        $this->iconAbrirFechar = 'fas fa-plus text-xs';

        $this->editarForm = false;
    }

    public function adequarMascara()
    {
        if (
            isset($this->num_quantidade_prevista) &&
            !is_null($this->num_quantidade_prevista) &&
            $this->num_quantidade_prevista != ''
        ) {
            if (
                is_null($this->dsc_unidade_medida) ||
                $this->dsc_unidade_medida == '' ||
                $this->dsc_unidade_medida !== $this->unidadeMedidaAnterior
            ) {
                $valorOriginalVlrMeta = $this->num_quantidade_prevista;

                $this->num_quantidade_prevista = null;

                $this->mensagemResultadoEdicao = "Você alterou a Unidade de Medida.<br>Dessa forma o valor informado da Meta que era (" . $valorOriginalVlrMeta . ") será apagado para que digite o valor correspondente a Unidade de Medida selecionada (" . $this->dsc_unidade_medida . ")";

                $this->showModalResultadoEdicao = true;
            }
        }

        $this->unidadeMedidaAnterior = $this->dsc_unidade_medida;
    }

    public function editForm($cod_entrega = '')
    {

        $singleData = TabEntregas::with('linhaBase', 'metaAno', 'evolucaoTabEntregas', 'codOrganizacoes', 'organizacoes')
            ->find($cod_entrega);

        $this->abrirFecharForm = 'block';
        $this->iconAbrirFechar = 'fas fa-minus text-xs';

        $this->editarForm = true;
    }

    public function deleteForm($cod_entrega = '')
    {

        $singleData = TabEntregas::with('linhaBase', 'metaAno', 'evolucaoTabEntregas')
            ->find($cod_entrega);

        $texto = '';

        $texto .= '<p class="my-2 text-gray-900 text-xs leading-relaxed"><strong>Dados do TabEntregas para confirmar a exclusão</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">Relacionado(a) ao PEI: <strong>' . $consultarPei->dsc_pei . ' (' . $consultarPei->num_ano_inicio_pei . ' a ' . $consultarPei->num_ano_fim_pei . ')</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">Perspectiva: <strong>' . $consultarPerspectiva->num_nivel_hierarquico_apresentacao . '. ' . $consultarPerspectiva->dsc_perspectiva . '</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">Objetivo Estratégico: <strong>' . $consultarObjetivoEstrategico->num_nivel_hierarquico_apresentacao . '. ' . $consultarObjetivoEstrategico->nom_objetivo_estrategico . '</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">Plano de Ação: <strong>' . $consultarPlanoDeAcao->num_nivel_hierarquico_apresentacao . '. ' . $consultarPlanoDeAcao->dsc_plano_de_acao . '</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">_________________________________</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">Descrição do TabEntregas: <strong>' . $singleData->dsc_TabEntregas . '</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">Unidade de Medida do TabEntregas: <strong>' . $singleData->dsc_unidade_medida . '</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">Esse TabEntregas terá o resultado acumulado? <strong>' . $singleData->bln_acumulado . '</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">Tipo de Análise do TabEntregas (Polaridade): <strong>' . tipoPolaridade($singleData->dsc_tipo) . '</strong></p><p class="my-2 text-gray-500 text-xs font-semibold leading-relaxed text-red-600">Quer realmente excluir?</p>';

        $this->mensagemDelete = $texto;

        $this->showModalDelete = true;

        // Incluir aqui o reset dos objetos

        $this->editarForm = false;
    }

    public function delete($cod_entrega = '')
    {

        $this->showModalDelete = false;

        $singleData = TabEntregas::with('linhaBase', 'metaAno', 'evolucaoTabEntregas')
            ->find($cod_entrega);

        $this->cod_entrega = $singleData->cod_entrega;

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

    protected function estruturaTableParaEditar()
    {

        $estrutura = DB::select("SELECT
            column_name,ordinal_position,is_nullable,data_type
            FROM
            information_schema.columns
            WHERE
            table_schema = 'pei'
            AND table_name = 'tab_entregas'
            AND column_name NOT IN ('cod_entrega', 'cod_plano_de_acao','created_at','updated_at','deleted_at');");

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

        $this->selected_organizations = null;

        $this->cod_entrega = null;

        $this->cod_objetivo_estrategico = null;
        $this->nom_TabEntregas = null;
        $this->dsc_TabEntregas = null;
        $this->txt_observacao = null;
        $this->dsc_meta = null;
        $this->dsc_atributos = null;
        $this->dsc_referencial_comparativo = null;

        $this->dsc_formula = null;
        $this->tiposTabEntregas = ['+' => 'Quanto maior for o resultado melhor', '-' => 'Quanto menor for o resultado melhor', '=' => 'Quanto igual for o resultado melhor'];
        $this->dsc_unidade_medida = null;


        $this->dsc_tipo = null;
        $this->dsc_fonte = null;
        $this->dsc_periodo_medicao = null;
        $this->bln_acumulado = null;

        $this->num_quantidade_prevista = null;

        $this->tirarReadonly = false;

        $this->adequarMascara = null;

        $this->hierarquiaUnidade = null;

        $this->anoInicioDoPeiSelecionado = null;
        $this->anoConclusaoDoPeiSelecionado = null;

        $this->habilitarCampoInserirMetas = 'none';

        $this->primeiroAnoDoPeiSelecionado = null;
        $this->ultimoAnoDoPeiSelecionado = null;

        $this->anosLinhaBase = null;

        $this->num_ano_base_1 = null;
        $this->num_ano_base_2 = null;
        $this->num_ano_base_3 = null;

        $this->num_linha_base_1 = null;
        $this->num_linha_base_2 = null;
        $this->num_linha_base_3 = null;

        for ($year = 2020; $year <= 2045; $year++) {

            $metaAno = "metaAno_{$year}";
            $this->$metaAno = null;

            for ($month = 1; $month <= 12; $month++) {
                $metaMes = "metaMes_{$month}_{$year}";
                $this->$metaMes = null;
            }
            $requiredMetaAno = "requiredMetaAno_{$year}";
            $this->$requiredMetaAno = null;
        }

        $this->ano1 = null;
        $this->ano2 = null;
        $this->ano3 = null;
        $this->ano4 = null;

        $this->somaMetaAno1 = null;
        $this->somaMetaAno2 = null;
        $this->somaMetaAno3 = null;
        $this->somaMetaAno4 = null;

        $this->erroInsercaoMetaMensal = false;
        $this->textoErroInsercaoMetaMensal = null;

        $this->inputAnoLinhaBaseClass = null;
        $this->inputValorLinhaBaseClass = null;

        $this->inputValorClass = null;

        $this->inputValorMesAno1Class = null;
        $this->inputValorMesAno2Class = null;
        $this->inputValorMesAno3Class = null;
        $this->inputValorMesAno4Class = null;
    }
}
