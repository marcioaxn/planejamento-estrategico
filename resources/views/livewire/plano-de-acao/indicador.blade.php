<div class="flex flex-wrap w-full text-base md:text-sm pt-1 pb-3 pl-3 pr-3 rounded-md border-1 border-gray-100"
    style="font-size: 0.91rem!Important;">

    <div class="w-full md:w-12/12 border-b-2 border-gray-100 pt-1 pb-2 pl-1">
        Indicadores do Objetivo Estratégico:
    </div>

    @php
        // Início dos indicadores ligados ao Objetivo Estratégico
    @endphp

    <div class="w-full md:w-1/1 mb-2"
        style="background-color: #DCDCC9 !Important; font-size: 0.071rem!Important; height: 0.061rem!Important;">

        &nbsp;

    </div>

    @if ($this->indicadoresObjetivoEstrategico)

        <div class="w-full md:w-1/12 border-b-2 border-gray-100 pt-2 pb-1 pl-1">
            <?php $this->objetivoEstrategico->primeiroIndicador->count() > 1 ? print 'Indicadores (' . $this->objetivoEstrategico->primeiroIndicador->count() . ')' : print 'Indicador (' . $this->objetivoEstrategico->primeiroIndicador->count() . ')'; ?>

            <br />

            <div wire:offline>
                You are now offline.
            </div>

            <div class="mt-1 mb-1 pt-1" wire:loading>
                <p><i class='fa fa-circle-notch fa-spin text-blue-600'></i> Carregando...</p>
            </div>
        </div>

        <div class="w-full md:w-11/12 border-b-2 border-gray-100 pt-0 pb-2 pl-1">

            <div
                class="grid grid-cols-1 sm:grid-cols-4 md:grid-cols-4 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-2 mt-0">

                <?php $contIndicador = 1; ?>

                @foreach ($this->indicadoresObjetivoEstrategico as $indicador)
                    <?php
                    $contMes = 1;
                    $totalPrevisto = 0;
                    $totalRealizado = 0;
                    $temMeta = false;
                    ?>

                    @foreach ($indicador->evolucaoIndicador as $evolucaoIndicador)
                        @if ($evolucaoIndicador->num_ano == $this->ano)
                            <?php

                            if ($this->ano == date('Y')) {
                                if ($evolucaoIndicador->num_mes <= $this->mesAnterior) {
                                    if ($indicador->bln_acumulado === 'Sim') {
                                        $totalPrevisto = $totalPrevisto + $evolucaoIndicador->vlr_previsto;

                                        $totalRealizado = $totalRealizado + $evolucaoIndicador->vlr_realizado;
                                    } else {
                                        if (isset($evolucaoIndicador->vlr_previsto) && !is_null($evolucaoIndicador->vlr_previsto) && $evolucaoIndicador->vlr_previsto != '') {
                                            $totalPrevisto = $evolucaoIndicador->vlr_previsto;
                                        }

                                        if (isset($evolucaoIndicador->vlr_realizado) && !is_null($evolucaoIndicador->vlr_realizado) && $evolucaoIndicador->vlr_realizado != '' && $evolucaoIndicador->vlr_realizado > 0) {
                                            $totalRealizado = $evolucaoIndicador->vlr_realizado;
                                        }
                                    }
                                }
                            } else {
                                if ($indicador->bln_acumulado === 'Sim') {
                                    $totalPrevisto = $totalPrevisto + $evolucaoIndicador->vlr_previsto;

                                    $totalRealizado = $totalRealizado + $evolucaoIndicador->vlr_realizado;
                                } else {
                                    if (isset($evolucaoIndicador->vlr_previsto) && !is_null($evolucaoIndicador->vlr_previsto) && $evolucaoIndicador->vlr_previsto != '') {
                                        $totalPrevisto = $evolucaoIndicador->vlr_previsto;
                                    }

                                    if (isset($evolucaoIndicador->vlr_realizado) && !is_null($evolucaoIndicador->vlr_realizado) && $evolucaoIndicador->vlr_realizado != '' && $evolucaoIndicador->vlr_realizado > 0) {
                                        $totalRealizado = $evolucaoIndicador->vlr_realizado;
                                    }
                                }
                            }

                            ?>

                            <?php $contMes = $contMes + 1;
                            $totalPrevisto > 0 ? ($temMeta = true) : ($temMeta = false); ?>
                        @endif
                    @endforeach

                    <?php $resultado = $this->calcularAcumuladoIndicador($indicador->cod_indicador, $this->anoSelecionado); ?>

                    <div class="pt-2 pb-1 pl-2 text-base text-lef bg-white-500 text-{!! $resultado['grau_de_satisfacao'] !!}-<?php $resultado['grau_de_satisfacao'] != 'pink' ? print '600' : print '800'; ?> rounded-md border-2 border-gray-100 shadow cursor-pointer"
                        onclick="javascript: alterarIndicadorObjetivoEstrategico('<?php print $indicador->cod_indicador; ?>');">

                        <?php is_null($this->cod_indicador) && $contIndicador == 1 ? print '<i class="fas fa-arrow-circle-right"></i>&nbsp;' : print ' &nbsp;'; ?><?php $indicador->cod_indicador == $this->cod_indicador ? print '<i class="fas fa-arrow-circle-right"></i>&nbsp;' : print ' &nbsp;'; ?><strong>&nbsp;{!! $indicador->dsc_indicador !!}</strong>

                    </div>

                    <?php $contIndicador = $contIndicador + 1; ?>
                @endforeach

                <script>
                    function alterarIndicadorObjetivoEstrategico(cod_indicador) {

                        @this.cod_indicador_objetivo_estrategico_selecionado = cod_indicador;

                    }
                </script>

            </div>

        </div>

        <div class="w-full md:w-2/6 border-b-2 border-gray-100 pt-2 pb-2 pl-1">
            Unidade de Medida: <strong>{{ $this->objetivoEstrategico->primeiroIndicador->dsc_unidade_medida }}</strong>
        </div>

        <div class="w-full md:w-2/6 border-b-2 border-gray-100 pt-2 pb-2 pl-1">
            Indicador terá o resultado acumulado?
            <strong>{{ $this->objetivoEstrategico->primeiroIndicador->bln_acumulado }}</strong>
        </div>

        <div class="w-full md:w-2/6 border-b-2 border-gray-100 pt-2 pb-2 pl-1">
            Tipo de Análise (Polaridade):
            <strong>{{ tipoPolaridade($this->objetivoEstrategico->primeiroIndicador->dsc_tipo) }}</strong>
        </div>

        <div class="w-full md:w-2/6 border-b-2 border-gray-100 pt-2 pb-2 pl-1">
            Período de medição:
            <strong>{{ $this->objetivoEstrategico->primeiroIndicador->dsc_periodo_medicao }}</strong>
        </div>

        <div class="w-full md:w-2/6 border-b-2 border-gray-100 pt-2 pb-2 pl-1">
            Fonte: <strong>{{ $this->objetivoEstrategico->primeiroIndicador->dsc_fonte }}</strong>
        </div>

        <div class="w-full md:w-2/6 border-b-2 border-gray-100 pt-2 pb-2 pl-1">
            Fórmula do Indicador:
            <strong>{{ nl2br($this->objetivoEstrategico->primeiroIndicador->dsc_formula) }}</strong>
        </div>

        <div class="w-full md:w-2/6 border-b-2 border-gray-100 pt-2 pb-2 pl-1">

            @foreach ($this->objetivoEstrategico->primeiroIndicador->linhaBase as $linhaBase)
                Linha de base do ano de <strong>{!! $linhaBase->num_ano !!}</strong> é
                <?php $this->objetivoEstrategico->primeiroIndicador->dsc_unidade_medida === 'Dinheiro' ? print '%' : print ''; ?><strong>{!! formatarValorConformeUnidadeMedida(
                    $this->objetivoEstrategico->primeiroIndicador->dsc_unidade_medida,
                    'MYSQL',
                    'PTBR',
                    $linhaBase->num_linha_base,
                ) !!}<?php $this->objetivoEstrategico->primeiroIndicador->dsc_unidade_medida === 'Porcentagem' ? print '%' : print ''; ?></strong>
            @endforeach


        </div>

        <div class="w-full md:w-6/6 border-b-2 border-gray-100 pt-2 pb-2 pl-1">

            @if ($this->objetivoEstrategico->primeiroIndicador->dsc_tipo === '+')
                <i class="fas fa-arrow-alt-circle-up text-lg"></i> <strong>{!! tipoPolaridade($this->objetivoEstrategico->primeiroIndicador->dsc_tipo) !!}</strong>
                será para esse indicador que tem a meta prevista de
                <strong>{{ formatarValorConformeUnidadeMedida($this->objetivoEstrategico->primeiroIndicador->dsc_unidade_medida, 'MYSQL', 'PTBR', $this->metaAno) }}<?php $this->objetivoEstrategico->primeiroIndicador->dsc_unidade_medida === 'Porcentagem' ? print '%' : print ''; ?></strong>
                para o ano de {!! $this->anoSelecionado !!}.
            @endif

            @if ($this->objetivoEstrategico->primeiroIndicador->dsc_tipo === '-')
                <i class="fas fa-arrow-alt-circle-down text-lg"></i> <strong>{!! tipoPolaridade($this->objetivoEstrategico->primeiroIndicador->dsc_tipo) !!}</strong>
                será para esse indicador que tem a meta prevista de
                <strong>{{ formatarValorConformeUnidadeMedida($this->objetivoEstrategico->primeiroIndicador->dsc_unidade_medida, 'MYSQL', 'PTBR', $this->metaAno) }}<?php $this->objetivoEstrategico->primeiroIndicador->dsc_unidade_medida === 'Porcentagem' ? print '%' : print ''; ?></strong>
                para o ano de {!! $this->anoSelecionado !!}.
            @endif

            @if ($this->objetivoEstrategico->primeiroIndicador->dsc_tipo === '=')
                <i class="fas fa-equals text-lg"></i> <strong>{!! tipoPolaridade($this->objetivoEstrategico->primeiroIndicador->dsc_tipo) !!}</strong> será para esse
                indicador que tem a meta prevista de
                <strong>{{ formatarValorConformeUnidadeMedida($this->objetivoEstrategico->primeiroIndicador->dsc_unidade_medida, 'MYSQL', 'PTBR', $this->metaAno) }}<?php $this->objetivoEstrategico->primeiroIndicador->dsc_unidade_medida === 'Porcentagem' ? print '%' : print ''; ?></strong>
                para o ano de {!! $this->anoSelecionado !!}.
            @endif

        </div>

        <div class="w-full md:w-1/1 border-b-2 border-gray-100 pt-2 pb-2 pl-1">

            <script type="text/javascript">
                function abrirFecharTabs(num_tab = '') {

                    for (i = 1; i <= 3; i++) {

                        // document.getElementById('divConteudoTab'+i).style.display = 'none';

                        $("#divConteudoTab" + i).fadeOut("fast");

                        $("#btnTab" + i).removeClass(
                            "inline-block py-4 px-4 text-sm font-medium text-center text-gray-500 rounded-t-lg border-b-2 border-blue-600 active hover:text-gray-600 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300"
                        );

                        $("#btnTab" + i).addClass(
                            "inline-block py-4 px-4 text-sm font-medium text-center text-gray-500 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300"
                        );

                    }

                    $("#btnTab" + num_tab).addClass(
                        "inline-block py-4 px-4 text-sm font-medium text-center text-gray-500 rounded-t-lg border-b-2 border-blue-600 active hover:text-gray-600 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300"
                    );

                    setTimeout(function() {
                        $("#divConteudoTab" + num_tab).fadeIn("slow");
                    }, 66);

                }
            </script>

            <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                <ul class="flex flex-wrap -mb-px" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                    <li class="mr-2" role="presentation">
                        <button id="btnTab1"
                            class="inline-block py-4 px-4 text-sm font-medium text-center text-gray-500 rounded-t-lg border-b-4 border-blue-600 active hover:text-gray-600 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300"
                            onclick="javascript: abrirFecharTabs('1');">Evolução mensal - Resumo</button>
                    </li>
                    <li role="presentation">
                        <button id="btnTab3"
                            class="inline-block py-4 px-4 text-sm font-medium text-center text-gray-500 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300"
                            onclick="javascript: abrirFecharTabs('3');">Evolução mensal - Detalhamento</button>
                    </li>
                </ul>
            </div>

            <div id="divConteudoTab1" style="display: block;">

                <?php

                $totalPrevisto = 0;
                $totalRealizado = 0;

                ?>

                <div class=" flex flex-wrap -mx-3 mb-6">

                    <div class="w-full md:w-1/1 px-3 mb-6 md:mb-0 pt-3">

                        <div class="border-b border-gray-200 shadow rounded-md">

                            <div class="flex flex-col">
                                <div class="overflow-x-auto">
                                    <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                                        <div class="overflow-x-auto">
                                            <table class="min-w-full">
                                                <thead class="border-b">

                                                    <tr class="">

                                                        <th
                                                            class="text-sm text-gray-900 px-6 py-4 whitespace-nowrap text-right">
                                                            <strong>Meta</strong>
                                                        </th>

                                                        <?php $contMes = 1; ?>

                                                        @foreach ($this->objetivoEstrategico->primeiroIndicador->evolucaoIndicador as $evolucaoIndicador)
                                                            @if ($evolucaoIndicador->num_ano == $this->ano)
                                                                <th
                                                                    class="text-sm text-gray-900 px-6 py-4 whitespace-nowrap text-right">
                                                                    <strong>{!! mesNumeralParaExtensoCurto($evolucaoIndicador->num_mes) !!}</strong>
                                                                </th>

                                                                <?php $contMes = $contMes + 1; ?>
                                                            @endif
                                                        @endforeach

                                                        @if ($this->objetivoEstrategico->primeiroIndicador->bln_acumulado == 'Sim')

                                                            @if ($this->ano == date('Y'))
                                                                <th
                                                                    class="text-sm text-gray-900 px-6 py-4 whitespace-nowrap text-right">
                                                                    <strong>Acumulado até
                                                                        {!! mesNumeralParaExtensoCurto($this->mesAnterior) !!}</strong>
                                                                </th>
                                                            @else
                                                                <th
                                                                    class="text-sm text-gray-900 px-6 py-4 whitespace-nowrap text-right">
                                                                    <strong>Total</strong>
                                                                </th>
                                                            @endif

                                                        @endif

                                                    </tr>

                                                </thead>

                                                <tbody class="">

                                                    <tr class="border-b">

                                                        <td
                                                            class="text-sm text-gray-900 px-6 py-4 whitespace-nowrap text-right">
                                                            <strong>Prevista</strong>
                                                        </td>

                                                        <?php
                                                        $contMes = 1;
                                                        ?>

                                                        @foreach ($this->objetivoEstrategico->primeiroIndicador->evolucaoIndicador as $evolucaoIndicador)
                                                            @if ($evolucaoIndicador->num_ano == $this->ano)
                                                                <?php

                                                                if ($this->ano == date('Y')) {
                                                                    if ($evolucaoIndicador->num_mes <= $this->mesAnterior) {
                                                                        $totalPrevisto = $totalPrevisto + $evolucaoIndicador->vlr_previsto;

                                                                        $totalRealizado = $totalRealizado + $evolucaoIndicador->vlr_realizado;
                                                                    }
                                                                } else {
                                                                    $totalPrevisto = $totalPrevisto + $evolucaoIndicador->vlr_previsto;

                                                                    $totalRealizado = $totalRealizado + $evolucaoIndicador->vlr_realizado;
                                                                }

                                                                ?>

                                                                @if (!is_null($evolucaoIndicador->vlr_previsto))
                                                                    <td
                                                                        class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-right">
                                                                        {!! formatarValorConformeUnidadeMedida(
                                                                            $this->objetivoEstrategico->primeiroIndicador->dsc_unidade_medida,
                                                                            'MYSQL',
                                                                            'PTBR',
                                                                            $evolucaoIndicador->vlr_previsto,
                                                                        ) !!}<?php $this->objetivoEstrategico->primeiroIndicador->dsc_unidade_medida === 'Porcentagem' ? print '%' : print ''; ?>
                                                                    </td>
                                                                @else
                                                                    <td
                                                                        class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-right">
                                                                        -</td>
                                                                @endif

                                                                <?php $contMes = $contMes + 1; ?>
                                                            @endif
                                                        @endforeach

                                                        @if ($this->objetivoEstrategico->primeiroIndicador->bln_acumulado == 'Sim')
                                                            <td
                                                                class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-right">
                                                                {!! formatarValorConformeUnidadeMedida(
                                                                    $this->objetivoEstrategico->primeiroIndicador->dsc_unidade_medida,
                                                                    'MYSQL',
                                                                    'PTBR',
                                                                    $totalPrevisto,
                                                                ) !!}<?php $this->objetivoEstrategico->primeiroIndicador->dsc_unidade_medida === 'Porcentagem' ? print '%' : print ''; ?>
                                                            </td>
                                                        @endif

                                                    </tr>

                                                    <tr class="border-b">

                                                        <td
                                                            class="text-sm text-gray-900 px-6 py-4 whitespace-nowrap text-right">
                                                            <strong>Realizada</strong>
                                                        </td>

                                                        <?php $contMes = 1; ?>

                                                        @foreach ($this->objetivoEstrategico->primeiroIndicador->evolucaoIndicador as $evolucaoIndicador)
                                                            @if ($evolucaoIndicador->num_ano == $this->ano)
                                                                @if ($this->ano == date('Y'))
                                                                    @if ($evolucaoIndicador->num_mes <= $this->mesAnterior)
                                                                        <td
                                                                            class="text-sm text-gray-900 font-light whitespace-nowrap text-right">

                                                                            @if (!is_null($evolucaoIndicador->vlr_previsto) && is_null($evolucaoIndicador->bln_atualizado))
                                                                                <div
                                                                                    class="bg-pink-800 text-white rounded-md px-5 py-1">
                                                                                    &nbsp;-
                                                                                </div>
                                                                            @elseif(is_null($evolucaoIndicador->vlr_previsto) && is_null($evolucaoIndicador->bln_atualizado))
                                                                                <div
                                                                                    class="bg-gray-500 text-white rounded-md px-5 py-1">
                                                                                    &nbsp;-
                                                                                </div>
                                                                            @elseif(is_null($evolucaoIndicador->vlr_previsto) && !is_null($evolucaoIndicador->bln_atualizado))
                                                                                {!! formatarValorConformeUnidadeMedida(
                                                                                    $this->objetivoEstrategico->primeiroIndicador->dsc_unidade_medida,
                                                                                    'MYSQL',
                                                                                    'PTBR',
                                                                                    $evolucaoIndicador->vlr_realizado,
                                                                                ) !!}<?php $this->objetivoEstrategico->primeiroIndicador->dsc_unidade_medida === 'Porcentagem' ? print '%' : print ''; ?>
                                                                            @elseif(!is_null($evolucaoIndicador->vlr_previsto) && !is_null($evolucaoIndicador->bln_atualizado))
                                                                                @if (!is_null($evolucaoIndicador->vlr_realizado))
                                                                                    <?php $resultado = $this->obterResultadoComValorRealizadoEValorPrevisto($this->objetivoEstrategico->primeiroIndicador->dsc_tipo, $evolucaoIndicador->vlr_realizado, $evolucaoIndicador->vlr_previsto); ?>



                                                                                    <div
                                                                                        class="bg-{!! $resultado['grau_de_satisfacao'] !!}-500 text-{!! $resultado['color'] !!} rounded-md px-5 py-1">

                                                                                        {!! formatarValorConformeUnidadeMedida(
                                                                                            $this->objetivoEstrategico->primeiroIndicador->dsc_unidade_medida,
                                                                                            'MYSQL',
                                                                                            'PTBR',
                                                                                            $evolucaoIndicador->vlr_realizado,
                                                                                        ) !!}<?php $this->objetivoEstrategico->primeiroIndicador->dsc_unidade_medida === 'Porcentagem' ? print '%' : print ''; ?>

                                                                                    </div>
                                                                                @else
                                                                                @endif

                                                                        </td>
                                                                    @else
                                                                        <td
                                                                            class="text-sm text-gray-900 font-light whitespace-nowrap text-right">

                                                                            &nbsp;

                                                                        </td>
                                                                    @endif
                                                                @else
                                                                    <td
                                                                        class="text-sm text-gray-900 font-light whitespace-nowrap text-right">

                                                                        &nbsp;

                                                                    </td>
                                                                @endif
                                                            @else
                                                                <td
                                                                    class="text-sm text-gray-900 font-light whitespace-nowrap text-right">

                                                                    @if (!is_null($evolucaoIndicador->vlr_previsto) && is_null($evolucaoIndicador->bln_atualizado))
                                                                        <div
                                                                            class="bg-pink-800 text-white rounded-md px-5 py-1">
                                                                            &nbsp;-
                                                                        </div>
                                                                    @elseif(is_null($evolucaoIndicador->vlr_previsto) && is_null($evolucaoIndicador->bln_atualizado))
                                                                        <div
                                                                            class="bg-gray-500 text-white rounded-md px-5 py-1">
                                                                            &nbsp;-
                                                                        </div>
                                                                    @elseif(is_null($evolucaoIndicador->vlr_previsto) && !is_null($evolucaoIndicador->bln_atualizado))
                                                                        {!! formatarValorConformeUnidadeMedida(
                                                                            $this->objetivoEstrategico->primeiroIndicador->dsc_unidade_medida,
                                                                            'MYSQL',
                                                                            'PTBR',
                                                                            $evolucaoIndicador->vlr_realizado,
                                                                        ) !!}<?php $this->objetivoEstrategico->primeiroIndicador->dsc_unidade_medida === 'Porcentagem' ? print '%' : print ''; ?>
                                                                    @elseif(!is_null($evolucaoIndicador->vlr_previsto) && !is_null($evolucaoIndicador->bln_atualizado))
                                                                        @if (!is_null($evolucaoIndicador->vlr_realizado))
                                                                            <?php $resultado = $this->obterResultadoComValorRealizadoEValorPrevisto($this->objetivoEstrategico->primeiroIndicador->dsc_tipo, $evolucaoIndicador->vlr_realizado, $evolucaoIndicador->vlr_previsto); ?>



                                                                            <div
                                                                                class="bg-{!! $resultado['grau_de_satisfacao'] !!}-500 text-{!! $resultado['color'] !!} rounded-md px-5 py-1">

                                                                                {!! formatarValorConformeUnidadeMedida(
                                                                                    $this->objetivoEstrategico->primeiroIndicador->dsc_unidade_medida,
                                                                                    'MYSQL',
                                                                                    'PTBR',
                                                                                    $evolucaoIndicador->vlr_realizado,
                                                                                ) !!}<?php $this->objetivoEstrategico->primeiroIndicador->dsc_unidade_medida === 'Porcentagem' ? print '%' : print ''; ?>

                                                                            </div>
                                                                        @else
                                                                </td>
                                                            @endif
                                                        @endif
    @endif

    <?php $contMes = $contMes + 1; ?>
    @endif
    @endforeach

    @if ($this->objetivoEstrategico->primeiroIndicador->bln_acumulado == 'Sim')
        <?php $resultado = $this->obterResultadoComValorRealizadoEValorPrevisto($this->objetivoEstrategico->primeiroIndicador->dsc_tipo, $totalRealizado, $totalPrevisto);
        $this->totalRealizado = $totalRealizado; ?>

        <td class="text-sm text-gray-900 font-light whitespace-nowrap text-right">

            <div
                class="bg-{!! $resultado['grau_de_satisfacao'] !!}-<?php $resultado['grau_de_satisfacao'] != 'pink' ? print '500' : print '800'; ?> text-{!! $resultado['color'] !!} rounded-md px-5 py-1">

                {!! formatarValorConformeUnidadeMedida(
                    $this->objetivoEstrategico->primeiroIndicador->dsc_unidade_medida,
                    'MYSQL',
                    'PTBR',
                    $totalRealizado,
                ) !!}<?php $this->objetivoEstrategico->primeiroIndicador->dsc_unidade_medida === 'Porcentagem' ? print '%' : print ''; ?>

            </div>

        </td>
    @endif

    </tr>

    @auth

        @if ($this->liberarAcessoParaAtualizar)
            <tr class="border-b">

                <td class="text-sm text-gray-900 px-6 py-4 whitespace-nowrap text-right"><strong>Atualização</strong>
                </td>

                @foreach ($this->objetivoEstrategico->primeiroIndicador->evolucaoIndicador as $evolucaoIndicador)
                    @if ($evolucaoIndicador->num_ano == $this->ano)
                        @if (1 == 1)
                            @if ($evolucaoIndicador->num_mes <= $this->mesAnterior)
                                <td class="text-sm text-gray-900 px-6 py-4 font-light whitespace-nowrap text-right">

                                    <span class="cursor-pointer" title="Incluir PDF para o mês de {!! mesNumeralParaExtensoCurto($evolucaoIndicador->num_mes) !!}"
                                        wire:click.prevent="abrirModalIncluirPdf('{!! $evolucaoIndicador->cod_evolucao_indicador !!}')"><i
                                            class="fa-solid fa-file-pdf text-base text-red-600 "></i></span>
                                    &nbsp;&nbsp;
                                    <a href="javascript: void(0);" wire:click.prevent="editForm('{!! $evolucaoIndicador->cod_evolucao_indicador !!}')"
                                        title="Editar a informação do mês de {!! mesNumeralParaExtensoCurto($evolucaoIndicador->num_mes) !!}"><i
                                            class="fas fa-edit text-base text-green-600"></i></a>

                                </td>
                            @else
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-right">

                                    &nbsp;

                                </td>
                            @endif
                        @endif
                    @endif
                @endforeach

                @if ($this->objetivoEstrategico->primeiroIndicador->bln_acumulado == 'Sim')
                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-right">&nbsp;</td>
                @endif

            </tr>
        @endif

    @endauth

    </tbody>

    </table>

