<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Organization;
use App\Models\Pei;
use App\Models\Valores;
use Livewire\WithPagination;
use App\Models\Acoes;
use App\Models\Audit;
use DB;
use Auth;

class ValoresLivewire extends Component
{

    public $valores = null;
    public $organization = null;
    public $pei = null;
    public $estruturaTable = null;
    public $cod_valor = null;
    public $nom_valor = null;
    public $dsc_valor = null;
    public $cod_pei = null;
    public $cod_organizacao = null;
    public $hierarquiaUnidade = null;

    public $abrirFecharForm = 'none';
    public $iconAbrirFechar = 'fas fa-plus text-xs';
    public $iconFechar = 'fas fa-minus text-xs';
    public $editarForm = false;
    public $deleteForm = false;
    public $showModalResultadoEdicao = false;
    public $mensagemResultadoEdicao = null;
    public $showModalDelete = false;
    public $mensagemDelete = null;

    public function create()
    {

        // Necessário incluir a parte de validação

        $modificacoes = '';
        $alteracao = array();

        if (!$this->editarForm) {

            $modificacoes = "Inseriu o seguinte dado em relação aos Valores:<br><br>";

            $save = new Valores;

            $save->cod_pei = $this->cod_pei;

            $consultarPei = Pei::find($this->cod_pei);

            if (isset($this->nom_valor) && !is_null($this->nom_valor) && $this->nom_valor != '') {

                $save->nom_valor = $this->nom_valor;

                $modificacoes = $modificacoes . "Valor: <span class='text-green-800'>" . $this->nom_valor . "</span><br>";

            }

            if (isset($this->dsc_valor) && !is_null($this->dsc_valor) && $this->dsc_valor != '') {

                $save->dsc_valor = $this->dsc_valor;

                $modificacoes = $modificacoes . "Descrição do Valor: <span class='text-green-800'>" . $this->dsc_valor . "</span><br>";

            }

            $modificacoes = $modificacoes . "PEI: <span class='text-green-800'>" . $consultarPei->dsc_pei . "</span><br>";

            $save->cod_organizacao = $this->cod_organizacao;

            $consultarOrganizacao = Organization::find($this->cod_organizacao);

            $modificacoes = $modificacoes . "Unidade: <span class='text-green-800'>" . $consultarOrganizacao->sgl_organizacao . " - " . $consultarOrganizacao->nom_organizacao . "</span><br><br>";

            $save->save();

            $acao = Acoes::create(
                array(
                    'table' => 'tab_pei',
                    'table_id' => $save->cod_valor,
                    'user_id' => Auth::user()->id,
                    'acao' => $modificacoes
                )
            );

            $this->showModalResultadoEdicao = true;

            $this->mensagemResultadoEdicao = $modificacoes;

        } else {

            $editar = Valores::find($this->cod_valor);

            $estruturaTable = $this->estruturaTableParaEditar();

            foreach ($estruturaTable as $result) {

                $column_name = $result->column_name;
                $data_type = $result->data_type;

                if ($editar->$column_name != $this->$column_name) {

                    $alteracao[$column_name] = $this->$column_name;

                    $audit = Audit::create(
                        array(
                            'table' => 'tab_valores',
                            'table_id' => $this->cod_valor,
                            'column_name' => $column_name,
                            'data_type' => $data_type,
                            'ip' => $_SERVER['REMOTE_ADDR'],
                            'user_id' => Auth::user()->id,
                            'acao' => 'Editou',
                            'antes' => $editar->$column_name,
                            'depois' => $this->$column_name
                        )
                    );

                    if ($column_name != 'cod_pei' && $column_name != 'cod_organizacao') {

                        $modificacoes = $modificacoes . 'Alterou o(a) <b>' . nomeCampoTabelaNormalizado($column_name) . '</b> de <span style="color:#CD3333;">( ' . $editar->$column_name . ' )</span> para <span style="color:#28a745;">( ' . $this->$column_name . ' )</span>;<br>';

                    } elseif ($column_name == 'cod_pei' || $column_name == 'cod_organizacao') {

                        if ($column_name == 'cod_pei') {

                            $consultarAntigo = Pei::find($editar->cod_pei);

                            $consultarNovo = Pei::find($this->$column_name);

                            $modificacoes = $modificacoes . 'Alterou o(a) <b>Planejamento Estratégico Integrado - PEI</b> de <span style="color:#CD3333;">( ' . $consultarAntigo->dsc_pei . ' )</span> para <span style="color:#28a745;">( ' . $consultarNovo->dsc_pei . ' )</span>;<br>';

                        }

                        if ($column_name == 'cod_organizacao') {

                            $consultarAntigo = Organization::find($editar->cod_organizacao);

                            $consultarNovo = Organization::find($this->$column_name);

                            $modificacoes = $modificacoes . 'Alterou o(a) <b>A unidade</b> de <span style="color:#CD3333;">( ' . $consultarAntigo->nom_organizacao . ' )</span> para <span style="color:#28a745;">( ' . $consultarNovo->nom_organizacao . ' )</span>;<br>';

                        }

                    }

                }

            }

            if (isset($modificacoes) && !is_null($modificacoes) && $modificacoes != '') {

                $editar->update($alteracao);

                $acao = Acoes::create(
                    array(
                        'table' => 'tab_valores',
                        'table_id' => $this->cod_valor,
                        'user_id' => Auth::user()->id,
                        'acao' => $modificacoes
                    )
                );

                $this->showModalResultadoEdicao = true;

                $this->mensagemResultadoEdicao = $modificacoes;

            } else {

                $this->showModalResultadoEdicao = true;

                $this->mensagemResultadoEdicao = 'Por não ter nenhuma modificação nada foi feito.';

            }

        }

        $this->cod_valor = null;
        $this->cod_pei = null;
        $this->cod_organizacao = null;
        $this->nom_valor = null;
        $this->dsc_valor = null;

        $this->abrirFecharForm = 'none';
        $this->iconAbrirFechar = 'fas fa-plus text-xs';

        $this->editarForm = false;

    }

