<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Organization;
use App\Models\RelOrganization;
use Livewire\WithPagination;
use App\Models\Acoes;
use DB;
Use Auth;

ini_set('memory_limit', '7096M');
ini_set('max_execution_time', 9900);
set_time_limit(900000000);

class ShowOrganization extends Component
{

    public $cod_organizacao = null;
    public $nom_organizacao = null;
    public $sgl_organizacao = null;
    public $rel_cod_organizacao = null;
    public $editarForm = false;
    public $showModalResultadoEdicao = false;
    public $mensagemResultadoEdicao = null;

    public $hierarquiaUnidade = null;

    public $abrirFecharForm = 'none';
    public $iconAbrirFechar = 'fas fa-plus text-xs';
    public $iconFechar = 'fas fa-minus text-xs';

    public function abrirFecharForm() {

        if($this->abrirFecharForm === 'none') {

            $this->nom_organizacao = null;
            $this->sgl_organizacao = null;
            $this->rel_cod_organizacao = null;
            $this->editarForm = false;

            $this->abrirFecharForm = 'block';
            $this->iconAbrirFechar = 'fas fa-minus text-xs';

        } else {

            $this->nom_organizacao = null;
            $this->sgl_organizacao = null;
            $this->rel_cod_organizacao = null;
            $this->editarForm = false;

            $this->abrirFecharForm = 'none';
            $this->iconAbrirFechar = 'fas fa-plus text-xs';

        }

    }