</div>
</div>
</div>
</div>

</div>

</div>

<div class="w-full md:w-1/1 px-3 mt-2 mb-6 md:mb-0 pt-6">

    <p>Gráfico da Evolução Mensal</p>

    <canvas id="chart-<?php print $this->cod_indicador; ?>" style="width: 100%!Important; height: 333px!Important;"></canvas>

    @if ($this->objetivoEstrategico->primeiroIndicador->bln_acumulado === 'Não')
        <script type="text/javascript">
            new Chart(document.getElementById("chart-<?php print $this->cod_indicador; ?>"), {
                type: 'bar',
                data: {
                    labels: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
                    datasets: [{
                        label: "Meta prevista",
                        backgroundColor: "#3e95cd",
                        data: [<?php print $this->dataChartMetaPrevista; ?>]
                    }, {
                        label: "Meta realizada",
                        backgroundColor: "#8e5ea2",
                        data: [<?php print $this->dataChartMetaRealizada; ?>]
                    }]
                },
                options: {
                    title: {
                        display: true,
                        text: 'Teste'
                    },
                    scales: {
                        y: {
                            suggestedMin: 0,
                            suggestedMax: <?php print $this->metaAno; ?> + 5,
                        }
                    }
                }
            });
        </script>
    @endif

    @if ($this->objetivoEstrategico->primeiroIndicador->bln_acumulado === 'Sim')
        <script type="text/javascript">
            new Chart(document.getElementById("chart-<?php print $this->cod_indicador; ?>"), {
                type: 'line',
                data: {
                    labels: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
                    datasets: [{
                        data: [<?php print $this->dataChartMetaPrevista; ?>],
                        label: "Meta Prevista",
                        backgroundColor: "#3e95cd",
                        borderColor: "#3e95cd",
                        fill: false
                    }, {
                        data: [<?php print $this->dataChartMetaRealizada; ?>],
                        label: "Meta Realizada",
                        backgroundColor: "#9A3412",
                        borderColor: "#9A3412",
                        fill: false
                    }, {
                        label: "Linha de base",
                        backgroundColor: "#696969",
                        borderColor: "#696969",
                        data: [<?php print $this->dataChartLinhaBase; ?>]
                    }]
                },
                options: {
                    title: {
                        display: true,
                        text: 'Teste'
                    },
                    scales: {
                        y: {
                            suggestedMin: 0,
                            suggestedMax: <?php print $this->linhaBase; ?> + 50,
                        }
                    }
                }
            });
        </script>
    @endif

