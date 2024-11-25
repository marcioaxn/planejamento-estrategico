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
                    
                    <div class="w-full md:w-4/4 px-3 mb-2 md:mb-1 pt-3" style="display: {!! $this->habilitarCampoInserirMetas !!};">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-labelpreenchimentoobrigatoriio for="dsc_entrega" value="5. Detalhamento da Entrega" />
                            {!! Form::textarea('dsc_entrega', null, [
                                'class' =>
                                    'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-2 pl-2',
                                'id' => 'dsc_entrega',
                                'placeholder' => 'Descreva detalhadamente o que será entregue, incluindo especificações e características técnicas..',
                                'rows' => 2,
                                'required' => 'required',
                                'style' => 'width: 100%',
                                'wire:model' => 'dsc_entrega',
                            ]) !!}
                            <x-jet-input-error for="dsc_entrega" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-1/4 px-3 mb-2 md:mb-1 pt-3" style="display: {!! $this->habilitarCampoInserirMetas !!};">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-labelpreenchimentoobrigatoriio for="dsc_unidade_medida" value="6. Unidade de Medida" />
                            {!! Form::select('dsc_unidade_medida', $this->unidadesMedida, null, [
                                'class' =>
                                    'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-0',
                                'style' => 'height: 40px!Important; padding-left: 10px!Important; width: 100% !Important;',
                                'id' => 'dsc_unidade_medida',
                                'placeholder' => 'Selecione',
                                'autocomplete' => 'off',
                                'required' => 'required',
                                'onchange' => 'javascript: adequarMascara(this.value);',
                                'wire:model' => 'dsc_unidade_medida',
                                'wire:click.prevent' => 'adequarMascara()',
                            ]) !!}
                            <div class="p-2 text-gray-500 text-xs md:list-disc">
                                Relativo ao Item que será Entregue
                            </div>
                            <x-jet-input-error for="dsc_unidade_medida" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-3/4 px-3 mb-2 md:mb-1 pt-3" style="display: {!! $this->habilitarCampoInserirMetas !!};">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-labelpreenchimentoobrigatoriio for="dsc_item_entregue" value="7. Item Entregue" />
                            {!! Form::text('dsc_item_entregue', null, [
                                'class' =>
                                    'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-2 pl-2',
                                'id' => 'dsc_item_entregue',
                                'placeholder' => 'Ex.: Estações de trabalho de alto desempenho, Relatórios técnicos, Treinamentos realizados...',
                                'required' => 'required',
                                'style' => 'width: 100%',
                                'wire:model' => 'dsc_item_entregue',
                            ]) !!}
                            <div class="p-2 text-gray-500 text-xs md:list-disc">
                                É o produto resultante da entrega
                            </div>
                            <x-jet-input-error for="dsc_item_entregue" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-1/4 px-3 mb-2 md:mb-1 pt-3" style="display: {!! $this->habilitarCampoInserirMetas !!};">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-labelpreenchimentoobrigatoriio for="num_quantidade_prevista" value="8. Quantidade Prevista" />
                            {!! Form::text('num_quantidade_prevista', null, [
                                'class' =>
                                    'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm text-right mt-1 pt-2 pl-2',
                                'id' => 'num_quantidade_prevista',
                                'placeholder' => 'digite o valor da meta da Entrega',
                                'required' => 'required',
                                'style' => 'width: 100%',
                                'wire:model' => 'num_quantidade_prevista',
                            ]) !!}
                            <x-jet-input-error for="num_quantidade_prevista" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-1/4 px-3 mb-2 md:mb-1 pt-3" style="display: {!! $this->habilitarCampoInserirMetas !!};">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-labelpreenchimentoobrigatoriio for="bln_status" value="9. Status de Execução" />
                            {!! Form::select(
                                'bln_status', 
                                $this->status, 
                                null,
                                [
                                    'class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-0', 
                                    'style' => 'height: 40px !important; padding-left: 10px !important; width: 100% !important;', 
                                    'autocomplete' => 'off', 
                                    'required' => 'required', 
                                    'wire:model' => 'bln_status'
                                ]
                            ) !!}
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

                    <div class="w-full md:w-1/2 px-3 mb-2 md:mb-1 pt-3" style="display: {!! $this->habilitarCampoInserirMetas !!};">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-labelpreenchimentoobrigatoriio for="dsc_periodo_medicao"
                                value="10. Período de medição" />
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

        <div class="w-full md:w-1/1 px-3 mb-6 md:mb-1 pt-3">

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
            wire:click.prevent="delete('{!! $this->cod_entrega !!}')">
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

<?php

    if($this->editarForm && isset($this->dsc_periodo_medicao) && !is_null($this->dsc_periodo_medicao) && $this->dsc_periodo_medicao != '') {

        for($ano = $anoInicioDoPeiSelecionadoProvisorio;$ano<=$anoConclusaoDoPlanoDeAcaoSelecionadoProvisorio;$ano++) {

            $column_name = '';

            $column_name = 'metaAno_'.$ano;

            if(isset($this->$column_name) && !is_null($this->$column_name) && $this->$column_name != '') {

                ?>
<script type="text/javascript">
    var unidadeMedida = '<?php print $this->dsc_unidade_medida; ?>';

    if (unidadeMedida == 'Quantidade') {

        $('#<?php print $column_name; ?>').mask('000.000.000.000.000', {
            reverse: true,
            selectOnFocus: true
        });

    } else if (unidadeMedida == 'Porcentagem') {

        $('#<?php print $column_name; ?>').mask('000,00', {
            reverse: true,
            selectOnFocus: true
        });

    } else if (unidadeMedida == 'Dinheiro') {

        $('#<?php print $column_name; ?>').mask('000.000.000.000.000,00', {
            reverse: true,
            selectOnFocus: true
        });

    }
</script>
<?php

            }

            for($contMes=1;$contMes<=12;$contMes++) {

                $column_name_mes = '';

                $column_name_mes = 'metaMes_'.$contMes.'_'.$ano;

                ?>
<script type="text/javascript">
    var unidadeMedida = '<?php print $this->dsc_unidade_medida; ?>';

    if (unidadeMedida == 'Quantidade') {

        $('#<?php print $column_name_mes; ?>').mask('000.000.000.000.000', {
            reverse: true,
            selectOnFocus: true
        });

    } else if (unidadeMedida == 'Porcentagem') {

        $('#<?php print $column_name_mes; ?>').mask('000,00', {
            reverse: true,
            selectOnFocus: true
        });

    } else if (unidadeMedida == 'Dinheiro') {

        $('#<?php print $column_name_mes; ?>').mask('000.000.000.000.000,00', {
            reverse: true,
            selectOnFocus: true
        });

    }
</script>
<?php

            }

        }

    }

    ?>

</div>
