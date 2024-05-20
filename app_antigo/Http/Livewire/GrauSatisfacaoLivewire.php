<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\GrauSatisfacao;
use App\Models\Acoes;
use App\Models\Audit;
use DB;
Use Auth;

class GrauSatisfacaoLivewire extends Component
{

    public $grauSatisfacao = null;
    public $cod_grau_satisfcao = null;
    public $estruturaTable = null;
    public $dsc_grau_satisfcao = null;
    public $cor = null;
    public $vlr_minimo = null;
    public $vlr_maximo = null;
    
    public $abrirFecharForm = 'none';
    public $iconAbrirFechar = 'fas fa-plus text-xs';
    public $iconFechar = 'fas fa-minus text-xs';
    public $editarForm = false;
    public $deleteForm = false;
    public $showModalResultadoEdicao = false;
    public $mensagemResultadoEdicao = null;
    public $showModalDelete = false;
    public $mensagemDelete = null;

    public function obterGrauSatisfacao($prc_alcancado = '') {

        $result = [];

        $result['grau_de_satisfacao'] = 'red';
        $result['color'] = 'white';

        if(isset($prc_alcancado) && !is_null($prc_alcancado) && $prc_alcancado != '') {

            if($prc_alcancado < 0) {

                $result['grau_de_satisfacao'] = 'red';

            } elseif($prc_alcancado > 100) {

                $result['grau_de_satisfacao'] = 'green';

            } else {

                $consultarGrauSatisfacao = GrauSatisfacao::where('vlr_maximo','>=',$prc_alcancado)
                ->where('vlr_minimo','<=',$prc_alcancado)
                ->first();

                if(!is_null($consultarGrauSatisfacao)) {

                    $result['grau_de_satisfacao'] = $consultarGrauSatisfacao->cor;

                    if($consultarGrauSatisfacao->cor === 'yellow') {

                        $result['color'] = 'black';

                    }

                }

            }

        }

        return $result;

    }