</div>

</div>

</div>

<div id="divConteudoTab3" style="display: none;">

    <p>Evolução mensal com as avaliações qualitativas e os arquivos anexos</p>

    <div class=" flex flex-wrap -mx-3 mb-6">

        <div class="w-full md:w-1/1 px-3 mb-6 md:mb-0 pt-3">

            <div class="border-b border-gray-200 shadow rounded-md">

                <?php

                $totalPrevisto = 0;
                $totalRealizado = 0;

                ?>

                <div class="flex flex-col">
                    <div class="overflow-x-auto">
                        <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="overflow-x-auto">

                                <table class="min-w-full">
                                    <thead class="border-b">

                                        <tr class="border-b">

                                            <th class="text-sm text-gray-900 px-6 py-4 whitespace-nowrap text-right">
                                                <strong></strong>Mês
                                            </th>
                                            <th class="text-sm text-gray-900 px-6 py-4 whitespace-nowrap text-right">
                                                <strong>Meta Prevista</strong>
                                            </th>
                                            <th class="text-sm text-gray-900 px-6 py-4 whitespace-nowrap text-right">
                                                <strong>Meta Realizada</strong>
                                            </th>

                                            <th class="text-sm text-gray-900 px-6 py-4 whitespace-nowrap text-left">
                                                A<strong>valiação qualitativa</strong></th>
                                            <th class="text-sm text-gray-900 px-6 py-4 whitespace-nowrap text-left">
                                                <strong>Arquivos</strong>
                                            </th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        @foreach ($this->objetivoEstrategico->primeiroIndicador->evolucaoIndicador as $evolucaoIndicador)
                                            @if ($evolucaoIndicador->num_ano == $this->ano)
                                                <tr class="border-b">

                                                    <td
                                                        class="text-sm text-gray-900 px-6 py-4 whitespace-nowrap text-right">
                                                        <strong>{!! mesNumeralParaExtensoCurto($evolucaoIndicador->num_mes) !!}</strong>
                                                    </td>

                                                    <?php

                                                    if ($this->ano == date('Y')) {
                                                        if ($evolucaoIndicador->num_mes <= $this->mesAnterior) {
                                                            $totalPrevisto = $totalPrevisto + $evolucaoIndicador->vlr_previsto;

                                                            $totalRealizado = $totalRealizado + $evolucaoIndicador->vlr_realizado;
                                                        }
                                                    } else {
                                                        $totalPrevisto = $totalPrevisto + $evolucaoIndicador->vlr_previsto;

                                                        $totalRealizado = $totalRealizado + $evolucaoIndicador->vlr_realizado;
                                                    }

                                                    ?>

                                                    @if (!is_null($evolucaoIndicador->vlr_previsto))
                                                        <td
                                                            class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-right">
                                                            {!! formatarValorConformeUnidadeMedida(
                                                                $this->objetivoEstrategico->primeiroIndicador->dsc_unidade_medida,
                                                                'MYSQL',
                                                                'PTBR',
                                                                $evolucaoIndicador->vlr_previsto,
                                                            ) !!}<?php $this->objetivoEstrategico->primeiroIndicador->dsc_unidade_medida === 'Porcentagem' ? print '%' : print ''; ?></td>
                                                    @else
                                                        <td
                                                            class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-right">
                                                            -</td>
                                                    @endif

                                                    @if ($this->ano == date('Y'))
                                                        @if ($evolucaoIndicador->num_mes <= $this->mesAnterior)
                                                            <td
                                                                class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-right">

                                                                @if (!is_null($evolucaoIndicador->vlr_previsto) && is_null($evolucaoIndicador->bln_atualizado))
                                                                    <div
                                                                        class="bg-pink-800 text-white rounded-md px-5 py-1">
                                                                        &nbsp;-
                                                                    </div>
                                                                @elseif(is_null($evolucaoIndicador->vlr_previsto) && is_null($evolucaoIndicador->bln_atualizado))
                                                                    <div
                                                                        class="bg-gray-500 text-white rounded-md px-5 py-1">
                                                                        &nbsp;-
                                                                    </div>
                                                                @elseif(is_null($evolucaoIndicador->vlr_previsto) && !is_null($evolucaoIndicador->bln_atualizado))
                                                                    {!! formatarValorConformeUnidadeMedida(
                                                                        $this->objetivoEstrategico->primeiroIndicador->dsc_unidade_medida,
                                                                        'MYSQL',
                                                                        'PTBR',
                                                                        $evolucaoIndicador->vlr_realizado,
                                                                    ) !!}<?php $this->objetivoEstrategico->primeiroIndicador->dsc_unidade_medida === 'Porcentagem' ? print '%' : print ''; ?>
                                                                @elseif(!is_null($evolucaoIndicador->vlr_previsto) && !is_null($evolucaoIndicador->bln_atualizado))
                                                                    @if (!is_null($evolucaoIndicador->vlr_realizado))
                                                                        <?php $resultado = $this->obterResultadoComValorRealizadoEValorPrevisto($this->objetivoEstrategico->primeiroIndicador->dsc_tipo, $evolucaoIndicador->vlr_realizado, $evolucaoIndicador->vlr_previsto); ?>



                                                                        <div
                                                                            class="bg-{!! $resultado['grau_de_satisfacao'] !!}-500 text-{!! $resultado['color'] !!} rounded-md px-5 py-1">

                                                                            {!! formatarValorConformeUnidadeMedida(
                                                                                $this->objetivoEstrategico->primeiroIndicador->dsc_unidade_medida,
                                                                                'MYSQL',
                                                                                'PTBR',
                                                                                $evolucaoIndicador->vlr_realizado,
                                                                            ) !!}<?php $this->objetivoEstrategico->primeiroIndicador->dsc_unidade_medida === 'Porcentagem' ? print '%' : print ''; ?>

                                                                        </div>
                                                                    @else
                                                                    @endif

                                                            </td>
                                                        @else
                                                            <td
                                                                class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-right">

                                                                &nbsp;

                                                            </td>
                                                        @endif
                                                    @else
                                                        <td
                                                            class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-right">

                                                            &nbsp;

                                                        </td>
                                                    @endif
                                                @else
                                                    <td
                                                        class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-right">

                                                        @if (!is_null($evolucaoIndicador->vlr_previsto) && is_null($evolucaoIndicador->bln_atualizado))
                                                            <div class="bg-pink-800 text-white rounded-md px-5 py-1">
                                                                &nbsp;-
                                                            </div>
                                                        @elseif(is_null($evolucaoIndicador->vlr_previsto) && is_null($evolucaoIndicador->bln_atualizado))
                                                            <div class="bg-gray-500 text-white rounded-md px-5 py-1">
                                                                &nbsp;-
                                                            </div>
                                                        @elseif(is_null($evolucaoIndicador->vlr_previsto) && !is_null($evolucaoIndicador->bln_atualizado))
                                                            {!! formatarValorConformeUnidadeMedida(
                                                                $this->objetivoEstrategico->primeiroIndicador->dsc_unidade_medida,
                                                                'MYSQL',
                                                                'PTBR',
                                                                $evolucaoIndicador->vlr_realizado,
                                                            ) !!}<?php $this->objetivoEstrategico->primeiroIndicador->dsc_unidade_medida === 'Porcentagem' ? print '%' : print ''; ?>
                                                        @elseif(!is_null($evolucaoIndicador->vlr_previsto) && !is_null($evolucaoIndicador->bln_atualizado))
                                                            @if (!is_null($evolucaoIndicador->vlr_realizado))
                                                                <?php $resultado = $this->obterResultadoComValorRealizadoEValorPrevisto($this->objetivoEstrategico->primeiroIndicador->dsc_tipo, $evolucaoIndicador->vlr_realizado, $evolucaoIndicador->vlr_previsto); ?>



                                                                <div
                                                                    class="bg-{!! $resultado['grau_de_satisfacao'] !!}-500 text-{!! $resultado['color'] !!} rounded-md px-5 py-1">

                                                                    {!! formatarValorConformeUnidadeMedida(
                                                                        $this->objetivoEstrategico->primeiroIndicador->dsc_unidade_medida,
                                                                        'MYSQL',
                                                                        'PTBR',
                                                                        $evolucaoIndicador->vlr_realizado,
                                                                    ) !!}<?php $this->objetivoEstrategico->primeiroIndicador->dsc_unidade_medida === 'Porcentagem' ? print '%' : print ''; ?>

                                                                </div>
                                                            @else
                                                    </td>
                                            @endif
                                        @endif
                                        @endif

                                        <td class="text-sm text-gray-900 font-light px-6 py-4 break-words text-justify"
                                            style="width: 45%!Important;">

                                            {!! nl2br($evolucaoIndicador->txt_avaliacao) !!}

                                        </td>

                                        <td
                                            class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-left">

                                            @foreach ($evolucaoIndicador->arquivos as $arquivo)
                                                <a class="px-1 py-1 mt-2 mt-1 mb-2 pt-3 pb-3"
                                                    href="{!! url($this->anoSelecionado . '/evolucao-mensal-arquivo/' . $arquivo->cod_arquivo) !!}" target="_blank"><i
                                                        class="fas fa-file-pdf text-lg text-red-600"></i>
                                                    {!! $arquivo->txt_assunto !!}</a>
                                                <br />
                                            @endforeach

                                        </td>

                                        </tr>

                                        <?php $contMes = $contMes + 1; ?>
                                        @endif
                                        @endforeach

                                    </tbody>

                                </table>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>


</div>

</div>
@else
<div class="w-full md:w-1/1 text-red-700 border-b-2 border-red-300 pt-3 pb-3 pl-1">

    Não há registro de indicadores para esse plano de ação

</div>

@endif

@php
    // Fim dos indicadores ligados ao Objetivo Estratégico
@endphp