    public function create() {

        // Necessário incluir a parte de validação

        $modificacoes = '';

        if(!$this->editarForm) {

            $modificacoes = "Inseriu uma nova unidade com as seguintes características:<br><br>";

            $saveOrganization = new Organization;

            $saveOrganization->nom_organizacao = $this->nom_organizacao;

            $modificacoes = $modificacoes . "Nome: <span class='text-green-800'>".$this->nom_organizacao."</span><br>";

            $saveOrganization->sgl_organizacao = $this->sgl_organizacao;

            $modificacoes = $modificacoes . "Sigla: <span class='text-green-800'>".$this->sgl_organizacao."</span><br>";

            if(isset($this->rel_cod_organizacao) && !is_null($this->rel_cod_organizacao) && $this->rel_cod_organizacao != '') {

                $saveOrganization->rel_cod_organizacao = $this->rel_cod_organizacao;

                $consultarRelacao = Organization::find($this->rel_cod_organizacao);

                $modificacoes = $modificacoes . "Vinculada ou subordinada a esta Unidade: <span class='text-green-800'>".$consultarRelacao->sgl_organizacao." - ".$consultarRelacao->nom_organizacao."</span><br>";

            }

            $saveOrganization->save();

            if(isset($this->rel_cod_organizacao) && !is_null($this->rel_cod_organizacao) && $this->rel_cod_organizacao != '') {

                $saveRelOrganization = new RelOrganization;

                $saveRelOrganization->cod_organizacao = $saveOrganization->cod_organizacao;

                $saveRelOrganization->rel_cod_organizacao = $this->rel_cod_organizacao;

                $saveRelOrganization->save();

            } else {

                $saveSelfRelOrganization = Organization::find($saveOrganization->cod_organizacao);

                $saveSelfRelOrganization->update(array('rel_cod_organizacao' => $saveOrganization->cod_organizacao));

            }

            $acao = Acoes::create(array(
                'table' => 'tab_organizacoes',
                'id_table' => $saveOrganization->cod_organizacao,
                'id_user' => Auth::user()->id,
                'acao' => $modificacoes
            ));

            $this->showModalResultadoEdicao = true;

            $this->mensagemResultadoEdicao = $modificacoes;

        } else {

            $editarOrganization = Organization::find($this->cod_organizacao);

            $estruturaTable = $this->estruturaTable();

            foreach($estruturaTable as $result) {

                $column_name = $result->column_name;

                if($column_name != 'rel_cod_organizacao') {

                    if($editarOrganization->$column_name != $this->$column_name) {

                        $modificacoes = $modificacoes.'Alterou o(a) <b>'.nomeCampoTabelaNormalizado($column_name).'</b> de <span style="color:#CD3333;">( '.$editarOrganization->$column_name.' )</span> para <span style="color:#28a745;">( '.$this->$column_name.' )</span>;<br>';

                    }

                } else {

                    if($editarOrganization->$column_name != $this->$column_name) {

                        $consultarValorAntigo = Organization::find($editarOrganization->$column_name);

                        $consultarValorNovo = Organization::find($this->$column_name);

                        if(isset($modificacoes) && !is_null($modificacoes) && $modificacoes != '') {

                            $modificacoes = $modificacoes.'Alterou a <b>vinculação ou subordinação</b> de <span style="color:#CD3333;">( '.$consultarValorAntigo->nom_organizacao.' )</span> para <span style="color:#28a745;">( '.$consultarValorNovo->nom_organizacao.' )</span>;<br>';

                        } else {

                            $modificacoes = $modificacoes.'Alterou a <b>vinculação ou subordinação</b> de <span style="color:#CD3333;">( '.$consultarValorAntigo->nom_organizacao.' )</span> para <span style="color:#28a745;">( '.$consultarValorNovo->nom_organizacao.' )</span> da Unidade <strong>'.$this->nom_organizacao.'</strong>;<br>';

                        }

                    }

                }

            }

            $editarOrganization->update(array('nom_organizacao' => $this->nom_organizacao, 'sgl_organizacao' => $this->sgl_organizacao, 'rel_cod_organizacao' => $this->rel_cod_organizacao));

            $editarRelOrganization = RelOrganization::where('cod_organizacao',$this->cod_organizacao)
            ->first();

            if($editarRelOrganization) {

                $editarRelOrganization->update(array('rel_cod_organizacao' => $this->rel_cod_organizacao));

            } else {

                if($this->rel_cod_organizacao != $this->cod_organizacao) {

                    $saveRelOrganization = new RelOrganization;

                    $saveRelOrganization->cod_organizacao = $this->cod_organizacao;

                    $saveRelOrganization->rel_cod_organizacao = $this->rel_cod_organizacao;

                    $saveRelOrganization->save();

                }

            }

            $this->showModalResultadoEdicao = true;

            $this->mensagemResultadoEdicao = $modificacoes;

        }

        $this->nom_organizacao = null;
        $this->sgl_organizacao = null;
        $this->rel_cod_organizacao = null;

        $this->abrirFecharForm = 'none';
        $this->iconAbrirFechar = 'fas fa-plus text-xs';
        
        $this->editarForm = false;

    }

    public function editForm(Organization $singleData) {

        $this->nom_organizacao = $singleData->nom_organizacao;
        $this->sgl_organizacao = $singleData->sgl_organizacao;
        $this->rel_cod_organizacao = $singleData->rel_cod_organizacao;
        $this->cod_organizacao = $singleData->cod_organizacao;

        $this->abrirFecharForm = 'block';
        $this->iconAbrirFechar = 'fas fa-minus text-xs';

        $this->editarForm = true;

    }

    public function delete(Organization $singleData) {

        $modificacoes = '';

        $this->nom_organizacao = $singleData->nom_organizacao;
        $this->sgl_organizacao = $singleData->sgl_organizacao;
        $this->rel_cod_organizacao = $singleData->rel_cod_organizacao;
        $this->cod_organizacao = $singleData->cod_organizacao;

        $modificacoes = $modificacoes."A unidade <strong>".$this->sgl_organizacao." - ".$this->nom_organizacao;

        if($singleData->rel_cod_organizacao != $singleData->cod_organizacao) {

            $consultarRelacao = Organization::find($this->rel_cod_organizacao);

            $modificacoes = $modificacoes . "</strong>, vinculada ou subordinada a unidade <strong>".$consultarRelacao->sgl_organizacao." - ".$consultarRelacao->nom_organizacao."</strong>, foi excluída com sucesso.";

        } else {

            $modificacoes = $modificacoes . "</strong> foi excluída com sucesso.";

        }

        $singleData->delete();

        $this->nom_organizacao = null;
        $this->sgl_organizacao = null;
        $this->rel_cod_organizacao = null;
        $this->editarForm = false;

        $this->showModalResultadoEdicao = true;

        $this->mensagemResultadoEdicao = $modificacoes;

    }

