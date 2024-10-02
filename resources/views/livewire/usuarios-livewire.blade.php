<x-slot name="header">
    <h2 class="font-semibold text-xl text-blue-800 leading-tight pl-3">
        Administração dos usuários do sistema
    </h2>
</x-slot>

<div class="" style="margin-top: 6px!Important; padding-top: 6px!Important;">

    <form wire:submit.prevent="create" method="post">

        <div class="w-full px-2 sm:px-4 lg:px-3">

            <div class="flex flex-wrap w-full">

                <div class="w-full md:w-1/1 pr-3 mb-1 text-right">
                    <span class="text-gray-600 pr-1 text-sm">Incluir</span>
                    <div
                        class="rounded-full h-6 w-6 flex items-center justify-center inline-flex items-center bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300 disabled:opacity-25 transition "
                        style="cursor: pointer;" wire:click.prevent="abrirFecharForm()"><i id="iconAbrirFecharForm"
                                                                                           class="<?php print($iconAbrirFechar) ?>"></i>
                    </div>
                </div>

            </div>

            <div id="divForm"
                 class="flex items-center px-4 py-6 bg-white rounded-md bg-gray-100 bg-opacity-50 shadow-md"
                 style="display: <?php print($this->abrirFecharForm) ?>;">

                <div class="flex flex-wrap w-full">

                    <div class="w-full md:w-1/1 mb-2">

                        <p><strong>Formulário de cadastro e edição</strong></p>

                    </div>

                    <div class="w-full md:w-1/3 px-3 mb-3 pt-1">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="name" value="Nome"/>
                            {!! Form::text('name',null,['class' => 'block w-full mt-1 rounded border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-left pl-3','id' => 'name', 'placeholder' => 'Nome completo', 'wire:model' => 'name', 'autocomplete' => 'off','required' => 'required']) !!}
                            <x-jet-input-error for="name" class="mt-2"/>
                        </div>

                    </div>

                    <div class="w-full md:w-1/3 px-3 mb-3 pt-1">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="email" value="E-mail"/>
                            {!! Form::email('email',null,['class' => 'block w-full mt-1 rounded border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-left pl-3','id' => 'email', 'placeholder' => 'Endereço de e-mail institucional', 'wire:model' => 'email', 'autocomplete' => 'off','required' => 'required']) !!}

                            <x-jet-input-error for="email" class="mt-2"/>
                        </div>

                    </div>

                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0 pt-1">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="cod_pei" value="Perfil"/>
                            {!! Form::select('adm', ['1' => 'Administrador(a)', '2' => 'Gestor(a)'], null, ['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-0', 'id' => 'adm', 'style' => 'height: 40px!Important; padding-left: 10px!Important; width: 100% !Important;', 'autocomplete' => 'off', 'placeholder' => 'Selecione', 'required' => 'required', 'wire:model' => 'adm', 'wire:change' => 'verificarTipoPerfilUsuario()']) !!}

                            <div class="p-2 text-gray-500 text-xs md:list-disc">

                                @for($contPerfil = 1; $contPerfil <= 6; $contPerfil++)

                                    @php $perfil = tipoPerfil($contPerfil); @endphp

                                    @if(isset($perfil) && !is_null($perfil) && $perfil != '')
                                        {!! $perfil . '<br /><br />' !!}
                                    @endif

                                @endfor
                            </div>

                            <x-jet-input-error for="adm" class="mt-2"/>
                        </div>

                    </div>

                    <div class="w-full md:w-3/3 px-3 mb-1 md:mb-0 pt-0">

                        <style>
                            .select2-selection {
                                border-color: #d1d5db !Important;
                                min-height: 41px !Important;
                            }
                        </style>

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-labelpreenchimentoobrigatoriio for="organizations-select" value="Área responsável" />

                            {!! Form::select('selected_organizations', $this->organizacoes, null, [
                                'class' => 'w-full m-0 p-0',
                                'style' => 'height: 40px!Important;',
                                'id' => 'organizations-select',
                                'multiple' => true,
                                'required' => 'required',
                                'wire:model' => 'selected_organizations',
                            ]) !!}
                            <x-jet-input-error for="organizations-select" class="mt-2" />

                            <script>
                                window.loadSelect2 = () => {
                                    $('#organizations-select').select2({
                                        // theme: "classic",
                                    }).on('change', function() {
                                        var data = $('#organizations-select').select2("val");
                                        @this.set('selected_organizations', data);
                                    });
                                }

                                document.addEventListener("livewire:load", () => {
                                    loadSelect2();
                                    window.livewire.on('select2Hydrate', () => {
                                        loadSelect2();
                                    });
                                });
                            </script>

                        </div>

                    </div>

                    @if($this->editarForm == true)
                        <div class="w-full md:w-1/3 px-3 mb-3 pt-1">

                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="ativo" value="Ativo"/>

                                <input
                                    class="form-check-input appearance-none w-9 rounded-full float-left h-5 align-top bg-white bg-no-repeat bg-contain bg-gray-300 focus:outline-none cursor-pointer shadow-sm"
                                    type="checkbox" role="switch" id="ativo" name="ativo"
                                    wire:model="ativo" @if($this->ativo == 1)
                                    {!! 'checked' !!}
                                    @endif>

                                <x-jet-input-error for="email" class="mt-2"/>
                            </div>

                        </div>

                    @endif

                    <div class="w-full md:w-1/1 px-3 mt-6 mb-3 md:mb-0 pt-1 text-right">

                        @if($this->editarForm == true)

                            <a class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring focus:ring-red-300 disabled:opacity-25 transition"
                               href="javascript: void(0);" wire:click.prevent="cancelar()">Cancelar</a>

                            <button
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
                                type="submit">Editar
                            </button>

                        @else

                            <button
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
                                type="submit">Salvar
                            </button>

                        @endif

                    </div>

                </div>

            </div>

    </form>

    <div class=" flex flex-wrap -mx-3 mb-6">

        <div class="w-full md:w-3/3 px-3 mb-6 md:mb-0 pt-3">

            <div class="border-b border-gray-200 shadow rounded-md">

                <table class="divide-gray-300 min-w-full border-collapse block md:table ">
                    <thead class="hidden shadow-lg inset-x-0 top-16 block md:table-header-group">
                    <tr class="shadow-lg">
                        <th class="bg-gray-400 px-1 py-2 text-xs text-white font-bold md:border md:border-gray-100 text-left block md:table-cell"
                            style="text-align: left!Important;">Nome
                        </th>
                        <th class="bg-gray-400 px-1 py-2 text-xs text-white font-bold md:border md:border-gray-100 text-left block md:table-cell"
                            style="text-align: left!Important;">E-mail
                        </th>
                        <th class="bg-gray-400 px-1 py-2 text-xs text-white font-bold md:border md:border-gray-100 text-left block md:table-cell"
                            style="text-align: left!Important;">Gestão
                        </th>
                        <th class="bg-gray-400 px-1 py-2 text-xs text-white font-bold md:border md:border-gray-100 text-left block md:table-cell"
                            style="text-align: left!Important;">Ação
                        </th>
                    </tr>
                    </thead>
                    @php $contUser = 1; @endphp
                    <tbody class="bg-white divide-y divide-gray-300 block md:table-row-group">

                    @foreach($this->users as $user)

                        <tr class="border border-gray-500 md:border-none block md:table-row @if($user->adm == 1) {!! 'bg-blue-50' !!} @endif @if($user->ativo == 0) {!! 'bg-red-50' !!} @endif">

                            <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell py-3 text-sm text-gray-600 ">
                                {!! $contUser++ !!}. @if($user->adm == 1)
                                    {!! '&nbsp;<i class="fa-solid fa-user-gear shadow-sm text-sky-700 cursor-help " title="Usuário(a) com perfil de Administrador(a)"></i>&nbsp;' !!}
                                @endif @if($user->ativo == 0)
                                    {!! '&nbsp;<i class="fa-solid fa-user-slash shadow-sm text-red-600 cursor-help " title="Usuário(a) inativo(a), dessa forma ele(a) não pode utilizar o sistema"></i>&nbsp;' !!}
                                @endif @if($user->trocarsenha == 1)
                                    {!! '&nbsp;<i class="fa-solid fa-user-lock shadow-sm text-orange-600 cursor-help " title="Usuário(a) ainda não alterou a senha inicial, dessa forma ele(a) não pode utilizar o sistema, exceto para efetuar a alteração da senha inicial ou o seu nome"></i>&nbsp;' !!}
                                @endif {!! $user->name !!}
                            </td>

                            <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell py-3 text-sm text-gray-600">
                                {{ $user->email }}
                            </td>

                            <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell py-3 text-sm text-gray-600">
                                @foreach($user->servidorResponsavel as $responsavel)
                                    {!! '&nbsp;<i class="fa-solid fa-user shadow-sm text-violet-900 cursor-help " title="Atuação como Responsável pelo Plano de Ação ' . $responsavel->dsc_plano_de_acao . ' na ' . $responsavel->unidade->sgl_organizacao . '"></i>&nbsp;' !!}
                                @endforeach

                                @foreach($user->servidorSubstituto as $substituto)
                                    {!! '&nbsp;<i class="fa-solid fa-user-group shadow-sm text-violet-600 cursor-help " title="Atuação como Substituto(a) no Plano de Ação ' . $substituto->dsc_plano_de_acao . ' na ' . $substituto->unidade->sgl_organizacao . '"></i>&nbsp;' !!}
                                @endforeach
                            </td>

                            <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell py-3 text-sm text-gray-600 ">
                                <div class="flex justify-center">
                                    <div class="flex items-center">
                                        <div class="text-sm">
                                            <a href="javascript: void(0);"
                                               wire:click.prevent="editForm('{{ $user->id }}')"
                                               onclick="javascript: document.documentElement.scrollTop = 0;">
                                                <i class="fas fa-edit text-green-600 hover:text-green-900"
                                                   title="Editar o cadastro"></i>
                                            </a>
                                        </div>
                                        <div class="text-sm ml-2">

                                        </div>
                                    </div>
                                </div>
                            </td>

                        </tr>

                    @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <!-- Modal -->
    <x-jet-dialog-modal wire:model="showModalResultadoEdicao">
        <x-slot name="title">
            <strong>Importante</strong>
        </x-slot>

        <x-slot name="content">
            {!! $this->mensagemResultadoEdicao !!}
        </x-slot>

        <x-slot name="footer">
            <x-jet-button wire:click.prevent="$toggle('showModalResultadoEdicao')" wire:loading.attr="disabled">
                {{ __('Closer') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

    <!-- Modal -->
    <x-jet-dialog-modal wire:model="showModalDelete">
        <x-slot name="title">
            <strong>Excluir</strong>
        </x-slot>

        <x-slot name="content">
            {!! $this->mensagemDelete !!}
        </x-slot>

        <x-slot name="footer">
            <x-jet-button wire:click.prevent="$toggle('showModalDelete')" wire:loading.attr="disabled">
                {{ __('Closer') }}
            </x-jet-button>
            <x-jet-danger-button wire:click.prevent="$toggle('showModalDelete')" wire:loading.attr="disabled"
                                 wire:click.prevent="delete('{!! $this->user_id !!}')">
                Sim, quero excluir
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>

    <!-- Modal -->
    <x-jet-geral-modal wire:model="showModalAudit">
        <x-slot name="title">
            <strong>Ações Realizadas</strong>
        </x-slot>

        <x-slot name="content">
            {!! $this->mensagemDelete !!}
        </x-slot>

        <x-slot name="footer">
            <x-jet-button wire:click.prevent="$toggle('showModalAudit')" wire:loading.attr="disabled">
                {{ __('Closer') }}
            </x-jet-button>
        </x-slot>
    </x-jet-geral-modal>

</div>
