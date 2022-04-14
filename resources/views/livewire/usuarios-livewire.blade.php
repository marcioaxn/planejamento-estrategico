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
                    <div class="rounded-full h-6 w-6 flex items-center justify-center inline-flex items-center bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300 disabled:opacity-25 transition " style="cursor: pointer;" wire:click.prevent="abrirFecharForm()"><i id="iconAbrirFecharForm" class="<?php print($iconAbrirFechar) ?>"></i></div>
                </div>

            </div>

            <div id="divForm" class="flex items-center px-4 py-6 bg-white rounded-md bg-gray-100 bg-opacity-50 shadow-md" style="display: <?php print($this->abrirFecharForm) ?>;">

                <div class="flex flex-wrap w-full">

                    <div class="w-full md:w-1/1 mb-2">

                        <p><strong>Formulário de cadastro e edição</strong></p>

                    </div>

                    <div class="w-full md:w-2/3 px-3 mb-1 md:mb-0 pt-1">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="cod_organizacao" value="Unidade Responsável" />
                            {!! Form::select('cod_organizacao', $this->organization, null, ['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-0', 'style' => 'height: 40px!Important; padding-left: 10px!Important; width: 100% !Important;', 'placeholder' => 'Selecione', 'autocomplete' => 'off', 'required' => 'required', 'wire:model' => 'cod_organizacao']) !!}
                            <x-jet-input-error for="cod_organizacao" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-1/2 px-3 mb-1 md:mb-0 pt-1">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="dsc_plano_de_acao" value="Descrição" />
                            
                            <x-jet-input-error for="dsc_plano_de_acao" class="mt-2" />
                        </div>

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
                                <th class="bg-gray-400 px-1 py-2 text-xs text-white font-bold md:border md:border-gray-100 text-left block md:table-cell" style="text-align: left!Important;">Nome</th>
                                <th class="bg-gray-400 px-1 py-2 text-xs text-white font-bold md:border md:border-gray-100 text-left block md:table-cell" style="text-align: left!Important;">E-mail</th>
                                <th class="bg-gray-400 px-1 py-2 text-xs text-white font-bold md:border md:border-gray-100 text-left block md:table-cell" style="text-align: left!Important;">Ação</th>
                            </tr>
                        </thead>
                        @php $contUser = 1; @endphp
                        <tbody class="bg-white divide-y divide-gray-300 block md:table-row-group">

                            @foreach($this->users as $user)

                            <tr class="border border-gray-500 md:border-none block md:table-row">

                                <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell py-3 text-sm text-gray-600 bg-blue-50 ">
                                    {!! $contUser++ !!}. {!! $user->name !!}
                                </td>

                                <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell py-3 text-sm text-gray-600">
                                    {{ $user->email }}
                                </td>

                                <td>
                                    <div class="flex justify-center">
                                        <div class="flex items-center">
                                            <div class="text-sm">
                                                <a href="#" wire:click.prevent="edit({{ $user->id }})" class="text-blue-500 hover:text-blue-700">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </div>
                                            <div class="text-sm ml-2">
                                                <a href="#" wire:click.prevent="delete({{ $user->id }})" class="text-red-500 hover:text-red-700">
                                                    <i class="fas fa-trash"></i>
                                                </a>
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
                <x-jet-danger-button wire:click.prevent="$toggle('showModalDelete')" wire:loading.attr="disabled" wire:click.prevent="delete('{!! $this->user_id !!}')">
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
