<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Organization;
use Livewire\Component;

class UsuariosLivewire extends Component
{

    public $users = [];
    public $user_id = null;
    public $organization = [];

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

    public function render()
    {

        $organization = Organization::whereRaw('cod_organizacao = rel_cod_organizacao')
        ->get();

        $organizationChild = Organization::whereRaw('cod_organizacao != rel_cod_organizacao')
        ->orderBy('nom_organizacao')
        ->get();

        foreach ($organization as $result) {

            if($this->editarForm == false) {

                $organizacoes[$result->cod_organizacao] = $result->nom_organizacao.$this->hierarquiaUnidade($result->cod_organizacao);

            } else {

                $organizacoes[$result->cod_organizacao] = $result->nom_organizacao.$this->hierarquiaUnidade($result->cod_organizacao);

            }

            foreach($organizationChild as $resultChild1) {

                if($result->cod_organizacao == $resultChild1->rel_cod_organizacao) {

                    if($this->editarForm == false) {

                        $organizacoes[$resultChild1->cod_organizacao] = $resultChild1->nom_organizacao.$this->hierarquiaUnidade($resultChild1->cod_organizacao);

                    } else {

                        $organizacoes[$resultChild1->cod_organizacao] = $resultChild1->nom_organizacao.$this->hierarquiaUnidade($resultChild1->cod_organizacao);

                    }

                    foreach ($resultChild1->deshierarquia as $resultChild2) {

                        if($resultChild1->cod_organizacao == $resultChild2->rel_cod_organizacao) {

                            if($this->editarForm == false) {

                                $organizacoes[$resultChild2->cod_organizacao] = $resultChild2->nom_organizacao.$this->hierarquiaUnidade($resultChild2->cod_organizacao);

                            } else {

                                $organizacoes[$resultChild2->cod_organizacao] = $resultChild2->nom_organizacao.$this->hierarquiaUnidade($resultChild2->cod_organizacao);

                            }

                            foreach ($resultChild2->deshierarquia as $resultChild3) {

                                if($resultChild2->cod_organizacao == $resultChild3->rel_cod_organizacao) {

                                    if($this->editarForm == false) {

                                        $organizacoes[$resultChild3->cod_organizacao] = $resultChild3->nom_organizacao.$this->hierarquiaUnidade($resultChild3->cod_organizacao);

                                    } else {

                                        $organizacoes[$resultChild3->cod_organizacao] = $resultChild3->nom_organizacao.$this->hierarquiaUnidade($resultChild3->cod_organizacao);

                                    }

                                    foreach ($resultChild3->deshierarquia as $resultChild4) {

                                        if($resultChild3->cod_organizacao == $resultChild4->rel_cod_organizacao) {

                                            if($this->editarForm == false) {

                                                $organizacoes[$resultChild4->cod_organizacao] = $resultChild4->nom_organizacao.$this->hierarquiaUnidade($resultChild4->cod_organizacao);

                                            } else {

                                                $organizacoes[$resultChild4->cod_organizacao] = $resultChild4->nom_organizacao.$this->hierarquiaUnidade($resultChild4->cod_organizacao);

                                            }

                                            foreach ($resultChild4->deshierarquia as $resultChild5) {

                                                if($resultChild4->cod_organizacao == $resultChild5->rel_cod_organizacao) {

                                                    if($this->editarForm == false) {

                                                        $organizacoes[$resultChild5->cod_organizacao] = $resultChild5->nom_organizacao.$this->hierarquiaUnidade($resultChild5->cod_organizacao);

                                                    } else {

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

        }

        $this->organization = $organizacoes;

        $this->users = User::all();
        
        return view('livewire.usuarios-livewire');
    }

    public function user(User $user_id) {

        $this->user_id = $user_id;
        $this->editarForm = true;
        $this->deleteForm = false;
        $this->audit = false;
        $this->showModalResultadoEdicao = false;
        $this->showModalDelete = false;
        $this->showModalAudit = false;
        $this->abrirFecharForm = 'none';
        $this->iconAbrirFechar = 'fas fa-plus text-xs';
        $this->iconFechar = 'fas fa-minus text-xs';
        $this->maxWidth = 'xl';

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
