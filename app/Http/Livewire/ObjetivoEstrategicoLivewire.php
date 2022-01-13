<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Pei;
use App\Models\Perspectiva;
use App\Models\ObjetivoEstrategico;
use App\Models\NumNivelHierarquico;
use Livewire\WithPagination;
use App\Models\Acoes;
use DB;
Use Auth;

class ObjetivoEstrategicoLivewire extends Component
{

    public $objetivoEstragico = null;
    public $pei = null;
    public $perspectiva = null;
    public $cod_pei = null;
    public $estruturaTable = null;
    public $cod_objetivo_estrategico = null;
    public $dsc_objetivo_estrategico = null;
    public $niveis_hierarquico_apresentacao = null;
    public $num_nivel_hierarquico_apresentacao = null;
    public $cod_perspectiva = null;
    public $pesquisarCodigo = null;
    
    public $editarForm = false;
    public $deleteForm = false;
    public $showModalResultadoEdicao = false;
    public $mensagemResultadoEdicao = null;
    public $showModalDelete = false;
    public $mensagemDelete = null;

    public $abrirFecharForm = 'none';
    public $iconAbrirFechar = 'fas fa-plus text-xs';
    public $iconFechar = 'fas fa-minus text-xs';

    protected function pesquisarCodigo($cod_perspectiva = '') {

        $this->num_nivel_hierarquico_apresentacao = '';

        if(isset($cod_perspectiva) && !is_null($cod_perspectiva) && $cod_perspectiva != '') {

            $objetivoEstragico = ObjetivoEstrategico::select('num_nivel_hierarquico_apresentacao')
            ->where('cod_perspectiva',$cod_perspectiva)
            ->orderBy('num_nivel_hierarquico_apresentacao','desc')
            ->first();

            if($objetivoEstragico) {

                $this->num_nivel_hierarquico_apresentacao = (($objetivoEstragico->num_nivel_hierarquico_apresentacao) + 1);

            } else {

                $this->num_nivel_hierarquico_apresentacao = 1;

            }

        }

        return $this->num_nivel_hierarquico_apresentacao;

    }

