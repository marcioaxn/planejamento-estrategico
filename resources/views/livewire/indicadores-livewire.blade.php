<x-slot name="header">
    <h2 class="break-words font-semibold text-xl text-blue-800 leading-tight pl-3">
        Administração dos Indicadores de Monitoramento do Plano de Ação
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

            <div id="divForm" class="flex items-center px-4 py-6 bg-white rounded-md bg-gray-50 bg-opacity-25 shadow-md" style="display: <?php print($this->abrirFecharForm) ?>;">

                <div class="flex flex-wrap w-full">

                    <div class="w-full md:w-1/1 mb-2">

                        <p><strong>Formulário de cadastro e edição</strong></p>

                    </div>

                    <div class="w-full md:w-2/3 px-3 mb-1 md:mb-0 pt-3">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-labelpreenchimentoobrigatoriio for="cod_pei" value="Planejamento Estratégico Integrado - PEI" />
                            {!! Form::select('cod_pei', $this->pei, null, ['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-0', 'style' => 'height: 40px!Important; padding-left: 10px!Important; width: 100% !Important;', 'placeholder' => 'Selecione', 'autocomplete' => 'off', 'required' => 'required', 'wire:model' => 'cod_pei']) !!}
                            <div class="p-2 text-gray-500 text-xs md:list-disc"></div>
                            <x-jet-input-error for="cod_pei" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-1/3 px-3 mb-1 md:mb-0 pt-3">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-labelpreenchimentoobrigatoriio for="cod_perspectiva" value="Perspectiva" />
                            {!! Form::select('cod_perspectiva', $this->perspectiva, null, ['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-0', 'style' => 'height: 40px!Important; padding-left: 10px!Important; width: 100% !Important;', 'placeholder' => 'Selecione', 'autocomplete' => 'off', 'required' => 'required', 'wire:model' => 'cod_perspectiva']) !!}
                            <div class="p-2 text-gray-500 text-xs md:list-disc">Os elementos desse campo só serão visíveis após a escolha do <strong>PEI</strong>.
                                <?php
                                if(isset($this->cod_pei) && !is_null($this->cod_pei) && $this->cod_pei != '' && $this->perspectiva->count() >= 0) {

                                    ?>
                                    <span class="text-green-600">Existe(m) <strong>{!! $this->perspectiva->count() !!}</strong> elemento(s).</span>
                                    <?php

                                }
                                ?>
                            </div>
                            <x-jet-input-error for="cod_perspectiva" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-3/3 px-3 mb-1 md:mb-0 pt-0" style="display: {!! $this->habilitarCampoInserirMetas !!};">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-labelpreenchimentoobrigatoriio for="cod_objetivo_estrategico" value="Objetivo Estratégico" />
                            {!! Form::select('cod_objetivo_estrategico', $this->objetivoEstragico, null, ['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-0', 'style' => 'height: 40px!Important; padding-left: 10px!Important; width: 100% !Important;', 'placeholder' => 'Selecione', 'autocomplete' => 'off', 'required' => 'required', 'wire:model' => 'cod_objetivo_estrategico']) !!}
                            <div class="p-2 text-gray-500 text-xs md:list-disc">Os elementos desse campo só serão visíveis após a escolha da <strong>Perspectiva</strong>.
                                <?php
                                if(isset($this->cod_perspectiva) && !is_null($this->cod_perspectiva) && $this->cod_perspectiva != '' && $this->perspectiva->count() >= 0) {

                                    ?>
                                    <span class="text-green-600">Existe(m) <strong>{!! $this->objetivoEstragico->count() !!}</strong> elemento(s).</span>
                                    <?php

                                }
                                ?>
                            </div>
                            <x-jet-input-error for="cod_objetivo_estrategico" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-3/3 px-3 mb-1 md:mb-0 pt-3" style="display: {!! $this->habilitarCampoInserirMetas !!};">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-labelpreenchimentoobrigatoriio for="cod_plano_de_acao" value="Plano de Ação" />
                            {!! Form::select('cod_plano_de_acao', $this->planoAcao, null, ['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-0', 'style' => 'height: 40px!Important; padding-left: 10px!Important; width: 100% !Important;', 'placeholder' => 'Selecione', 'autocomplete' => 'off', 'required' => 'required', 'wire:model' => 'cod_plano_de_acao']) !!}
                            <div class="p-2 text-gray-500 text-xs md:list-disc">Os elementos desse campo só serão visíveis após a escolha do <strong>Objetivo Estratégico</strong>.
                                <?php
                                if(isset($this->cod_objetivo_estrategico) && !is_null($this->cod_objetivo_estrategico) && $this->cod_objetivo_estrategico != '' && $this->planoAcao->count() >= 0) {

                                    ?>
                                    <span class="text-green-600">Existe(m) <strong>{!! $this->planoAcao->count() !!}</strong> elemento(s).</span>
                                    <?php

                                }
                                ?>
                            </div>
                            <x-jet-input-error for="cod_plano_de_acao" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-3/3 px-3 mb-1 md:mb-0 pt-3" style="display: {!! $this->habilitarCampoInserirMetas !!};">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-labelpreenchimentoobrigatoriio for="dsc_indicador" value="Descrição do Indicador" />
                            {!! Form::textarea('dsc_indicador',null,['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-2 pl-2','id' => 'dsc_indicador', 'placeholder' => 'Escreva a descrição do indicador', 'rows' => 2, 'required' => 'required', 'style' => 'width: 100%', 'wire:model' => 'dsc_indicador']) !!}
                            <x-jet-input-error for="dsc_indicador" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-3/3 px-3 mb-1 md:mb-0 pt-3" style="display: {!! $this->habilitarCampoInserirMetas !!};">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-labelopcional for="dsc_formula" value="Fórmula do Indicador" />
                            {!! Form::textarea('dsc_formula',null,['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-2 pl-2','id' => 'dsc_formula', 'placeholder' => 'Escreva a fórmula do indicador', 'rows' => 2, 'style' => 'width: 100%', 'wire:model' => 'dsc_formula']) !!}
                            <x-jet-input-error for="dsc_formula" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-1/3 px-3 mb-1 md:mb-0 pt-6" style="display: {!! $this->habilitarCampoInserirMetas !!};">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-labelpreenchimentoobrigatoriio for="dsc_unidade_medida" value="Unidade de Medida do Indicador" />
                            {!! Form::select('dsc_unidade_medida', $this->unidadesMedida, null, ['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-0', 'style' => 'height: 40px!Important; padding-left: 10px!Important; width: 100% !Important;', 'id' => 'dsc_unidade_medida', 'placeholder' => 'Selecione', 'autocomplete' => 'off', 'required' => 'required', 'onchange' => "javascript: adequarMascara(this.value);", 'wire:model' => 'dsc_unidade_medida', 'wire:click.prevent' => "adequarMascara()"]) !!}
                            <x-jet-input-error for="dsc_unidade_medida" class="mt-2" />
                        </div>

                    </div>

                    <script type='text/javascript'>

                        function adequarMascara(unidadeMedida = '') {

                            inicio = @this.anoInicioDoPeiSelecionado;

                            fim = @this.anoConclusaoDoPeiSelecionado;

                            // @this.tirarReadonly = true;

                            for(ano=(inicio)*1;ano<=(fim)*1;ano++) {

                                for(i=1;i<=12;i++) {

                                    if(unidadeMedida == 'Quantidade') {

                                        if(i<=3) {

                                            $('#num_linha_base_'+i).mask('000.000.000.000.000',{reverse: true, selectOnFocus: true});

                                        }

                                        $('#metaMes_'+i+'_'+ano).mask('000.000.000.000.000',{reverse: true, selectOnFocus: true});

                                    } else if(unidadeMedida == 'Porcentagem') {

                                        if(i<=3) {

                                            $('#num_linha_base_'+i).mask('000,00',{reverse: true, selectOnFocus: true});

                                        }

                                        $('#metaMes_'+i+'_'+ano).mask('000,00',{reverse: true, selectOnFocus: true});

                                    } else if(unidadeMedida == 'Dinheiro') {

                                        if(i<=3) {

                                            $('#num_linha_base_'+i).mask('000.000.000.000.000,00',{reverse: true, selectOnFocus: true});

                                        }

                                        $('#metaMes_'+i+'_'+ano).mask('000.000.000.000.000,00',{reverse: true, selectOnFocus: true});

                                    }

                                }

                            }

                        }

                    </script>

                    <div class="w-full md:w-1/3 px-3 mb-1 md:mb-0 pt-6" style="display: {!! $this->habilitarCampoInserirMetas !!};">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-labelpreenchimentoobrigatoriio for="bln_acumulado" value="Esse indicador terá o resultado acumulado?" />
                            {!! Form::select('bln_acumulado', ['Sim' => 'Sim','Não' => 'Não'], null, ['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-0', 'id' => 'bln_acumulado', 'style' => 'height: 40px!Important; padding-left: 10px!Important; width: 100% !Important;', 'placeholder' => 'Selecione', 'autocomplete' => 'off', 'required' => 'required', 'wire:model' => 'bln_acumulado']) !!}
                            <div class="p-2 text-gray-500 text-xs md:list-disc">

                                Acumulado é considerar todos os meses do ano para o cálculo final. Não acumulado o cálculo considerará apenas o último preenchimento.

                            </div>

                            <x-jet-input-error for="bln_acumulado" class="mt-2" />

                        </div>

                    </div>

                    <div class="w-full md:w-1/3 px-3 mb-1 md:mb-0 pt-6" style="display: {!! $this->habilitarCampoInserirMetas !!};">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-labelpreenchimentoobrigatoriio for="dsc_tipo" value="Tipo de Análise do Indicador (Polaridade)" />
                            {!! Form::select('dsc_tipo', $tiposIndicadores, null, ['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-0', 'style' => 'height: 40px!Important; padding-left: 10px!Important; width: 100% !Important;', 'placeholder' => 'Selecione', 'autocomplete' => 'off', 'required' => 'required', 'wire:model' => 'dsc_tipo']) !!}
                            <x-jet-input-error for="dsc_tipo" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-1/2 px-3 mb-1 md:mb-0 pt-3" style="display: {!! $this->habilitarCampoInserirMetas !!};">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-labelpreenchimentoobrigatoriio for="dsc_fonte" value="Fonte" />
                            {!! Form::textarea('dsc_fonte',null,['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-2 pl-2','id' => 'dsc_fonte', 'placeholder' => 'Escreva a fonte desse indicador', 'rows' => 2, 'style' => 'width: 100%', 'wire:model' => 'dsc_fonte','required' => 'required']) !!}

                            <x-jet-input-error for="dsc_fonte" class="mt-2" />

                        </div>

                    </div>

                    <div class="w-full md:w-1/2 px-3 mb-1 md:mb-0 pt-3" style="display: {!! $this->habilitarCampoInserirMetas !!};">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-labelpreenchimentoobrigatoriio for="dsc_periodo_medicao" value="Período de medição" />
                            {!! Form::select('dsc_periodo_medicao', ['Mensal' => 'Mensal','Bimestral' => 'Bimestral','Trimestral' => 'Trimestral','Semestral' => 'Semestral','Anual' => 'Anual'], null, ['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-0', 'id' => 'dsc_periodo_medicao', 'style' => 'height: 40px!Important; padding-left: 10px!Important; width: 100% !Important;', 'placeholder' => 'Selecione', 'autocomplete' => 'off', 'required' => 'required', 'wire:model' => 'dsc_periodo_medicao']) !!}
                            <div class="p-2 text-gray-500 text-xs md:list-disc">



                            </div>

                            <x-jet-input-error for="dsc_periodo_medicao" class="mt-2" />

                        </div>

                    </div>

                    <div class="w-full md:w-1/1 px-3 mb-1 md:mb-0 pt-5" style="display: {!! $this->habilitarCampoInserirMetas !!};">

                        <p class="break-words text-sm subpixel-antialiased tracking-wide">
                            Na sequência estão os campos para o preenchimento da Linha de Base e da Meta prevista desse Indicador. Os campos só serão liberados para preenchimento após selecionar um dos itens do campo (Unidade de Medida do Indicador) e do campo (Esse indicador terá o resultado acumulado?). No caso da Meta anual não é necessário preencher todos os anos correspondente ao PEI, mas é necessário preencher ao menos um dos campos da Meta Anual e em seguida o(s) valor(es) da Meta Mensal.<br><br>Esse modo de preecnhimento facilita para os casos onde a Meta tenha início em um determinado ano e a conclusão em um outro. Por exemplo, uma meta de percentual de 100% dividida em quatro partes iguais da seguinte forma: 25% para novembro/2021, 25% para dezembro/2021, 25% para janeiro/2022 e 25% para fevereiro/2022. Teremos então 50% da meta apurada em 2021 e os outros 50% em 2022, totalizando 100%.
                        </p>

                    </div>

                    <div class="w-full md:w-1/1 px-3 mb-0 md:mb-0 pt-6" style="display: {!! $this->habilitarCampoInserirMetas !!};">

                        <x-jet-labelpreenchimentoobrigatoriio for="dsc_tipo" value="Linha de Base" />

                    </div>

                    <style type="text/css">
                        .ler-somente {
                            background: #eee;
                            pointer-events: none;
                            touch-action: none;
                        }
                    </style>

                    <div class="w-full md:w-1/2 px-3 mb-1 md:mb-0 pt-0" style="display: {!! $this->habilitarCampoInserirMetas !!};">

                        <div class="flex w-full rounded-md shadow-sm">

                            {!! Form::select('num_ano_base_1', $this->anosLinhaBase, null, ['class' => $this->inputAnoLinhaBaseClass, 'placeholder' => 'Ano da linha base', 'autocomplete' => 'off', 'wire:model' => 'num_ano_base_1','required' => 'required']) !!}
                            {!! Form::text('num_linha_base_1',null,['class' => $this->inputValorLinhaBaseClass,'id' => 'num_linha_base_1', 'placeholder' => 'Linha de base', 'wire:model' => 'num_linha_base_1', 'autocomplete' => 'off','required' => 'required']) !!}

                        </div>

                    </div>

                    <div class="w-full md:w-1/2 px-3 mb-1 md:mb-0 pt-0" style="display: {!! $this->habilitarCampoInserirMetas !!};">
                        &nbsp;
                    </div>

                    <?php

                    for($ano = $this->anoInicioDoPeiSelecionado;$ano<=$this->anoConclusaoDoPeiSelecionado;$ano++) {

                        ?>

                        <div class="w-full md:w-1/4 px-3 mt-3 mb-1 md:mb-0 pt-6" style="display: {!! $this->habilitarCampoInserirMetas !!};">

                            <div class="w-full col-span-6 sm:col-span-6">
                                <x-jet-label for="metaAno_" value="Meta prevista para {!! $ano !!}" />
                                {!! Form::text('metaAno_'.$ano,null,['class' => $this->inputValorClass,'id' => 'metaAno_'.$ano, 'placeholder' => 'Valor da meta anual', 'style' => 'min-width: 100%!Important; width: 100%!Important; max-width: 100%!Important;', 'wire:model' => 'metaAno_'.$ano, 'onkeyup' => "javascript: mascara(this.id)", 'autocomplete' => 'off']) !!}
                                <x-jet-input-error for="metaAno_" class="mt-2" />
                            </div>

                        </div>

                        <?php
                    }
                    ?>

                    <?php

                    $contAno = 1;

                    for($ano = $this->anoInicioDoPeiSelecionado;$ano<=$this->anoConclusaoDoPeiSelecionado;$ano++) {

                        $column_name_meta_ano = '';

                        $column_name_meta_ano = 'metaAno_'.$ano;

                        $column_name_input_class_mes = '';

                        $column_name_input_class_mes = 'inputValorMesAno'.$contAno.'Class';

                        $column_name_ano_required = '';

                        $required = '';

                        if(isset($ano) && !is_null($ano) && $ano != '') {

                            $column_name_ano_required = 'requiredMetaAno_'.$ano;

                            if($this->$column_name_ano_required != '') {

                                $this->$column_name_ano_required = $this->$column_name_ano_required;

                            } else {

                                $this->$column_name_ano_required = '';

                            }

                        } else {

                            $this->$column_name_ano_required = '';

                        }

                        ?>
                        <div class="w-full md:w-1/4 px-3 mb-2 md:mb-0 pt-3" style="display: {!! $this->habilitarCampoInserirMetas !!};">

                            <div class="w-full md:w-1/1 pt-3">

                                <?php

                                if($contAno == 1) {

                                    if(isset($this->dsc_unidade_medida) && !is_null($this->dsc_unidade_medida) && $this->dsc_unidade_medida != '' && isset($this->$column_name_meta_ano) && !is_null($this->$column_name_meta_ano) && $this->$column_name_meta_ano != '' && $this->$column_name_meta_ano > 0) {

                                        print($this->somaMetaAno1);

                                    }

                                } elseif($contAno == 2) {

                                    if(isset($this->dsc_unidade_medida) && !is_null($this->dsc_unidade_medida) && $this->dsc_unidade_medida != '' && isset($this->$column_name_meta_ano) && !is_null($this->$column_name_meta_ano) && $this->$column_name_meta_ano != '' && $this->$column_name_meta_ano > 0) {

                                        print($this->somaMetaAno2);

                                    }

                                } elseif($contAno == 3) {

                                    if(isset($this->dsc_unidade_medida) && !is_null($this->dsc_unidade_medida) && $this->dsc_unidade_medida != '' && isset($this->$column_name_meta_ano) && !is_null($this->$column_name_meta_ano) && $this->$column_name_meta_ano != '' && $this->$column_name_meta_ano > 0) {

                                        print($this->somaMetaAno3);

                                    }

                                } elseif($contAno == 4) {

                                    if(isset($this->dsc_unidade_medida) && !is_null($this->dsc_unidade_medida) && $this->dsc_unidade_medida != '' && isset($this->$column_name_meta_ano) && !is_null($this->$column_name_meta_ano) && $this->$column_name_meta_ano != '' && $this->$column_name_meta_ano > 0) {

                                        print($this->somaMetaAno4);

                                    }

                                }

                                ?>

                            </div>

                            <?php

                            if(isset($this->$column_name_input_class_mes) && !is_null($this->$column_name_input_class_mes) && $this->$column_name_input_class_mes != '') {

                                $this->$column_name_input_class_mes = $this->$column_name_input_class_mes;

                            } else {

                                $this->$column_name_input_class_mes = 'w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-0 pt-2 pl-2 h-9 text-right ler-somente';

                            }

                            for($mes=1;$mes<=12;$mes++) {

                                ?>

                                <div class="w-full md:w-1/1 mb-1 pt-3">
                                    <x-jet-label for="metaMes_{!! $mes !!}_{!! $ano !!}" value="Meta prevista para {!! mesNumeralParaExtenso($mes) !!}/{!! $ano !!}" />
                                    {!! Form::text('metaMes_'.$mes.'_'.$ano,null,['class' => $this->$column_name_input_class_mes,'id' => 'metaMes_'.$mes.'_'.$ano, 'placeholder' => 'Valor da meta mensal', 'style' => 'min-width: 100%!Important; width: 100%!Important; max-width: 100%!Important;', 'wire:model' => 'metaMes_'.$mes.'_'.$ano, 'onkeyup' => "javascript: mascara(this.id)", 'autocomplete' => 'off']) !!}
                                    <x-jet-input-error for="metaMes_{!! $mes !!}_{!! $ano !!}" class="mt-2" />
                                    <br>
                                </div>

                                <?php

                                if($mes == 6) {

                                    ?>

                                    <div class="w-full md:w-1/1 pt-3">

                                        <?php

                                        if($contAno == 1) {

                                            if(isset($this->dsc_unidade_medida) && !is_null($this->dsc_unidade_medida) && $this->dsc_unidade_medida != '' && isset($this->$column_name_meta_ano) && !is_null($this->$column_name_meta_ano) && $this->$column_name_meta_ano != '' && $this->$column_name_meta_ano > 0) {

                                                print($this->somaMetaAno1);

                                            }

                                        } elseif($contAno == 2) {

                                            if(isset($this->dsc_unidade_medida) && !is_null($this->dsc_unidade_medida) && $this->dsc_unidade_medida != '' && isset($this->$column_name_meta_ano) && !is_null($this->$column_name_meta_ano) && $this->$column_name_meta_ano != '' && $this->$column_name_meta_ano > 0) {

                                                print($this->somaMetaAno2);

                                            }

                                        } elseif($contAno == 3) {

                                            if(isset($this->dsc_unidade_medida) && !is_null($this->dsc_unidade_medida) && $this->dsc_unidade_medida != '' && isset($this->$column_name_meta_ano) && !is_null($this->$column_name_meta_ano) && $this->$column_name_meta_ano != '' && $this->$column_name_meta_ano > 0) {

                                                print($this->somaMetaAno3);

                                            }

                                        } elseif($contAno == 4) {

                                            if(isset($this->dsc_unidade_medida) && !is_null($this->dsc_unidade_medida) && $this->dsc_unidade_medida != '' && isset($this->$column_name_meta_ano) && !is_null($this->$column_name_meta_ano) && $this->$column_name_meta_ano != '' && $this->$column_name_meta_ano > 0) {

                                                print($this->somaMetaAno4);

                                            }

                                        }

                                        ?>

                                    </div>

                                    <?php

                                }

                            }
                            ?>

                        </div>
                        <?php

                        $contAno = $contAno + 1;

                    }

                    ?>

                    <script type='text/javascript'>

                        function mascara(id) {

                            var unidadeMedida = document.getElementById('dsc_unidade_medida').value;

                            if(unidadeMedida == 'Quantidade') {

                                $('#'+id).mask('000.000.000.000.000',{reverse: true, selectOnFocus: true});

                            } else if(unidadeMedida == 'Porcentagem') {

                                $('#'+id).mask('000,00',{reverse: true, selectOnFocus: true});

                            } else if(unidadeMedida == 'Dinheiro') {

                                $('#'+id).mask('000.000.000.000.000,00',{reverse: true, selectOnFocus: true});

                            }

                        }

                    </script>

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

            <div class="w-full md:w-1/1 px-3 mb-6 md:mb-0 pt-3">

                @foreach($this->indicadores as $result)

                <div class="bg-white rounded-lg overflow-hidden border-2 border-gray-200 border-opacity-50 mb-2">

                    <div class="bg-gray-900 bg-opacity-50 text-white text-lg px-1 pb-1 pl-3 pr-3"><span class="text-sm">PEI: <strong>{{ $result->dsc_pei }} ( {!! $result->num_ano_inicio_pei !!} a {!! $result->num_ano_fim_pei !!})</strong></span></div>

                </div>

                @foreach($result->perspectivas as $resultPerspectiva)

                <div class="bg-white rounded-lg overflow-hidden border-2 border-gray-200 border-opacity-50 mb-2">

                    <div class="bg-gray-500 bg-opacity-50 text-white text-lg px-1 pb-1 pl-3 pr-3"><span class="text-sm">Perspectiva: <span class="text-sm">{!! $resultPerspectiva->num_nivel_hierarquico_apresentacao !!}. </span><strong>{!! $resultPerspectiva->dsc_perspectiva !!}</strong></span></div>

                </div>

                @foreach($resultPerspectiva->objetivosEstrategicos as $resultObjetivosEstrategicos)

                <div class="bg-white rounded-lg overflow-hidden border-2 border-gray-200 border-opacity-50 mb-2">

                    <div class="bg-gray-200 bg-opacity-50 text-gray-600 text-lg px-1 pb-1 pl-3 pr-3"><span class="text-sm">OE: <span class="text-sm">{!! $resultPerspectiva->num_nivel_hierarquico_apresentacao !!}.{!! $resultObjetivosEstrategicos->num_nivel_hierarquico_apresentacao !!}. </span><strong>{!! $resultObjetivosEstrategicos->dsc_objetivo_estrategico !!}</strong></span></div>

                </div>

                @foreach($resultObjetivosEstrategicos->planosDeAcao as $resultPlanoDeAcao)

                <div class="bg-white rounded-lg overflow-hidden border-2 border-gray-200 border-opacity-50 mb-2">

                    <div class="bg-gray-100 bg-opacity-50 text-gray-900 text-lg px-1 pb-1 pl-3 pr-3"><span class="text-sm">{{ $resultPlanoDeAcao->tipoExecucao->dsc_tipo_execucao }} {!! $resultPerspectiva->num_nivel_hierarquico_apresentacao !!}.{!! $resultObjetivosEstrategicos->num_nivel_hierarquico_apresentacao !!}.{!! $resultPlanoDeAcao->num_nivel_hierarquico_apresentacao !!}. </span><strong>{!! $resultPlanoDeAcao->dsc_plano_de_acao !!}</strong></div>

                    <p class="px-3 px-2 pt-3">Indicadores</p>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-1 mb-1 px-1 pt-2 pb-2 pl-2 pr-2">

                        @foreach($resultPlanoDeAcao->indicadores as $resultIndicadores)

                        <div class="pt-2 pb-2 pl-3 pr-3 bg-white rounded-md border-2 border-gray-300 border-opacity-50 shadow ">

                            <p class="w-full text-sm text-left text-gray-600 h-20 " style="width: 100%!Important;"><strong>{!! $resultIndicadores->dsc_indicador !!}.</strong></p>

                            <div class="w-full pt-1" style="width: 100%!Important;">

                                <div class="flex mb-2 items-center justify-between" style="width: 100%!Important;">

                                    <div class="text-xs text-gray-500">&nbsp;</div>

                                    <div class="text-right">

                                        <a href="javascript: void(0);" wire:click.prevent="editForm('{!! $resultIndicadores->cod_indicador !!}')" onclick="javascript: document.documentElement.scrollTop = 0;"><i class="fas fa-edit text-green-600"></i></a>

                                        &nbsp;
                                        &nbsp;
                                        <button type="button" wire:click.prevent="deleteForm('{!! $resultIndicadores->cod_indicador !!}')"><i class="fas fa-trash-alt text-red-600"></i></button>

                                    </div>

                                </div>

                            </div>

                        </div>

                        @endforeach

                    </div>

                </div>

                @endforeach

                @endforeach

                @endforeach

                @endforeach

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
            <x-jet-danger-button wire:click.prevent="$toggle('showModalDelete')" wire:loading.attr="disabled" wire:click.prevent="delete('{!! $this->cod_indicador !!}')">
                Sim, quero excluir
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>

    <script>
        document.addEventListener('livewire:load', () => {
            setInterval(function(){ window.livewire.emit('alive'); }, 1800000);
        });
    </script>

    <?php

    if($this->editarForm && isset($this->dsc_periodo_medicao) && !is_null($this->dsc_periodo_medicao) && $this->dsc_periodo_medicao != '') {

        for($ano = $this->anoInicioDoPeiSelecionado;$ano<=$this->anoConclusaoDoPeiSelecionado;$ano++) {

            $column_name = '';

            $column_name = 'metaAno_'.$ano;

            if(isset($this->$column_name) && !is_null($this->$column_name) && $this->$column_name != '') {

                ?>
                <script type="text/javascript">

                    var unidadeMedida = '<?php print($this->dsc_unidade_medida) ?>';

                    if(unidadeMedida == 'Quantidade') {

                        $('#<?php print($column_name) ?>').mask('000.000.000.000.000',{reverse: true, selectOnFocus: true});

                    } else if(unidadeMedida == 'Porcentagem') {

                        $('#<?php print($column_name) ?>').mask('000,00',{reverse: true, selectOnFocus: true});

                    } else if(unidadeMedida == 'Dinheiro') {

                        $('#<?php print($column_name) ?>').mask('000.000.000.000.000,00',{reverse: true, selectOnFocus: true});

                    }

                </script>
                <?php

            }

            for($contMes=1;$contMes<=12;$contMes++) {

                $column_name_mes = '';

                $column_name_mes = 'metaMes_'.$contMes.'_'.$ano;

                ?>
                <script type="text/javascript">

                    var unidadeMedida = '<?php print($this->dsc_unidade_medida) ?>';

                    if(unidadeMedida == 'Quantidade') {

                        $('#<?php print($column_name_mes) ?>').mask('000.000.000.000.000',{reverse: true, selectOnFocus: true});

                    } else if(unidadeMedida == 'Porcentagem') {

                        $('#<?php print($column_name_mes) ?>').mask('000,00',{reverse: true, selectOnFocus: true});

                    } else if(unidadeMedida == 'Dinheiro') {

                        $('#<?php print($column_name_mes) ?>').mask('000.000.000.000.000,00',{reverse: true, selectOnFocus: true});

                    }

                </script>
                <?php

            }

        }

    }

    ?>

</div>
