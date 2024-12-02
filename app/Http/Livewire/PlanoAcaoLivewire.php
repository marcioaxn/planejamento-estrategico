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
use App\Models\User;
use App\Models\RelUsersTabOrganizacoesTabPerfilAcesso;
use App\Models\Acoes;
use App\Models\Audit;
use DB;
use Auth;
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
    // public $txt_principais_entregas = null;
    public $vlr_orcamento_previsto = null;
    public $dte_inicio = null;
    public $dte_fim = null;
    public $bln_status = 'Não iniciada';

    public $hierarquiaUnidade = null;

    public $pei = null;
    public $cod_pei = null;
    public $perspectiva = [];
    public $cod_perspectiva = null;
    public $objetivoEstragico = [];
    public $tipoExecucao = null;

    public $usuariosResponsaveis = null;
    public $user_id_responsavel = null;
    public $usuariosSubstitutos = null;
    public $user_id_substituto = null;

    public $primeiroAnoDoPeiSelecionado = null;
    public $ultimoAnoDoPeiSelecionado = null;

    public $estruturaTable = null;

    public $editarForm = false;
    public $deleteForm = false;
    public $audit = false;
    public $showModalResultadoEdicao = false;
    public $mensagemResultadoEdicao = null;
    public $showModalDelete = false;
    public $showModalAudit = false;
    public $mensagemDelete = null;

    public $abrirFecharForm = 'none';
    public $iconAbrirFechar = 'fas fa-plus text-xs';
    public $iconFechar = 'fas fa-minus text-xs';

    public $maxWidth = 'xl';

    public function getPlanoDeAcaoPorCodsOrganizacao($cods_organizacao = '', $ano = '')
    {

        // Esta função tem o objetivo de consultar e retornar o(s) plano(s) de ação(ções)
        // por um determinado cod_organizacao ou por um array de cod_organizacao e pelo ano
        // --- x --- x --- x ---


        // Início da declaração da variável de consulta ao plano de ação
        $planosAcao = [];
        // Fim da declaração da variável de consulta ao plano de ação
        // --- x --- x --- x ---


        // Início da consulta ao plano de ação
        $planosAcao = PlanoAcao::orderBy('num_nivel_hierarquico_apresentacao')
            ->orderBy('dsc_plano_de_acao');

        // Início do IF para verificar se a variável $cods_organizacao contem algum conteúdo
        if (isset($cods_organizacao) && !is_null($cods_organizacao) && $cods_organizacao != '') {


            // Início do IF para verificar se a variável $cods_organizacao é do tipo array e se o array é maior que zero
            if (is_array($cods_organizacao) && count($cods_organizacao) > 0) {

                $planosAcao = $planosAcao->whereIn('cod_organizacao', $cods_organizacao);

            } else {

                // Esta é a exceção caso a variável $cods_organizacao não seja do tipo array e se o array é não maior que zero

                $planosAcao = $planosAcao->where('cod_organizacao', $cods_organizacao);

            }
            // Fim do IF para verificar se a variável $cods_organizacao é do tipo array e se o array é maior que zero
            // --- x --- x --- x ---

        }
        // Fim do IF para verificar se a variável $cods_organizacao contem algum conteúdo
        // --- x --- x --- x ---

        // Início do IF para verificar se a variável $ano contem algum conteúdo
        if (isset($ano) && !is_null($ano) && $ano != '') {

            $planosAcao = $planosAcao->whereYear('dte_inicio', '<=', $ano)
                ->whereYear('dte_fim', '>=', $ano);

        }
        // Fim do IF para verificar se a variável $ano contem algum conteúdo
        // --- x --- x --- x ---

        $planosAcao = $planosAcao->get();
        // Fim da consulta ao plano de ação
        // --- x --- x --- x ---

        // Retorno com o resultado da função
        return $planosAcao;

    }

    protected function pesquisarCodigo($cod_objetivo_estrategico = '')
    {

        $this->num_nivel_hierarquico_apresentacao = '';

        if (isset($cod_objetivo_estrategico) && !is_null($cod_objetivo_estrategico) && $cod_objetivo_estrategico != '') {

            $planoAcao = PlanoAcao::select('num_nivel_hierarquico_apresentacao')
                ->where('cod_objetivo_estrategico', $cod_objetivo_estrategico)
                ->orderBy('num_nivel_hierarquico_apresentacao', 'desc')
                ->first();

            if ($planoAcao) {

                $this->num_nivel_hierarquico_apresentacao = (($planoAcao->num_nivel_hierarquico_apresentacao) + 1);

            } else {

                $this->num_nivel_hierarquico_apresentacao = 1;

            }

        }

        return $this->num_nivel_hierarquico_apresentacao;

    }

    public function abrirFecharForm()
    {

        if ($this->abrirFecharForm === 'none') {

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

    public function create()
    {

        // Necessário incluir a parte de validação

        $modificacoes = '';
        $alteracao = array();

        if (!$this->editarForm) {

            $modificacoes = "Inseriu os seguintes dados em relação ao novo Plano de Ação:<br><br>";

            $save = new PlanoAcao;

            if (isset($this->cod_objetivo_estrategico) && !is_null($this->cod_objetivo_estrategico) && $this->cod_objetivo_estrategico != '') {

                $save->cod_objetivo_estrategico = $this->cod_objetivo_estrategico;

                $consultarObjetivoEstrategico = ObjetivoEstrategico::find($this->cod_objetivo_estrategico);

                $modificacoes = $modificacoes . "Objetivo Estratégico: <span class='text-green-800'>" . $consultarObjetivoEstrategico->num_nivel_hierarquico_apresentacao . '. ' . $consultarObjetivoEstrategico->nom_objetivo_estrategico . "</span><br>";

            }

            if (isset($this->cod_tipo_execucao) && !is_null($this->cod_tipo_execucao) && $this->cod_tipo_execucao != '') {

                $save->cod_tipo_execucao = $this->cod_tipo_execucao;

                $consultarTipoExecucao = TipoExecucao::find($this->cod_tipo_execucao);

                $modificacoes = $modificacoes . "Tipo: <span class='text-green-800'>" . $consultarTipoExecucao->dsc_tipo_execucao . "</span><br>";

            }

            if (isset($this->cod_organizacao) && !is_null($this->cod_organizacao) && $this->cod_organizacao != '') {

                $save->cod_organizacao = $this->cod_organizacao;

                $consultarOrganizacao = Organization::find($this->cod_organizacao);

                $modificacoes = $modificacoes . "Unidade Responsável: <span class='text-green-800'>" . $consultarOrganizacao->sgl_organizacao . " - " . $consultarOrganizacao->nom_organizacao . "</span><br>";

            }

            if (isset($this->dsc_plano_de_acao) && !is_null($this->dsc_plano_de_acao) && $this->dsc_plano_de_acao != '') {

                $save->num_nivel_hierarquico_apresentacao = $this->num_nivel_hierarquico_apresentacao;

                $save->dsc_plano_de_acao = $this->dsc_plano_de_acao;

                $modificacoes = $modificacoes . "Descrição: <span class='text-green-800'>" . $this->num_nivel_hierarquico_apresentacao . '. ' . $this->dsc_plano_de_acao . "</span><br>";

            }

            // if (isset($this->txt_principais_entregas) && !is_null($this->txt_principais_entregas) && $this->txt_principais_entregas != '') {

            //     $save->txt_principais_entregas = $this->txt_principais_entregas;

            //     $modificacoes = $modificacoes . "Principais entregas: <span class='text-green-800'>" . $this->txt_principais_entregas . "</span><br>";

            // }

            if (isset($this->dte_inicio) && !is_null($this->dte_inicio) && $this->dte_inicio != '') {

                $save->dte_inicio = $this->dte_inicio;

                $modificacoes = $modificacoes . "Data de Início: <span class='text-green-800'>" . converterData('EN', 'PTBR', $this->dte_inicio) . "</span><br>";

            }

            if (isset($this->dte_fim) && !is_null($this->dte_fim) && $this->dte_fim != '') {

                $save->dte_fim = $this->dte_fim;

                $modificacoes = $modificacoes . "Data de Conclusão: <span class='text-green-800'>" . converterData('EN', 'PTBR', $this->dte_fim) . "</span><br>";

            }

            if (isset($this->bln_status) && !is_null($this->bln_status) && $this->bln_status != '') {

                $save->bln_status = $this->bln_status;

                $modificacoes = $modificacoes . "Status: <span class='text-green-800'>" . $this->bln_status . "</span><br>";

            }

            if (isset($this->vlr_orcamento_previsto) && !is_null($this->vlr_orcamento_previsto) && $this->vlr_orcamento_previsto != '') {

                $save->vlr_orcamento_previsto = converteValor('PTBR', 'MYSQL', $this->vlr_orcamento_previsto);

                $modificacoes = $modificacoes . "Orçamento Previsto: <span class='text-green-800'>" . $this->vlr_orcamento_previsto . "</span><br>";

            }

            if (isset($this->user_id_responsavel) && !is_null($this->user_id_responsavel) && $this->user_id_responsavel != '') {

                $consultarUsuarioResponsavel = User::find($this->user_id_responsavel);

                $modificacoes = $modificacoes . "Servidor(a) Responsável: <span class='text-green-800'>" . $consultarUsuarioResponsavel->name . "</span><br>";

            }

            if (isset($this->user_id_substituto) && !is_null($this->user_id_substituto) && $this->user_id_substituto != '') {

                $consultarUsuarioSubstituto = User::find($this->user_id_substituto);

                $modificacoes = $modificacoes . "Servidor(a) Substituto: <span class='text-green-800'>" . $consultarUsuarioSubstituto->name . "</span><br>";

            }

            $save->save();

            $acao = Acoes::create(array(
                'table' => 'tab_plano_de_acao',
                'table_id' => $save->cod_plano_de_acao,
                'user_id' => Auth::user()->id,
                'acao' => $modificacoes
            ));

            if (isset($this->user_id_responsavel) && !is_null($this->user_id_responsavel) && $this->user_id_responsavel != '') {

                $saveUsuarioResponsavel = new RelUsersTabOrganizacoesTabPerfilAcesso;

                $saveUsuarioResponsavel->user_id = $this->user_id_responsavel;

                $saveUsuarioResponsavel->cod_organizacao = $this->cod_organizacao;

                $saveUsuarioResponsavel->cod_plano_de_acao = $save->cod_plano_de_acao;

                $saveUsuarioResponsavel->cod_perfil = 'c00b9ebc-7014-4d37-97dc-7875e55fff4c';

                $saveUsuarioResponsavel->save();

            }

            if (isset($this->user_id_substituto) && !is_null($this->user_id_substituto) && $this->user_id_substituto != '') {

                $saveUsuarioSubstituto = new RelUsersTabOrganizacoesTabPerfilAcesso;

                $saveUsuarioSubstituto->user_id = $this->user_id_substituto;

                $saveUsuarioSubstituto->cod_organizacao = $this->cod_organizacao;

                $saveUsuarioSubstituto->cod_plano_de_acao = $save->cod_plano_de_acao;

                $saveUsuarioSubstituto->cod_perfil = 'c00b9ebc-7014-4d37-97dc-7875e55fff5d';

                $saveUsuarioSubstituto->save();

            }

            $this->showModalResultadoEdicao = true;

            $this->mensagemResultadoEdicao = $modificacoes;

        } else {

            $editar = PlanoAcao::with('servidorResponsavel', 'servidorSubstituto')
                ->find($this->cod_plano_de_acao);

            $estruturaTable = $this->estruturaTableParaEditar();

            foreach ($estruturaTable as $result) {

                $column_name = $result->column_name;
                $data_type = $result->data_type;

                // Início da parte para igualar a formatação do campo de valor

                if ($data_type === 'numeric') {

                    $this->$column_name = converteValor('PTBR', 'MYSQL', $this->$column_name);

                }

                // Fim da parte para igualar a formatação do campo de valor

                if ($editar->$column_name != $this->$column_name) {

                    $alteracao[$column_name] = $this->$column_name;

                    $audit = TabAudit::create(array(
                        'table' => 'tab_plano_de_acao',
                        'table_id' => $this->cod_plano_de_acao,
                        'column_name' => $column_name,
                        'data_type' => $data_type,
                        'ip' => $_SERVER['REMOTE_ADDR'],
                        'user_id' => Auth::user()->id,
                        'acao' => 'Editou',
                        'antes' => $editar->$column_name,
                        'depois' => $this->$column_name
                    ));

                    if ($data_type === 'date') {

                        $modificacoes = $modificacoes . 'Alterou o(a) <b>' . nomeCampoTabelaNormalizado($column_name) . '</b> de <span style="color:#CD3333;">( ' . converterData('EN', 'PTBR', $editar->$column_name) . ' )</span> para <span style="color:#28a745;">( ' . converterData('EN', 'PTBR', $this->$column_name) . ' )</span>;<br>';

                    } elseif ($data_type === 'numeric') {

                        $modificacoes = $modificacoes . 'Alterou o(a) <b>' . nomeCampoTabelaNormalizado($column_name) . '</b> de <span style="color:#CD3333;">( ' . converteValor('MYSQL', 'PTBR', $editar->$column_name) . ' )</span> para <span style="color:#28a745;">( ' . converteValor('MYSQL', 'PTBR', $this->$column_name) . ' )</span>;<br>';

                    } elseif ($data_type === 'uuid') {

                        if ($column_name === 'cod_objetivo_estrategico') {

                            $consultarValorAntigo = ObjetivoEstrategico::find($editar->$column_name);

                            $consultarValorAtualizado = ObjetivoEstrategico::find($this->$column_name);

                            $modificacoes = $modificacoes . 'Alterou o(a) <b>' . nomeCampoTabelaNormalizado($column_name) . '</b> de <span style="color:#CD3333;">( ' . $consultarValorAntigo->num_nivel_hierarquico_apresentacao . '. ' . $consultarValorAntigo->nom_objetivo_estrategico . ' )</span> para <span style="color:#28a745;">( ' . $consultarValorAtualizado->num_nivel_hierarquico_apresentacao . '. ' . $consultarValorAtualizado->nom_objetivo_estrategico . ' )</span>;<br>';

                        } elseif ($column_name === 'cod_tipo_execucao') {

                            $consultarValorAntigo = TipoExecucao::find($editar->$column_name);

                            $consultarValorAtualizado = TipoExecucao::find($this->$column_name);

                            $modificacoes = $modificacoes . 'Alterou o(a) <b>' . nomeCampoTabelaNormalizado($column_name) . '</b> de <span style="color:#CD3333;">( ' . $consultarValorAntigo->dsc_tipo_execucao . ' )</span> para <span style="color:#28a745;">( ' . $consultarValorAtualizado->dsc_tipo_execucao . ' )</span>;<br>';

                        } elseif ($column_name === 'cod_organizacao') {

                            $consultarValorAntigo = Organization::find($editar->$column_name);

                            $consultarValorAtualizado = Organization::find($this->$column_name);

                            $modificacoes = $modificacoes . 'Alterou o(a) <b>' . nomeCampoTabelaNormalizado($column_name) . '</b> de <span style="color:#CD3333;">( ' . $consultarValorAntigo->sgl_organizacao . ' - ' . $consultarValorAntigo->nom_organizacao . ' )</span> para <span style="color:#28a745;">( ' . $consultarValorAtualizado->sgl_organizacao . ' - ' . $consultarValorAtualizado->nom_organizacao . ' )</span>;<br>';

                        }

                    } else {

                        $modificacoes = $modificacoes . 'Alterou o(a) <b>' . nomeCampoTabelaNormalizado($column_name) . '</b> de <span style="color:#CD3333;">( ' . $editar->$column_name . ' )</span> para <span style="color:#28a745;">( ' . $this->$column_name . ' )</span>;<br>';

                    }

                }

            }

            // Início da verificação se houve modificação do(a) servidor(a) responsável

            if (isset($this->user_id_responsavel) && !is_null($this->user_id_responsavel) && $this->user_id_responsavel != '') {

                $servidorResponsavelAntigo = '';
                $idServidorResponsavelAntigo = '';

                foreach ($editar->servidorResponsavel as $servidorResponsavel) {

                    $servidorResponsavelAntigo = $servidorResponsavel->name;
                    $idServidorResponsavelAntigo = $servidorResponsavel->id;

                }

                if ($idServidorResponsavelAntigo != $this->user_id_responsavel) {

                    $consultarNovoServidorResponsavel = User::find($this->user_id_responsavel);

                    $audit = TabAudit::create(array(
                        'table' => 'tab_plano_de_acao',
                        'table_id' => $this->cod_plano_de_acao,
                        'column_name' => 'user_id_responsavel',
                        'data_type' => 'uuid',
                        'ip' => $_SERVER['REMOTE_ADDR'],
                        'user_id' => Auth::user()->id,
                        'acao' => 'Editou o(a) servidor(a) responsável',
                        'antes' => $servidorResponsavelAntigo,
                        'depois' => $consultarNovoServidorResponsavel->name
                    ));

                    // Início excluir o(a) atual servidor(a) responsável

                    $consultarRelUsersTabOrganizacoesTabPerfilAcesso = RelUsersTabOrganizacoesTabPerfilAcesso::where('cod_plano_de_acao', $this->cod_plano_de_acao)
                        ->where('user_id', $idServidorResponsavelAntigo)
                        ->where('cod_organizacao', $this->cod_organizacao)
                        ->where('cod_perfil', 'c00b9ebc-7014-4d37-97dc-7875e55fff4c')
                        ->first();

                    $consultarRelUsersTabOrganizacoesTabPerfilAcesso->delete();

                    // Fim excluir o(a) atual servidor(a) responsável

                    // --- x --- x --- x --- x --- x --- x ---

                    // Início cadastrar o(a) novo servidor(a) responsável

                    $saveUsuarioResponsavel = new RelUsersTabOrganizacoesTabPerfilAcesso;

                    $saveUsuarioResponsavel->user_id = $this->user_id_responsavel;

                    $saveUsuarioResponsavel->cod_organizacao = $this->cod_organizacao;

                    $saveUsuarioResponsavel->cod_plano_de_acao = $this->cod_plano_de_acao;

                    $saveUsuarioResponsavel->cod_perfil = 'c00b9ebc-7014-4d37-97dc-7875e55fff4c';

                    $saveUsuarioResponsavel->save();

                    // Fim cadastrar o(a) novo servidor(a) responsável

                    $modificacoes = $modificacoes . 'Alterou o(a) <b>' . nomeCampoTabelaNormalizado('user_id_responsavel') . '</b> de <span style="color:#CD3333;">( ' . $servidorResponsavelAntigo . ' )</span> para <span style="color:#28a745;">( ' . $consultarNovoServidorResponsavel->name . ' )</span>;<br>';

                }

            }

            // Fim da verificação se houve modificação do(a) servidor(a) responsável

            // --- x --- x --- x --- x --- x --- x ---

            // Início da verificação se houve modificação do(a) servidor(a) substituto(a)

            if (isset($this->user_id_substituto) && !is_null($this->user_id_substituto) && $this->user_id_substituto != '') {

                $servidorSubstitutoAntigo = '';
                $idServidorSubstitutoAntigo = '';

                foreach ($editar->servidorSubstituto as $servidorSubstituto) {

                    $servidorSubstitutoAntigo = $servidorSubstituto->name;
                    $idServidorSubstitutoAntigo = $servidorSubstituto->id;

                }

                if (isset($idServidorSubstitutoAntigo) && !is_null($idServidorSubstitutoAntigo) && $idServidorSubstitutoAntigo != '') {

                    if ($idServidorSubstitutoAntigo != $this->user_id_substituto) {

                        $consultarNovoServidorSubstituto = User::find($this->user_id_substituto);

                        $audit = TabAudit::create(array(
                            'table' => 'tab_plano_de_acao',
                            'table_id' => $this->cod_plano_de_acao,
                            'column_name' => 'user_id_substituto',
                            'data_type' => 'uuid',
                            'ip' => $_SERVER['REMOTE_ADDR'],
                            'user_id' => Auth::user()->id,
                            'acao' => 'Editou o(a) servidor(a) substituo',
                            'antes' => $servidorSubstitutoAntigo,
                            'depois' => $consultarNovoServidorSubstituto->name
                        ));

                        // Início excluir o(a) atual servidor(a) substituto(a)

                        $consultarRelUsersTabOrganizacoesTabPerfilAcesso = RelUsersTabOrganizacoesTabPerfilAcesso::where('cod_plano_de_acao', $this->cod_plano_de_acao)
                            ->where('user_id', $idServidorSubstitutoAntigo)
                            ->where('cod_organizacao', $this->cod_organizacao)
                            ->where('cod_perfil', 'c00b9ebc-7014-4d37-97dc-7875e55fff5d')
                            ->first();

                        $consultarRelUsersTabOrganizacoesTabPerfilAcesso->delete();

                        // Fim excluir o(a) atual servidor(a) substituto(a)

                        // --- x --- x --- x --- x --- x --- x ---

                        // Início cadastrar o(a) novo servidor(a) substituto(a)

                        $saveUsuarioResponsavel = new RelUsersTabOrganizacoesTabPerfilAcesso;

                        $saveUsuarioResponsavel->user_id = $this->user_id_substituto;

                        $saveUsuarioResponsavel->cod_organizacao = $this->cod_organizacao;

                        $saveUsuarioResponsavel->cod_plano_de_acao = $this->cod_plano_de_acao;

                        $saveUsuarioResponsavel->cod_perfil = 'c00b9ebc-7014-4d37-97dc-7875e55fff5d';

                        $saveUsuarioResponsavel->save();

                        // Fim cadastrar o(a) novo servidor(a) substituto(a)

                        $modificacoes = $modificacoes . 'Alterou o(a) <b>' . nomeCampoTabelaNormalizado('user_id_substituto') . '</b> de <span style="color:#CD3333;">( ' . $servidorSubstitutoAntigo . ' )</span> para <span style="color:#28a745;">( ' . $consultarNovoServidorSubstituto->name . ' )</span>;<br>';

                    }

                } else {

                    if (isset($this->user_id_substituto) && !is_null($this->user_id_substituto) && $this->user_id_substituto != '') {

                        $saveUsuarioSubstituto = new RelUsersTabOrganizacoesTabPerfilAcesso;

                        $saveUsuarioSubstituto->user_id = $this->user_id_substituto;

                        $saveUsuarioSubstituto->cod_organizacao = $this->cod_organizacao;

                        $saveUsuarioSubstituto->cod_plano_de_acao = $this->cod_plano_de_acao;

                        $saveUsuarioSubstituto->cod_perfil = 'c00b9ebc-7014-4d37-97dc-7875e55fff5d';

                        $saveUsuarioSubstituto->save();

                    }

                }

            } else {

                $servidorSubstitutoAntigo = '';
                $idServidorSubstitutoAntigo = '';

                foreach ($editar->servidorSubstituto as $servidorSubstituto) {

                    $servidorSubstitutoAntigo = $servidorSubstituto->name;
                    $idServidorSubstitutoAntigo = $servidorSubstituto->id;

                }

                if (isset($idServidorSubstitutoAntigo) && !is_null($idServidorSubstitutoAntigo) && $idServidorSubstitutoAntigo != '') {

                    // Início excluir o(a) atual servidor(a) substituto(a)

                    $consultarRelUsersTabOrganizacoesTabPerfilAcesso = RelUsersTabOrganizacoesTabPerfilAcesso::where('cod_plano_de_acao', $this->cod_plano_de_acao)
                        ->where('user_id', $idServidorSubstitutoAntigo)
                        ->where('cod_organizacao', $this->cod_organizacao)
                        ->where('cod_perfil', 'c00b9ebc-7014-4d37-97dc-7875e55fff5d')
                        ->first();

                    $consultarRelUsersTabOrganizacoesTabPerfilAcesso->delete();

                    // Fim excluir o(a) atual servidor(a) substituto(a)

                }

            }

            // Fim da verificação se houve modificação do(a) servidor(a) substituto(a)

            // --- x --- x --- x --- x --- x --- x ---

            if (isset($modificacoes) && !is_null($modificacoes) && $modificacoes != '') {

                $editar->update($alteracao);

                $acao = Acoes::create(array(
                    'table' => 'tab_plano_de_acao',
                    'table_id' => $this->cod_plano_de_acao,
                    'user_id' => Auth::user()->id,
                    'acao' => $modificacoes
                ));

                $this->showModalResultadoEdicao = true;

                $this->mensagemResultadoEdicao = $modificacoes;

            } else {

                $this->showModalResultadoEdicao = true;

                $this->mensagemResultadoEdicao = 'Por não ter nenhuma modificação nada foi feito.';

            }

        }

        $this->cod_plano_de_acao = null;
        $this->cod_objetivo_estrategico = null;
        $this->cod_tipo_execucao = null;
        $this->cod_organizacao = null;
        $this->num_nivel_hierarquico_apresentacao = null;
        $this->dsc_plano_de_acao = null;
        $this->periodicidade_medicao = null;
        // $this->txt_principais_entregas = null;
        $this->vlr_orcamento_previsto = null;
        $this->dte_inicio = null;
        $this->dte_fim = null;
        $this->bln_status = 'Não iniciada';

        $this->user_id_responsavel = null;
        $this->user_id_substituto = null;

        $this->cod_pei = null;
        $this->cod_perspectiva = null;

        $this->abrirFecharForm = 'none';
        $this->iconAbrirFechar = 'fas fa-plus text-xs';

        $this->editarForm = false;

    }

    public function editForm($cod_plano_de_acao = '')
    {

        $singleData = PlanoAcao::with('servidorResponsavel', 'servidorSubstituto')
            ->find($cod_plano_de_acao);

        $this->cod_plano_de_acao = $singleData->cod_plano_de_acao;

        $consultarObjetivoEstrategico = ObjetivoEstrategico::find($singleData->cod_objetivo_estrategico);

        $consultarPerspectiva = Perspectiva::find($consultarObjetivoEstrategico->cod_perspectiva);

        $this->cod_perspectiva = $consultarObjetivoEstrategico->cod_perspectiva;

        $this->cod_pei = $consultarPerspectiva->cod_pei;

        $this->cod_objetivo_estrategico = $singleData->cod_objetivo_estrategico;
        $this->cod_tipo_execucao = $singleData->cod_tipo_execucao;
        $this->num_nivel_hierarquico_apresentacao = $singleData->num_nivel_hierarquico_apresentacao;
        $this->cod_organizacao = $singleData->cod_organizacao;
        $this->dsc_plano_de_acao = $singleData->dsc_plano_de_acao;
        // $this->txt_principais_entregas = $singleData->txt_principais_entregas;
        $this->dte_inicio = $singleData->dte_inicio;
        $this->dte_fim = $singleData->dte_fim;
        $this->bln_status = $singleData->bln_status;
        $this->vlr_orcamento_previsto = converteValor('MYSQL', 'PTBR', $singleData->vlr_orcamento_previsto);

        foreach ($singleData->servidorResponsavel as $servidorResponsavel) {

            $this->user_id_responsavel = $servidorResponsavel->id;

        }

        foreach ($singleData->servidorSubstituto as $servidorSubstituto) {

            $this->user_id_substituto = $servidorSubstituto->id;

        }

        $organizacoes = [];

        $organization = Organization::whereRaw('cod_organizacao = rel_cod_organizacao')
            ->get();

        $organizationChild = Organization::whereRaw('cod_organizacao != rel_cod_organizacao')
            ->orderBy('nom_organizacao')
            ->get();

        foreach ($organization as $result) {

            $organizacoes[$result->cod_organizacao] = $result->nom_organizacao . $this->hierarquiaUnidade($result->cod_organizacao);

            foreach ($organizationChild as $resultChild1) {

                if ($result->cod_organizacao == $resultChild1->rel_cod_organizacao) {

                    $organizacoes[$resultChild1->cod_organizacao] = $resultChild1->nom_organizacao . $this->hierarquiaUnidade($resultChild1->cod_organizacao);

                    foreach ($resultChild1->deshierarquia as $resultChild2) {

                        if ($resultChild1->cod_organizacao == $resultChild2->rel_cod_organizacao) {

                            $organizacoes[$resultChild2->cod_organizacao] = $resultChild2->nom_organizacao . $this->hierarquiaUnidade($resultChild2->cod_organizacao);

                            foreach ($resultChild2->deshierarquia as $resultChild3) {

                                if ($resultChild2->cod_organizacao == $resultChild3->rel_cod_organizacao) {

                                    $organizacoes[$resultChild3->cod_organizacao] = $resultChild3->nom_organizacao . $this->hierarquiaUnidade($resultChild3->cod_organizacao);

                                    foreach ($resultChild3->deshierarquia as $resultChild4) {

                                        if ($resultChild3->cod_organizacao == $resultChild4->rel_cod_organizacao) {

                                            $organizacoes[$resultChild4->cod_organizacao] = $resultChild4->nom_organizacao . $this->hierarquiaUnidade($resultChild4->cod_organizacao);

                                            foreach ($resultChild4->deshierarquia as $resultChild5) {

                                                if ($resultChild4->cod_organizacao == $resultChild5->rel_cod_organizacao) {

                                                    $organizacoes[$resultChild5->cod_organizacao] = $resultChild5->nom_organizacao . $this->hierarquiaUnidade($resultChild5->cod_organizacao);

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

    public function deleteForm($cod_plano_de_acao = '')
    {

        $this->cod_plano_de_acao = $cod_plano_de_acao;

        $singleData = PlanoAcao::with('servidorResponsavel', 'servidorSubstituto')
            ->find($cod_plano_de_acao);

        $consultarObjetivoEstrategico = ObjetivoEstrategico::find($singleData->cod_objetivo_estrategico);

        $consultarPerspectiva = Perspectiva::find($consultarObjetivoEstrategico->cod_perspectiva);

        $consultarPei = Pei::find($consultarPerspectiva->cod_pei);

        foreach ($singleData->servidorResponsavel as $servidorResponsavel) {

            $name_responsavel = $servidorResponsavel->name;

        }

        foreach ($singleData->servidorSubstituto as $servidorSubstituto) {

            $name_substituto = $servidorSubstituto->name;

        }

        $consultarOrganizacao = Organization::find($singleData->cod_organizacao);

        $texto = '';

        $texto .= '<p class="my-2 text-gray-500 text-xs leading-relaxed">Descrição: <strong>' . $singleData->tipoExecucao->dsc_tipo_execucao . ' ' . $singleData->num_nivel_hierarquico_apresentacao . '. ' . $singleData->dsc_plano_de_acao . '</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">Relacionado(a) ao PEI: <strong>' . $consultarPei->dsc_pei . ' (' . $consultarPei->num_ano_inicio_pei . ' a ' . $consultarPei->num_ano_fim_pei . ')</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">A Perspectiva: <strong>' . $consultarPerspectiva->num_nivel_hierarquico_apresentacao . '. ' . $consultarPerspectiva->dsc_perspectiva . '</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">E ao Objetivo Estrategico: <strong>' . $consultarObjetivoEstrategico->num_nivel_hierarquico_apresentacao . '. ' . $consultarObjetivoEstrategico->nom_objetivo_estrategico . '</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">Unidade: <strong>' . $consultarOrganizacao->nom_organizacao . '</strong></p><p class="my-2 text-gray-500 text-xs font-semibold leading-relaxed text-red-600">Quer realmente excluir?</p>';

        $this->mensagemDelete = $texto;

        $this->showModalDelete = true;

        $this->dsc_missao = null;
        $this->cod_pei = null;
        $this->cod_organizacao = null;
        $this->editarForm = false;

    }

    public function audit($cod_plano_de_acao = '')
    {

        $result = PlanoAcao::with('servidorResponsavel', 'servidorSubstituto')
            ->find($cod_plano_de_acao);

        $corpoModalAudit = '';

        $corpoModalAudit .= '<p class="text-gray-500 pl-2">Em: <strong>' . $result->tipoExecucao->dsc_tipo_execucao . ' ' . $result->num_nivel_hierarquico_apresentacao . '. ' . $result->dsc_plano_de_acao . '</strong></p><br><table class="divide-gray-300 min-w-full border-collapse" style="font-size: 0.8rem!Important;"><thead><tr class=""><td class="px-2 py-2 border border-gray-200">#</td><td class="px-2 py-2 border border-gray-200">Ação</td><td class="px-2 py-2 border border-gray-200">Quem?</td><td class="px-2 py-2 border border-gray-200">Quando?</td></tr></thead><tbody>';

        $contAcao = 1;

        foreach ($result->acoesRealizadas as $resultadoAcao) {

            $corpoModalAudit .= '<tr><td class="px-2 py-2 border border-gray-200">' . $contAcao . '</td><td class="px-2 py-2 border border-gray-200">' . $resultadoAcao->acao . '</td><td class="px-2 py-2 border border-gray-200">' . $resultadoAcao->usuario->name . '</td><td class="px-2 py-2 border border-gray-200">' . formatarDataComCarbonForHumans($resultadoAcao->created_at) . ' em ' . formatarTimeStampComCarbonParaBR($resultadoAcao->created_at) . '</td></tr>';

            $contAcao = $contAcao + 1;

        }

        $corpoModalAudit .= '</tbody></table>';

        $this->mensagemDelete = $corpoModalAudit;

        $this->showModalAudit = true;

        $this->editarForm = false;

    }

    public function delete($cod_plano_de_acao = '')
    {

        $this->showModalDelete = false;

        $singleData = PlanoAcao::with('servidorResponsavel', 'servidorSubstituto')
            ->find($cod_plano_de_acao);

        $consultarObjetivoEstrategico = ObjetivoEstrategico::find($singleData->cod_objetivo_estrategico);

        $consultarPerspectiva = Perspectiva::find($consultarObjetivoEstrategico->cod_perspectiva);

        $consultarPei = Pei::find($consultarPerspectiva->cod_pei);

        foreach ($singleData->servidorResponsavel as $servidorResponsavel) {

            $name_responsavel = $servidorResponsavel->name;

        }

        foreach ($singleData->servidorSubstituto as $servidorSubstituto) {

            $name_substituto = $servidorSubstituto->name;

        }

        $consultarOrganizacao = Organization::find($singleData->cod_organizacao);

        $texto = '';

        $texto .= '<p class="my-2 text-gray-500 text-xs leading-relaxed">Excluiu com sucesso o Plano de Ação com a Descrição: <strong>' . $singleData->tipoExecucao->dsc_tipo_execucao . ' ' . $singleData->num_nivel_hierarquico_apresentacao . '. ' . $singleData->dsc_plano_de_acao . '</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">Relacionado(a) ao PEI: <strong>' . $consultarPei->dsc_pei . ' (' . $consultarPei->num_ano_inicio_pei . ' a ' . $consultarPei->num_ano_fim_pei . ')</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">A Perspectiva: <strong>' . $consultarPerspectiva->num_nivel_hierarquico_apresentacao . '. ' . $consultarPerspectiva->dsc_perspectiva . '</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">E ao Objetivo Estrategico: <strong>' . $consultarObjetivoEstrategico->num_nivel_hierarquico_apresentacao . '. ' . $consultarObjetivoEstrategico->nom_objetivo_estrategico . '</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">Unidade: <strong>' . $consultarOrganizacao->nom_organizacao . '</strong></p>';

        $acao = Acoes::create(array(
            'table' => 'tab_plano_de_acao',
            'table_id' => $this->cod_plano_de_acao,
            'user_id' => Auth::user()->id,
            'acao' => $texto
        ));

        $singleData->delete();

        $this->cod_plano_de_acao = null;
        $this->cod_objetivo_estrategico = null;
        $this->cod_tipo_execucao = null;
        $this->cod_organizacao = null;
        $this->num_nivel_hierarquico_apresentacao = null;
        $this->dsc_plano_de_acao = null;
        $this->periodicidade_medicao = null;
        // $this->txt_principais_entregas = null;
        $this->vlr_orcamento_previsto = null;
        $this->dte_inicio = null;
        $this->dte_fim = null;
        $this->bln_status = 'Não iniciada';

        $this->user_id_responsavel = null;
        $this->user_id_substituto = null;

        $this->cod_pei = null;
        $this->cod_perspectiva = null;

        $this->editarForm = false;

        $this->showModalResultadoEdicao = true;

        $this->mensagemResultadoEdicao = $texto;

    }

    public function cancelar()
    {

        $this->cod_plano_de_acao = null;
        $this->cod_objetivo_estrategico = null;
        $this->cod_tipo_execucao = null;
        $this->cod_organizacao = null;
        $this->num_nivel_hierarquico_apresentacao = null;
        $this->dsc_plano_de_acao = null;
        $this->periodicidade_medicao = null;
        // $this->txt_principais_entregas = null;
        $this->vlr_orcamento_previsto = null;
        $this->dte_inicio = null;
        $this->dte_fim = null;
        $this->bln_status = 'Não iniciada';

        $this->user_id_responsavel = null;
        $this->user_id_substituto = null;

        $this->cod_pei = null;
        $this->cod_perspectiva = null;

        $this->editarForm = false;

    }

    public function render()
    {

        $this->pei = Pei::select(db::raw("dsc_pei||' ( '||num_ano_inicio_pei||' a '||num_ano_fim_pei||' )' as dsc_pei, cod_pei"))
            ->where('dsc_pei', '!=', '')
            ->whereNotNull('dsc_pei')
            ->orderBy('dsc_pei')
            ->pluck('dsc_pei', 'cod_pei');

        $perspectiva = Perspectiva::select(db::raw("num_nivel_hierarquico_apresentacao||'. '||dsc_perspectiva as dsc_perspectiva, cod_perspectiva"));

        if (isset($this->cod_pei) && !is_null($this->cod_pei) && $this->cod_pei != '') {

            $perspectiva = $perspectiva->where('cod_pei', $this->cod_pei);

        } else {

            $perspectiva = $perspectiva->whereNull('cod_pei');

        }

        $perspectiva = $perspectiva->orderBy('num_nivel_hierarquico_apresentacao', 'desc')
            ->pluck('dsc_perspectiva', 'cod_perspectiva');

        $perspectiva && isset($perspectiva) && !empty($perspectiva) ? $this->perspectiva = $perspectiva : $this->perspectiva = [];
        ;

        $objetivoEstrategico = ObjetivoEstrategico::select(DB::raw("num_nivel_hierarquico_apresentacao||'. '||nom_objetivo_estrategico AS nom_objetivo_estrategico, cod_objetivo_estrategico"));

        if (isset($this->cod_pei) && !is_null($this->cod_pei) && $this->cod_pei != '' && isset($this->cod_perspectiva) && !is_null($this->cod_perspectiva) && $this->cod_perspectiva != '' && $perspectiva->count() > 0) {

            $objetivoEstrategico = $objetivoEstrategico->where('cod_perspectiva', $this->cod_perspectiva);

        } else {

            $objetivoEstrategico = $objetivoEstrategico->whereNull('cod_perspectiva');

        }

        $objetivoEstrategico = $objetivoEstrategico->orderBy('num_nivel_hierarquico_apresentacao')
            ->with('perspectiva')
            ->pluck('nom_objetivo_estrategico', 'cod_objetivo_estrategico');

        $this->objetivoEstragico = $objetivoEstrategico;

        if (isset($this->cod_pei) && !is_null($this->cod_pei) && $this->cod_pei != '') {

            $consultarPei = Pei::select('num_ano_inicio_pei', 'num_ano_fim_pei')
                ->find($this->cod_pei);

            $primeiroAnoDoPeiSelecionado = $consultarPei->num_ano_inicio_pei;

            $ultimoAnoDoPeiSelecionado = $consultarPei->num_ano_fim_pei;

            $this->primeiroAnoDoPeiSelecionado = $primeiroAnoDoPeiSelecionado . '-01-01';

            $this->ultimoAnoDoPeiSelecionado = $ultimoAnoDoPeiSelecionado . '-12-31';

        } else {

            $this->primeiroAnoDoPeiSelecionado = '2020-01-01';

            $this->ultimoAnoDoPeiSelecionado = '2051-12-31';

        }

        $this->estruturaTable = $this->estruturaTable();

        if ($this->editarForm == false) {

            if (isset($this->cod_objetivo_estrategico) && !is_null($this->cod_objetivo_estrategico) && $this->cod_objetivo_estrategico != '') {

                $this->num_nivel_hierarquico_apresentacao = $this->pesquisarCodigo($this->cod_objetivo_estrategico);

            }

        } else {

            if (isset($this->cod_objetivo_estrategico) && !is_null($this->cod_objetivo_estrategico) && $this->cod_objetivo_estrategico != '' && $this->editarForm == false) {

                $this->num_nivel_hierarquico_apresentacao = $this->num_nivel_hierarquico_apresentacao;

            }

        }

        $this->niveis_hierarquico_apresentacao = NumNivelHierarquico::pluck('num_nivel_hierarquico_apresentacao', 'num_nivel_hierarquico_apresentacao');

        $this->tipoExecucao = TipoExecucao::orderBy('dsc_tipo_execucao')
            ->pluck('dsc_tipo_execucao', 'cod_tipo_execucao');

        $organization = Organization::whereRaw('cod_organizacao = rel_cod_organizacao')
            ->get();

        $organizationChild = Organization::whereRaw('cod_organizacao != rel_cod_organizacao')
            ->orderBy('nom_organizacao')
            ->get();

        foreach ($organization as $result) {

            if ($this->editarForm == false) {

                $organizacoes[$result->cod_organizacao] = $result->nom_organizacao . $this->hierarquiaUnidade($result->cod_organizacao);

            } else {

                $organizacoes[$result->cod_organizacao] = $result->nom_organizacao . $this->hierarquiaUnidade($result->cod_organizacao);

            }

            foreach ($organizationChild as $resultChild1) {

                if ($result->cod_organizacao == $resultChild1->rel_cod_organizacao) {

                    if ($this->editarForm == false) {

                        $organizacoes[$resultChild1->cod_organizacao] = $resultChild1->nom_organizacao . $this->hierarquiaUnidade($resultChild1->cod_organizacao);

                    } else {

                        $organizacoes[$resultChild1->cod_organizacao] = $resultChild1->nom_organizacao . $this->hierarquiaUnidade($resultChild1->cod_organizacao);

                    }

                    foreach ($resultChild1->deshierarquia as $resultChild2) {

                        if ($resultChild1->cod_organizacao == $resultChild2->rel_cod_organizacao) {

                            if ($this->editarForm == false) {

                                $organizacoes[$resultChild2->cod_organizacao] = $resultChild2->nom_organizacao . $this->hierarquiaUnidade($resultChild2->cod_organizacao);

                            } else {

                                $organizacoes[$resultChild2->cod_organizacao] = $resultChild2->nom_organizacao . $this->hierarquiaUnidade($resultChild2->cod_organizacao);

                            }

                            foreach ($resultChild2->deshierarquia as $resultChild3) {

                                if ($resultChild2->cod_organizacao == $resultChild3->rel_cod_organizacao) {

                                    if ($this->editarForm == false) {

                                        $organizacoes[$resultChild3->cod_organizacao] = $resultChild3->nom_organizacao . $this->hierarquiaUnidade($resultChild3->cod_organizacao);

                                    } else {

                                        $organizacoes[$resultChild3->cod_organizacao] = $resultChild3->nom_organizacao . $this->hierarquiaUnidade($resultChild3->cod_organizacao);

                                    }

                                    foreach ($resultChild3->deshierarquia as $resultChild4) {

                                        if ($resultChild3->cod_organizacao == $resultChild4->rel_cod_organizacao) {

                                            if ($this->editarForm == false) {

                                                $organizacoes[$resultChild4->cod_organizacao] = $resultChild4->nom_organizacao . $this->hierarquiaUnidade($resultChild4->cod_organizacao);

                                            } else {

                                                $organizacoes[$resultChild4->cod_organizacao] = $resultChild4->nom_organizacao . $this->hierarquiaUnidade($resultChild4->cod_organizacao);

                                            }

                                            foreach ($resultChild4->deshierarquia as $resultChild5) {

                                                if ($resultChild4->cod_organizacao == $resultChild5->rel_cod_organizacao) {

                                                    if ($this->editarForm == false) {

                                                        $organizacoes[$resultChild5->cod_organizacao] = $resultChild5->nom_organizacao . $this->hierarquiaUnidade($resultChild5->cod_organizacao);

                                                    } else {

                                                        $organizacoes[$resultChild5->cod_organizacao] = $resultChild5->nom_organizacao . $this->hierarquiaUnidade($resultChild5->cod_organizacao);

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

        $planoAcao = PlanoAcao::with('objetivoEstrategico', 'tipoExecucao', 'unidade', 'servidorResponsavel', 'servidorSubstituto', 'acoesRealizadas')
            ->orderBy('num_nivel_hierarquico_apresentacao');

        $planoAcao = $planoAcao->whereHas('objetivoEstrategico', function ($query) {
            $query->orderBy('num_nivel_hierarquico_apresentacao');
        });

        if (isset($this->cod_pei) && !is_null($this->cod_pei) && $this->cod_pei != '') {

            $consultarPei = Pei::find($this->cod_pei);

            $planoAcao = $planoAcao->where('dte_inicio', '>=', $primeiroAnoDoPeiSelecionado . '-01-01');

            $planoAcao = $planoAcao->where('dte_fim', '<=', $ultimoAnoDoPeiSelecionado . '-12-31');

        }

        if (isset($this->cod_perspectiva) && !is_null($this->cod_perspectiva) && $this->cod_perspectiva != '') {

            $objetivosEstrategicos = ObjetivoEstrategico::select('cod_objetivo_estrategico')
                ->where('cod_perspectiva', $this->cod_perspectiva)
                ->get();

            $cods_objetivo_estrategico = '';

            foreach ($objetivosEstrategicos as $result) {

                if (isset($result->cod_objetivo_estrategico) && !empty($result->cod_objetivo_estrategico)) {
                    $cods_objetivo_estrategico = $cods_objetivo_estrategico . $result->cod_objetivo_estrategico . ",";
                }

            }

            if (isset($cods_objetivo_estrategico) && !empty($cods_objetivo_estrategico)) {
                $cods_objetivo_estrategico = trim($cods_objetivo_estrategico, ',');

                $cods_objetivo_estrategico = explode(',', $cods_objetivo_estrategico);

                if (isset($cods_objetivo_estrategico) && !empty($cods_objetivo_estrategico) && is_array($cods_objetivo_estrategico) && count($cods_objetivo_estrategico) > 0) {
                    $planoAcao = $planoAcao->whereIn('cod_objetivo_estrategico', $cods_objetivo_estrategico);
                }
            }

        }

        if (isset($this->cod_objetivo_estrategico) && !is_null($this->cod_objetivo_estrategico) && $this->cod_objetivo_estrategico != '') {

            $planoAcao = $planoAcao->where('cod_objetivo_estrategico', $this->cod_objetivo_estrategico);

        }

        if (isset($this->dte_inicio) && !is_null($this->dte_inicio) && $this->dte_inicio != '') {

            $this->primeiroAnoDoPeiSelecionado = $this->dte_inicio;

        }

        $planoAcao && isset($planoAcao) && !empty($planoAcao) ? $this->planoAcao = $planoAcao->get() : $this->planoAcao = [];

        $usuariosResponsaveis = User::where('ativo', 1)
            ->orderBy('name');

        if (isset($this->user_id_substituto) && !is_null($this->user_id_substituto) && $this->user_id_substituto != '') {

            $usuariosResponsaveis = $usuariosResponsaveis->where('id', '!=', $this->user_id_substituto);

        }

        $this->usuariosResponsaveis = $usuariosResponsaveis->pluck('name', 'id');

        $usuariosSubstitutos = User::where('ativo', 1)
            ->orderBy('name');

        if (isset($this->user_id_responsavel) && !is_null($this->user_id_responsavel) && $this->user_id_responsavel != '') {

            $usuariosSubstitutos = $usuariosSubstitutos->where('id', '!=', $this->user_id_responsavel);

        }

        $this->usuariosSubstitutos = $usuariosSubstitutos->pluck('name', 'id');

        return view('livewire.plano-acao-livewire');

    }

    protected function estruturaTable()
    {

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

    protected function estruturaTableParaEditar()
    {

        $estrutura = DB::select("SELECT
            column_name,ordinal_position,is_nullable,data_type
            FROM
            information_schema.columns
            WHERE
            table_schema = 'pei'
            AND table_name = 'tab_plano_de_acao'
            AND column_name NOT IN ('cod_plano_de_acao','cod_ppa','cod_loa','created_at','updated_at','deleted_at');");

        return $estrutura;

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

}
