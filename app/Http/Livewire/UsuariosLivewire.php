<?php

namespace App\Http\Livewire;

use Mail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Organization;
use Livewire\Component;

class UsuariosLivewire extends Component
{

    public $users = [];
    public $user_id = null;
    public $organization = [];

    public $name = null;
    public $email = null;
    public $adm = null;

    public $senha = null;

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

    public function abrirFecharForm()
    {

        if ($this->abrirFecharForm === 'none') {

            $this->cod_missao_visao_valores = null;
            $this->cod_pei = null;
            $this->cod_organizacao = null;
            $this->dsc_missao = null;
            $this->dsc_visao = null;
            $this->dsc_valores = null;
            $this->editarForm = false;

            $this->abrirFecharForm = 'block';
            $this->iconAbrirFechar = 'fas fa-minus text-xs';

        } else {

            $this->cod_missao_visao_valores = null;
            $this->cod_pei = null;
            $this->cod_organizacao = null;
            $this->dsc_missao = null;
            $this->dsc_visao = null;
            $this->dsc_valores = null;
            $this->editarForm = false;

            $this->abrirFecharForm = 'none';
            $this->iconAbrirFechar = 'fas fa-plus text-xs';

        }

    }

    public function verificarTipoPerfilUsuario()
    {

        if ($this->abrirFecharForm === 'block' && isset($this->adm) && !is_null($this->adm) && $this->adm != '') {

            if ($this->adm == 1) {

                // dd($this->adm);

            } elseif ($this->adm == 2) {

                // dd($this->adm);

            }

        }

    }

    public function create()
    {

        // Início da consulta para verificar se esse usuário já está cadastrado

        // Início do IF para verificar se a variável email foi informada
        if (isset($this->email) && !is_null($this->email) && $this->email != '') {

            $consultaUsuario = User::where('email', $this->email)
                ->first();

            if ($consultaUsuario) {

                $this->showModalResultadoEdicao = true;
                $this->mensagemResultadoEdicao = "Não será permitida a inclusão desse cadastro, pois já existe um usuário(a) cadastrado(a) com este e-mail ( " . $this->email . " ).";

                return false;

            }

        }
        // Fim do IF para verificar se a variável email foi informada
        // --- x --- x --- x ---

        // Fim da consulta para verificar se esse usuário já está cadastrado
        // --- x --- x --- x ---

        // Início do IF para ter a certeza de que o usuário não existe no banco de dados
        if (!$consultaUsuario) {

            $gravarNovoUsuario = new User;

            $gravarNovoUsuario->name = $this->name;
            $gravarNovoUsuario->email = $this->email;
            $gravarNovoUsuario->adm = $this->adm;

            $this->senha = gerar_senha();

            $gravarNovoUsuario->password = Hash::make($this->senha);

            $assunto = "Cadastro no sistema " . config('app.name');
            $header = config('app.name');
            $textoEmail = "<p>Informo que foi feito o seu cadastro no sistema " . config('app.name') . ".<br /><br />O seu perfil de acesso ao sistema é " . tipoPerfil($this->adm) . "<br /><br />A sua senha inicial é <br /><br /><span class='text-base font-semibold text-black'>" . $this->senha . "</span><br /><br />O endereço de acesso ao sistema é <a class='text-blue-600' href='" . config('app.url') . "' target='_blank'>" . config('app.url') . "</a></p><p class='pt-6'>Em caso de dúvidas envie uma mensagem para: email@organizacao.com.br</p><p class='pt-6'>Atenciosamente,<br><strong>Equipe " . config('app.name') . "</strong></p>";

            $email = $this->email;
            $nome = $this->name;

            Mail::send('email.cadastro', ['name' => $nome, 'textoEmail' => $textoEmail, 'header' => $header], function ($message) use ($email, $nome, $assunto, $header) {
                $message->to($email, $nome)->subject($assunto);
                $message->from('maxnprojetos@gmail.com', config('app.name'));
            });

            if ($this->adm == 2) {

                $complementoInformacao = null;

                $complementoInformacao = "<br /><br /><span class='text-red-700'>No caso desse(a) usuário(a) que o perfil é de Gestor(a), você poderá no menu <strong>Administração do Sistema</strong> e submenu <strong>Plano de Ação</strong> efetuar a indicação se ele(a) atuará como Servidor(a) Responsável ou como Servidor(a) Substituto(a) num determinado Plano de Ação.<br /><br />Se o Plano de Ação ainda não foi criado essa indicação é feita no momento da criação, mas se já foi o caminho será editar o Plano de Ação e dessa forma efetuar a indicação.</span>";

            }

            $gravarNovoUsuario->save();

            $this->showModalResultadoEdicao = true;
            $this->mensagemResultadoEdicao = "Foi feito com sucesso o cadastro do(a) " . $this->name . ".<br /><br />Foi gerada uma senha e ela foi encaminhada para este e-mail ( " . $this->email . " )." . $complementoInformacao;

            $this->name = null;
            $this->email = null;
            $this->adm = null;

            $this->abrirFecharForm = 'none';
            $this->iconAbrirFechar = 'fas fa-plus text-xs';

            $this->editarForm = false;

        }
        // Fim do IF para ter a certeza de que o usuário não existe no banco de dados
        // --- x --- x --- x ---

    }

    public function render()
    {

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

        $this->users = User::with('servidorResponsavel', 'servidorResponsavel.unidade', 'servidorSubstituto', 'servidorSubstituto.unidade')
            ->get();

        return view('livewire.usuarios-livewire');
    }

    public function user(User $user_id)
    {

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
