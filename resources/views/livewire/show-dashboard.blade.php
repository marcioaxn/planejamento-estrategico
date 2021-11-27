<div class="">

    <div class="flex flex-wrap w-full pt-1">

        <div class="w-full md:w-1/1 px-3 mb-6 md:mb-0">

            <div class="col-span-6 sm:col-span-4">
                {!! Form::select('cod_organizacao', $this->objetivoEstragico, $this->cod_organizacao, ['class' => 'border-gray-50 font-semibold text-lg focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-1', 'style' => 'height: 40px!Important; padding-left: 10px!Important; width: 100% !Important; cursor: pointer;', 'autocomplete' => 'off', 'onchange' => "javascript: var url = '".url($ano)."'+'/'+this.value;window.location.href = url;"]) !!}
            </div>

        </div>

        @if(isset($this->missaoVisaoValores) && !is_null($this->missaoVisaoValores) && $this->missaoVisaoValores != '')
        <div class="max-w-34xl mx-auto pt-2 px-2 sm:px-4 lg:px-3 w-full ">

            <div class="grid gap-4 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 2xl:grid-cols-2">

                <div class="flex pt-2 pb-2 pl-3 pr-3 bg-white rounded-md border-2 border-gray-50 text-gray-600 text-lg shadow ">
                    Missão: <span class="pl-3 text-gray-600 text-lg">{{ $this->missaoVisaoValores->dsc_missao }}</span>
                </div>

                <div class="flex pt-2 pb-2 pl-3 pr-3 bg-white rounded-md border-2 border-gray-50 text-gray-600 text-lg shadow ">
                    Visão: <span class="pl-3 text-gray-600 text-lg">{{ $this->missaoVisaoValores->dsc_visao }}</span>
                </div>

            </div>

        </div>
        @else
        <div class="max-w-34xl mx-auto pt-2 px-2 sm:px-4 lg:px-3 w-full ">

            <div class="grid gap-4 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 2xl:grid-cols-2 w-full ">

                <div class="flex pt-2 pb-2 pl-3 pr-3 bg-white rounded-md border-2 border-gray-50 text-red-400 w-full shadow ">
                    Missão: sem cadastro
                </div>

                <div class="flex pt-2 pb-2 pl-3 pr-3 bg-white rounded-md border-2 border-gray-50 text-red-400 w-full shadow ">
                    Visão: sem cadastro
                </div>

            </div>

        </div>
        @endif
        
    </div>

    <div class="flex flex-wrap w-full pt-3 pl-3 pr-3">

        @foreach($this->perspectiva as $resultPerspectiva)

        <div class="w-full flex flex-col bg-white rounded-lg overflow-hidden border-2 border-indigo-50">
            <div class="bg-indigo-50 bg-opacity-50 text-gray-600 text-lg pt-1 pb-1 pl-3 pr-3"><span class="text-sm">{!! $resultPerspectiva->num_nivel_hierarquico_apresentacao !!}. </span><strong>{!! $resultPerspectiva->dsc_perspectiva !!}</strong></div>

            <div class="w-full pb-4" style="margin-top: 6px!Important; padding-top: 6px!Important;">

                <div class="w-full mx-auto px-2 sm:px-4 lg:px-3">

                    <div class="w-full grid gap-2 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 2xl:grid-cols-6 justify-end">

                        @foreach($resultPerspectiva->objetivosEstrategicos as $resultObjetivoEstragico)

                        <a href="javascript: void(0);" wire:click.prevent="detalharObjetivoEstrategico('{!! $resultObjetivoEstragico->cod_objetivo_estrategico !!}')" >
                            <div class="flex w-full pt-2 pb-2 pl-3 pr-3 bg-white rounded-md border-2 border-indigo-50 hover:border-gray-200 shadow ">

                                <div class="w-full" style="width: 100%!Important;">

                                    <p class="w-full text-sm text-left text-gray-600 h-20 " style="width: 100%!Important;"><strong>OE {!! $resultObjetivoEstragico->num_nivel_hierarquico_apresentacao !!}.</strong> {!! $resultObjetivoEstragico->dsc_objetivo_estrategico !!}</p>

                                    <div class="w-full pt-1" style="width: 100%!Important;">

                                        @php
                                        $acoes = rand(3, 17);
                                        $resultado = rand(3, 100);

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

                                            <div style="width:{{ $resultado  }}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-{{ $grauSatisfacao }}-500"></div>

                                        </div>

                                    </div>

                                </div>

                            </div>
                        </a>

                        @endforeach

                    </div>

                </div>

            </div>

        </div>

        <div class="w-full flex flex-col bg-white" style="margin: 0px!Important; padding: 0px!Important; height: 9px!Important;">
            &nbsp;
        </div>

        @endforeach

    </div>

</div>