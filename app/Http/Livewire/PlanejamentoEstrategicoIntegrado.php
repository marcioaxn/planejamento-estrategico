<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Pei;
use Livewire\WithPagination;
use App\Models\Acoes;
use App\Models\Audit;
use DB;
use Auth;

class PlanejamentoEstrategicoIntegrado extends Component
{

    public $pei = null;
    public $cod_pei = null;
    public $dsc_pei = null;
    public $num_ano_inicio_pei = null;
    public $num_ano_fim_pei = null;
    public $anos = null;
    public $editarForm = false;
    public $deleteForm = false;
    public $showModalResultadoEdicao = false;
    public $mensagemResultadoEdicao = null;
    public $showModalDelete = false;
    public $mensagemDelete = null;

    public $estruturaTable = null;

    public $abrirFecharForm = 'none';
    public $iconAbrirFechar = 'fas fa-plus text-xs';
    public $iconFechar = 'fas fa-minus text-xs';

    public function getPei($codPei = null)
    {

        if (isset($codPei) && !empty($codPei)) {
            return Pei::find($codPei);
        } else {
            return null;
        }

    }

    public function abrirFecharForm()
    {

        if ($this->abrirFecharForm === 'none') {

            $this->dsc_pei = null;
            $this->num_ano_inicio_pei = null;
            $this->num_ano_fim_pei = null;
            $this->editarForm = false;

            $this->abrirFecharForm = 'block';
            $this->iconAbrirFechar = 'fas fa-minus text-xs';

        } else {

            $this->dsc_pei = null;
            $this->num_ano_inicio_pei = null;
            $this->num_ano_fim_pei = null;
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

            $modificacoes = "Inseriu um novo PEI com as seguintes características:<br><br>";

            $save = new Pei;

            $save->dsc_pei = $this->dsc_pei;

            $modificacoes = $modificacoes . "Descrição: <span class='text-green-800'>" . $this->dsc_pei . "</span><br>";

            $save->num_ano_inicio_pei = $this->num_ano_inicio_pei;

            $modificacoes = $modificacoes . "Ano de Incialização do PEI: <span class='text-green-800'>" . $this->num_ano_inicio_pei . "</span><br>";

            $save->num_ano_fim_pei = $this->num_ano_fim_pei;

            $modificacoes = $modificacoes . "Ano de Finalização do PEI: <span class='text-green-800'>" . $this->num_ano_fim_pei . "</span><br>";

            $save->save();

            $acao = Acoes::create(
                array(
                    'table' => 'tab_pei',
                    'table_id' => $save->cod_pei,
                    'user_id' => Auth::user()->id,
                    'acao' => $modificacoes
                )
            );

            $this->showModalResultadoEdicao = true;

            $this->mensagemResultadoEdicao = $modificacoes;

        } else {

            $editar = Pei::find($this->cod_pei);

            $estruturaTable = $this->estruturaTable();

            foreach ($estruturaTable as $result) {

                $column_name = $result->column_name;
                $data_type = $result->data_type;

                if ($editar->$column_name != $this->$column_name) {

                    $alteracao[$column_name] = $this->$column_name;

                    $audit = Audit::create(
                        array(
                            'table' => 'tab_pei',
                            'table_id' => $this->cod_pei,
                            'column_name' => $column_name,
                            'data_type' => $data_type,
                            'ip' => $_SERVER['REMOTE_ADDR'],
                            'user_id' => Auth::user()->id,
                            'acao' => 'Editou',
                            'antes' => $editar->$column_name,
                            'depois' => $this->$column_name
                        )
                    );

                    if ($modificacoes == '' && $column_name === 'num_ano_inicio_pei' || $column_name === 'num_ano_fim_pei') {

                        $modificacoes = $modificacoes . 'Alterou o(a) <b>' . nomeCampoTabelaNormalizado($column_name) . '</b> de <span style="color:#CD3333;">( ' . $editar->$column_name . ' )</span> para <span style="color:#28a745;">( ' . $this->$column_name . ' )</span> do PEI (' . $editar->dsc_pei . ');<br>';

                    } else {

                        $modificacoes = $modificacoes . 'Alterou o(a) <b>' . nomeCampoTabelaNormalizado($column_name) . '</b> de <span style="color:#CD3333;">( ' . $editar->$column_name . ' )</span> para <span style="color:#28a745;">( ' . $this->$column_name . ' )</span>;<br>';

                    }

                }

            }

            if (isset($modificacoes) && !is_null($modificacoes) && $modificacoes != '') {

                $editar->update($alteracao);

                $acao = Acoes::create(
                    array(
                        'table' => 'tab_pei',
                        'table_id' => $this->cod_pei,
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

        $this->dsc_pei = null;
        $this->num_ano_inicio_pei = null;
        $this->num_ano_fim_pei = null;

        $this->abrirFecharForm = 'none';
        $this->iconAbrirFechar = 'fas fa-plus text-xs';

        $this->editarForm = false;

    }

    public function editForm(Pei $singleData)
    {

        $this->dsc_pei = $singleData->dsc_pei;
        $this->num_ano_inicio_pei = $singleData->num_ano_inicio_pei;
        $this->num_ano_fim_pei = $singleData->num_ano_fim_pei;
        $this->cod_pei = $singleData->cod_pei;

        $this->abrirFecharForm = 'block';
        $this->iconAbrirFechar = 'fas fa-minus text-xs';

        $this->editarForm = true;

    }

    public function deleteForm(Pei $singleData)
    {

        $this->cod_pei = $singleData->cod_pei;

        $texto = '';

        $texto .= '<p class="my-2 text-gray-500 text-lg leading-relaxed">Descrição: <strong>' . $singleData->dsc_pei . '</strong></p><p class="my-2 text-gray-500 text-lg leading-relaxed">Ano de Incialização e Finalização do PEI: <strong>' . $singleData->num_ano_inicio_pei . ' - ' . $singleData->num_ano_fim_pei . '</strong><p class="my-2 text-gray-500 text-lg font-semibold leading-relaxed text-red-600">Quer realmente excluir?</p>';

        $this->mensagemDelete = $texto;

        $this->showModalDelete = true;

        $this->dsc_pei = null;
        $this->num_ano_inicio_pei = null;
        $this->num_ano_fim_pei = null;
        $this->editarForm = false;

    }

    public function delete(Pei $singleData)
    {

        $this->showModalDelete = false;

        $modificacoes = '';

        $this->dsc_pei = $singleData->dsc_pei;
        $this->num_ano_inicio_pei = $singleData->num_ano_inicio_pei;
        $this->num_ano_fim_pei = $singleData->num_ano_fim_pei;
        $this->cod_pei = $singleData->cod_pei;

        $modificacoes = $modificacoes . "O PEI <strong>" . $this->dsc_pei . " com início de vigência em " . $this->num_ano_inicio_pei . " e fim em " . $this->num_ano_fim_pei . "</strong> foi excluído com sucesso.";

        $acao = Acoes::create(
            array(
                'table' => 'tab_pei',
                'table_id' => $singleData->cod_pei,
                'user_id' => Auth::user()->id,
                'acao' => $modificacoes
            )
        );

        $singleData->delete();

        $this->dsc_pei = null;
        $this->num_ano_inicio_pei = null;
        $this->num_ano_fim_pei = null;
        $this->editarForm = false;


        $this->showModalResultadoEdicao = true;

        $this->mensagemResultadoEdicao = $modificacoes;

    }

    public function cancelar()
    {

        $this->dsc_pei = null;
        $this->num_ano_inicio_pei = null;
        $this->num_ano_fim_pei = null;
        $this->editarForm = false;

    }

    public function render()
    {

        $anos = [];
        for ($index = date('Y') + 6; $index >= 2020; $index -= 1) {
            $anos[$index * 1] = $index * 1;
        }

        $this->anos = $anos;

        $estruturaTable = $this->estruturaTable();

        $pei = Pei::orderBy('num_ano_inicio_pei', 'desc')
            ->get();

        $this->pei = $pei;

        return view('livewire.planejamento-estrategico-integrado');
    }

    protected function estruturaTable()
    {

        $estrutura = DB::select("SELECT
            column_name,ordinal_position,is_nullable,data_type
            FROM
            information_schema.columns
            WHERE
            table_schema = 'pei'
            AND table_name = 'tab_pei'
            AND column_name NOT IN ('cod_pei','created_at','updated_at','deleted_at');");

        return $estrutura;

    }
}