    public function cancelar() {

        $this->nom_organizacao = null;
        $this->sgl_organizacao = null;
        $this->rel_cod_organizacao = null;
        $this->editarForm = false;

    }

    public function render()
    {

        $nom_organizacao = $this->nom_organizacao;

        $organizacoes = [];

        $organization = Organization::whereRaw('cod_organizacao = rel_cod_organizacao')
        ->get();

        $organizationChild = Organization::whereRaw('cod_organizacao != rel_cod_organizacao')
        ->orderBy('nom_organizacao')
        ->get();

        foreach ($organization as $result) {

            $organizacoes[$result->cod_organizacao] = $result->nom_organizacao.$this->hierarquiaUnidade($result->cod_organizacao);

            foreach($organizationChild as $resultChild1) {

                if($result->cod_organizacao == $resultChild1->rel_cod_organizacao) {

                    $organizacoes[$resultChild1->cod_organizacao] = $resultChild1->nom_organizacao.$this->hierarquiaUnidade($resultChild1->cod_organizacao);

                    foreach ($resultChild1->deshierarquia as $resultChild2) {

                        if($resultChild1->cod_organizacao == $resultChild2->rel_cod_organizacao) {

                            $organizacoes[$resultChild2->cod_organizacao] = $resultChild2->nom_organizacao.$this->hierarquiaUnidade($resultChild2->cod_organizacao);

                            foreach ($resultChild2->deshierarquia as $resultChild3) {

                                if($resultChild2->cod_organizacao == $resultChild3->rel_cod_organizacao) {

                                    $organizacoes[$resultChild3->cod_organizacao] = $resultChild3->nom_organizacao.$this->hierarquiaUnidade($resultChild3->cod_organizacao);

                                    foreach ($resultChild3->deshierarquia as $resultChild4) {

                                        if($resultChild3->cod_organizacao == $resultChild4->rel_cod_organizacao) {

                                            $organizacoes[$resultChild4->cod_organizacao] = $resultChild4->nom_organizacao.$this->hierarquiaUnidade($resultChild4->cod_organizacao);

                                            foreach ($resultChild4->deshierarquia as $resultChild5) {

                                                if($resultChild4->cod_organizacao == $resultChild5->rel_cod_organizacao) {

                                                    $organizacoes[$resultChild5->cod_organizacao] = $resultChild5->nom_organizacao.$this->hierarquiaUnidade($resultChild5->cod_organizacao);

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

        $rel_cod_organizacao_lista = $organizacoes;

        $organization = Organization::whereRaw('cod_organizacao = rel_cod_organizacao')
        ->get();

        $organizationChild = Organization::whereRaw('cod_organizacao != rel_cod_organizacao')
        ->orderBy('nom_organizacao')
        ->get();

        return view('livewire.organization.show')
        ->with('rel_cod_organizacao_lista',$rel_cod_organizacao_lista)
        ->with('organization',$organization)
        ->with('organizationChild',$organizationChild)
        ->with('nom_organizacao',$nom_organizacao);
    }

    protected function estruturaTable() {

        $estrutura = DB::select("SELECT
            column_name,ordinal_position,is_nullable,data_type
            FROM
            information_schema.columns
            WHERE
            table_schema = 'public'
            AND table_name = 'tab_organizacoes' 
            AND column_name NOT IN ('cod_organizacao','created_at','updated_at','deleted_at');");

        return $estrutura;

    }

    protected function hierarquiaUnidade($cod_organizacao) {

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
