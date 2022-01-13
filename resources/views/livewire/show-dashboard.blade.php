@if($this->existePei)
<div class="">

    <div class="flex flex-wrap w-full pt-1">

        <div class="w-full md:w-1/1 px-3 pt-1">

            <div class="pt-1 pb-1 pl-3 pr-3 bg-white rounded-md border-2 border-gray-300 border-opacity-25 text-gray-600 text-lg items-center font-semibold text-lg " style="text-align: center!Important;">
                Mapa Estratégico
            </div>
            
        </div>

        <div class="w-full md:w-1/1 pt-0 pb-0 pl-3 pr-3 ">

            <style type="text/css">select { text-align-last:center; }</style>

            <div class="col-span-6 sm:col-span-4">
                {!! Form::select('cod_organizacao', $this->organization, $this->cod_organizacao, ['class' => 'w-full border-2 border-gray-300 border-opacity-25 font-semibold text-sm sm:text-base focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 text-center pt-1 h-10', 'style' => 'cursor: pointer;text-align: center !Important;', 'autocomplete' => 'off', 'onchange' => "javascript: var url = '".url($ano)."'+'/'+this.value;window.location.href = url;"]) !!}
            </div>

        </div>

        @if(isset($this->missaoVisaoValores) && !is_null($this->missaoVisaoValores) && $this->missaoVisaoValores != '')

        <div class="w-full md:w-1/2 px-3 md:px-1 md:pl-3 pt-1 md:mb-0 pt-2">

            <div class="flex items-center justify-center text-center h-18 sm:h-16 md:h-28 lg:h-20 xl:h-14 pt-3 pb-3 md:pt-5 md:pb-6 lg:pt-2 lg:pb-2 xl:pt-0 xl:pb-0 pl-3 pr-3 bg-white rounded-md text-gray-700 text-base shadow ">
                Missão: {{ $this->missaoVisaoValores->dsc_missao }}
            </div>

        </div>

        <div class="w-full md:w-1/2 px-3 md:px-1 md:pr-3 pt-1 md:mb-0 pt-2">

            <div class="flex items-center justify-center text-center h-18 sm:h-16 md:h-28 lg:h-20 xl:h-14 pt-3 pb-3 md:pt-5 md:pb-6 lg:pt-2 lg:pb-2 xl:pt-0 xl:pb-0 pl-3 pr-3 bg-white rounded-md text-gray-700 text-base shadow ">
                Visão: {{ $this->missaoVisaoValores->dsc_visao }}
            </div>

        </div>

        <div class="w-full md:w-1/1 px-3 pt-1 md:mb-0 pt-2">

            <div class="flex items-center justify-center text-center h-18 sm:h-16 md:h-28 lg:h-20 xl:h-14 pt-3 pb-3 md:pt-5 md:pb-6 lg:pt-2 lg:pb-2 xl:pt-0 xl:pb-0 pl-3 pr-3 bg-white rounded-md text-gray-700 text-base shadow ">
                Valores: {{ $this->missaoVisaoValores->dsc_missao }}
            </div>

        </div>

        @else

        <div class="w-full md:w-1/2 px-3 pt-1 md:mb-0 pt-2">

            <div class="h-10 pt-2 pb-2 pl-3 pr-3 bg-white rounded-md text-gray-400 text-base shadow ">
                Missão: Sem informação
            </div>

        </div>

        <div class="w-full md:w-1/2 px-3 pt-1 md:mb-0 pt-2">

            <div class="h-10 pt-2 pb-2 pl-3 pr-3 bg-white rounded-md text-gray-400 text-base shadow ">
                Visão: Sem informação
            </div>

        </div>

        <div class="w-full md:w-1/1 px-3 pt-1 md:mb-0 pt-2">

            <div class="h-10 pt-2 pb-2 pl-3 pr-3 bg-white rounded-md text-gray-400 text-base shadow ">
                Valores: Sem informação
            </div>

        </div>

        @endif
        
    </div>

    <div class="pt-2 pl-2 pr-2">

        @if($this->perspectiva->count() > 0)
        @foreach($this->perspectiva as $resultPerspectiva)

        <div class="bg-white rounded-lg overflow-hidden border-2 border-gray-100 border-opacity-50">

            <div class="bg-gray-200 bg-opacity-50 text-gray-600 text-lg pt-1 pb-1 pl-3 pr-3"><span class="text-sm">{!! $resultPerspectiva->num_nivel_hierarquico_apresentacao !!}. </span><strong>{!! $resultPerspectiva->dsc_perspectiva !!}</strong></div>

            @if($resultPerspectiva->objetivosEstrategicos->count() > 0)

            <div class="grid lg:grid-flow-row xl:grid-flow-col-dense sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-5 2xl:grid-cols-6.9 sm:grid-rows-{!! ceil($resultPerspectiva->objetivosEstrategicos->count()/$resultPerspectiva->objetivosEstrategicos->count()) !!} md:grid-rows-{!! ceil($resultPerspectiva->objetivosEstrategicos->count()/2) !!} lg:grid-rows-{!! ceil($resultPerspectiva->objetivosEstrategicos->count()/2) !!} xl:grid-rows-{!! ceil($resultPerspectiva->objetivosEstrategicos->count()/5) !!} 2xl:grid-rows-{!! ceil($resultPerspectiva->objetivosEstrategicos->count()/6) !!} gap-3 pt-2 pb-2 pl-2 pr-2">

                @foreach($resultPerspectiva->objetivosEstrategicos as $resultObjetivoEstragico)

                <a href="javascript: void(0);" wire:click.prevent="detalharObjetivoEstrategico('{!! $resultObjetivoEstragico->cod_objetivo_estrategico !!}')" >

                    <div class="pt-2 pb-2 pl-3 pr-3 bg-white rounded-md border-2 border-gray-50 border-opacity-25 shadow ">

                        <div id="load-objetivo-estrategico-{!! $resultObjetivoEstragico->cod_objetivo_estrategico !!}" class="max-w-sm w-full mx-auto">

                            <div class="animate-pulse flex space-x-4">

                                <div class="flex-1 space-y-4 py-1">

                                    <div class="h-4 bg-gray-200 rounded w-4/4"></div>

                                    <div class="h-4 bg-gray-200 rounded w-2/4"></div>

                                    <div class="space-y-2">

                                        <div class="h-1 bg-white rounded"></div>

                                        <div class="h-1 bg-white rounded"></div>

                                        <div class="h-3 bg-gray-200 rounded w-6/6"></div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div  id="objetivo-estrategico-{!! $resultObjetivoEstragico->cod_objetivo_estrategico !!}" class="w-full" style="width: 100%!Important; display: none;">

                            <p class="w-full text-sm text-left text-gray-600 h-20 " style="width: 100%!Important;"><strong>OE {!! $resultObjetivoEstragico->num_nivel_hierarquico_apresentacao !!}.</strong> {!! $resultObjetivoEstragico->dsc_objetivo_estrategico !!}</p>

                            <div class="w-full pt-1" style="width: 100%!Important;">

                                @php
                                $acoes = rand(3, 17);
                                $resultado = rand(10, 1000) / 10;

                                $grauSatisfacao = '';

                                if($resultado <= 100) {
                                    $grauSatisfacao = 'green';
                                }

                                if($resultado <= 69) {
                                    $grauSatisfacao = 'yellow';
                                }

                                if($resultado <= 35) {
                                    $grauSatisfacao = 'red';
                                }

                                @endphp

                                <div class="flex mb-2 items-center justify-between" style="width: 100%!Important;">

                                    <div class="text-xs text-gray-500">{{ $acoes }} ações/projetos</div>

                                    <div class="text-right">

                                        <span class="text-xs font-semibold inline-block text-gray-500">{!! $resultado !!}%</span>

                                    </div>

                                </div>

                                <div class="overflow-hidden h-2 text-xs flex rounded bg-{{ $grauSatisfacao }}-50" style="width: 100%!Important;">

                                    <div style="width:{!! $resultado  !!}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-{{ $grauSatisfacao }}-500 "></div>

                                </div>

                            </div>

                        </div>

                    </div>
                </a>

                <script type="text/javascript">

                    setTimeout(function () {
                        $("#load-objetivo-estrategico-{!! $resultObjetivoEstragico->cod_objetivo_estrategico !!}").fadeOut("slow");
                    }, 669);

                    setTimeout(function () {
                        $("#objetivo-estrategico-{!! $resultObjetivoEstragico->cod_objetivo_estrategico !!}").fadeIn("slow");
                    }, 936);

                </script>

                @endforeach

            </div>

            @else
            <div class="pt-3 pb-3 pl-3">
                Não tem objetivo estratégico cadastrado para essa perspectiva
            </div>
            @endif



        </div>

        <div class="w-full flex flex-col bg-white" style="margin: 0px!Important; padding: 0px!Important; height: 3px!Important;">
            &nbsp;
        </div>

        @if($resultPerspectiva->num_nivel_hierarquico_apresentacao == 2 || $resultPerspectiva->num_nivel_hierarquico_apresentacao == 3)

        <div class="grid place-items-left" style="margin: 0px!Important; padding: 0px!Important;">
            <div class="arrow-up"></div>
        </div>

        @endif

        @endforeach
        @else
        <div>
            Não existe perspectiva casdastrada para esse Planejamento Estratégico Integrado.
        </div>
        @endif

    </div>

    <div class="w-full flex flex-col bg-white" style="margin: 0px!Important; padding: 0px!Important; height: 33px!Important;">
        &nbsp;
    </div>

</div>
@else
<div class="">

    <div class="flex flex-wrap w-full pt-1">

        <div class="w-full md:w-1/1 px-3 pt-1">

            <div class="pt-1 pb-1 pl-3 pr-3 bg-white rounded-md border-2 border-gray-300 border-opacity-25 text-gray-600 text-lg font-semibold text-lg " style="text-align: center!Important;">
                Ainda não existe Planejamento Estratégico Integrado cadastrado que tenha abrangência a este ano ({{ $ano }})
            </div>
            
        </div>
    </div>
</div>
@endif
