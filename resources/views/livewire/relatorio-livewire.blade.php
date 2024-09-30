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