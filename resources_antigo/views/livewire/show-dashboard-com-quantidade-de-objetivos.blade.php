<div class="">

    <div class="flex flex-wrap w-full pt-1">

        <div class="w-full md:w-1/1 px-3 mb-6 pt-1 md:mb-0">

            <div class="pt-1 pb-1 pl-3 pr-3 bg-white rounded-md border-2 border-gray-300 border-opacity-25 text-gray-600 text-lg items-center font-semibold text-lg " style="text-align: center!Important;">
                Mapa Estratégico
            </div>
            
        </div>

        <div class="w-full md:w-1/1 px-3 mb-6 pt-1 md:mb-0">

            <div class="col-span-6 sm:col-span-4">
                {!! Form::select('cod_organizacao', $this->organization, $this->cod_organizacao, ['class' => 'border-2 border-gray-300 border-opacity-25 font-semibold text-tiny sm:text-lg focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-1', 'style' => 'height: 40px!Important; padding-left: 10px!Important; width: 100% !Important; cursor: pointer;', 'autocomplete' => 'off', 'onchange' => "javascript: var url = '".url($ano)."'+'/'+this.value;window.location.href = url;"]) !!}
            </div>

        </div>

        @if(isset($this->missaoVisaoValores) && !is_null($this->missaoVisaoValores) && $this->missaoVisaoValores != '')

        <div class="w-full md:w-1/2 px-3 mb-6 pt-1 md:mb-0 pt-2">

            <div class="pt-2 pb-2 pl-3 pr-3 bg-white rounded-md text-gray-600 text-base shadow ">
                Missão: {{ $this->missaoVisaoValores->dsc_missao }}
            </div>

        </div>

        <div class="w-full md:w-1/2 px-3 mb-6 pt-1 md:mb-0 pt-2">

            <div class="pt-2 pb-2 pl-3 pr-3 bg-white rounded-md text-gray-600 text-base shadow ">
                Visão: {{ $this->missaoVisaoValores->dsc_visao }}
            </div>

        </div>

        <div class="w-full md:w-1/1 px-3 mb-6 pt-1 md:mb-0 pt-2">

            <div class="pt-2 pb-2 pl-3 pr-3 bg-white rounded-md text-gray-600 text-base shadow ">
                Valores: {{ $this->missaoVisaoValores->dsc_missao }}
            </div>

        </div>

        @else

        <div class="w-full md:w-1/2 px-3 mb-6 pt-1 md:mb-0 pt-2">

            <div class="pt-2 pb-2 pl-3 pr-3 bg-white rounded-md text-gray-600 text-lg shadow ">
                Missão: Sem informação
            </div>

        </div>

        <div class="w-full md:w-1/2 px-3 mb-6 pt-1 md:mb-0 pt-2">

            <div class="pt-2 pb-2 pl-3 pr-3 bg-white rounded-md text-gray-600 text-lg shadow ">
                Visão: Sem informação
            </div>

        </div>

        <div class="w-full md:w-1/1 px-3 mb-6 pt-1 md:mb-0 pt-2">

            <div class="pt-2 pb-2 pl-3 pr-3 bg-white rounded-md text-gray-600 text-lg shadow ">
                Valores: Sem informação
            </div>

        </div>

        @endif
        
    </div>

    <div class="pt-3 pl-3 pr-3">

        @foreach($this->perspectiva as $resultPerspectiva)

        @php
        $somaPercentuais = 0;
        @endphp

        <div class="bg-white rounded-lg overflow-hidden border-2 border-gray-100 border-opacity-50">

            <div class="bg-gray-200 bg-opacity-25 text-gray-600 text-lg pt-1 pb-1 pl-3 pr-3"><span class="text-sm">{!! $resultPerspectiva->num_nivel_hierarquico_apresentacao !!}. </span><strong>{!! $resultPerspectiva->dsc_perspectiva !!}</strong></div>

            <div class="grid gap-3 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 2xl:grid-cols-6 pt-2 pb-2 pl-3 pr-3">

                @foreach($resultPerspectiva->objetivosEstrategicos as $resultObjetivoEstragico)

                <a href="javascript: void(0);" wire:click.prevent="detalharObjetivoEstrategico('{!! $resultObjetivoEstragico->cod_objetivo_estrategico !!}')" >

                    <div class="pt-2 pb-2 pl-3 pr-3 bg-white rounded-md border-2 border-gray-50 border-opacity-25 shadow ">

                        <div class="w-full" style="width: 100%!Important;">

                            <p class="w-full text-sm text-left text-gray-600 h-20 " style="width: 100%!Important;"><strong>OE {!! $resultObjetivoEstragico->num_nivel_hierarquico_apresentacao !!}.</strong> {!! $resultObjetivoEstragico->dsc_objetivo_estrategico !!}</p>

                            <div class="w-full pt-1" style="width: 100%!Important;">

                                @php
                                $acoes = rand(3, 17);
                                $resultado = rand(10, 1000) / 10;

                                $somaPercentuais = $somaPercentuais + $resultado;

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

                                <div class="overflow-hidden h-2 text-xs flex rounded bg-gray-100" style="width: 100%!Important;">

                                    <div style="width:{!! $resultado  !!}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-{{ $grauSatisfacao }}-500"></div>

                                </div>

                            </div>

                        </div>

                    </div>
                </a>

                @endforeach

            </div>

            <div class="flex justify-end pt-3 pb-3">

                @php
                $calculo = 0;

                $calculo = (($somaPercentuais)/$resultPerspectiva->objetivosEstrategicos->count());

                $grauSatisfacao = '';

                if($calculo <= 100) {
                    $grauSatisfacao = 'green';
                }

                if($calculo <= 69) {
                    $grauSatisfacao = 'yellow';
                }

                if($calculo <= 35) {
                    $grauSatisfacao = 'red';
                }
                @endphp

                <div class="w-3 h-3 bg-{!! $grauSatisfacao !!}-400 rounded-full mt-2 ml-4 "></div>
                <div class="bg-white text-gray-400 text-sm pt-1 pb-1 pl-3 pr-3">São {!! $resultPerspectiva->objetivosEstrategicos->count() !!} Objetivos Estrégicos para essa Perpectiva</div>

            </div>

        </div>

        <div class="w-full flex flex-col bg-white" style="margin: 0px!Important; padding: 0px!Important; height: 9px!Important;">
            &nbsp;
        </div>

        @if($resultPerspectiva->num_nivel_hierarquico_apresentacao == 2 || $resultPerspectiva->num_nivel_hierarquico_apresentacao == 3)

        <div class="grid place-items-left" style="margin: 0px!Important; padding: 0px!Important;">
            <div class="arrow-up"></div>
        </div>

        @endif

        @endforeach

    </div>

</div>