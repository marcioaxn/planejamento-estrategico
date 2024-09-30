<?php

namespace App\Http\Livewire;

use App\Models\Acoes;
use App\Models\Audit;
use Mail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Organization;
use Livewire\Component;
use Auth;

class UsuariosLivewire extends Component
{

    public $users = [];
    public $user_id = null;
    public $organization = [];

    public $name = null;
    public $email = null;
    public $adm = null;
    public $ativo = null;

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

    public function getUsers()
    {
        return User::where('ativo', 1)
            ->orderBy('name')
            ->pluck('name', 'id');
    }

    public function abrirFecharForm()
    {

        if ($this->abrirFecharForm === 'none') {

            $this->cod_missao_visao_valores = null;
            $this->cod_pei = null;
            $this->cod_organizacao = null;
            $this->dsc_missao = null;
            $this->dsc_visao = null;
            $this->nom_valor = null;
            $this->editarForm = false;

            $this->abrirFecharForm = 'block';
            $this->iconAbrirFechar = 'fas fa-minus text-xs';

        } else {

            $this->cod_missao_visao_valores = null;
            $this->cod_pei = null;
            $this->cod_organizacao = null;
            $this->dsc_missao = null;
            $this->dsc_visao = null;
            $this->nom_valor = null;
            $this->editarForm = false;

            $this->abrirFecharForm = 'none';
            $this->iconAbrirFechar = 'fas fa-plus text-xs';

        }

    }

    public function verificarTipoPerfilUsuario()
    {

        if ($this->abrirFecharForm === 'block' && isset($this->adm) && !is_null($this->adm) && $this->adm != '') {

            if ($this->adm == 1) {

                //

            } elseif ($this->adm == 2) {

                //

            }

        }

    }