    public function create() {

        // Necessário incluir a parte de validação

        $modificacoes = '';
        $alteracao = array();

        if(!$this->editarForm) {

            $modificacoes = "Inseriu os seguintes dados em relação ao Grau de Satisfação:<br><br>";

            $save = new GrauSatisfacao;

            if(isset($this->dsc_grau_satisfcao) && !is_null($this->dsc_grau_satisfcao) && $this->dsc_grau_satisfcao != '') {

                $save->dsc_grau_satisfcao = $this->dsc_grau_satisfcao;

                $modificacoes = $modificacoes . "Descrição do Grau de Satisfação: <span class='text-green-800'>".$this->dsc_grau_satisfcao."</span><br>";

            }

            if(isset($this->cor) && !is_null($this->cor) && $this->cor != '') {

                $save->cor = $this->cor;

                $modificacoes = $modificacoes . "Cor para representar o Grau de Satisfação: <span class='text-green-800'>".$this->cor."</span><br>";

            }

            if(isset($this->vlr_minimo) && !is_null($this->vlr_minimo) && $this->vlr_minimo != '') {

                $save->vlr_minimo = converteValor('PTBR','MYSQL',$this->vlr_minimo);

                $modificacoes = $modificacoes . "Percentual mínimo aceitável: <span class='text-green-800'>".$this->vlr_minimo."</span><br>";

            }

            if(isset($this->vlr_maximo) && !is_null($this->vlr_maximo) && $this->vlr_maximo != '') {

                $save->vlr_maximo = converteValor('PTBR','MYSQL',$this->vlr_maximo);

                $modificacoes = $modificacoes . "Percentual máximo aceitável: <span class='text-green-800'>".$this->vlr_maximo."</span><br>";

            }

            $save->save();

            $acao = Acoes::create(array(
                'table' => 'tab_grau_satisfcao',
                'table_id' => $save->cod_grau_satisfcao,
                'user_id' => Auth::user()->id,
                'acao' => $modificacoes
            ));

            $this->showModalResultadoEdicao = true;

            $this->mensagemResultadoEdicao = $modificacoes;

        } else {

            $editar = GrauSatisfacao::find($this->cod_grau_satisfcao);

            $estruturaTable = $this->estruturaTableParaEditar();

            foreach($estruturaTable as $result) {

                $column_name = $result->column_name;
                $data_type = $result->data_type;

                // Início da parte para igualar a formatação do campo de valor

                if($data_type === 'numeric') {

                    $this->$column_name = converteValor('PTBR','MYSQL',$this->$column_name);

                }

                // Fim da parte para igualar a formatação do campo de valor

                // --- x --- x --- x --- x --- x --- x ---

                // Início da verificação se houve alteração entre o valor antigo e o atual

                if($editar->$column_name != $this->$column_name) {

                    $alteracao[$column_name] = $this->$column_name;

                    if($data_type === 'numeric') {

                        $modificacoes = $modificacoes.'Alterou o(a) <b>'.nomeCampoTabelaNormalizado($column_name).'</b> de <span style="color:#CD3333;">( '.converteValor('MYSQL','PTBR',$editar->$column_name).' )</span> para <span style="color:#28a745;">( '.converteValor('MYSQL','PTBR',$this->$column_name).' )</span>;<br>';

                        $audit = Audit::create(array(
                            'table' => 'tab_grau_satisfcao',
                            'table_id' => $this->cod_grau_satisfcao,
                            'column_name' => $column_name,
                            'data_type' => $data_type,
                            'ip' => $_SERVER['REMOTE_ADDR'],
                            'user_id' => Auth::user()->id,
                            'acao' => 'Editou',
                            'antes' => $editar->$column_name,
                            'depois' => converteValor('MYSQL','PTBR',$this->$column_name)
                        ));

                    } else {

                        $modificacoes = $modificacoes.'Alterou o(a) <b>'.nomeCampoTabelaNormalizado($column_name).'</b> de <span style="color:#CD3333;">( '.$editar->$column_name.' )</span> para <span style="color:#28a745;">( '.$this->$column_name.' )</span>;<br>';

                        $audit = Audit::create(array(
                            'table' => 'tab_grau_satisfcao',
                            'table_id' => $this->cod_grau_satisfcao,
                            'column_name' => $column_name,
                            'data_type' => $data_type,
                            'ip' => $_SERVER['REMOTE_ADDR'],
                            'user_id' => Auth::user()->id,
                            'acao' => 'Editou',
                            'antes' => $editar->$column_name,
                            'depois' => $this->$column_name
                        ));

                    }

                }

                // Fim da verificação se houve alteração entre o valor antigo e o atual

                // --- x --- x --- x --- x --- x --- x ---

            }

            if(isset($modificacoes) && !is_null($modificacoes) && $modificacoes != '') {

                $editar->update($alteracao);

                $acao = Acoes::create(array(
                    'table' => 'tab_grau_satisfcao',
                    'table_id' => $this->cod_grau_satisfcao,
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

        $this->cod_grau_satisfcao = null;
        $this->dsc_grau_satisfcao = null;
        $this->cor = null;
        $this->vlr_minimo = null;
        $this->vlr_maximo = null;

        $this->abrirFecharForm = 'none';
        $this->iconAbrirFechar = 'fas fa-plus text-xs';
        
        $this->editarForm = false;

    }

    public function abrirFecharForm() {

        if($this->abrirFecharForm === 'none') {

            $this->cod_grau_satisfcao = null;
            $this->dsc_grau_satisfcao = null;
            $this->cor = null;
            $this->vlr_minimo = null;
            $this->vlr_maximo = null;
            $this->editarForm = false;

            $this->abrirFecharForm = 'block';
            $this->iconAbrirFechar = 'fas fa-minus text-xs';

        } else {

            $this->cod_grau_satisfcao = null;
            $this->dsc_grau_satisfcao = null;
            $this->cor = null;
            $this->vlr_minimo = null;
            $this->vlr_maximo = null;
            $this->editarForm = false;

            $this->abrirFecharForm = 'none';
            $this->iconAbrirFechar = 'fas fa-plus text-xs';

        }

    }

    public function editForm(GrauSatisfacao $singleData) {

        $this->cod_grau_satisfcao = $singleData->cod_grau_satisfcao;
        $this->dsc_grau_satisfcao = $singleData->dsc_grau_satisfcao;
        $this->cor = $singleData->cor;
        $this->vlr_minimo = converteValor('MYSQL','PTBR',$singleData->vlr_minimo);
        $this->vlr_maximo = converteValor('MYSQL','PTBR',$singleData->vlr_maximo);

        $this->abrirFecharForm = 'block';
        $this->iconAbrirFechar = 'fas fa-minus text-xs';

        $this->editarForm = true;

    }

    public function deleteForm(GrauSatisfacao $singleData) {

        $this->cod_grau_satisfcao = $singleData->cod_grau_satisfcao;

        $texto = '';

        $texto .= '<p class="my-2 text-gray-900 text-xs leading-relaxed"><strong>Dados do Grau de Satisfação para confirmar a exclusão</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">Descrição do Grau de Satisfação: <strong>'.$singleData->dsc_grau_satisfcao.'</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">Cor para representar o Grau de Satisfação: <strong>'.$singleData->cor.'</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">Percentual mínimo aceitável: <strong>'.$singleData->vlr_minimo.'</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">Percentual máximo aceitável: <strong>'.$singleData->vlr_maximo.'</strong></p><p class="my-2 text-gray-500 text-xs font-semibold leading-relaxed text-red-600">Quer realmente excluir?</p>';

        $this->mensagemDelete = $texto;

        $this->showModalDelete = true;

        $this->cod_grau_satisfcao = null;
        $this->dsc_grau_satisfcao = null;
        $this->cor = null;
        $this->vlr_minimo = null;
        $this->vlr_maximo = null;
        $this->editarForm = false;

    }

    public function delete(GrauSatisfacao $singleData) {

        $this->cod_grau_satisfcao = $singleData->cod_grau_satisfcao;

        $texto = '';

        $texto .= '<p class="my-2 text-gray-900 text-xs leading-relaxed"><strong>Excluiu com sucesso o seguinte Grau de Satisfação</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">Descrição do Grau de Satisfação: <strong>'.$singleData->dsc_grau_satisfcao.'</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">Cor para representar o Grau de Satisfação: <strong>'.$singleData->cor.'</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">Percentual mínimo aceitável: <strong>'.$singleData->vlr_minimo.'</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">Percentual máximo aceitável: <strong>'.$singleData->vlr_maximo.'</strong></p>';


        $acao = Acoes::create(array(
            'table' => 'tab_grau_satisfcao',
            'table_id' => $singleData->cod_grau_satisfcao,
            'user_id' => Auth::user()->id,
            'acao' => $modificacoes
        ));

        $singleData->delete();

        $this->cod_grau_satisfcao = null;
        $this->dsc_grau_satisfcao = null;
        $this->cor = null;
        $this->vlr_minimo = null;
        $this->vlr_maximo = null;
        $this->editarForm = false;


        $this->showModalResultadoEdicao = true;

        $this->mensagemResultadoEdicao = $modificacoes;

    }

    public function cancelar() {

        $this->cod_grau_satisfcao = null;
        $this->dsc_grau_satisfcao = null;
        $this->cor = null;
        $this->vlr_minimo = null;
        $this->vlr_maximo = null;
        $this->editarForm = false;

    }

    public function render()
    {

        $grau_satisfacao = GrauSatisfacao::get();

        $this->grau_satisfacao = $grau_satisfacao;

        return view('livewire.grau-satisfacao-livewire');
    }

    protected function estruturaTable() {

        $estrutura = DB::select("SELECT
            column_name,ordinal_position,is_nullable,data_type
            FROM
            information_schema.columns
            WHERE
            table_schema = 'pei'
            AND table_name = 'tab_grau_satisfcao' 
            AND column_name NOT IN ('cod_grau_satisfcao','created_at','updated_at','deleted_at');");

        return $estrutura;

    }

    protected function estruturaTableParaEditar() {

        $estrutura = DB::select("SELECT
            column_name,ordinal_position,is_nullable,data_type
            FROM
            information_schema.columns
            WHERE
            table_schema = 'pei'
            AND table_name = 'tab_grau_satisfcao' 
            AND column_name NOT IN ('cod_grau_satisfcao','created_at','updated_at','deleted_at');");

        return $estrutura;

    }

    protected function hierarquiaUnidade($cod_organizacao = '') {

        if(isset($cod_organizacao) && !is_null($cod_organizacao) && $cod_organizacao != '') {

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

    }
}