    public function abrirFecharForm() {

        if($this->abrirFecharForm === 'none') {

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

    public function create() {

        // Necessário incluir a parte de validação

        $modificacoes = '';
        $alteracao = array();

        if(!$this->editarForm) {

            $modificacoes = "Inseriu os seguintes dados em relação ao Objetivo Estratégico:<br><br>";

            $save = new ObjetivoEstrategico;

            $save->cod_perspectiva = $this->cod_perspectiva;

            $consultarPerspectiva = Perspectiva::find($this->cod_perspectiva);

            $modificacoes = $modificacoes . "Perspectiva: <span class='text-green-800'>".$consultarPerspectiva->num_nivel_hierarquico_apresentacao.". ".$consultarPerspectiva->dsc_perspectiva."</span><br>";

            if(isset($this->num_nivel_hierarquico_apresentacao) && !is_null($this->num_nivel_hierarquico_apresentacao) && $this->num_nivel_hierarquico_apresentacao != '') {

                $save->num_nivel_hierarquico_apresentacao = $this->num_nivel_hierarquico_apresentacao;

                $modificacoes = $modificacoes . "Código: <span class='text-green-800'>".$this->num_nivel_hierarquico_apresentacao."</span><br>";

            }

            if(isset($this->dsc_objetivo_estrategico) && !is_null($this->dsc_objetivo_estrategico) && $this->dsc_objetivo_estrategico != '') {

                $save->dsc_objetivo_estrategico = $this->dsc_objetivo_estrategico;

                $modificacoes = $modificacoes . "Objetivo Estratégico: <span class='text-green-800'>".$this->dsc_objetivo_estrategico."</span><br>";

            }

            $save->save();

            $acao = Acoes::create(array(
                'table' => 'tab_objetivo_estrategico',
                'id_table' => $save->cod_objetivo_estrategico,
                'user_id' => Auth::user()->id,
                'acao' => $modificacoes
            ));

            $this->showModalResultadoEdicao = true;

            $this->mensagemResultadoEdicao = $modificacoes;

        } else {

            $editar = ObjetivoEstrategico::find($this->cod_objetivo_estrategico);

            $estruturaTable = $this->estruturaTableParaEditar();

            foreach($estruturaTable as $result) {

                $column_name = $result->column_name;

                if($editar->$column_name != $this->$column_name) {

                    $alteracao[$column_name] = $this->$column_name;

                    if($column_name != 'cod_perspectiva') {

                        $modificacoes = $modificacoes.'Alterou o(a) <b>'.nomeCampoTabelaNormalizado($column_name).'</b> de <span style="color:#CD3333;">( '.$editar->$column_name.' )</span> para <span style="color:#28a745;">( '.$this->$column_name.' )</span>;<br>';

                    } elseif($column_name == 'cod_perspectiva' || $column_name == 'cod_organizacao') {

                        if($column_name == 'cod_perspectiva') {

                            $consultarAntigo = Perspectiva::find($editar->cod_perspectiva);

                            $consultarNovo = Perspectiva::find($this->$column_name);

                            $modificacoes = $modificacoes.'Alterou o(a) <b>Perspectiva</b> de <span style="color:#CD3333;">( '.$consultarAntigo->num_nivel_hierarquico_apresentacao.'. '.$consultarAntigo->dsc_perspectiva.' )</span> para <span style="color:#28a745;">( '.$consultarNovo->num_nivel_hierarquico_apresentacao.'. '.$consultarNovo->dsc_perspectiva.' )</span>;<br>';

                        }

                    }

                }

            }

            if(isset($modificacoes) && !is_null($modificacoes) && $modificacoes != '') {

                $editar->update($alteracao);

                $acao = Acoes::create(array(
                    'table' => 'tab_objetivoEstragico',
                    'id_table' => $this->cod_objetivo_estrategico,
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

        $this->cod_objetivo_estrategico = null;
        $this->cod_pei = null;
        $this->cod_perspectiva = null;
        $this->dsc_objetivo_estrategico = null;
        $this->num_nivel_hierarquico_apresentacao = null;

        $this->abrirFecharForm = 'none';
        $this->iconAbrirFechar = 'fas fa-plus text-xs';

        $this->editarForm = false;

    }

    public function editForm(ObjetivoEstrategico $singleData) {

        $this->cod_objetivo_estrategico = null;
        $this->cod_pei = null;
        $this->cod_perspectiva = null;
        
        $this->dsc_objetivo_estrategico = null;
        $this->num_nivel_hierarquico_apresentacao = null;

        $this->cod_objetivo_estrategico = $singleData->cod_objetivo_estrategico;
        $this->cod_perspectiva = $singleData->cod_perspectiva;
        $this->num_nivel_hierarquico_apresentacao = $singleData->num_nivel_hierarquico_apresentacao;
        $this->dsc_objetivo_estrategico = $singleData->dsc_objetivo_estrategico;

        $consultarPerspectiva = Perspectiva::find($singleData->cod_perspectiva);

        $this->cod_pei = $consultarPerspectiva->cod_pei;

        $this->abrirFecharForm = 'block';
        $this->iconAbrirFechar = 'fas fa-minus text-xs';

        $this->editarForm = true;

    }

    public function deleteForm(ObjetivoEstrategico $singleData) {

        $this->cod_objetivo_estrategico = $singleData->cod_objetivo_estrategico;

        $consultarPerspectiva = Perspectiva::find($singleData->cod_perspectiva);

        $texto = '';

        $texto .= '<p class="my-2 text-gray-500 text-lg leading-relaxed">Objetivo Estrategico: <strong>'.$singleData->num_nivel_hierarquico_apresentacao.'. '.$singleData->dsc_objetivo_estrategico.'</strong></p><p class="my-2 text-gray-500 text-lg leading-relaxed">Perspectiva: <strong>'.$consultarPerspectiva->num_nivel_hierarquico_apresentacao.'. '.$consultarPerspectiva->dsc_perspectiva.'</strong></p><p class="my-2 text-gray-500 text-lg font-semibold leading-relaxed text-red-600">Quer realmente excluir?</p>';

        $this->mensagemDelete = $texto;

        $this->showModalDelete = true;

        $this->dsc_objetivo_estrategico = null;
        $this->cod_perspectiva = null;
        
        $this->editarForm = false;

    }

    public function delete(ObjetivoEstrategico $singleData) {

        $this->showModalDelete = false;

        $consultarPerspectiva = Perspectiva::find($singleData->cod_perspectiva);

        $modificacoes = '';

        $this->dsc_objetivo_estrategico = $singleData->dsc_objetivo_estrategico;
        $this->cod_perspectiva = $singleData->cod_perspectiva;
        $this->num_nivel_hierarquico_apresentacao = $singleData->num_nivel_hierarquico_apresentacao;
        $this->cod_objetivo_estrategico = $singleData->cod_objetivo_estrategico;

        $modificacoes = $modificacoes.'<p class="my-2 text-gray-500 text-lg leading-relaxed">O Objetivo Estrategico <strong>'.$singleData->num_nivel_hierarquico_apresentacao.'. '.$singleData->dsc_objetivo_estrategico.'</strong> vinculado a Perspectiva <strong>'.$consultarPerspectiva->num_nivel_hierarquico_apresentacao.'. '.$consultarPerspectiva->dsc_perspectiva.'</strong> foi excluído com sucesso.</p>';

        $acao = Acoes::create(array(
            'table' => 'tab_objetivo_estrategico',
            'id_table' => $singleData->cod_objetivo_estrategico,
            'user_id' => Auth::user()->id,
            'acao' => $modificacoes
        ));

        $singleData->delete();

        $this->cod_pei = null;
        $this->cod_perspectiva = null;
        $this->num_nivel_hierarquico_apresentacao = null;
        $this->dsc_objetivo_estrategico = null;

        $this->editarForm = false;

        $this->showModalResultadoEdicao = true;

        $this->mensagemResultadoEdicao = $modificacoes;

    }

    public function cancelar() {

        $this->cod_pei = null;
        $this->cod_perspectiva = null;
        $this->cod_objetivo_estrategico = null;
        $this->num_nivel_hierarquico_apresentacao = null;
        $this->dsc_objetivo_estrategico = null;

        $this->editarForm = false;

    }

    public function render()
    {

        $this->estruturaTable = $this->estruturaTable();

        $this->pei = Pei::select(db::raw("dsc_pei||' ( '||num_ano_inicio_pei||' a '||num_ano_fim_pei||' )' as dsc_pei, cod_pei"))
        ->where('dsc_pei','!=','')
        ->whereNotNull('dsc_pei')
        ->orderBy('dsc_pei')
        ->pluck('dsc_pei', 'cod_pei');

        if($this->editarForm == false) {

            $perspectiva = Perspectiva::select(db::raw("num_nivel_hierarquico_apresentacao||'. '||dsc_perspectiva as dsc_perspectiva, cod_perspectiva"));

            if(isset($this->cod_pei) && !is_null($this->cod_pei) && $this->cod_pei != '') {

                $perspectiva = $perspectiva->where('cod_pei',$this->cod_pei);

            } else {

                $perspectiva = $perspectiva->whereNull('cod_pei');

            }

            $perspectiva = $perspectiva->orderBy('num_nivel_hierarquico_apresentacao','desc')
            ->pluck('dsc_perspectiva','cod_perspectiva');

            $this->perspectiva = $perspectiva;

            if(isset($this->cod_perspectiva) && !is_null($this->cod_perspectiva) && $this->cod_perspectiva != '' && $this->editarForm == false) {

                $this->num_nivel_hierarquico_apresentacao = $this->num_nivel_hierarquico_apresentacao;

            }

            if(isset($this->cod_perspectiva) && !is_null($this->cod_perspectiva) && $this->cod_perspectiva != '') {

                $this->num_nivel_hierarquico_apresentacao = $this->pesquisarCodigo($this->cod_perspectiva);

            }

        } else {

            $perspectiva = Perspectiva::select(db::raw("num_nivel_hierarquico_apresentacao||'. '||dsc_perspectiva as dsc_perspectiva, cod_perspectiva"));

            if(isset($this->cod_pei) && !is_null($this->cod_pei) && $this->cod_pei != '') {

                $perspectiva = $perspectiva->where('cod_pei',$this->cod_pei);

            }

            $perspectiva = $perspectiva->orderBy('num_nivel_hierarquico_apresentacao','desc')
            ->pluck('dsc_perspectiva','cod_perspectiva');

            $this->perspectiva = $perspectiva;

            $this->num_nivel_hierarquico_apresentacao = $this->num_nivel_hierarquico_apresentacao;

        }

        $this->niveis_hierarquico_apresentacao = NumNivelHierarquico::pluck('num_nivel_hierarquico_apresentacao','num_nivel_hierarquico_apresentacao');

        $objetivoEstragico = ObjetivoEstrategico::orderBy('num_nivel_hierarquico_apresentacao','desc')
        ->with('perspectiva')
        ->get();

        $this->objetivoEstragico = $objetivoEstragico;

        return view('livewire.objetivo-estrategico-livewire');
    }

    protected function estruturaTable() {

        $estrutura = DB::select("SELECT
            column_name,ordinal_position,is_nullable,data_type
            FROM
            information_schema.columns
            WHERE
            table_schema = 'pei'
            AND table_name = 'tab_objetivo_estrategico' 
            AND column_name NOT IN ('cod_objetivo_estrategico','cod_perspectiva','created_at','updated_at','deleted_at');");

        return $estrutura;

    }

    protected function estruturaTableParaEditar() {

        $estrutura = DB::select("SELECT
            column_name,ordinal_position,is_nullable,data_type
            FROM
            information_schema.columns
            WHERE
            table_schema = 'pei'
            AND table_name = 'tab_objetivo_estrategico' 
            AND column_name NOT IN ('cod_objetivo_estrategico','created_at','updated_at','deleted_at');");

        return $estrutura;

    }
}
