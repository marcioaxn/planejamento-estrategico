@if ($this->existePei)
    <div class="">

        <div class="flex flex-wrap w-full pt-1">

            <div class="w-full md:w-1/1 mt-2 mb-1 ml-1 mr-1 pt-1">

                <div class="rounded pt-1 pb-1 pl-3 pr-2 bg-blue-600 text-white text-lg items-center font-semibold text-lg "
                    style="text-align: center!Important;">
                    {{ $this->pei->dsc_pei }}
                </div>

            </div>

            <div class="w-full md:w-1/1 mt-1 mt-1 mb-2 ml-1 mr-1 pt-0 pb-0 ">

                <style type="text/css">
                    select {
                        text-align-last: center;
                    }
                </style>

                <div class="col-span-6 sm:col-span-4">
                    {!! Form::select('cod_organizacao', $this->organization, $this->cod_organizacao, [
                        'class' =>
                            'w-full border-2 border-gray-300 border-opacity-25 font-semibold text-sm sm:text-base focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 text-blue-500 text-center pt-1 h-10',
                        'style' => 'cursor: pointer;text-align: center !Important;',
                        'wire:model' => 'cod_organizacao',
                        'autocomplete' => 'off',
                        'onchange' => "javascript: var url = '" . url($ano) . "'+'/'+this.value;window.location.href = url;",
                    ]) !!}
                </div>

            </div>

            @include('livewire.missao-visao-valores.index')

        </div>

        <div class="mt-2 p-2">

            @include('livewire.objetivo-estrategico.por-perspectiva')

        </div>

        <div class="mb-4 p-2">

            <div>

                <p class="pb-2">Grau de satisfação dos Indicadores:</p>

            </div>

            <div
                class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-5 2xl:grid-cols-5 gap-2 mt-0 pb-2">

                {!! $this->grau_satisfacao !!}

            </div>

            <div class="mt-4">

                <p class="pb-2">Grau de satisfação das Entregas:</p>

            </div>

            <div
                class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 2xl:grid-cols-6 gap-2 mt-0">

                {!! getGrauSatisfacaoEntregas() !!}

            </div>

        </div>

    </div>
@else
    <div class="">

        <div class="flex flex-wrap w-full mt-3 pt-1">

            <div class="w-full md:w-1/1 px-3 pt-1">

                <div class="pt-1 pb-1 pl-3 pr-3 rounded-md border-2 border-red-400 border-opacity-50 text-gray-600 text-lg font-semibold text-red-500 "
                    style="text-align: center!Important;">
                    <i class="fas fa-exclamation-triangle text-red-600"></i> Não existe Planejamento Estratégico
                    Integrado<br>cadastrado que tenha abrangência ao ano de<br>({{ $ano }})
                </div>

            </div>
        </div>
    </div>
@endif
