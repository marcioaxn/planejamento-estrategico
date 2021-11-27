<x-slot name="header">
    <h2 class="font-semibold text-xl text-blue-800 leading-tight">
        Administração da Missão, Visão e Valores
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

                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0 pt-1">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="cod_pei" value="A Missão, Visão e Valores serão para qual PEI?" />
                            {!! Form::select('cod_pei', $this->pei, null, ['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-0', 'style' => 'height: 40px!Important; padding-left: 10px!Important; width: 100% !Important;', 'placeholder' => 'Selecione', 'autocomplete' => 'off', 'required' => 'required', 'wire:model' => 'cod_pei']) !!}
                            <x-jet-input-error for="cod_pei" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0 pt-1">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="cod_organizacao" value="Serão utilizados em qual unidade?" />
                            {!! Form::select('cod_organizacao', $this->organization, null, ['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-0', 'style' => 'height: 40px!Important; padding-left: 10px!Important; width: 100% !Important;', 'placeholder' => 'Selecione', 'autocomplete' => 'off', 'required' => 'required', 'wire:model' => 'cod_organizacao']) !!}
                            <x-jet-input-error for="cod_organizacao" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-1/2 px-3 pt-6 mb-3 md:mb-0 pt-1">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="dsc_missao" value="Missão" />
                            {!! Form::textarea('dsc_missao',null,['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-2 pl-2','id' => 'dsc_missao', 'placeholder' => 'Escreva aqui a missão', 'rows' => 3, 'required' => 'required', 'style' => 'width: 100%', 'wire:model' => 'dsc_missao']) !!}
                            <x-jet-input-error for="dsc_missao" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-1/2 px-3 pt-6 mb-3 md:mb-0 pt-1">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="dsc_visao" value="Visão" />
                            {!! Form::textarea('dsc_missao',null,['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-2 pl-2','id' => 'dsc_visao', 'placeholder' => 'Escreva aqui a visão', 'rows' => 3, 'required' => 'required', 'style' => 'width: 100%', 'wire:model' => 'dsc_visao']) !!}
                            <x-jet-input-error for="dsc_visao" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-1/1 px-3 pt-6 mb-3 md:mb-0 pt-1">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="dsc_valores" value="Valores" />
                            {!! Form::textarea('dsc_missao',null,['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-2 pl-2','id' => 'dsc_valores', 'placeholder' => 'Escreva aqui os valores', 'rows' => 3, 'required' => 'required', 'style' => 'width: 100%', 'wire:model' => 'dsc_valores']) !!}
                            <x-jet-input-error for="dsc_valores" class="mt-2" />
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
                                <th class="bg-gray-400 px-6 py-2 text-xs text-white font-bold md:border md:border-gray-100 text-left block md:table-cell" style="text-align: left!Important;">Missão</th>
                                <th class="bg-gray-400 px-6 py-2 text-xs text-white font-bold md:border md:border-gray-100 text-left block md:table-cell" style="text-align: left!Important;">Visão</th>
                                <th class="bg-gray-400 px-6 py-2 text-xs text-white font-bold md:border md:border-gray-100 text-left block md:table-cell" style="text-align: left!Important;">Valores</th>
                                <th class="bg-gray-400 px-6 py-2 text-xs text-white font-bold md:border md:border-gray-100 text-left block md:table-cell" style="text-align: left!Important;">PEI</th>
                                <th class="bg-gray-400 px-6 py-2 text-xs text-white font-bold md:border md:border-gray-100 text-left block md:table-cell" style="text-align: left!Important;">Unidade</th>
                                <th class="bg-gray-400 px-6 py-2 text-xs text-white font-bold md:border md:border-gray-100 text-left block md:table-cell" style="text-align: left!Important;">Ação</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-300 block md:table-row-group">

                            @foreach ($this->missaoVisaoValores as $result)

                            <tr class="border border-gray-500 md:border-none block md:table-row">
                                <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell px-5 py-3 text-sm text-gray-600">
                                    {{ $result->dsc_missao }}
                                </td>
                                <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell px-5 py-3 text-sm text-gray-600">
                                    {{ $result->dsc_visao }}
                                </td>
                                <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell px-5 py-3 text-sm text-gray-600">
                                    {{ $result->dsc_valores }}
                                </td>
                                <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell px-5 py-3 text-sm text-gray-600">
                                    {{ $result->planejamentoEstrategicoIntegrado->dsc_pei }} ( {!! $result->planejamentoEstrategicoIntegrado->num_ano_inicio_pei !!} a {!! $result->planejamentoEstrategicoIntegrado->num_ano_fim_pei !!} )
                                </td>
                                <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell px-5 py-3 text-sm text-gray-600">
                                    <strong>{{ $result->unidade->sgl_organizacao }}</strong>{!! $this->hierarquiaUnidade($result->cod_organizacao) !!}
                                </td>
                                <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell px-5 py-3 text-sm text-gray-600">
                                    <a href="javascript: void(0);" wire:click.prevent="editForm('{!! $result->cod_missao_visao_valores !!}')" onclick="javascript: document.documentElement.scrollTop = 0;"><i class="fas fa-edit text-green-600"></i></a>

                                    &nbsp;
                                    &nbsp;
                                    <button type="button" wire:click.prevent="deleteForm('{!! $result->cod_missao_visao_valores !!}')"><i class="fas fa-trash-alt text-red-600"></i></button>

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
                <x-jet-danger-button wire:click.prevent="$toggle('showModalDelete')" wire:loading.attr="disabled" wire:click.prevent="delete('{!! $this->cod_missao_visao_valores !!}')">
                    Sim, quero excluir
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>

    </div>
