<x-slot name="header">
    <h2 class="font-semibold text-xl text-blue-800 leading-tight pl-3">
        Administração do Grau de Satisfação
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

            <div id="divForm" class="flex items-center px-4 py-6 bg-white rounded-md shadow-md" style="display: <?php print($this->abrirFecharForm) ?>;">

                <div class="flex flex-wrap w-full">

                    <div class="w-full md:w-1/1 mb-2">

                        <p><strong>Formulário de cadastro e edição</strong></p>

                    </div>

                    <div class="w-full md:w-1/2 px-3 pt-6 mb-3 md:mb-0 pt-1">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="dsc_grau_satisfcao" value="Descrição do Grau de Satisfação" />
                            {!! Form::text('dsc_grau_satisfcao', null, ['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-1', 'id' => 'dsc_grau_satisfcao', 'style' => 'width: 100% !Important;', 'autocomplete' => 'off', 'placeholder' => 'Digite a descrição do Grau de Satisfação', 'required' => 'required', 'wire:model' => 'dsc_grau_satisfcao']) !!}
                            <x-jet-input-error for="dsc_grau_satisfcao" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-1/2 px-3 pt-6 mb-3 md:mb-0 pt-1">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="cor" value="Cor, em inglês, para representar o Grau de Satisfação" />
                            {!! Form::text('cor', null, ['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-1', 'id' => 'cor', 'style' => 'width: 100% !Important;', 'autocomplete' => 'off', 'placeholder' => 'Digite a cor em inglês', 'required' => 'required', 'wire:model' => 'cor']) !!}
                            <x-jet-input-error for="cor" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-1/2 px-3 pt-6 mb-3 md:mb-0 pt-1">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="vlr_minimo" value="Percentual mínimo aceitável" />
                            {!! Form::text('vlr_minimo', null, ['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-1', 'id' => 'vlr_minimo', 'style' => 'width: 100% !Important;', 'autocomplete' => 'off', 'placeholder' => '0,00', 'required' => 'required', 'wire:model' => 'vlr_minimo']) !!}
                            <x-jet-input-error for="vlr_minimo" class="mt-2" />
                        </div>

                        <script type="text/javascript">

                            $('#vlr_minimo').mask('000,00', {reverse: true});

                        </script>

                    </div>

                    <div class="w-full md:w-1/2 px-3 pt-6 mb-3 md:mb-0 pt-1">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="vlr_maximo" value="Percentual máximo aceitável" />
                            {!! Form::text('vlr_maximo', null, ['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-1', 'id' => 'vlr_maximo', 'style' => 'width: 100% !Important;', 'autocomplete' => 'off', 'placeholder' => '0,00', 'required' => 'required', 'wire:model' => 'vlr_maximo']) !!}
                            <x-jet-input-error for="vlr_maximo" class="mt-2" />
                        </div>

                        <script type="text/javascript">

                            $('#vlr_maximo').mask('000,00', {reverse: true});

                        </script>

                    </div>

                    <div class="w-full md:w-1/1 px-3 mt-6 mb-3 md:mb-0 pt-1 text-right">

                        @if($this->editarForm == true)

                        <a class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring focus:ring-red-300 disabled:opacity-25 transition" href="javascript: void(0);" wire:click.prevent="cancelar()" >Cancelar</a>

                        <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" type="submit">Editar</button>

                        @else

                        <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" type="submit">Salvar</button>

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
                                <th class="bg-gray-400 px-6 py-2 text-xs text-white font-bold md:border md:border-gray-100 text-left block md:table-cell" style="text-align: left!Important;">Descrição do Grau de Satisfação</th>
                                <th class="bg-gray-400 px-6 py-2 text-xs text-white font-bold md:border md:border-gray-100 text-left block md:table-cell" style="text-align: left!Important;">Cor para representar o Grau de Satisfação</th>
                                <th class="bg-gray-400 px-6 py-2 text-xs text-white font-bold md:border md:border-gray-100 text-left block md:table-cell" style="text-align: left!Important;">Percentual mínimo aceitável</th>
                                <th class="bg-gray-400 px-6 py-2 text-xs text-white font-bold md:border md:border-gray-100 text-left block md:table-cell" style="text-align: left!Important;">Percentual máximo aceitável</th>
                                <th class="bg-gray-400 px-6 py-2 text-xs text-white font-bold md:border md:border-gray-100 text-left block md:table-cell" style="text-align: left!Important;">Ação</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-300 block md:table-row-group">

                            @foreach ($this->grau_satisfacao as $result)

                            <tr class="border border-gray-500 md:border-none block md:table-row">
                                <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell px-5 py-3 text-sm text-gray-600">
                                    {{ $result->dsc_grau_satisfcao }}
                                </td>
                                <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell px-5 py-3 text-sm text-gray-600">
                                    {{ $result->cor }}
                                </td>
                                <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell px-5 py-3 text-sm text-gray-600">
                                    {{ converteValor('MYSQL','PTBR',$result->vlr_minimo) }}
                                </td>
                                <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell px-5 py-3 text-sm text-gray-600">
                                    {{ converteValor('MYSQL','PTBR',$result->vlr_maximo) }}
                                </td>
                                <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell px-5 py-3 text-sm text-gray-600">
                                    <a href="javascript: void(0);" wire:click.prevent="editForm('{!! $result->cod_grau_satisfcao !!}')" onclick="javascript: document.documentElement.scrollTop = 0;"><i class="fas fa-edit text-green-600"></i></a>

                                    &nbsp;
                                    &nbsp;
                                    <button type="button" wire:click.prevent="deleteForm('{!! $result->cod_grau_satisfcao !!}')"><i class="fas fa-trash-alt text-red-600"></i></button>

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
                <x-jet-danger-button wire:click.prevent="$toggle('showModalDelete')" wire:loading.attr="disabled" wire:click.prevent="delete('{!! $this->cod_grau_satisfcao !!}')">
                    Sim, quero excluir
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>

    </div>