    public function abrirFecharForm()
    {

        if ($this->abrirFecharForm === 'none') {

            $this->cod_valor = null;
            $this->cod_pei = null;
            $this->cod_organizacao = null;
            $this->nom_valor = null;
            $this->dsc_valor = null;
            $this->editarForm = false;

            $this->abrirFecharForm = 'block';
            $this->iconAbrirFechar = 'fas fa-minus text-xs';

        } else {

            $this->cod_valor = null;
            $this->cod_pei = null;
            $this->cod_organizacao = null;
            $this->nom_valor = null;
            $this->dsc_valor = null;
            $this->editarForm = false;

            $this->abrirFecharForm = 'none';
            $this->iconAbrirFechar = 'fas fa-plus text-xs';

        }

    }

    public function editForm(Valores $singleData)
    {

        $this->cod_pei = $singleData->cod_pei;
        $this->cod_organizacao = $singleData->cod_organizacao;
        $this->nom_valor = $singleData->nom_valor;
        $this->dsc_valor = $singleData->dsc_valor;
        $this->cod_valor = $singleData->cod_valor;

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

    public function deleteForm(Valores $singleData)
    {

        $this->cod_valor = $singleData->cod_valor;

        $consultarPei = Pei::find($singleData->cod_pei);

        $consultarOrganizacao = Organization::find($singleData->cod_organizacao);

        $texto = '';

        $texto .= '<p class="my-2 text-gray-500 text-xs leading-relaxed">Valor: <strong>' . $singleData->nom_valor . '</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">Descrição do Valor: <strong>' . $singleData->dsc_valor . '</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">Planejamento: <strong>' . $consultarPei->dsc_pei . '</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">Unidade: <strong>' . $consultarOrganizacao->nom_organizacao . '</strong></p><p class="my-2 text-gray-500 text-xs font-semibold leading-relaxed text-red-600">Quer realmente excluir?</p>';

        $this->mensagemDelete = $texto;

        $this->showModalDelete = true;

        $this->nom_valor = null;
        $this->dsc_valor = null;
        $this->cod_pei = null;
        $this->cod_organizacao = null;
        $this->editarForm = false;

    }

    public function delete(Valores $singleData)
    {

        $this->showModalDelete = false;

        $consultarPei = Pei::find($singleData->cod_pei);

        $consultarOrganizacao = Organization::find($singleData->cod_organizacao);

        $modificacoes = '';

        $this->nom_valor = $singleData->nom_valor;
        $this->dsc_valor = $singleData->dsc_valor;
        $this->cod_pei = $singleData->cod_pei;
        $this->cod_organizacao = $singleData->cod_organizacao;
        $this->cod_valor = $singleData->cod_valor;

        $modificacoes = $modificacoes . '<p class="my-2 text-gray-500 text-xs leading-relaxed">Valor <strong>' . $singleData->nom_valor . '</strong> da Unidade <strong>' . $consultarOrganizacao->nom_organizacao . '</strong> e do Planejamento Estratégico Integrado <strong>' . $consultarPei->dsc_pei . '</strong> foi excluído com sucesso.</p>';

        $acao = Acoes::create(
            array(
                'table' => 'tab_pei',
                'table_id' => $singleData->cod_valor,
                'user_id' => Auth::user()->id,
                'acao' => $modificacoes
            )
        );

        $singleData->delete();

        $this->nom_valor = null;
        $this->dsc_valor = null;
        $this->cod_pei = null;
        $this->cod_organizacao = null;
        $this->editarForm = false;

        $this->showModalResultadoEdicao = true;

        $this->mensagemResultadoEdicao = $modificacoes;

    }

    public function cancelar()
    {

        $this->cod_valor = null;
        $this->cod_pei = null;
        $this->cod_organizacao = null;
        $this->nom_valor = null;
        $this->dsc_valor = null;
        $this->editarForm = false;

    }

    public function render()
    {

        $this->estruturaTable = $this->estruturaTable();

        $cods_organizacao = [];

        $organization = Organization::whereRaw('cod_organizacao = rel_cod_organizacao')
            ->get();

        $organizationChild = Organization::whereRaw('cod_organizacao != rel_cod_organizacao')
            ->orderBy('nom_organizacao')
            ->get();

        $organizacoes = [];

        foreach ($organization as $result) {

            if ($this->editarForm == false) {

                if (!in_array($result->cod_organizacao, $cods_organizacao)) {

                    $organizacoes[$result->cod_organizacao] = $result->nom_organizacao . $this->hierarquiaUnidade($result->cod_organizacao);

                }

            } else {

                $organizacoes[$result->cod_organizacao] = $result->nom_organizacao . $this->hierarquiaUnidade($result->cod_organizacao);

            }

            foreach ($organizationChild as $resultChild1) {

                if ($result->cod_organizacao == $resultChild1->rel_cod_organizacao) {

                    if ($this->editarForm == false) {

                        if (!in_array($resultChild1->cod_organizacao, $cods_organizacao)) {

                            $organizacoes[$resultChild1->cod_organizacao] = $resultChild1->nom_organizacao . $this->hierarquiaUnidade($resultChild1->cod_organizacao);

                        }

                    } else {

                        $organizacoes[$resultChild1->cod_organizacao] = $resultChild1->nom_organizacao . $this->hierarquiaUnidade($resultChild1->cod_organizacao);

                    }

                    foreach ($resultChild1->deshierarquia as $resultChild2) {

                        if ($resultChild1->cod_organizacao == $resultChild2->rel_cod_organizacao) {

                            if ($this->editarForm == false) {

                                if (!in_array($resultChild2->cod_organizacao, $cods_organizacao)) {

                                    $organizacoes[$resultChild2->cod_organizacao] = $resultChild2->nom_organizacao . $this->hierarquiaUnidade($resultChild2->cod_organizacao);

                                }

                            } else {

                                $organizacoes[$resultChild2->cod_organizacao] = $resultChild2->nom_organizacao . $this->hierarquiaUnidade($resultChild2->cod_organizacao);

                            }

                            foreach ($resultChild2->deshierarquia as $resultChild3) {

                                if ($resultChild2->cod_organizacao == $resultChild3->rel_cod_organizacao) {

                                    if ($this->editarForm == false) {

                                        if (!in_array($resultChild3->cod_organizacao, $cods_organizacao)) {

                                            $organizacoes[$resultChild3->cod_organizacao] = $resultChild3->nom_organizacao . $this->hierarquiaUnidade($resultChild3->cod_organizacao);

                                        }

                                    } else {

                                        $organizacoes[$resultChild3->cod_organizacao] = $resultChild3->nom_organizacao . $this->hierarquiaUnidade($resultChild3->cod_organizacao);

                                    }

                                    foreach ($resultChild3->deshierarquia as $resultChild4) {

                                        if ($resultChild3->cod_organizacao == $resultChild4->rel_cod_organizacao) {

                                            if ($this->editarForm == false) {

                                                if (!in_array($resultChild4->cod_organizacao, $cods_organizacao)) {

                                                    $organizacoes[$resultChild4->cod_organizacao] = $resultChild4->nom_organizacao . $this->hierarquiaUnidade($resultChild4->cod_organizacao);

                                                }

                                            } else {

                                                $organizacoes[$resultChild4->cod_organizacao] = $resultChild4->nom_organizacao . $this->hierarquiaUnidade($resultChild4->cod_organizacao);

                                            }

                                            foreach ($resultChild4->deshierarquia as $resultChild5) {

                                                if ($resultChild4->cod_organizacao == $resultChild5->rel_cod_organizacao) {

                                                    if ($this->editarForm == false) {

                                                        if (!in_array($resultChild5->cod_organizacao, $cods_organizacao)) {

                                                            $organizacoes[$resultChild5->cod_organizacao] = $resultChild5->nom_organizacao . $this->hierarquiaUnidade($resultChild5->cod_organizacao);

                                                        }

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

        $this->pei = Pei::select(db::raw("dsc_pei||' ( '||num_ano_inicio_pei||' a '||num_ano_fim_pei||' )' as dsc_pei, cod_pei"))
            ->where('dsc_pei', '!=', '')
            ->whereNotNull('dsc_pei')
            ->orderBy('dsc_pei')
            ->pluck('dsc_pei', 'cod_pei');

        $valores = Valores::orderBy('nom_valor', 'desc')
            ->with('planejamentoEstrategicoIntegrado', 'unidade.hierarquia')
            ->get();

        $this->valores = $valores;

        $this->mostrarHierarquia = $this->hierarquiaUnidade($this->cod_organizacao);

        return view('livewire.valores');
    }

    protected function estruturaTable()
    {

        $estrutura = DB::select("SELECT
            column_name,ordinal_position,is_nullable,data_type
            FROM
            information_schema.columns
            WHERE
            table_schema = 'pei'
            AND table_name = 'tab_valores'
            AND column_name NOT IN ('cod_valor','cod_pei','cod_organizacao','created_at','updated_at','deleted_at');");

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
            AND table_name = 'tab_valores'
            AND column_name NOT IN ('cod_valor','created_at','updated_at','deleted_at');");

        return $estrutura;

    }

    protected function hierarquiaUnidade($cod_organizacao = '')
    {

        if (isset($cod_organizacao) && !is_null($cod_organizacao) && $cod_organizacao != '') {

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

}
