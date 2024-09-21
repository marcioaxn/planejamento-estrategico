<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Perspectiva;
use App\Models\Pei;
use Livewire\WithPagination;
use App\Models\Acoes;
use App\Models\Audit;
use DB;
use Auth;

class PerspectivaLivewire extends Component
{

    public $perspectiva = null;
    public $pei = null;
    public $estruturaTable = null;
    public $cod_perspectiva = null;
    public $dsc_perspectiva = null;
    public $niveis_hierarquico_apresentacao = null;
    public $num_nivel_hierarquico_apresentacao = null;
    public $cod_pei = null;

    public $editarForm = false;
    public $deleteForm = false;
    public $showModalResultadoEdicao = false;
    public $mensagemResultadoEdicao = null;
    public $showModalDelete = false;
    public $mensagemDelete = null;

    public $abrirFecharForm = 'none';
    public $iconAbrirFechar = 'fas fa-plus text-xs';
    public $iconFechar = 'fas fa-minus text-xs';

    public function getPerspectiva($codPerspectiva = null)
    {
        if (isset($codPerspectiva) && !empty($codPerspectiva)) {
            return Perspectiva::find($codPerspectiva);
        } else {
            return null;
        }
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

            $modificacoes = "Inseriu os seguintes dados em relação a Perspectiva:<br><br>";

            $save = new Perspectiva;

            $save->cod_pei = $this->cod_pei;

            $consultarPei = Pei::find($this->cod_pei);

            $modificacoes = $modificacoes . "A Perspectiva será vinculada a qual PEI? <span class='text-green-800'>" . $consultarPei->dsc_pei . "</span><br>";

            if (isset($this->dsc_perspectiva) && !is_null($this->dsc_perspectiva) && $this->dsc_perspectiva != '') {

                $save->dsc_perspectiva = $this->dsc_perspectiva;

                $modificacoes = $modificacoes . "Perspectiva: <span class='text-green-800'>" . $this->dsc_perspectiva . "</span><br>";

            }

            $save->num_nivel_hierarquico_apresentacao = $this->num_nivel_hierarquico_apresentacao;

            $consultarPei = Pei::find($this->cod_pei);

            $modificacoes = $modificacoes . "Qual será o nível hierarquico de apresentação da Perspectiva, de baixo para cima? <span class='text-green-800'>" . $this->num_nivel_hierarquico_apresentacao . "</span><br>";

            $save->save();

            $acao = Acoes::create(
                array(
                    'table' => 'tab_pei',
                    'table_id' => $save->cod_perspectiva,
                    'user_id' => Auth::user()->id,
                    'acao' => $modificacoes
                )
            );

            $this->showModalResultadoEdicao = true;

            $this->mensagemResultadoEdicao = $modificacoes;

        } else {

            $editar = Perspectiva::find($this->cod_perspectiva);

            $estruturaTable = $this->estruturaTableParaEditar();

            foreach ($estruturaTable as $result) {

                $column_name = $result->column_name;

                if ($editar->$column_name != $this->$column_name) {

                    $alteracao[$column_name] = $this->$column_name;

                    if ($column_name != 'cod_pei') {

                        $modificacoes = $modificacoes . 'Alterou o(a) <b>' . nomeCampoTabelaNormalizado($column_name) . '</b> de <span style="color:#CD3333;">( ' . $editar->$column_name . ' )</span> para <span style="color:#28a745;">( ' . $this->$column_name . ' )</span>;<br>';

                    } elseif ($column_name == 'cod_pei' || $column_name == 'cod_organizacao') {

                        if ($column_name == 'cod_pei') {

                            $consultarAntigo = Pei::find($editar->cod_pei);

                            $consultarNovo = Pei::find($this->$column_name);

                            $modificacoes = $modificacoes . 'Alterou o(a) <b>Planejamento Estratégico Integrado - PEI</b> de <span style="color:#CD3333;">( ' . $consultarAntigo->dsc_pei . ' )</span> para <span style="color:#28a745;">( ' . $consultarNovo->dsc_pei . ' )</span>;<br>';

                        }

                    }

                }

            }

            if (isset($modificacoes) && !is_null($modificacoes) && $modificacoes != '') {

                $editar->update($alteracao);

                $acao = Acoes::create(
                    array(
                        'table' => 'tab_perspectiva',
                        'table_id' => $this->cod_perspectiva,
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

        $this->cod_perspectiva = null;
        $this->cod_pei = null;
        $this->dsc_perspectiva = null;
        $this->num_nivel_hierarquico_apresentacao = null;

        $this->abrirFecharForm = 'none';
        $this->iconAbrirFechar = 'fas fa-plus text-xs';

        $this->editarForm = false;

    }

    public function editForm(Perspectiva $singleData)
    {

        $this->cod_pei = $singleData->cod_pei;
        $this->cod_organizacao = $singleData->cod_organizacao;
        $this->dsc_perspectiva = $singleData->dsc_perspectiva;
        $this->num_nivel_hierarquico_apresentacao = $singleData->num_nivel_hierarquico_apresentacao;
        $this->nom_valor = $singleData->nom_valor;
        $this->cod_perspectiva = $singleData->cod_perspectiva;

        $this->abrirFecharForm = 'block';
        $this->iconAbrirFechar = 'fas fa-minus text-xs';

        $this->editarForm = true;

    }

    public function deleteForm(Perspectiva $singleData)
    {

        $this->cod_perspectiva = $singleData->cod_perspectiva;

        $consultarPei = Pei::find($singleData->cod_pei);

        $texto = '';

        $texto .= '<p class="my-2 text-gray-500 text-lg leading-relaxed">Perspectiva: <strong>' . $singleData->dsc_perspectiva . '</strong></p><p class="my-2 text-gray-500 text-lg leading-relaxed">Nível hierarquico de apresentação: <strong>' . $singleData->num_nivel_hierarquico_apresentacao . '</strong></p><p class="my-2 text-gray-500 text-lg leading-relaxed">Planejamento: <strong>' . $consultarPei->dsc_pei . '</strong></p><p class="my-2 text-gray-500 text-lg font-semibold leading-relaxed text-red-600">Quer realmente excluir?</p>';

        $this->mensagemDelete = $texto;

        $this->showModalDelete = true;

        $this->dsc_perspectiva = null;
        $this->cod_pei = null;

        $this->editarForm = false;

    }

    public function delete(Perspectiva $singleData)
    {

        $this->showModalDelete = false;

        $consultarPei = Pei::find($singleData->cod_pei);

        $modificacoes = '';

        $this->dsc_perspectiva = $singleData->dsc_perspectiva;
        $this->cod_pei = $singleData->cod_pei;
        $this->num_nivel_hierarquico_apresentacao = $singleData->num_nivel_hierarquico_apresentacao;
        $this->cod_perspectiva = $singleData->cod_perspectiva;

        $modificacoes = $modificacoes . '<p class="my-2 text-gray-500 text-lg leading-relaxed">A Perspectiva <strong>' . $singleData->dsc_perspectiva . '</strong> com o Nível hierarquico de apresentação <strong>' . $singleData->num_nivel_hierarquico_apresentacao . '</strong> e vinculada ao Planejamento Estratégico Integrado <strong>' . $consultarPei->dsc_pei . '</strong> foi excluída com sucesso.</p>';

        $acao = Acoes::create(
            array(
                'table' => 'tab_pei',
                'table_id' => $singleData->cod_perspectiva,
                'user_id' => Auth::user()->id,
                'acao' => $modificacoes
            )
        );

        $singleData->delete();

        $this->dsc_perspectiva = null;
        $this->num_nivel_hierarquico_apresentacao = null;
        $this->cod_pei = null;

        $this->editarForm = false;


        $this->showModalResultadoEdicao = true;

        $this->mensagemResultadoEdicao = $modificacoes;

    }

    public function cancelar()
    {

        $this->cod_perspectiva = null;
        $this->cod_pei = null;

        $this->dsc_perspectiva = null;
        $this->num_nivel_hierarquico_apresentacao = null;

        $this->editarForm = false;

    }

    public function render()
    {

        $this->estruturaTable = $this->estruturaTable();

        $this->pei = Pei::select(db::raw("dsc_pei||' ( '||num_ano_inicio_pei||' a '||num_ano_fim_pei||' )' as dsc_pei, cod_pei"))
            ->where('dsc_pei', '!=', '')
            ->whereNotNull('dsc_pei')
            ->orderBy('dsc_pei')
            ->pluck('dsc_pei', 'cod_pei');

        $this->niveis_hierarquico_apresentacao = [5 => '5', 4 => '4', 3 => '3', 2 => '2', 1 => '1'];

        $perspectiva = Perspectiva::orderBy('num_nivel_hierarquico_apresentacao', 'desc')
            ->with('planejamentoEstrategicoIntegrado')
            ->get();

        $this->perspectiva = $perspectiva;

        return view('livewire.perspectiva-livewire');
    }

    protected function estruturaTable()
    {

        $estrutura = DB::select("SELECT
            column_name,ordinal_position,is_nullable,data_type
            FROM
            information_schema.columns
            WHERE
            table_schema = 'pei'
            AND table_name = 'tab_perspectiva'
            AND column_name NOT IN ('cod_perspectiva','cod_pei','created_at','updated_at','deleted_at');");

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
            AND table_name = 'tab_perspectiva'
            AND column_name NOT IN ('cod_perspectiva','created_at','updated_at','deleted_at');");

        return $estrutura;

    }
}
