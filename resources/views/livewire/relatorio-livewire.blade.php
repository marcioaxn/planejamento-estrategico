<div class="mt-0 p-2 pt-0">

    <div class="flex flex-wrap w-full pt-1">

        <div class="w-full md:w-1/1 mt-2 mb-1 pt-1">

            <div class="rounded pt-1 pb-1 pl-3 pr-2 bg-blue-600 text-white text-lg items-center font-semibold text-lg "
                style="text-align: center!Important;">
                RELATÓRIO DO {{ $pei->dsc_pei }} ({{ $pei->num_ano_inicio_pei . ' a ' . $pei->num_ano_fim_pei }})
            </div>

        </div>

        <div style="margin-top: 25px; width: 100%!Important;">

            @php
            $contPerspectiva = 1;
            @endphp

            @foreach ($this->perspectivas as $resultPerspectiva)
                @php
                    if ($resultPerspectiva->num_nivel_hierarquico_apresentacao == 1) {
                        $colorBg = 'slate-700 text-white';
                        $colorBgInterno = 'bg-slate-50';
                        $border = 'border-slate-700';
                        $borderInterno = 'border-slate-200';
                    } elseif ($resultPerspectiva->num_nivel_hierarquico_apresentacao == 2) {
                        $colorBg = 'green-600 text-white';
                        $colorBgInterno = 'bg-green-50';
                        $border = 'border-green-600';
                        $borderInterno = 'border-green-200';
                    } else {
                        $colorBg = 'fuchsia-200 text-fuchsia-800';
                        $border = 'border-fuchsia-200';
                    }
                @endphp

                <style>
                    .h-full {
                        display: grid;
                        grid-template-rows: 1fr auto;
                    }

                    #divChartIndicadoresEPlanoAcao {
                        grid-row: 2;
                        padding-bottom: 35px !Important;
                    }

                    @media print {
                        .break-page {
                            page-break-after: always;
                        }
                    }
                </style>

                <div class="bg-white rounded-lg overflow-hidden border-2 {{ $border }} mb-4">

                    <div class="bg-{{ $colorBg }} text-lg pt-1 pb-1 pl-3 pr-3">
                        Perspectiva - <strong>{{ $resultPerspectiva->num_nivel_hierarquico_apresentacao . '. ' . $resultPerspectiva->dsc_perspectiva }}</strong>
                    </div>

                    @if ($resultPerspectiva->objetivosEstrategicos->count() > 0)

                    <div
                        class="grid grid-cols-1 gap-4 p-3 pt-5 pb-5">

                        @foreach ($resultPerspectiva->objetivosEstrategicos as $resultObjetivoEstragico)
                            @php
                                $resultIndicador = $this->calcularAcumuladoIndicadoresObjetivoEstrategico(
                                    $this->cod_organizacao,
                                    $resultObjetivoEstragico->cod_objetivo_estrategico,
                                    $this->anoSelecionado,
                                );

                                $result = $this->calcularAcumuladoObjetivoEstrategico(
                                    $this->cod_organizacao,
                                    $resultObjetivoEstragico->cod_objetivo_estrategico,
                                    $this->anoSelecionado,
                                );
                            @endphp

                            <div>
                                O.E. - {{ $resultPerspectiva->num_nivel_hierarquico_apresentacao . '.' . $resultObjetivoEstragico->num_nivel_hierarquico_apresentacao }}. <span style="font-weight: bold;">{{$resultObjetivoEstragico->nom_objetivo_estrategico }}</span>

                                <div style="text-align: left;">
                                    @if($resultObjetivoEstragico->indicadores->count() > 0)
                                    <table class="table" style="width: 100%!Important;">
                                        <thead>
                                            <tr>
                                                <th>Indicador</th>
                                                <th>Resultado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            @foreach ($resultObjetivoEstragico->indicadores as $indicador)

                                            <?php
                                            $contMes = 1;
                                            $totalPrevisto = 0;
                                            $totalRealizado = 0;
                                            $temMeta = false;
                                            ?>

                                            <tr>
                                                <td style="border-bottom: 1px solid gray;">
                                                    {{ $indicador->nom_indicador }}
                                                </td>

                                                {{-- Início do cálculo do Indicador --}}
                                                @foreach ($indicador->evolucaoIndicador as $evolucaoIndicador)
                                                    
                                                    @if ($evolucaoIndicador->num_ano == $this->ano)

                                                        @if ($this->ano == date('Y'))

                                                            @if ($evolucaoIndicador->num_mes == $this->mes)

                                                                <td
                                                                class="text-sm text-gray-900 font-light whitespace-nowrap text-right" style="width: 12%!Important; border-bottom: 1px solid gray;">

                                                                    @if (!is_null($evolucaoIndicador->vlr_previsto) && is_null($evolucaoIndicador->bln_atualizado))
                                                                        <div
                                                                            class="bg-pink-800 text-white rounded-md px-5 py-1">
                                                                            &nbsp;-
                                                                        </div>
                                                                    @endif

                                                                </td>

                                                            @endif

                                                        @else
                                                        <td
                                                        class="text-sm text-gray-900 font-light whitespace-nowrap text-right" style="width: 12%!Important; border-bottom: 1px solid gray;">-</td>
                                                        @endif

                                                    @else
                                                        
                                                    @endif
                                                    
                                                @endforeach

                                            </tr>
                                                
                                            @endforeach
                                    
                                        </tbody>
                                    </table>
                                    @else
                                        <span class="text-red-700">Não há cadastro de indicador ao Objetivo Estratégico</span>
                                    @endif
                                </div>

                            </div>

                        @endforeach

                        </div>

                    @endif

                </div>
                
                @php
                $contPerspectiva++;
                @endphp

                @if($contPerspectiva <= $this->perspectivas->count())
                    <div class="break-page"></div>
                @endif

            @endforeach

            <script>
                window.onload = function() {
                    const divs = document.querySelectorAll('.break-page-check');
                    
                    divs.forEach(function(div) {
                        const rect = div.getBoundingClientRect();
                        const pageHeight = window.innerHeight;

                        // Se a posição do fundo da div for maior que a altura da página
                        if (rect.bottom > pageHeight) {
                            div.style.pageBreakBefore = 'always';
                        }
                    });
            </script>

        </div>

    </div>

</div>