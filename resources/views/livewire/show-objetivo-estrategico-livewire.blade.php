<div class="pt-3 pb-3 pl-1 pr-1">

    <div class="flex flex-wrap w-full text-base md:text-sm pt-3 pb-3 pl-3 pr-3 rounded-md border-1 border-gray-100">

        <div class="w-full md:w-1/6 border-b-2 border-gray-300 pt-1 pb-2 pl-1">
            Perspectiva: <strong>{!! $this->perspectiva->num_nivel_hierarquico_apresentacao !!}. {!! $this->perspectiva->dsc_perspectiva !!}</strong>
        </div>

        <div class="w-full md:w-1/6 text-right border-b-2 border-gray-300 pt-1 pb-1 pl-1">
            Objetivo Estratégico:
        </div>

        <div class="w-full md:w-4/6 border-b-2 border-gray-300 pl-1">
            {!! Form::select('cod_objetivo_estrategico', $this->objetivoEstragico, null, ['class' => 'w-full pl-1 border-0 border-white border-opacity-25 font-semibold text-sm sm:text-base focus:border-indigo-300 focus:ring focus:ring-gray-50 focus:ring-opacity-50 rounded-md shadow-sm text-left cursor-pointer', 'placeholder' => 'Selecione', 'autocomplete' => 'off', 'required' => 'required', 'wire:model' => 'cod_objetivo_estrategico','onchange' => "javascript: alterarUrl(this.value);"]) !!}
        </div>

        <script>

            function alterarUrl(cod_objetivo_estrategico) {

                var url_antiga = window.location.pathname;

                var cod_objetivo_estrategico_antigo = @this.cod_objetivo_estrategico;

                var nova_url = url_antiga.replace(cod_objetivo_estrategico_antigo,cod_objetivo_estrategico);

                window.history.pushState('urlAtualizada', 'Title', nova_url);


            }

        </script>

        @if($this->planosAcao->count() > 0)

        <div class="w-full md:w-1/6 border-b-2 border-gray-300 pt-3 pb-1 pl-1">Plano de Ação:</div>

        <div class="w-full md:w-5/6 border-b-2 border-gray-300 pt-2 pb-2 pl-1">

            <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-4 lg:grid-cols-2 xl:grid-cols-12 2xl:grid-cols-12 gap-2 mt-0">

                <?php $contPlanoAcao = 1; $somaPercentual = 0; ?>

                @foreach($this->planosAcao as $resultPlanoAcao)

                <?php $contIndicador = 0; ?>

                @foreach($resultPlanoAcao->indicadores as $indicador)

                <?php
                $totalPrevisto = 0;
                $totalRealizado = 0;
                $calculo = 0;

                $contIndicador = $contIndicador + 1;
                
                ?>

                @foreach($indicador->evolucaoIndicador as $evolucaoIndicador)

                @if($evolucaoIndicador->num_ano == $this->ano)

                <?php

                if($this->ano == date('Y')) {

                    if($evolucaoIndicador->num_mes <= $this->mesAnterior) {

                        $totalPrevisto = $totalPrevisto + $evolucaoIndicador->vlr_previsto;

                        $totalRealizado = $totalRealizado + $evolucaoIndicador->vlr_realizado;

                    }

                } else {

                    $totalPrevisto = $totalPrevisto + $evolucaoIndicador->vlr_previsto;

                    $totalRealizado = $totalRealizado + $evolucaoIndicador->vlr_realizado;

                }

                ?>

                @endif

                @php
                $totalPrevisto > 0 ? $temMeta = true : $temMeta = false;
                @endphp

                @endforeach

                <?php

                if($totalPrevisto > 0) {

                    if($indicador->dsc_tipo == '+') {

                        $calculo = ($totalRealizado/$totalPrevisto)*100;

                    }

                    if($indicador->dsc_tipo == '-') {

                        $calculo = ((1-($totalRealizado-$totalPrevisto)/$totalPrevisto)*100)-100;

                    }

                    $somaPercentual = $somaPercentual + $calculo;

                }

                ?>

                @endforeach

                <?php

                $calculoGeralPlanoAno = 0;

                if($contIndicador > 0) {

                    $calculoGeralPlanoAno = $somaPercentual/$contIndicador;

                }

                $resultado = $this->getGrauSatisfacao($calculoGeralPlanoAno);

                if($resultPlanoAcao->indicadores->count() > 0) {

                    ?>
                    <div class="text-base text-center bg-{!! $resultado['grau_de_satisfacao'] !!}-500 text-white rounded-md border-2 border-{!! $resultado['grau_de_satisfacao'] !!}-50 border-opacity-25 shadow-md cursor-pointer" onclick="javascript: alterarPlanoAcao('<?php print($resultPlanoAcao->cod_plano_de_acao) ?>');">
                        <?php is_null($this->cod_plano_de_acao) && $contPlanoAcao == 1 ? print('<i class="fas fa-arrow-circle-right"></i> ') : print(''); ?><?php $resultPlanoAcao->cod_plano_de_acao == $this->cod_plano_de_acao ? print('<i class="fas fa-arrow-circle-right"></i> ') : print(''); ?>{!! $this->perspectiva->num_nivel_hierarquico_apresentacao !!}.{!! $this->objetivoEstrategico->num_nivel_hierarquico_apresentacao !!}.{!! $resultPlanoAcao->num_nivel_hierarquico_apresentacao !!}
                    </div>
                    <?php

                } else {

                    ?>
                    <div class="text-base text-center bg-gray-500 text-white rounded-md border-2 border-gray-50 border-opacity-25 shadow-md cursor-pointer" onclick="javascript: alterarPlanoAcao('<?php print($resultPlanoAcao->cod_plano_de_acao) ?>');">
                        <?php is_null($this->cod_plano_de_acao) && $contPlanoAcao == 1 ? print('<i class="fas fa-arrow-circle-right"></i> ') : print(''); ?><?php $resultPlanoAcao->cod_plano_de_acao == $this->cod_plano_de_acao ? print('<i class="fas fa-arrow-circle-right"></i> ') : print(''); ?>{!! $this->perspectiva->num_nivel_hierarquico_apresentacao !!}.{!! $this->objetivoEstrategico->num_nivel_hierarquico_apresentacao !!}.{!! $resultPlanoAcao->num_nivel_hierarquico_apresentacao !!}
                    </div>
                    <?php

                }

                $contPlanoAcao = $contPlanoAcao + 1;

                ?>

                @endforeach

            </div>

            <script>

                function alterarPlanoAcao(cod_plano_de_acao) {

                    @this.cod_plano_de_acao = cod_plano_de_acao;

                }
            </script>

        </div>

        <div class="w-full md:w-3/6 border-b-2 border-gray-300 pt-2 pb-2 pl-1">
            {!! $planoAcao->tipoExecucao->dsc_tipo_execucao !!}: <strong>{!! $this->perspectiva->num_nivel_hierarquico_apresentacao !!}.{!! $this->objetivoEstrategico->num_nivel_hierarquico_apresentacao !!}.{!! $planoAcao->num_nivel_hierarquico_apresentacao !!}. {!! $planoAcao->dsc_plano_de_acao !!}</strong>
        </div>

        <div class="w-full md:w-3/6 border-b-2 border-gray-300 pt-2 pb-2 pl-1">
            Principais entregas: <strong>{{ $planoAcao->txt_principais_entregas }}</strong>
        </div>

        <div class="w-full md:w-3/6 border-b-2 border-gray-300 pt-2 pb-2 pl-1">Data de início em <strong>{{ converterData('EN','PTBR',$planoAcao->dte_inicio) }}</strong><span class="text-gray-400">, {{ formatarDataComCarbonForHumans($planoAcao->dte_inicio) }},</span> e a conclusão prevista para <strong>{{ converterData('EN','PTBR',$planoAcao->dte_fim) }}</strong>
        </div>

        <div class="w-full md:w-1/6 border-b-2 border-gray-300 pt-2 pb-2 pl-1">
            Status: <strong>{{ $planoAcao->bln_status }}</strong>
        </div>

        <div class="w-full md:w-2/6 border-b-2 border-gray-300 pt-2 pb-2 pl-1">
            Orçamento previsto: R$ <strong>{{ converteValor('MYSQL','PTBR',$planoAcao->vlr_orcamento_previsto) }}</strong>
        </div>

        <div class="w-full md:w-2/6 border-b-2 border-gray-300 pt-2 pb-2 pl-1">
            Unidade responsável: <strong>{{ $planoAcao->unidade->sgl_organizacao }}</strong><span class="text-gray-400">{!! $this->hierarquiaUnidade($planoAcao->unidade->cod_organizacao) !!}</span>
        </div>

        <div class="w-full md:w-2/6 border-b-2 border-gray-300 pt-2 pb-2 pl-1">
            Servidor(a) Responsável: 
            <strong>
                @foreach($planoAcao->servidorResponsavel as $responsavel)

                {!! $responsavel->name !!}

                @auth

                <?php

                if(Auth::user()->id === $responsavel->id) {

                    $this->liberarAcessoParaAtualizar = true;

                }

                ?>

                @endauth

                @endforeach
            </strong>
        </div>

        <div class="w-full md:w-2/6 border-b-2 border-gray-300 pt-2 pb-2 pl-1">
            Servidor(a) Substituto(a): 
            <strong>
                @foreach($planoAcao->servidorSubstituto as $subtituto)

                {!! $subtituto->name !!}

                @auth

                <?php

                if(Auth::user()->id === $subtituto->id) {

                    $this->liberarAcessoParaAtualizar = true;

                }

                ?>

                @endauth

                @endforeach
            </strong>
        </div>

        <div class="w-full md:w-1/1">

            &nbsp;

        </div>

        @if($this->indicador)

        <div class="w-full md:w-1/6 border-b-2 border-gray-300 pt-3 pb-1 pl-1"><?php $planoAcao->indicadores->count() > 1 ? print('Indicadores') : print('Indicador'); ?>: </div>

        <div class="w-full md:w-5/6 border-b-2 border-gray-300 pt-2 pb-2 pl-1">

            <div class="grid grid-cols-1 sm:grid-cols-4 md:grid-cols-4 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-3 gap-2 mt-0">

                <?php $contIndicador = 1; ?>

                @foreach($planoAcao->indicadores as $indicador)

                <?php
                $contMes = 1;
                $totalPrevisto = 0;
                $totalRealizado = 0;
                $temMeta = false;
                ?>

                @foreach($indicador->evolucaoIndicador as $evolucaoIndicador)

                @if($evolucaoIndicador->num_ano == $this->ano)

                <?php

                if($this->ano == date('Y')) {

                    if($evolucaoIndicador->num_mes <= $this->mesAnterior) {

                        $totalPrevisto = $totalPrevisto + $evolucaoIndicador->vlr_previsto;

                        $totalRealizado = $totalRealizado + $evolucaoIndicador->vlr_realizado;

                    }

                } else {

                    $totalPrevisto = $totalPrevisto + $evolucaoIndicador->vlr_previsto;

                    $totalRealizado = $totalRealizado + $evolucaoIndicador->vlr_realizado;

                }

                ?>

                <?php $contMes = $contMes + 1; $totalPrevisto > 0 ? $temMeta = true : $temMeta = false; ?>

                @endif

                @endforeach

                <?php $resultado = $this->calculoMensal($indicador->dsc_unidade_medida,$indicador->dsc_tipo,$totalPrevisto,$totalRealizado) ?>

                @if($temMeta)

                <div class="px-1 py-1 pl-2 text-base text-lef bg-white-500 text-{!! $resultado['grau_de_satisfacao'] !!}-600 rounded-md border-1 border-gray-100 shadow cursor-pointer" onclick="javascript: alterarIndicador('<?php print($indicador->cod_indicador) ?>');">

                    <?php is_null($this->cod_indicador) && $contIndicador == 1 ? print('<i class="fas fa-arrow-circle-right"></i>&nbsp;') : print(' &nbsp;'); ?><?php $indicador->cod_indicador == $this->cod_indicador ? print('<i class="fas fa-arrow-circle-right"></i>&nbsp;') : print(' &nbsp;'); ?><strong>&nbsp;{!! $indicador->dsc_indicador !!}</strong>

                </div>

                @endif

                <?php $contIndicador = $contIndicador + 1; ?>

                @endforeach

                <script>

                    function alterarIndicador(cod_indicador) {

                        @this.cod_indicador_selecionado = cod_indicador;

                    }

                </script>

            </div>

        </div>

        <div class="w-full md:w-2/6 border-b-2 border-gray-300 pt-2 pb-2 pl-1">
            Unidade de Medida: <strong>{{ $this->indicador->dsc_unidade_medida }}</strong>
        </div>

        <div class="w-full md:w-2/6 border-b-2 border-gray-300 pt-2 pb-2 pl-1">
            Indicador terá o resultado acumulado? <strong>{{ $this->indicador->bln_acumulado }}</strong>
        </div>

        <div class="w-full md:w-2/6 border-b-2 border-gray-300 pt-2 pb-2 pl-1">
            Tipo de Análise (Polaridade): <strong>{{ tipoPolaridade($this->indicador->dsc_tipo) }}</strong>
        </div>

        <div class="w-full md:w-1/6 border-b-2 border-gray-300 pt-2 pb-2 pl-1">
            Período de medição: <strong>{{ $this->indicador->dsc_periodo_medicao }}</strong>
        </div>

        <div class="w-full md:w-1/6 border-b-2 border-gray-300 pt-2 pb-2 pl-1">
            Fonte: <strong>{{ $this->indicador->dsc_fonte }}</strong>
        </div>

        <div class="w-full md:w-2/6 border-b-2 border-gray-300 pt-2 pb-2 pl-1">
            Fórmula do Indicador: <strong>{{ nl2br($this->indicador->dsc_formula) }}</strong>
        </div>

        <div class="w-full md:w-2/6 border-b-2 border-gray-300 pt-2 pb-2 pl-1">

            @foreach($this->indicador->linhaBase as $linhaBase)

            Linha de base do ano de <strong>{!! $linhaBase->num_ano !!}</strong> é <?php $this->indicador->dsc_unidade_medida === 'Dinheiro' ? print('%') : print(''); ?><strong>{!! formatarValorConformeUnidadeMedida($this->indicador->dsc_unidade_medida,'MYSQL','PTBR',$linhaBase->num_linha_base) !!}<?php $this->indicador->dsc_unidade_medida === 'Porcentagem' ? print('%') : print(''); ?></strong>

            @endforeach


        </div>

        <div class="w-full md:w-1/1 border-b-2 border-gray-300 pt-2 pb-2 pl-1">

            <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                <ul class="flex flex-wrap -mb-px" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                    <li class="mr-2" role="presentation">
                        <button class="inline-block py-4 px-4 text-sm font-medium text-center text-gray-500 rounded-t-lg border-b-2 border-blue-600 active hover:text-gray-600 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Evolução mensal</button>
                    </li>
                    <li class="mr-2" role="presentation">
                        <button class="inline-block py-4 px-4 text-sm font-medium text-center text-gray-500 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300" id="settings-tab" data-tabs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">Análise gráfica</button>
                    </li>
                    <li role="presentation">
                        <button class="inline-block py-4 px-4 text-sm font-medium text-center text-gray-500 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300" id="contacts-tab" data-tabs-target="#contacts" type="button" role="tab" aria-controls="contacts" aria-selected="false">Gestão</button>
                    </li>
                </ul>
            </div>
            <div id="divConteudoTab">

                <?php

                $totalPrevisto = 0;
                $totalRealizado = 0;

                ?>

                <div id="divEvolucaoMensal" style="display: block;">

                    <div class=" flex flex-wrap -mx-3 mb-6">

                        <div class="w-full md:w-3/3 px-3 mb-6 md:mb-0 pt-3">

                            <div class="border-b border-gray-200 shadow rounded-md">

                                <table class="divide-gray-300 min-w-full border-collapse block md:table " style="width: 100%;">
                                    <thead>

                                        <tr class="shadow">

                                            <th class="bg-white px-6 py-2 pl-3 text-xs text-black font-bold md:border md:border-gray-100 text-left block md:table-cell text-right">Meta</th>

                                            <?php $contMes = 1; ?>

                                            @foreach($this->indicador->evolucaoIndicador as $evolucaoIndicador)

                                            @if($evolucaoIndicador->num_ano == $this->ano)

                                            <th class="bg-white px-6 py-2 pl-3 text-xs text-black font-bold md:border md:border-gray-100 text-left block md:table-cell text-right">{!! mesNumeralParaExtensoCurto($evolucaoIndicador->num_mes) !!}</th>

                                            <?php $contMes = $contMes + 1; ?>

                                            @endif

                                            @endforeach

                                            @if($this->ano == date('Y'))

                                            <th class="bg-white px-6 py-2 pl-3 text-xs text-black font-bold md:border md:border-gray-100 text-left block md:table-cell text-right">Acumulado até {!! mesNumeralParaExtensoCurto($this->mesAnterior) !!}</th>

                                            @else

                                            <th class="bg-white px-6 py-2 pl-3 text-xs text-black font-bold md:border md:border-gray-100 text-left block md:table-cell text-right">Total</th>

                                            @endif

                                        </tr>

                                    </thead>

                                    <tbody class="bg-white divide-y divide-gray-300 block md:table-row-group">

                                        <tr class="border border-gray-500 md:border-none block md:table-row">

                                            <td class="md:border md:border-gray-100 text-left block md:table-cell px-5 py-3 pl-3 text-sm text-gray-600 text-right"><strong>Prevista</strong></td>

                                            <?php $contMes = 1; ?>

                                            @foreach($this->indicador->evolucaoIndicador as $evolucaoIndicador)

                                            @if($evolucaoIndicador->num_ano == $this->ano)

                                            <?php

                                            if($this->ano == date('Y')) {

                                                if($evolucaoIndicador->num_mes <= $this->mesAnterior) {

                                                    $totalPrevisto = $totalPrevisto + $evolucaoIndicador->vlr_previsto;

                                                    $totalRealizado = $totalRealizado + $evolucaoIndicador->vlr_realizado;

                                                }

                                            } else {

                                                $totalPrevisto = $totalPrevisto + $evolucaoIndicador->vlr_previsto;

                                                $totalRealizado = $totalRealizado + $evolucaoIndicador->vlr_realizado;

                                            }
                                            
                                            ?>

                                            @if(!is_null($evolucaoIndicador->vlr_previsto))

                                            <td class="md:border md:border-gray-100 text-left block md:table-cell px-5 py-3 pl-3 text-sm text-gray-600 text-right">{!! formatarValorConformeUnidadeMedida($this->indicador->dsc_unidade_medida,'MYSQL','PTBR',$evolucaoIndicador->vlr_previsto) !!}<?php $this->indicador->dsc_unidade_medida === 'Porcentagem' ? print('%') : print(''); ?></td>

                                            @else

                                            <td class="md:border md:border-gray-100 text-left block md:table-cell px-5 py-3 pl-3 text-sm text-gray-600 text-right">-</td>

                                            @endif

                                            <?php $contMes = $contMes + 1; ?>

                                            @endif

                                            @endforeach

                                            <td class="md:border md:border-gray-100 text-left block md:table-cell px-5 py-3 pl-3 text-sm text-gray-600 text-right">
                                                {!! $totalPrevisto !!}
                                            </td>

                                        </tr>

                                        <tr class="border border-gray-500 md:border-none block md:table-row">

                                            <td class="md:border md:border-gray-100 text-left block md:table-cell px-5 py-3 pl-3 text-sm text-gray-600 text-right"><strong>Realizada</strong></td>

                                            <?php $contMes = 1; ?>

                                            @foreach($this->indicador->evolucaoIndicador as $evolucaoIndicador)

                                            @if($evolucaoIndicador->num_ano == $this->ano)

                                            @if($this->ano == date('Y'))

                                            @if($evolucaoIndicador->num_mes <= $this->mesAnterior)

                                                <td class="md:border md:border-gray-100 text-left block md:table-cell pt-1 pb-1 pl-1 pr-1 text-sm text-right">

                                                    @if(!is_null($evolucaoIndicador->vlr_previsto) && is_null($evolucaoIndicador->bln_atualizado))

                                                    <div class="bg-pink-800 text-white rounded-md px-5 py-2">
                                                        &nbsp;-
                                                    </div>

                                                    @elseif(is_null($evolucaoIndicador->vlr_previsto) && is_null($evolucaoIndicador->bln_atualizado))

                                                    <div class="bg-gray-500 text-white rounded-md px-5 py-1">
                                                        &nbsp;-
                                                    </div>

                                                    @elseif(is_null($evolucaoIndicador->vlr_previsto) && !is_null($evolucaoIndicador->bln_atualizado))

                                                    {!! formatarValorConformeUnidadeMedida($this->indicador->dsc_unidade_medida,'MYSQL','PTBR',$evolucaoIndicador->vlr_realizado) !!}<?php $this->indicador->dsc_unidade_medida === 'Porcentagem' ? print('%') : print(''); ?>

                                                    @elseif(!is_null($evolucaoIndicador->vlr_previsto) && !is_null($evolucaoIndicador->bln_atualizado))

                                                    @if(!is_null($evolucaoIndicador->vlr_realizado))

                                                    <?php $resultado = $this->calculoMensal($this->indicador->dsc_unidade_medida,$this->indicador->dsc_tipo,$evolucaoIndicador->vlr_previsto,$evolucaoIndicador->vlr_realizado) ?>



                                                    <div class="bg-{!! $resultado['grau_de_satisfacao'] !!}-500 text-{!! $resultado['color'] !!} rounded-md px-5 py-1">

                                                        {!! formatarValorConformeUnidadeMedida($this->indicador->dsc_unidade_medida,'MYSQL','PTBR',$evolucaoIndicador->vlr_realizado) !!}<?php $this->indicador->dsc_unidade_medida === 'Porcentagem' ? print('%') : print(''); ?>

                                                    </div>



                                                    @else

                                                    @endif

                                                </td>
                                                @else

                                                <td class="md:border md:border-gray-100 text-left block md:table-cell pt-1 pb-1 pl-1 pr-3 text-sm text-right">

                                                    &nbsp;

                                                </td>
                                                @endif

                                                @else

                                                <td class="md:border md:border-gray-100 text-left block md:table-cell pt-1 pb-1 pl-1 pr-3 text-sm text-right">

                                                    &nbsp;

                                                </td>
                                                @endif

                                                @else
                                                <td class="md:border md:border-gray-100 text-left block md:table-cell pt-1 pb-1 pl-1 pr-1 text-sm text-right">

                                                    @if(!is_null($evolucaoIndicador->vlr_previsto) && is_null($evolucaoIndicador->bln_atualizado))

                                                    <div class="bg-pink-800 text-white rounded-md px-5 py-1">
                                                        &nbsp;-
                                                    </div>

                                                    @elseif(is_null($evolucaoIndicador->vlr_previsto) && is_null($evolucaoIndicador->bln_atualizado))

                                                    <div class="bg-gray-500 text-white rounded-md px-5 py-1">
                                                        &nbsp;-
                                                    </div>

                                                    @elseif(is_null($evolucaoIndicador->vlr_previsto) && !is_null($evolucaoIndicador->bln_atualizado))

                                                    {!! formatarValorConformeUnidadeMedida($this->indicador->dsc_unidade_medida,'MYSQL','PTBR',$evolucaoIndicador->vlr_realizado) !!}<?php $this->indicador->dsc_unidade_medida === 'Porcentagem' ? print('%') : print(''); ?>

                                                    @elseif(!is_null($evolucaoIndicador->vlr_previsto) && !is_null($evolucaoIndicador->bln_atualizado))

                                                    @if(!is_null($evolucaoIndicador->vlr_realizado))

                                                    <?php $resultado = $this->calculoMensal($this->indicador->dsc_unidade_medida,$this->indicador->dsc_tipo,$evolucaoIndicador->vlr_previsto,$evolucaoIndicador->vlr_realizado) ?>



                                                    <div class="bg-{!! $resultado['grau_de_satisfacao'] !!}-500 text-{!! $resultado['color'] !!} rounded-md px-5 py-1">

                                                        {!! formatarValorConformeUnidadeMedida($this->indicador->dsc_unidade_medida,'MYSQL','PTBR',$evolucaoIndicador->vlr_realizado) !!}<?php $this->indicador->dsc_unidade_medida === 'Porcentagem' ? print('%') : print(''); ?>

                                                    </div>



                                                    @else

                                                </td>
                                                @endif



                                                @endif

                                                @endif

                                                <?php $contMes = $contMes + 1; ?>

                                                @endif

                                                @endforeach

                                                <?php $resultado = $this->calculoMensal($this->indicador->dsc_unidade_medida,$this->indicador->dsc_tipo,$totalPrevisto,$totalRealizado) ?>

                                                <td class="md:border md:border-gray-100 text-left block md:table-cell pt-1 pb-1 pl-1 pr-1 text-sm text-right">

                                                    <div class="bg-{!! $resultado['grau_de_satisfacao'] !!}-500 text-{!! $resultado['color'] !!} rounded-md px-5 py-1">

                                                        {!! formatarValorConformeUnidadeMedida($this->indicador->dsc_unidade_medida,'MYSQL','PTBR',$totalRealizado) !!}<?php $this->indicador->dsc_unidade_medida === 'Porcentagem' ? print('%') : print(''); ?>

                                                    </div>

                                                </td>

                                            </tr>

                                            @auth

                                            @if($this->liberarAcessoParaAtualizar)

                                            <tr class="border border-gray-500 md:border-none block md:table-row">

                                                <td class="md:border md:border-gray-100 text-left block md:table-cell px-5 py-3 pl-3 text-sm text-gray-600 text-right"><strong>Atualização</strong></td>

                                                @foreach($this->indicador->evolucaoIndicador as $evolucaoIndicador)

                                                @if($evolucaoIndicador->num_ano == $this->ano)

                                                @if($this->ano == date('Y'))

                                                @if($evolucaoIndicador->num_mes <= $this->mesAnterior)

                                                    <td class="md:border md:border-gray-100 text-left block md:table-cell pt-1 pb-1 pl-1 pr-5 text-sm text-right">

                                                        <a href="javascript: void(0);" wire:click.prevent="editForm('{!! $evolucaoIndicador->cod_evolucao_indicador !!}')"><i class="fas fa-edit text-green-600"></i></a>

                                                    </td>

                                                    @else

                                                    <td class="md:border md:border-gray-100 text-left block md:table-cell pt-1 pb-1 pl-1 pr-3 text-sm text-right">

                                                        &nbsp;

                                                    </td>

                                                    @endif

                                                    @endif

                                                    @endif

                                                    @endforeach

                                                    <td class="md:border md:border-gray-100 text-left block md:table-cell pt-1 pb-1 pl-1 pr-1 text-sm text-right">&nbsp;</td>

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

                @else

                <div class="w-full md:w-1/1 text-red-700 border-b-2 border-red-300 pt-3 pb-3 pl-1">

                    Não há registro de indicadores para esse plano de ação

                </div>

                @endif

                @else

                <div class="w-full md:w-1/1 text-red-700 border-b-2 border-red-300 pt-3 pb-3 pl-1">

                    Não há registro de plano de ação e indicadores para esse objetivo estratégico

                </div>

                @endif

            </div>

            <div class="px-3 py-2 pt-2 pl-2 pr-2">

                <div>

                    <p class="mt-4 mb-1 pl-1">Legenda:</p>

                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-5 2xl:grid-cols-5 gap-2 mt-0">

                    {!! $this->grau_satisfacao !!}

                </div>

            </div>

            <div class="px-3 py-2 pt-2 pl-2 pr-2">
                &nbsp;
            </div>

            <!-- Modal -->
            <x-jet-dialog-modal wire:model="showModalResultadoEdicao">
                <form wire:submit.prevent="create" method="post">
                    <x-slot name="title">
                        <strong>Editar</strong>
                    </x-slot>

                    <x-slot name="content">
                        {!! $this->mensagemResultadoEdicao !!}
                    </x-slot>

                    <x-slot name="footer">
                        <x-jet-button wire:click.prevent="$toggle('showModalResultadoEdicao')" wire:loading.attr="disabled">
                            {{ __('Closer') }}
                        </x-jet-button>
                        <x-jet-danger-button wire:click.prevent="$toggle('showModalResultadoEdicao')" wire:loading.attr="disabled" wire:click.prevent="create()">
                            Salvar
                        </x-jet-danger-button>
                    </x-slot>
                </form>
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
                    <x-jet-danger-button wire:click.prevent="$toggle('showModalDelete')" wire:loading.attr="disabled" wire:click.prevent="delete('{!! $this->cod_plano_de_acao !!}')">
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