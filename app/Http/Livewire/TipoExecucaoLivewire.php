<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\TipoExecucao;
use Livewire\WithPagination;
use App\Models\Acoes;
use DB;
Use Auth;

class TipoExecucaoLivewire extends Component
{

    public $tipo_execucao = null;
    public $cod_tipo_execucao = null;
    public $dsc_tipo_execucao = null;
    
    public $editarForm = false;
    public $deleteForm = false;
    public $showModalResultadoEdicao = false;
    public $mensagemResultadoEdicao = null;
    public $showModalDelete = false;
    public $mensagemDelete = null;

    public $abrirFecharForm = 'none';
    public $iconAbrirFechar = 'fas fa-plus text-xs';
    public $iconFechar = 'fas fa-minus text-xs';

    public function abrirFecharForm() {

        if($this->abrirFecharForm === 'none') {

            $this->dsc_tipo_execucao = null;
            $this->editarForm = false;

            $this->abrirFecharForm = 'block';
            $this->iconAbrirFechar = 'fas fa-minus text-xs';

        } else {

            $this->dsc_tipo_execucao = null;
            $this->editarForm = false;

            $this->abrirFecharForm = 'none';
            $this->iconAbrirFechar = 'fas fa-plus text-xs';

        }

    }

    public function create() {

        // Necessário incluir a parte de validação

        $modificacoes = '';
        $alteracao = array();

        if(!$this->editarForm) {

            $modificacoes = "Inseriu um novo PEI com as seguintes características:<br><br>";

            $save = new TipoExecucao;

            $save->dsc_tipo_execucao = $this->dsc_tipo_execucao;

            $modificacoes = $modificacoes . "Descrição: <span class='text-green-800'>".$this->dsc_tipo_execucao."</span><br>";

            $save->save();

            $acao = Acoes::create(array(
                'table' => 'tab_tipo_execucao',
                'id_table' => $save->cod_tipo_execucao,
                'user_id' => Auth::user()->id,
                'acao' => $modificacoes
            ));

            $this->showModalResultadoEdicao = true;

            $this->mensagemResultadoEdicao = $modificacoes;

        } else {

            $editar = TipoExecucao::find($this->cod_tipo_execucao);

            $estruturaTable = $this->estruturaTable();

            foreach($estruturaTable as $result) {

                $column_name = $result->column_name;

                if($editar->$column_name != $this->$column_name) {

                    $alteracao[$column_name] = $this->$column_name;

                    $modificacoes = $modificacoes.'Alterou o(a) <b>'.nomeCampoTabelaNormalizado($column_name).'</b> de <span style="color:#CD3333;">( '.$editar->$column_name.' )</span> para <span style="color:#28a745;">( '.$this->$column_name.' )</span>;<br>';

                }

            }

            if(isset($modificacoes) && !is_null($modificacoes) && $modificacoes != '') {

                $editar->update($alteracao);

                $acao = Acoes::create(array(
                    'table' => 'tab_tipo_execucao',
                    'id_table' => $this->cod_tipo_execucao,
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

        $this->dsc_tipo_execucao = null;
        
        $this->abrirFecharForm = 'none';
        $this->iconAbrirFechar = 'fas fa-plus text-xs';
        
        $this->editarForm = false;

    }

    public function editForm(TipoExecucao $singleData) {

        $this->dsc_tipo_execucao = $singleData->dsc_tipo_execucao;
        $this->cod_tipo_execucao = $singleData->cod_tipo_execucao;

        $this->abrirFecharForm = 'block';
        $this->iconAbrirFechar = 'fas fa-minus text-xs';

        $this->editarForm = true;

    }

    public function deleteForm(TipoExecucao $singleData) {

        $this->cod_tipo_execucao = $singleData->cod_tipo_execucao;

        $texto = '';

        $texto .= '<p class="my-2 text-gray-500 text-lg leading-relaxed">Descrição: <strong>'.$singleData->dsc_tipo_execucao.'</strong></p><p class="my-2 text-gray-500 text-lg font-semibold leading-relaxed text-red-600">Quer realmente excluir?</p>';

        $this->mensagemDelete = $texto;

        $this->showModalDelete = true;

        $this->dsc_tipo_execucao = null;
        $this->editarForm = false;

    }

    public function delete(TipoExecucao $singleData) {

        $this->showModalDelete = false;

        $modificacoes = '';

        $this->dsc_tipo_execucao = $singleData->dsc_tipo_execucao;
        $this->cod_tipo_execucao = $singleData->cod_tipo_execucao;

        $modificacoes = $modificacoes."O PEI <strong>".$this->dsc_tipo_execucao." foi excluído com sucesso.";

        $acao = Acoes::create(array(
            'table' => 'tab_tipo_execucao',
            'id_table' => $singleData->cod_tipo_execucao,
            'user_id' => Auth::user()->id,
            'acao' => $modificacoes
        ));

        $singleData->delete();

        $this->dsc_tipo_execucao = null;
        $this->editarForm = false;


        $this->showModalResultadoEdicao = true;

        $this->mensagemResultadoEdicao = $modificacoes;

    }

    public function cancelar() {

        $this->dsc_tipo_execucao = null;
        $this->editarForm = false;

    }

    public function render()
    {

        $anos = [];
        for ($index = date('Y')+6; $index >= 2020; $index -= 1) {
            $anos[$index * 1] = $index * 1;
        }

        $this->anos = $anos;

        $estruturaTable = $this->estruturaTable();

        $tipo_execucao = TipoExecucao::orderBy('dsc_tipo_execucao')
        ->get();

        $this->tipo_execucao = $tipo_execucao;

        return view('livewire.tipo-execucao');
    }

    protected function estruturaTable() {

        $estrutura = DB::select("SELECT
            column_name,ordinal_position,is_nullable,data_type
            FROM
            information_schema.columns
            WHERE
            table_schema = 'public'
            AND table_name = 'tab_tipo_execucao' 
            AND column_name NOT IN ('cod_tipo_execucao','created_at','updated_at','deleted_at');");

        return $estrutura;

    }
}
