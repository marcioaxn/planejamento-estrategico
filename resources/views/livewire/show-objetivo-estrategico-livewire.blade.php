<div class="pt-3 pb-3 pl-1 pr-1">

    <div class="flex flex-wrap w-full text-base md:text-sm pt-1 pb-3 pl-3 pr-3 rounded-md border-1 border-gray-100">

        <div class="w-full md:w-1/1">

            <div class="pt-0 pb-1 pl-3 pr-3 bg-white rounded-md border-2 border-gray-300 border-opacity-25 text-gray-600 text-lg items-center font-semibold text-lg " style="text-align: left!Important;">
                Plano de Ação
            </div>
            
        </div>

        <div class="w-full md:w-1/1 pt-0 pb-0">

            <div class="col-span-6 sm:col-span-4">
                {!! Form::select('cod_organizacao', $this->organization, null, ['class' => 'w-full pl-3 border-2 border-gray-300 border-opacity-25 font-semibold text-sm sm:text-base focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 text-center pt-1 h-10', 'style' => 'cursor: pointer;text-align: left !Important;', 'autocomplete' => 'off', 'wire:model' => "cod_organizacao",'onchange' => "javascript: alterarUrlCodOrganizacao(this.value);"]) !!}
            </div>

            <script>

                function alterarUrlCodOrganizacao(cod_organizacao) {

                    var url_antiga = window.location.pathname;

                    var cod_organizacao_antigo = @this.cod_organizacao;

                    var nova_url = url_antiga.replace(cod_organizacao_antigo,cod_organizacao);

                    var origin = window.location.origin;

                    window.location = origin + nova_url;

                    // window.history.pushState({}, 'Title', nova_url);


                }

            </script>

        </div>

    </div>

    <div class="flex flex-wrap w-full text-base md:text-sm pt-1 pb-3 pl-3 pr-3 rounded-md border-1 border-gray-100">

        <div class="w-full md:w-1/6 border-b-2 border-gray-100 pt-1 pb-2 pl-1">
            Perspectiva: <strong>{!! $this->perspectiva->num_nivel_hierarquico_apresentacao !!}. {!! $this->perspectiva->dsc_perspectiva !!}</strong>
        </div>

        <div class="w-full md:w-1/6 text-right border-b-2 border-gray-100 pt-1 pb-1 pl-1">
            Objetivo Estratégico:
        </div>

        <style type="text/css">select { text-align-last:left; }</style>

        <div class="w-full md:w-4/6 border-b-2 border-gray-100 text-left pl-1">
            {!! Form::select('cod_objetivo_estrategico', $this->objetivoEstragico, null, ['class' => 'w-full text-left pl-1 border-0 border-white border-opacity-25 font-semibold text-sm sm:text-base focus:border-indigo-300 focus:ring focus:ring-gray-50 focus:ring-opacity-50 h-7 rounded-md text-left cursor-pointer', 'placeholder' => 'Selecione', 'autocomplete' => 'off', 'required' => 'required', 'wire:model' => 'cod_objetivo_estrategico','onchange' => "javascript: alterarUrlCodObjetivoEstrategico(this.value);"]) !!}
        </div>

        <script>

            function alterarUrlCodObjetivoEstrategico(cod_objetivo_estrategico) {

                var url_antiga = window.location.pathname;

                var cod_objetivo_estrategico_antigo = @this.cod_objetivo_estrategico;

                var nova_url = url_antiga.replace(cod_objetivo_estrategico_antigo,cod_objetivo_estrategico);

                var origin = window.location.origin;

                window.location = origin + nova_url;


            }

        </script>

        @if(!is_null($this->planoAcao) && $this->planosAcao->count() > 0)

        <div class="w-full md:w-1/6 border-b-2 border-gray-100 pt-3 pb-1 pl-1">Plano de Ação:</div>

        <div class="w-full md:w-5/6 border-b-2 border-gray-100 pt-2 pb-2 pl-1">

            <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-4 lg:grid-cols-2 xl:grid-cols-12 2xl:grid-cols-12 gap-2 mt-0">

                <?php $contPlanoAcao = 1; $somaPercentual = 0; $calculoGeralPlanoAno = 0; ?>

                @foreach($this->planosAcao as $resultPlanoAcao)

                <?php $contIndicador = 0; ?>

                <?php

                $resultado = $this->calcularAcumuladoPlanoDeAcao($resultPlanoAcao->cod_plano_de_acao,$this->anoSelecionado);

                if($resultPlanoAcao->indicadores->count() > 0) {

                    ?>

                    <a href="{!! url($this->ano.'/unidade/'.$this->cod_organizacao.'/perspectiva/'.$this->cod_perspectiva.'/objetivo-estrategico/'.$this->cod_objetivo_estrategico.'/plano-de-acao/'.$resultPlanoAcao->cod_plano_de_acao) !!}" >

                        <div class="text-base text-center bg-{!! $resultado['grau_de_satisfacao'] !!}-500 text-white rounded-md border-2 border-{!! $resultado['grau_de_satisfacao'] !!}-50 border-opacity-25 shadow-md cursor-pointer" onclick="javascript: alterarPlanoAcao('<?php print($resultPlanoAcao->cod_plano_de_acao) ?>');">
                            <?php is_null($this->cod_plano_de_acao) && $contPlanoAcao == 1 ? print('<i class="fas fa-arrow-circle-right"></i> ') : print(''); ?><?php $resultPlanoAcao->cod_plano_de_acao == $this->cod_plano_de_acao ? print('<i class="fas fa-arrow-circle-right"></i> ') : print(''); ?>{!! $this->perspectiva->num_nivel_hierarquico_apresentacao !!}.{!! $this->objetivoEstrategico->num_nivel_hierarquico_apresentacao !!}.{!! $resultPlanoAcao->num_nivel_hierarquico_apresentacao !!}
                        </div>

                    </a>
                    <?php

                } else {

                    ?>

                    <a href="{!! url($this->ano.'/unidade/'.$this->cod_organizacao.'/perspectiva/'.$this->cod_perspectiva.'/objetivo-estrategico/'.$this->cod_objetivo_estrategico.'/plano-de-acao/'.$resultPlanoAcao->cod_plano_de_acao) !!}" >

                        <div class="text-base text-center bg-gray-500 text-white rounded-md border-2 border-gray-50 border-opacity-25 shadow-md cursor-pointer" onclick="javascript: alterarPlanoAcao('<?php print($resultPlanoAcao->cod_plano_de_acao) ?>');">
                            <?php is_null($this->cod_plano_de_acao) && $contPlanoAcao == 1 ? print('<i class="fas fa-arrow-circle-right"></i> ') : print(''); ?><?php $resultPlanoAcao->cod_plano_de_acao == $this->cod_plano_de_acao ? print('<i class="fas fa-arrow-circle-right"></i> ') : print(''); ?>{!! $this->perspectiva->num_nivel_hierarquico_apresentacao !!}.{!! $this->objetivoEstrategico->num_nivel_hierarquico_apresentacao !!}.{!! $resultPlanoAcao->num_nivel_hierarquico_apresentacao !!}
                        </div>

                    </a>
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

        <div class="w-full md:w-3/6 border-b-2 border-gray-100 pt-2 pb-2 pl-1">
            {!! $planoAcao->tipoExecucao->dsc_tipo_execucao !!}: <strong>{!! $this->perspectiva->num_nivel_hierarquico_apresentacao !!}.{!! $this->objetivoEstrategico->num_nivel_hierarquico_apresentacao !!}.{!! $planoAcao->num_nivel_hierarquico_apresentacao !!}. {!! $planoAcao->dsc_plano_de_acao !!}</strong>
        </div>

        <div class="w-full md:w-3/6 border-b-2 border-gray-100 pt-2 pb-2 pl-1">
            Principais entregas: <strong>{{ $planoAcao->txt_principais_entregas }}</strong>
        </div>

        <div class="w-full md:w-3/6 border-b-2 border-gray-100 pt-2 pb-2 pl-1">Data de início em <strong>{{ converterData('EN','PTBR',$planoAcao->dte_inicio) }}</strong><span class="text-gray-400">, {{ formatarDataComCarbonForHumans($planoAcao->dte_inicio) }},</span> e a conclusão prevista para <strong>{{ converterData('EN','PTBR',$planoAcao->dte_fim) }}</strong>
        </div>

        <div class="w-full md:w-1/6 border-b-2 border-gray-100 pt-2 pb-2 pl-1">
            Status: <strong>{{ $planoAcao->bln_status }}</strong>
        </div>

        <div class="w-full md:w-2/6 border-b-2 border-gray-100 pt-2 pb-2 pl-1">
            Orçamento previsto: R$ <strong>{{ converteValor('MYSQL','PTBR',$planoAcao->vlr_orcamento_previsto) }}</strong>
        </div>

        <div class="w-full md:w-2/6 border-b-2 border-gray-100 pt-2 pb-2 pl-1">
            Unidade responsável: <strong>{{ $planoAcao->unidade->sgl_organizacao }}</strong><span class="text-gray-400">{!! $this->hierarquiaUnidade($planoAcao->unidade->cod_organizacao) !!}</span>
        </div>

        <div class="w-full md:w-2/6 border-b-2 border-gray-100 pt-2 pb-2 pl-1">
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

        <div class="w-full md:w-2/6 border-b-2 border-gray-100 pt-2 pb-2 pl-1">
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

        <div class="w-full md:w-1/6 border-b-2 border-gray-100 pt-3 pb-1 pl-1"><?php $planoAcao->indicadores->count() > 1 ? print('Indicadores') : print('Indicador'); ?>: </div>

        <div class="w-full md:w-5/6 border-b-2 border-gray-100 pt-2 pb-2 pl-1">

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

                        if($indicador->bln_acumulado === 'Sim') {

                            $totalPrevisto = $totalPrevisto + $evolucaoIndicador->vlr_previsto;

                            $totalRealizado = $totalRealizado + $evolucaoIndicador->vlr_realizado;

                        } else {

                            $totalPrevisto = $evolucaoIndicador->vlr_previsto;

                            $totalRealizado = $evolucaoIndicador->vlr_realizado;

                        }

                    }

                } else {

                    if($indicador->bln_acumulado === 'Sim') {

                        $totalPrevisto = $totalPrevisto + $evolucaoIndicador->vlr_previsto;

                        $totalRealizado = $totalRealizado + $evolucaoIndicador->vlr_realizado;

                    } else {

                        $totalPrevisto = $evolucaoIndicador->vlr_previsto;

                        $totalRealizado = $evolucaoIndicador->vlr_realizado;

                    }

                }

                ?>

                <?php $contMes = $contMes + 1; $totalPrevisto > 0 ? $temMeta = true : $temMeta = false; ?>

                @endif

                @endforeach

                <?php $resultado = $this->calcularAcumuladoIndicador($indicador->cod_indicador,$this->anoSelecionado); ?>

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

        <div class="w-full md:w-2/6 border-b-2 border-gray-100 pt-2 pb-2 pl-1">
            Unidade de Medida: <strong>{{ $this->indicador->dsc_unidade_medida }}</strong>
        </div>

        <div class="w-full md:w-2/6 border-b-2 border-gray-100 pt-2 pb-2 pl-1">
            Indicador terá o resultado acumulado? <strong>{{ $this->indicador->bln_acumulado }}</strong>
        </div>

        <!-- <div class="w-full md:w-2/6 border-b-2 border-gray-100 pt-2 pb-2 pl-1">
            Tipo de Análise (Polaridade): <strong>{{ tipoPolaridade($this->indicador->dsc_tipo) }}</strong>
        </div> -->

        <div class="w-full md:w-2/6 border-b-2 border-gray-100 pt-2 pb-2 pl-1">
            Período de medição: <strong>{{ $this->indicador->dsc_periodo_medicao }}</strong>
        </div>

        <div class="w-full md:w-2/6 border-b-2 border-gray-100 pt-2 pb-2 pl-1">
            Fonte: <strong>{{ $this->indicador->dsc_fonte }}</strong>
        </div>

        <div class="w-full md:w-2/6 border-b-2 border-gray-100 pt-2 pb-2 pl-1">
            Fórmula do Indicador: <strong>{{ nl2br($this->indicador->dsc_formula) }}</strong>
        </div>

        <div class="w-full md:w-2/6 border-b-2 border-gray-100 pt-2 pb-2 pl-1">

            @foreach($this->indicador->linhaBase as $linhaBase)

            Linha de base do ano de <strong>{!! $linhaBase->num_ano !!}</strong> é <?php $this->indicador->dsc_unidade_medida === 'Dinheiro' ? print('%') : print(''); ?><strong>{!! formatarValorConformeUnidadeMedida($this->indicador->dsc_unidade_medida,'MYSQL','PTBR',$linhaBase->num_linha_base) !!}<?php $this->indicador->dsc_unidade_medida === 'Porcentagem' ? print('%') : print(''); ?></strong>

            @endforeach


        </div>

        <div class="w-full md:w-4/6 border-b-2 border-gray-100 pt-2 pb-2 pl-1">

            @if($this->indicador->dsc_tipo === '+')

            <i class="fas fa-arrow-alt-circle-up text-lg"></i> <strong>{!! tipoPolaridade($this->indicador->dsc_tipo) !!}</strong> será para esse indicador que tem a meta prevista de <strong>{{ formatarValorConformeUnidadeMedida($this->indicador->dsc_unidade_medida,'MYSQL','PTBR',$this->metaAno) }}<?php $this->indicador->dsc_unidade_medida === 'Porcentagem' ? print('%') : print(''); ?></strong> para o ano de {!! $this->anoSelecionado !!}.

            @endif

            @if($this->indicador->dsc_tipo === '-')

            <i class="fas fa-arrow-alt-circle-down text-lg"></i> <strong>{!! tipoPolaridade($this->indicador->dsc_tipo) !!}</strong> será para esse indicador que tem a meta prevista de <strong>{{ formatarValorConformeUnidadeMedida($this->indicador->dsc_unidade_medida,'MYSQL','PTBR',$this->metaAno) }}<?php $this->indicador->dsc_unidade_medida === 'Porcentagem' ? print('%') : print(''); ?></strong> para o ano de {!! $this->anoSelecionado !!}.

            @endif

            @if($this->indicador->dsc_tipo === '=')

            <i class="fas fa-equals text-lg"></i> <strong>{!! tipoPolaridade($this->indicador->dsc_tipo) !!}</strong> será para esse indicador que tem a meta prevista de <strong>{{ formatarValorConformeUnidadeMedida($this->indicador->dsc_unidade_medida,'MYSQL','PTBR',$this->metaAno) }}<?php $this->indicador->dsc_unidade_medida === 'Porcentagem' ? print('%') : print(''); ?></strong> para o ano de {!! $this->anoSelecionado !!}.

            @endif
            
        </div>

        <div class="w-full md:w-1/1 border-b-2 border-gray-100 pt-2 pb-2 pl-1">

            <script type="text/javascript">

                function abrirFecharTabs(num_tab = '') {

                    for(i=1;i<=3;i++) {

                        // document.getElementById('divConteudoTab'+i).style.display = 'none';

                        $("#divConteudoTab"+i).fadeOut("fast");

                        $("#btnTab"+i).removeClass("inline-block py-4 px-4 text-sm font-medium text-center text-gray-500 rounded-t-lg border-b-2 border-blue-600 active hover:text-gray-600 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300");

                        $("#btnTab"+i).addClass("inline-block py-4 px-4 text-sm font-medium text-center text-gray-500 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300");

                    }

                    $("#btnTab"+num_tab).addClass("inline-block py-4 px-4 text-sm font-medium text-center text-gray-500 rounded-t-lg border-b-2 border-blue-600 active hover:text-gray-600 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300");

                    setTimeout(function () {
                        $("#divConteudoTab"+num_tab).fadeIn("slow");
                    }, 66);

                }

            </script>

            <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                <ul class="flex flex-wrap -mb-px" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                    <li class="mr-2" role="presentation">
                        <button id="btnTab1" class="inline-block py-4 px-4 text-sm font-medium text-center text-gray-500 rounded-t-lg border-b-2 border-blue-600 active hover:text-gray-600 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300" onclick="javascript: abrirFecharTabs('1');">Evolução mensal</button>
                    </li>
                    <li role="presentation">
                        <button id="btnTab3" class="inline-block py-4 px-4 text-sm font-medium text-center text-gray-500 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300" onclick="javascript: abrirFecharTabs('3');">Gestão</button>
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

                                        @if($this->indicador->bln_acumulado == 'Sim')

                                        @if($this->ano == date('Y'))

                                        <th class="bg-white px-6 py-2 pl-3 text-xs text-black font-bold md:border md:border-gray-100 text-left block md:table-cell text-right">Acumulado até {!! mesNumeralParaExtensoCurto($this->mesAnterior) !!}</th>

                                        @else

                                        <th class="bg-white px-6 py-2 pl-3 text-xs text-black font-bold md:border md:border-gray-100 text-left block md:table-cell text-right">Total</th>

                                        @endif

                                        @endif

                                    </tr>

                                </thead>

                                <tbody class="bg-white divide-y divide-gray-300 block md:table-row-group">

                                    <tr class="border border-gray-500 md:border-none block md:table-row">

                                        <td class="md:border md:border-gray-100 text-left block md:table-cell px-5 py-3 pl-3 text-sm text-gray-600 text-right"><strong>Prevista</strong></td>

                                        <?php
                                        $contMes = 1;
                                        ?>

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

                                        @if($this->indicador->bln_acumulado == 'Sim')

                                        <td class="md:border md:border-gray-100 text-left block md:table-cell px-5 py-3 pl-3 text-sm text-gray-600 text-right">
                                            {!! $totalPrevisto !!}
                                        </td>

                                        @endif

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

                                                <?php $resultado = $this->obterResultadoComValorRealizadoEValorPrevisto($this->indicador->dsc_tipo,$evolucaoIndicador->vlr_realizado,$evolucaoIndicador->vlr_previsto) ?>



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

                                                <?php $resultado = $this->obterResultadoComValorRealizadoEValorPrevisto($this->indicador->dsc_tipo,$evolucaoIndicador->vlr_realizado,$evolucaoIndicador->vlr_previsto) ?>



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

                                            @if($this->indicador->bln_acumulado == 'Sim')

                                            <?php $resultado = $this->obterResultadoComValorRealizadoEValorPrevisto($this->indicador->dsc_tipo,$totalRealizado,$totalPrevisto); $this->totalRealizado = $totalRealizado; ?>

                                            <td class="md:border md:border-gray-100 text-left block md:table-cell pt-1 pb-1 pl-1 pr-1 text-sm text-right">

                                                <div class="bg-{!! $resultado['grau_de_satisfacao'] !!}-500 text-{!! $resultado['color'] !!} rounded-md px-5 py-1">

                                                    {!! formatarValorConformeUnidadeMedida($this->indicador->dsc_unidade_medida,'MYSQL','PTBR',$totalRealizado) !!}<?php $this->indicador->dsc_unidade_medida === 'Porcentagem' ? print('%') : print(''); ?>

                                                </div>

                                            </td>

                                            @endif

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

                                                    <a href="javascript: void(0);" wire:click.prevent="abrirModalIncluirPdf()"><i class="fas fa-file-pdf text-base text-red-600"></i></a>
                                                    &nbsp;&nbsp;    
                                                    <a href="javascript: void(0);" wire:click.prevent="editForm('{!! $evolucaoIndicador->cod_evolucao_indicador !!}')"><i class="fas fa-edit text-base text-green-600"></i></a>

                                                </td>

                                                @else

                                                <td class="md:border md:border-gray-100 text-left block md:table-cell pt-1 pb-1 pl-1 pr-3 text-sm text-right">

                                                    &nbsp;

                                                </td>

                                                @endif

                                                @endif

                                                @endif

                                                @endforeach

                                                @if($this->indicador->bln_acumulado == 'Sim')

                                                <td class="md:border md:border-gray-100 text-left block md:table-cell pt-1 pb-1 pl-1 pr-1 text-sm text-right">&nbsp;</td>

                                                @endif

                                            </tr>

                                            @endif

                                            @endauth

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                            <div class="w-full md:w-1/1 px-3 mt-2 mb-6 md:mb-0 pt-6">

                                <p>Gráfico da Evolução Mensal</p>

                                <canvas id="chart-<?php print($this->cod_indicador) ?>" style="width: 100%!Important; height: 333px!Important;"></canvas>

                                @if($this->indicador->bln_acumulado === 'Não')

                                <script type="text/javascript">

                                    new Chart(document.getElementById("chart-<?php print($this->cod_indicador) ?>"), {
                                        type: 'bar',
                                        data: {
                                          labels: ["Jan","Fev","Mar","Abr","Mai","Jun","Jul","Ago","Set","Out","Nov","Dez"],
                                          datasets: [
                                          {
                                            label: "Meta prevista",
                                            backgroundColor: "#3e95cd",
                                            data: [<?php print($this->dataChartMetaPrevista) ?>]
                                        },{
                                            label: "Meta realizada",
                                            backgroundColor: "#8e5ea2",
                                            data: [<?php print($this->dataChartMetaRealizada) ?>]
                                        }
                                        ]
                                    },
                                    options: {
                                        title: {
                                            display: true,
                                            text: 'Teste'
                                        },
                                        scales: {
                                            y: {
                                                suggestedMin: 0,
                                                suggestedMax: <?php print($this->metaAno) ?>+5,
                                            }
                                        }
                                    }
                                });

                            </script>

                            @endif

                            @if($this->indicador->bln_acumulado === 'Sim')

                            <script type="text/javascript">

                                new Chart(document.getElementById("chart-<?php print($this->cod_indicador) ?>"), {
                                  type: 'line',
                                  data: {
                                    labels: ["Jan","Fev","Mar","Abr","Mai","Jun","Jul","Ago","Set","Out","Nov","Dez"],
                                    datasets: [{ 
                                        data: [<?php print($this->dataChartMetaPrevista) ?>],
                                        label: "Meta Prevista",
                                        backgroundColor: "#3e95cd",
                                        borderColor: "#3e95cd",
                                        fill: false
                                    }, { 
                                        data: [<?php print($this->dataChartMetaRealizada) ?>],
                                        label: "Meta Realizada",
                                        backgroundColor: "#9A3412",
                                        borderColor: "#9A3412",
                                        fill: false
                                    },{
                                        label: "Linha de base",
                                        backgroundColor: "#696969",
                                        data: [<?php print($this->dataChartLinhaBase) ?>]
                                    }
                                    ]
                                },
                                options: {
                                  title: {
                                    display: true,
                                    text: 'Teste'
                                },
                                scales: {
                                    y: {
                                        suggestedMin: 0,
                                        suggestedMax: <?php print($this->linhaBase) ?>+50,
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
            Tab 3
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
<x-jet-dialog-modal wire:model="showModalInformacao">
    <form wire:submit.prevent="create" method="post">
        <x-slot name="title">
            <strong>Importante</strong>
        </x-slot>

        <x-slot name="content">
            {!! $this->mensagemInformacao !!}
        </x-slot>

        <x-slot name="footer">
            <x-jet-button wire:click.prevent="$toggle('showModalInformacao')" wire:loading.attr="disabled">
                {{ __('Closer') }}
            </x-jet-button>
        </x-slot>
    </form>
</x-jet-dialog-modal>

<!-- Modal -->
<x-jet-geral-modal wire:model="showModalIncluirPdf">
    <form method="POST" enctype="multipart/form-data" wire:submit.prevent="">
        <x-slot name="title">
            <strong>Incluir PDF</strong>
        </x-slot>

        <x-slot name="content">
            <input type="file" wire:model="pdf">
            <x-jet-input-error for="pdf" class="mt-2" />
            <div wire:loading wire:target="pdf">Uploading...</div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-button wire:click.prevent="$toggle('showModalIncluirPdf')" wire:loading.attr="disabled">
                {{ __('Closer') }}
            </x-jet-button>
            <x-jet-danger-button wire:click.prevent="$toggle('showModalIncluirPdf')" wire:loading.attr="disabled" wire:click.prevent="savePdf()">
                Salvar
            </x-jet-danger-button>
        </x-slot>
    </form>
</x-jet-geral-modal>

<!-- Modal -->
<x-jet-geral-modal wire:model="showModalResultadoEdicao">
    <form wire:submit.prevent="create" method="post">
        <x-slot name="title">
            <strong>Editar</strong>
        </x-slot>

        <x-slot name="content">
            {!! $this->mensagemResultadoEdicao !!}
            <x-jet-input-error for="vlr_realizado" class="mt-2" />
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
</x-jet-geral-modal>

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