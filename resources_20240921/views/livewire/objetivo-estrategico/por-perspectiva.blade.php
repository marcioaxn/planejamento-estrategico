@if ($this->perspectiva->count() > 0)
    @foreach ($this->perspectiva as $resultPerspectiva)
        @php
            if ($resultPerspectiva->num_nivel_hierarquico_apresentacao == 1) {
                $colorBg = 'slate-500 text-white';
                $colorBgInterno = 'bg-slate-50';
                $border = 'border-slate-500';
                $borderInterno = 'border-slate-200';
            } elseif ($resultPerspectiva->num_nivel_hierarquico_apresentacao == 2) {
                $colorBg = 'lime-600 text-white';
                $colorBgInterno = 'bg-lime-50';
                $border = 'border-lime-600';
                $borderInterno = 'border-lime-200';
            } else {
                $colorBg = 'fuchsia-200 text-fuchsia-800';
                $border = 'border-fuchsia-200';
            }
        @endphp

        <div class="bg-white rounded-lg overflow-hidden border-2 {{ $border }} mb-2">

            <div class="bg-{{ $colorBg }} text-lg pt-1 pb-1 pl-3 pr-3">
                <strong>{!! $resultPerspectiva->num_nivel_hierarquico_apresentacao !!}. {!! $resultPerspectiva->dsc_perspectiva !!}</strong>
            </div>

            @if ($resultPerspectiva->objetivosEstrategicos->count() > 0)
                <div>

                    @if ($resultPerspectiva->objetivosEstrategicos->count() > 0)
                        <div
                            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 2xl:grid-cols-4 gap-4 p-3 pt-5 pb-5">

                            <style>
                                .cabecalho_div {
                                    margin-bottom: 0.7rem;
                                    padding-top: 0.7rem;
                                    padding-left: 0.7rem;
                                    padding-right: 0.7rem;
                                }

                                .principal_div {
                                    flex-grow: 1;
                                    margin-bottom: 1.2rem;
                                    padding-top: 0.7rem;
                                    padding-left: 0.7rem;
                                    padding-right: 0.7rem;
                                }

                                .rodape_div {
                                    margin-bottom: 1.2rem;
                                    padding-top: 0.7rem;
                                    padding-left: 0.7rem;
                                    padding-right: 0.7rem;
                                }
                            </style>

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
                                <div class="bg-white rounded-xl shadow-md overflow-hidden border-2">
                                    <a href="{!! url(
                                        $this->ano .
                                            '/unidade/' .
                                            $this->cod_organizacao .
                                            '/perspectiva/' .
                                            $resultPerspectiva->cod_perspectiva .
                                            '/objetivo-estrategico/' .
                                            $resultObjetivoEstragico->cod_objetivo_estrategico .
                                            '/plano-de-acao',
                                    ) !!}">
                                        <div class="relative">
                                            <div
                                                class="bg-{{ $colorBg . ' ' . $border }} text-lg px-1 pt-1 pb-1 pl-3 pr-3">
                                                <span class="text-sm"><strong>OE
                                                        {!! $resultPerspectiva->num_nivel_hierarquico_apresentacao !!}.{!! $resultObjetivoEstragico->num_nivel_hierarquico_apresentacao !!}.</strong>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="h-full" id="divIndicadoresEPlanoDeAcao">
                                            <div class="cabecalho_div mt-0 pt-0 mb-0 pb-0">
                                                <p
                                                    class="text-base text-gray-lite dark:text-[#A6A6A6] text-justify mt-0 pt-0 mb-0 pb-0">
                                                    {{ $resultObjetivoEstragico->dsc_objetivo_estrategico }}
                                                </p>
                                            </div>
                                            <div class="principal_div mt-0 pt-0 mb-0 pb-0"
                                                style="vertical-align: bottom !Important;">
                                                <div class="flex justify-between mb-1">
                                                    @php
                                                        $resultIndicador['quantidadeIndicador'] > 1 ? $textoAcao = 'indicadores' : $textoAcao = 'indicador';
                                                    @endphp
                                                    <span class="text-xs text-gray-700">
                                                        <span class="text-base">{!! !is_null($resultIndicador['quantidadeIndicador']) ? $resultIndicador['quantidadeIndicador'] : 0 !!}</span>
                                                        {{ $textoAcao }}
                                                    </span>
                                                    <span
                                                        class="text-sm font-medium text-{{ $resultIndicador['grau_de_satisfacao'] }}-700 dark:text-white">
                                                        {{ $resultIndicador['percentual_alcancado'] }}%
                                                    </span>
                                                </div>
                                                <div class="w-full bg-gray-200 rounded-full h-1.5 dark:bg-gray-700">
                                                    <div class="bg-{{ $resultIndicador['grau_de_satisfacao'] }}-600 h-1.5 rounded-full"
                                                        style="width: {{ $resultIndicador['percentual_alcancado'] }}%">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="rodape_div mt-0 pt-0 mb-0 pb-0">
                                                <div class="flex justify-between mb-1">
                                                    <span class="text-xs text-gray-700">
                                                        @php
                                                            $result['quantidadePlanosDeAcao'] > 1
                                                                ? ($textoAcao = 'ações/iniciativas /projetos')
                                                                : ($textoAcao = 'açao/iniciativa/projeto');
                                                        @endphp
                                                        <span class="text-base">{!! !is_null($result['quantidadePlanosDeAcao']) ? $result['quantidadePlanosDeAcao'] : 0 !!}</span>
                                                        {{ $textoAcao }}
                                                    </span>
                                                    <span
                                                        class="text-sm font-medium text-{{ $result['grau_de_satisfacao'] }}-700 dark:text-white">
                                                        {{ $result['percentual_alcancado'] }}%
                                                    </span>
                                                </div>
                                                <div class="w-full bg-gray-200 rounded-full h-1.5 dark:bg-gray-700">
                                                    <div class="bg-{{ $result['grau_de_satisfacao'] }}-600 h-1.5 rounded-full"
                                                        style="width: {{ $result['percentual_alcancado'] }}%">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </a>
                                </div>
                            @endforeach

                        </div>
                    @endif


                </div>
            @else
                <div class="pt-3 pb-3 pl-3 text-slate-400">
                    Não tem objetivo estratégico cadastrado para essa perspectiva
                </div>
            @endif



        </div>

        <div class="w-full flex flex-col mt-1 bg-white"
            style="margin: 0px!Important; padding: 0px!Important; height: 3px!Important;">
            &nbsp;
        </div>

        @if (
            $resultPerspectiva->num_nivel_hierarquico_apresentacao >= 2 &&
                $resultPerspectiva->num_nivel_hierarquico_apresentacao <= $this->perspectiva->count())
            <diiv>

                <div class="grid place-items-left" style="margin: 0px!Important; padding: 0px!Important;">
                    <div class="arrow-up {{ $colorBg }}"></div>
                </div>
        @endif
    @endforeach
@else
    <div>
        Não existe perspectiva casdastrada para esse Planejamento Estratégico Integrado.
    </div>
@endif
