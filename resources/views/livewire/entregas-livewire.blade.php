<x-slot name="header">
    <h2 class="break-words font-semibold text-xl text-blue-800 leading-tight pl-3">
        Administração das Entregas das Iniciativas, Ações ou Projetos do Plano de Ação
    </h2>
</x-slot>
<div class="" style="margin-top: 6px!Important; padding-top: 6px!Important;">

    <form wire:submit.prevent="create" method="post">

        <div class="w-full px-2 sm:px-4 lg:px-3">

            <div class="flex flex-wrap w-full">

                <div class="w-full md:w-1/1 pr-3 mb-1 text-right">
                    <span class="text-gray-600 pr-1 text-sm">Incluir</span>
                    <div class="rounded-full h-6 w-6 flex items-center justify-center inline-flex items-center bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300 disabled:opacity-25 transition "
                        style="cursor: pointer;" wire:click.prevent="abrirFecharForm()"><i id="iconAbrirFecharForm"
                            class="<?php print $iconAbrirFechar; ?>"></i></div>
                </div>

            </div>

            <div id="divForm"
                class="flex items-center px-4 py-6 bg-white rounded-md bg-gray-50 bg-opacity-25 shadow-md"
                style="display: <?php print $this->abrirFecharForm; ?>;">

                <div class="flex flex-wrap w-full">

                    <div class="w-full md:w-1/1 mb-2">

                        <p><strong>Formulário de cadastro e edição</strong></p>

                    </div>

                    <div class="w-full md:w-2/3 px-3 mb-1 md:mb-1 pt-3">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-labelpreenchimentoobrigatoriio for="cod_pei"
                                value="1. Planejamento Estratégico Integrado - PEI" />
                            {!! Form::select('cod_pei', $this->pei, null, [
                                'class' =>
                                    'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-0',
                                'style' => 'height: 40px!Important; padding-left: 10px!Important; width: 100% !Important;',
                                'placeholder' => 'Selecione',
                                'autocomplete' => 'off',
                                'required' => 'required',
                                'wire:model' => 'cod_pei',
                            ]) !!}
                            <div class="p-2 text-gray-500 text-xs md:list-disc"></div>
                            <x-jet-input-error for="cod_pei" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-1/3 px-3 mb-1 md:mb-1 pt-3" style="display: {!! $this->habilitarCampoInserirMetas !!};">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-labelpreenchimentoobrigatoriio for="cod_perspectiva" value="2. Perspectiva" />
                            {!! Form::select('cod_perspectiva', $this->perspectiva, null, [
                                'class' =>
                                    'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-0',
                                'style' => 'height: 40px!Important; padding-left: 10px!Important; width: 100% !Important;',
                                'placeholder' => 'Selecione',
                                'autocomplete' => 'off',
                                'required' => 'required',
                                'wire:model' => 'cod_perspectiva',
                            ]) !!}
                            <div class="p-2 text-gray-500 text-xs md:list-disc">Os elementos desse campo só serão
                                visíveis após a escolha do <strong>PEI</strong>.
                                <?php
                                if(isset($this->cod_pei) && !is_null($this->cod_pei) && $this->cod_pei != '' && $this->perspectiva->count() >= 0) {

                                    ?>
                                <span class="text-green-600">Existe(m) <strong>{!! $this->perspectiva->count() !!}</strong>
                                    elemento(s).</span>
                                <?php

                                }
                                ?>
                            </div>
                            <x-jet-input-error for="cod_perspectiva" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-3/3 px-3 mb-2 md:mb-1 pt-3" style="display: {!! $this->habilitarCampoInserirMetas !!};">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-labelpreenchimentoobrigatoriio for="cod_objetivo_estrategico"
                                value="3. Objetivo Estratégico" />
                            {!! Form::select('cod_objetivo_estrategico', $this->objetivoEstragico, null, [
                                'class' =>
                                    'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-0',
                                'style' => 'height: 40px!Important; padding-left: 10px!Important; width: 100% !Important;',
                                'placeholder' => 'Selecione',
                                'autocomplete' => 'off',
                                'required' => 'required',
                                'wire:model' => 'cod_objetivo_estrategico',
                            ]) !!}
                            <div class="p-2 text-gray-500 text-xs md:list-disc">Os elementos desse campo só serão
                                visíveis após a escolha da <strong>Perspectiva</strong>.
                                <?php
                                if(isset($this->cod_perspectiva) && !is_null($this->cod_perspectiva) && $this->cod_perspectiva != '' && $this->perspectiva->count() >= 0) {

                                    ?>
                                <span class="text-green-600">Existe(m) <strong>{!! $this->objetivoEstragico->count() !!}</strong>
                                    elemento(s).</span>
                                <?php

                                }
                                ?>
                            </div>
                            <x-jet-input-error for="cod_objetivo_estrategico" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-3/3 px-3 mb-2 md:mb-1 pt-3" style="display: {!! $this->habilitarCampoInserirMetas !!};">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-labelpreenchimentoobrigatoriio for="cod_plano_de_acao"
                                value="4. Selecionar Iniciativa/Ação/Projeto" />
                            {!! Form::select('cod_plano_de_acao', $this->planoAcao, null, [
                                'class' =>
                                    'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-0',
                                'style' => 'height: 40px!Important; padding-left: 10px!Important; width: 100% !Important;',
                                'placeholder' => 'Selecione a iniciativa, ação ou projeto correspondente...',
                                'autocomplete' => 'off',
                                'required' => 'required',
                                'wire:model' => 'cod_plano_de_acao',
                            ]) !!}
                            <div class="p-2 text-gray-500 text-xs md:list-disc">Os elementos desse campo só serão
                                visíveis após a escolha do <strong>Objetivo Estratégico</strong>.
                                <?php
                                if(isset($this->objetivoEstragico) && !empty($this->objetivoEstragico) && $this->objetivoEstragico->count() >= 0 && $this->planoAcao) {

                                    ?>
                                <span class="text-green-600">Existe(m) <strong>{!! $this->planoAcao->count() !!}</strong>
                                    elemento(s).</span>
                                <?php

                                }
                                ?>
                            </div>
                            <x-jet-input-error for="cod_plano_de_acao" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-1/4 px-3 mb-1 md:mb-0 pt-3">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="num_nivel_hierarquico_apresentacao" value="5. Ordem" />
                            {!! Form::select('num_nivel_hierarquico_apresentacao', $this->niveis_hierarquico_apresentacao, null, [
                                'class' =>
                                    'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-0',
                                'style' => 'height: 40px!Important; padding-left: 10px!Important; width: 100% !Important;',
                                'placeholder' => 'Selecione',
                                'autocomplete' => 'off',
                                'required' => 'required',
                                'wire:model' => 'num_nivel_hierarquico_apresentacao',
                            ]) !!}
                            <div class="p-2 text-gray-500 text-xs md:list-disc">Este campo será preenchido
                                automaticamente após a escolha do Plano de Ação, mas pode ser alterado se
                                necessário.</div>
                            <x-jet-input-error for="num_nivel_hierarquico_apresentacao" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-3/4 px-3 mb-2 md:mb-1 pt-3" style="display: {!! $this->habilitarCampoInserirMetas !!};">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-labelpreenchimentoobrigatoriio for="dsc_entrega"
                                value="6. Detalhamento da Entrega" />
                            {!! Form::textarea('dsc_entrega', null, [
                                'class' =>
                                    'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-2 pl-2',
                                'id' => 'dsc_entrega',
                                'placeholder' =>
                                    'Descreva detalhadamente o que será entregue, incluindo especificações e características técnicas..',
                                'rows' => 2,
                                'required' => 'required',
                                'style' => 'width: 100%',
                                'wire:model' => 'dsc_entrega',
                            ]) !!}
                            <x-jet-input-error for="dsc_entrega" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-2/4 px-3 mb-2 md:mb-1 pt-3" style="display: {!! $this->habilitarCampoInserirMetas !!};">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-labelpreenchimentoobrigatoriio for="bln_status" value="7. Status de Execução" />
                            {!! Form::select('bln_status', $this->status, null, [
                                'class' =>
                                    'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-0',
                                'style' => 'height: 40px !important; padding-left: 10px !important; width: 100% !important;',
                                'autocomplete' => 'off',
                                'required' => 'required',
                                'wire:model' => 'bln_status',
                            ]) !!}
                            <x-jet-input-error for="bln_status" class="mt-2" />
                        </div>

                    </div>

                    <script type='text/javascript'>
                        function adequarMascara(unidadeMedida = '') {

                            if (unidadeMedida == 'Quantidade') {

                                $('#num_quantidade_prevista').mask('000.000.000.000.000', {
                                    reverse: true,
                                    selectOnFocus: true
                                });

                            } else if (unidadeMedida == 'Porcentagem') {

                                $('#num_quantidade_prevista').mask('000,00', {
                                    reverse: true,
                                    selectOnFocus: true
                                });

                            } else if (unidadeMedida == 'Dinheiro') {

                                $('#num_quantidade_prevista').mask('000.000.000.000.000,00', {
                                    reverse: true,
                                    selectOnFocus: true
                                });

                            }

                        }
                    </script>

                    <div class="w-full md:w-2/4 px-3 mb-2 md:mb-1 pt-3" style="display: {!! $this->habilitarCampoInserirMetas !!};">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-labelpreenchimentoobrigatoriio for="dsc_periodo_medicao"
                                value="8. Período de medição" />
                            {!! Form::select(
                                'dsc_periodo_medicao',
                                [
                                    'Mensal' => 'Mensal',
                                    'Bimestral' => 'Bimestral',
                                    'Trimestral' => 'Trimestral',
                                    'Semestral' => 'Semestral',
                                    'Anual' => 'Anual',
                                ],
                                null,
                                [
                                    'class' =>
                                        'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-0',
                                    'id' => 'dsc_periodo_medicao',
                                    'style' => 'height: 40px!Important; padding-left: 10px!Important; width: 100% !Important;',
                                    'placeholder' => 'Selecione',
                                    'autocomplete' => 'off',
                                    'required' => 'required',
                                    'wire:model' => 'dsc_periodo_medicao',
                                ],
                            ) !!}
                            <div class="p-2 text-gray-500 text-xs md:list-disc">



                            </div>

                            <x-jet-input-error for="dsc_periodo_medicao" class="mt-2" />

                        </div>

                    </div>

                    <div class="w-full md:w-1/1 px-3 mt-6 mb-3 md:mb-1 pt-1 text-right">

                        @if ($this->editarForm == true)
                            <a class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring focus:ring-red-300 disabled:opacity-25 transition"
                                href="javascript: void(0);" wire:click.prevent="cancelar()">Cancelar</a>

                            <button
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
                                type="submit">Editar</button>
                        @else
                            <button
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
                                type="submit">Salvar</button>
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
                                style="text-align: left!Important;">Ação</th>
                            <th class="bg-gray-400 px-1 py-2 text-xs text-white font-bold md:border md:border-gray-100 text-left block md:table-cell"
                                style="text-align: left!Important;">Plano de Ação Vinculado</th>
                            <th class="bg-gray-400 px-1 py-2 text-xs text-white font-bold md:border md:border-gray-100 text-left block md:table-cell"
                                style="text-align: left!Important;">Detalhamento da Entrega</th>
                            <th class="bg-gray-400 px-1 py-2 text-xs text-white font-bold md:border md:border-gray-100 text-left block md:table-cell"
                                style="text-align: left!Important;">Status de Execução</th>
                            <th class="bg-gray-400 px-1 py-2 text-xs text-white font-bold md:border md:border-gray-100 text-left block md:table-cell"
                                style="text-align: left!Important;">Período de medição</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-300 block md:table-row-group">

                        @foreach ($this->tabEntregas as $result)
                            <tr class="border border-gray-500 md:border-none block md:table-row">
                                <td
                                    class="p-2 md:border md:border-gray-100 text-left block md:table-cell py-3 text-sm text-gray-600 w-36 ">

                                    @if ($result->acoesRealizadas->count() > 0)
                                        <?php

                                        $corpoModalAudit = '';

                                        $corpoModalAudit .= '<p class="text-gray-500 pl-2">Em: <strong>' . $result->dsc_entrega . '</strong></p><br><table class="divide-gray-300 min-w-full border-collapse" style="font-size: 0.8rem!Important;"><thead><tr class=""><td class="px-2 py-2 border border-gray-200">#</td><td class="px-2 py-2 border border-gray-200">Ação</td><td class="px-2 py-2 border border-gray-200">Quem?</td><td class="px-2 py-2 border border-gray-200">Quando?</td></tr></thead><tbody>';

                                        $contAcao = 1;

                                        foreach ($result->acoesRealizadas as $resultadoAcao) {
                                            $corpoModalAudit .= '<tr><td class="px-2 py-2 border border-gray-200">' . $contAcao . '</td><td class="px-2 py-2 border border-gray-200">' . $resultadoAcao->acao . '</td><td class="px-2 py-2 border border-gray-200">' . $resultadoAcao->usuario->name . '</td><td class="px-2 py-2 border border-gray-200">' . formatarDataComCarbonForHumans($resultadoAcao->created_at) . ' em ' . formatarTimeStampComCarbonParaBR($resultadoAcao->created_at) . '</td></tr>';

                                            $contAcao = $contAcao + 1;
                                        }

                                        $corpoModalAudit .= '</tbody></table>';

                                        ?>

                                        <button type="button"
                                            wire:click.prevent="audit('{!! $result->cod_entrega !!}')"><i
                                                class="fas fa-eye text-gray-600"></i></button>
                                        &nbsp;
                                        &nbsp;
                                    @endif

                                    <a href="javascript: void(0);"
                                        wire:click.prevent="editForm('{!! $result->cod_entrega !!}')"
                                        onclick="javascript: document.documentElement.scrollTop = 0;"><i
                                            class="fas fa-edit text-green-600"></i></a>

                                    &nbsp;
                                    &nbsp;
                                    <button type="button"
                                        wire:click.prevent="deleteForm('{!! $result->cod_entrega !!}')"><i
                                            class="fas fa-trash-alt text-red-600"></i></button>

                                </td>

                                <td
                                    class="p-2 md:border md:border-gray-100 text-left block md:table-cell py-3 text-sm text-gray-600 bg-blue-50 ">
                                    {{ $result->planoAcao->num_nivel_hierarquico_apresentacao }}.
                                    {{ $result->planoAcao->dsc_plano_de_acao }}
                                </td>

                                <td
                                    class="p-2 md:border md:border-gray-100 text-left block md:table-cell py-3 text-sm text-gray-600 bg-blue-50 ">
                                    {{ $result->num_nivel_hierarquico_apresentacao }}. {{ $result->dsc_entrega }}
                                </td>

                                <td
                                    class="p-2 md:border md:border-gray-100 text-left block md:table-cell py-3 text-sm text-gray-600">
                                    {{ $result->bln_status }}
                                </td>
                                <td
                                    class="p-2 md:border md:border-gray-100 text-left block md:table-cell py-3 text-sm text-gray-600">
                                    {{ $result->dsc_periodo_medicao }}
                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>

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
<x-jet-important-modal wire:model="showModalImportant">
    <x-slot name="title">
        <strong>Importante</strong>
    </x-slot>

    <x-slot name="content">
        {!! $this->mensagemImportant !!}
    </x-slot>

    <x-slot name="footer">
        <x-jet-button-danger wire:click.prevent="$toggle('showModalImportant')" wire:loading.attr="disabled">
            {{ __('Closer') }}
        </x-jet-button-danger>
    </x-slot>
</x-jet-important-modal>

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
            wire:click.prevent="delete('{{ $this->cod_entrega }}')">
            Sim, quero excluir
        </x-jet-danger-button>
    </x-slot>
</x-jet-dialog-modal>

<script>
    document.addEventListener('livewire:load', () => {
        setInterval(function() {
            window.livewire.emit('alive');
        }, 1800000);
    });
</script>



</div>