    public function create()
    {

        // Início do IF para verificar se o usuário logado tem perfil de administrador para prosseguir com o procedimento
        if (Auth::user()->adm == 1) {

            // Início do IF que verifica se existe o ID do usuário, pois se existir será a parte do update
            if (isset($this->user_id) && !is_null($this->user_id) && $this->user_id != '') {

                $modificacoes = '';
                $alteracao = array();

                // Consultar o usuário pelo ID
                $consultaUsuario = User::find($this->user_id);

                // Início do IF para verificar se houve alteração no nome de usuário
                if ($consultaUsuario->name != $this->name) {

                    $alteracao['name'] = $this->name;

                    $audit = Audit::create(
                        array(
                            'table' => 'users',
                            'table_id' => $this->user_id,
                            'column_name' => 'name',
                            'data_type' => 'character varying',
                            'ip' => $_SERVER['REMOTE_ADDR'],
                            'user_id' => Auth::user()->id,
                            'acao' => 'Editou',
                            'antes' => $consultaUsuario->name,
                            'depois' => $this->name
                        )
                    );

                    $modificacoes .= 'Alterou o(a) <b>Nome</b> de <span style="color:#CD3333;">( ' . $consultaUsuario->name . ' )</span> para <span style="color:#28a745;">( ' . $this->name . ' )</span>;<br>';

                }
                // Fim do IF para verificar se houve alteração no nome de usuário

                // Início do IF para verificar se houve alteração no email de usuário
                if ($consultaUsuario->email != $this->email) {

                    $alteracao['email'] = $this->email;

                    $audit = Audit::create(
                        array(
                            'table' => 'users',
                            'table_id' => $this->user_id,
                            'column_name' => 'email',
                            'data_type' => 'character varying',
                            'ip' => $_SERVER['REMOTE_ADDR'],
                            'user_id' => Auth::user()->id,
                            'acao' => 'Editou',
                            'antes' => $consultaUsuario->email,
                            'depois' => $this->email
                        )
                    );

                    $modificacoes .= 'Alterou o(a) <b>E-mail</b> de <span style="color:#CD3333;">( ' . $consultaUsuario->email . ' )</span> para <span style="color:#28a745;">( ' . $this->email . ' )</span>;<br>';

                }
                // Fim do IF para verificar se houve alteração no email de usuário

                // Início do IF para verificar se houve alteração no perfil de usuário
                if ($consultaUsuario->adm != $this->adm) {

                    $alteracao['adm'] = ($this->adm) * 1;

                    $consultaUsuario->adm == 1 ? $perfilTabela = "Super administrador(a)" : $perfilTabela = "Gestor(a)";
                    $this->adm == 1 ? $perfilForm = "Super administrador(a)" : $perfilForm = "Gestor(a)";

                    $audit = Audit::create(
                        array(
                            'table' => 'users',
                            'table_id' => $this->user_id,
                            'column_name' => 'adm',
                            'data_type' => 'smallint',
                            'ip' => $_SERVER['REMOTE_ADDR'],
                            'user_id' => Auth::user()->id,
                            'acao' => 'Editou',
                            'antes' => $perfilTabela,
                            'depois' => $perfilForm
                        )
                    );

                    $modificacoes .= 'Alterou o(a) <b>Perfil</b> de <span style="color:#CD3333;">( ' . $perfilTabela . ' )</span> para <span style="color:#28a745;">( ' . $perfilForm . ' )</span>;<br>';

                }
                // Fim do IF para verificar se houve alteração no perfil de usuário

                // Início do IF para verificar se houve alteração na ativação do usuário

                $this->ativo == false ? $this->ativo = 0 : $this->ativo = 1;

                if ($consultaUsuario->ativo != $this->ativo) {

                    $alteracao['ativo'] = $this->ativo;

                    $consultaUsuario->ativo == 1 ? $ativoTabela = "Ativo" : $ativoTabela = "Inativo";
                    $this->ativo == 1 ? $ativoForm = "Ativo" : $ativoForm = "Inativo";

                    $audit = Audit::create(
                        array(
                            'table' => 'users',
                            'table_id' => $this->user_id,
                            'column_name' => 'ativo',
                            'data_type' => 'smallint',
                            'ip' => $_SERVER['REMOTE_ADDR'],
                            'user_id' => Auth::user()->id,
                            'acao' => 'Editou',
                            'antes' => $ativoTabela,
                            'depois' => $ativoForm
                        )
                    );

                    $modificacoes .= 'Alterou o(a) <b>Ativação do cadastro</b> de <span style="color:#CD3333;">( ' . $ativoTabela . ' )</span> para <span style="color:#28a745;">( ' . $ativoForm . ' )</span>;<br>';

                }
                // Fim do IF para verificar se houve alteração na ativação do usuário

                // Início do IF para verificar se houve modificação
                if (isset($modificacoes) && !is_null($modificacoes) && $modificacoes != '') {

                    $consultaUsuario->update($alteracao);

                    $acao = Acoes::create(
                        array(
                            'table' => 'users',
                            'table_id' => $this->user_id,
                            'user_id' => Auth::user()->id,
                            'acao' => $modificacoes
                        )
                    );

                    $assunto = "Cadastro alterado no sistema " . config('app.name');
                    $header = config('app.name');
                    $textoEmail = "<p>Informo que houve alteração no seu cadastro no sistema " . config('app.name') . ", conforme a seguinte lista: <br /><br />" . $modificacoes . "</p><p class='pt-6'>Em caso de dúvidas envie uma mensagem para: email@organizacao.com.br</p><p class='pt-6'>Atenciosamente,<br><strong>Equipe " . config('app.name') . "</strong></p>";

                    $email = $this->email;
                    $nome = $this->name;

                    Mail::send('email.cadastro', ['name' => $nome, 'textoEmail' => $textoEmail, 'header' => $header], function ($message) use ($email, $nome, $assunto, $header) {
                        $message->to($email, $nome)->subject($assunto);
                        $message->from('maxnprojetos@gmail.com', config('app.name'));
                    });

                    $this->showModalResultadoEdicao = true;

                    $this->mensagemResultadoEdicao = "Será encaminhada uma mensagem de e-mail para esse usuário informando que houve modificação em seu cadastro, conforme a seguinte lista:<br /><br />" . $modificacoes;

                    $this->name = null;
                    $this->email = null;
                    $this->adm = null;
                    $this->ativo = null;

                    $this->abrirFecharForm = 'none';
                    $this->iconAbrirFechar = 'fas fa-plus text-xs';

                    $this->editarForm = false;

                }
                // Fim do IF para verificar se houve modificação
                // --- x --- x --- x ---

                // Este ELSE é para o caso do usuário ter clicado em Editar, mas não fizera nenhuma alteração
                else {

                    $this->showModalResultadoEdicao = true;

                    $this->mensagemResultadoEdicao = 'Por não ter nenhuma modificação nada foi feito.';

                }

            }
            // Fim do IF que verifica se existe o ID do usuário, pois se existir será a parte do update
            // --- x --- x --- x ---
            else {

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

                    $complementoInformacao = null;

                    $gravarNovoUsuario = new User;

                    $gravarNovoUsuario->name = $this->name;
                    $gravarNovoUsuario->email = $this->email;
                    $gravarNovoUsuario->adm = $this->adm;

                    // $this->senha = gerar_senha();
                    $this->senha = 'L<Wx+UQ=$Im*HnBUrYLg1U@kx';

                    $gravarNovoUsuario->password = Hash::make($this->senha);

                    $assunto = "Cadastro no sistema " . config('app.name');
                    $header = config('app.name');
                    $textoEmail = "<p>Informo que foi feito o seu cadastro no sistema " . config('app.name') . ".<br /><br />O seu perfil de acesso ao sistema é " . tipoPerfil($this->adm) . "<br /><br />A sua senha inicial é <br /><br /><span class='text-base font-semibold text-black'>" . $this->senha . "</span><br /><br />O endereço de acesso ao sistema é <a class='text-blue-600' href='" . config('app.url') . "' target='_blank'>" . config('app.url') . "</a></p><p class='pt-6'>Em caso de dúvidas envie uma mensagem para: email@organizacao.com.br</p><p class='pt-6'>Atenciosamente,<br><strong>Equipe " . config('app.name') . "</strong></p>";

                    $email = $this->email;
                    $nome = $this->name;

                    // Descomentar quando houver um servidor de e-mail configurado. Além de tirar este endereço 'maxnprojetos@gmail.com' e incluir o endereço correto.
                    /*
                    Mail::send('email.cadastro', ['name' => $nome, 'textoEmail' => $textoEmail, 'header' => $header], function ($message) use ($email, $nome, $assunto, $header) {
                        $message->to($email, $nome)->subject($assunto);
                        $message->from('maxnprojetos@gmail.com', config('app.name'));
                    });
                    */

                    if ($this->adm == 2) {

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

        } else {

            $this->showModalResultadoEdicao = true;

            $this->mensagemResultadoEdicao = 'Você não possui a permissão para prosseguir com esse procedimento';

        }
        // Fim do IF para verificar se o usuário logado tem perfil de administrador para prosseguir com o procedimento

    }

    public function editForm(User $singleData)
    {

        $this->user_id = $singleData->id;
        $this->name = $singleData->name;
        $this->email = $singleData->email;
        $this->adm = $singleData->adm;
        $this->ativo = $singleData->ativo;

        $this->abrirFecharForm = 'block';
        $this->iconAbrirFechar = 'fas fa-minus text-xs';

        $this->editarForm = true;

    }

    public function cancelar()
    {

        $this->name = null;
        $this->email = null;
        $this->adm = null;

        $this->editarForm = false;

    }

    public function render()
    {

        $this->users = User::orderBy('name')
            ->with('servidorResponsavel', 'servidorResponsavel.unidade', 'servidorSubstituto', 'servidorSubstituto.unidade')
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
