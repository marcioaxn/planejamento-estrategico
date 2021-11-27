<x-slot name="header">
    <h2 class="font-semibold text-xl text-blue-800 leading-tight">
        Administração do Objetivo Estratégico
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

            <div id="divForm" class="flex items-center px-4 py-6 bg-white rounded-md bg-indigo-50 bg-opacity-50 shadow-md" style="display: <?php print($this->abrirFecharForm) ?>;">

                <div class="flex flex-wrap w-full">

                    <div class="w-full md:w-1/1 mb-2">

                        <p><strong>Formulário de cadastro e edição</strong></p>

                    </div>

                    <div class="w-full md:w-1/2 px-3 mb-1 md:mb-0 pt-1">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="cod_pei" value="Planejamento Estratégico Integrado - PEI:" />
                            {!! Form::select('cod_pei', $this->pei, null, ['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-0', 'style' => 'height: 40px!Important; padding-left: 10px!Important; width: 100% !Important;', 'placeholder' => 'Selecione', 'autocomplete' => 'off', 'required' => 'required', 'wire:model' => 'cod_pei']) !!}
                            <x-jet-input-error for="cod_pei" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-1/2 px-3 mb-1 md:mb-0 pt-1">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="cod_perspectiva" value="Perspectiva:" />
                            {!! Form::select('cod_perspectiva', $this->perspectiva, null, ['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-0', 'style' => 'height: 40px!Important; padding-left: 10px!Important; width: 100% !Important;', 'placeholder' => 'Selecione', 'autocomplete' => 'off', 'required' => 'required', 'wire:model' => 'cod_perspectiva']) !!}
                            <div class="p-2 text-gray-500 text-xs md:list-disc">Os elementos desse campo só serão visíveis após a escolha do PEI.</div>
                            <x-jet-input-error for="cod_perspectiva" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-1/3 px-3 pt-2 mb-1 md:mb-0">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="num_nivel_hierarquico_apresentacao" value="Código:" />
                            {!! Form::select('num_nivel_hierarquico_apresentacao', $this->niveis_hierarquico_apresentacao, null, ['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-0', 'style' => 'height: 40px!Important; padding-left: 10px!Important; width: 100% !Important;', 'placeholder' => 'Selecione', 'autocomplete' => 'off', 'required' => 'required', 'wire:model' => 'num_nivel_hierarquico_apresentacao']) !!}
                            <div class="p-2 text-gray-500 text-xs md:list-disc">Este campo será preenchido automaticamente após a escolha da perspectiva, mas pode ser alterado se necessário.</div>
                            <x-jet-input-error for="num_nivel_hierarquico_apresentacao" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-2/3 px-3 pt-2 mb-1 md:mb-0">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="dsc_objetivo_estrategico" value="Objetivo Estratégico:" />
                            {!! Form::textarea('dsc_objetivo_estrategico',null,['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-2 pl-2','id' => 'dsc_objetivo_estrategico', 'placeholder' => 'Escreva aqui o objetivo estratégico', 'rows' => 3, 'required' => 'required', 'style' => 'width: 100%', 'wire:model' => 'dsc_objetivo_estrategico']) !!}
                            <x-jet-input-error for="dsc_objetivo_estrategico" class="mt-2" />
                        </div>

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
                                <th class="bg-gray-400 px-6 py-2 text-xs text-white font-bold md:border md:border-gray-100 text-left block md:table-cell" style="text-align: left!Important;">Objetivo Estratégico</th>
                                <th class="bg-gray-400 px-6 py-2 text-xs text-white font-bold md:border md:border-gray-100 text-left block md:table-cell" style="text-align: left!Important;">Perspectiva</th>
                                <th class="bg-gray-400 px-6 py-2 text-xs text-white font-bold md:border md:border-gray-100 text-left block md:table-cell" style="text-align: left!Important;">Ação</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-300 block md:table-row-group">

                            @foreach ($this->objetivoEstragico as $result)

                            <tr class="border border-gray-500 md:border-none block md:table-row">
                                <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell px-5 py-3 text-sm text-gray-600">
                                    {{ $result->num_nivel_hierarquico_apresentacao }}. {{ $result->dsc_objetivo_estrategico }}
                                </td>
                                <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell px-5 py-3 text-sm text-gray-600">
                                    {{ $result->perspectiva->num_nivel_hierarquico_apresentacao }}. {!! $result->perspectiva->dsc_perspectiva !!}
                                </td>
                                <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell px-5 py-3 text-sm text-gray-600">
                                    <a href="javascript: void(0);" wire:click.prevent="editForm('{!! $result->cod_objetivo_estrategico !!}')" onclick="javascript: document.documentElement.scrollTop = 0;"><i class="fas fa-edit text-green-600"></i></a>

                                    &nbsp;
                                    &nbsp;
                                    <button type="button" wire:click.prevent="deleteForm('{!! $result->cod_objetivo_estrategico !!}')"><i class="fas fa-trash-alt text-red-600"></i></button>

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
                <x-jet-danger-button wire:click.prevent="$toggle('showModalDelete')" wire:loading.attr="disabled" wire:click.prevent="delete('{!! $this->cod_objetivo_estrategico !!}')">
                    Sim, quero excluir
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>

    </div>
