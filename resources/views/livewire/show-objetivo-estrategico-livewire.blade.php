<div class="mt-0 p-2 pt-0">

    <div class="flex flex-wrap w-full pt-1">

        <div class="w-full md:w-1/1 mt-2 mb-1 pt-1">

            <div class="rounded pt-1 pb-1 pl-3 pr-2 bg-blue-600 text-white text-lg items-center font-semibold text-lg "
                style="text-align: center!Important;">
                Objetivos Estratégicos | {{ $this->pei->dsc_pei }}
            </div>

        </div>

        <div class="w-full md:w-1/1 pt-0 pb-0">

            <div class="col-span-6 sm:col-span-4">
                {!! Form::select('cod_organizacao', $this->organization, $this->cod_organizacao, [
                    'class' =>
                        'w-full pl-3 border-2 border-gray-300 border-opacity-25 h-11 font-semibold text-sm sm:text-base focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 text-blue-500 text-center pt-1 pb-1',
                    'style' => 'cursor: pointer;text-align: left !Important;',
                    'autocomplete' => 'off',
                    'wire:model' => 'cod_organizacao',
                    'onchange' => 'javascript: alterarUrlCodOrganizacao(this.value);',
                ]) !!}
            </div>

            <script>
                function alterarUrlCodOrganizacao(cod_organizacao) {

                    var url_antiga = window.location.pathname;

                    var cod_organizacao_antigo = @this.cod_organizacao;

                    var nova_url = url_antiga.replace(cod_organizacao_antigo, cod_organizacao);

                    var origin = window.location.origin;

                    window.location = origin + nova_url;

                    // window.history.pushState({}, 'Title', nova_url);


                }
            </script>

        </div>

    </div>

    <div class="flex flex-wrap w-full text-lg md:text-sm p-1 pt-2 rounded-md border-1 border-gray-100 mb-1">

        <div class="w-full md:w-1/12 border-b-2 text-lg border-gray-100 pt-1 pb-2 pl-1">
            Perspectiva:
        </div>

        <div class="w-full md:w-11/12 text-lg border-b-2 border-gray-100 pt-1 pb-2 pl-1">
            <strong>{!! $this->perspectiva->num_nivel_hierarquico_apresentacao !!}. {!! $this->perspectiva->dsc_perspectiva !!}</strong>
        </div>

    </div>

    <div class="rounded-t-lg pt-1 pb-1 pl-3 pr-2 bg-blue-600 text-white text-xl font-bold text-lg ">
        Objetivo Estratégico <span class="text-yellow-300">{{ $this->perspectiva->num_nivel_hierarquico_apresentacao }}.
            {{ $this->objetivoEstrategico->num_nivel_hierarquico_apresentacao }}.</span>
    </div>

    <div
        class="w-full p-4 bg-white border border-gray-200 rounded-b-lg shadow sm:p-3 dark:bg-gray-800 dark:border-gray-700">

        <p class="mb-0">
            {!! Form::select('cod_objetivo_estrategico', $this->objetivoEstragicoPluck, null, [
                'class' =>
                    'w-full text-left pl-1 border-0 border-white border-opacity-25 font-semibold text-lg focus:border-indigo-300 focus:ring focus:ring-gray-50 focus:ring-opacity-50 h-7 text-black rounded-md text-left cursor-pointer whitespace-normal break-words',
                'autocomplete' => 'off',
                'required' => 'required',
                'wire:model' => 'cod_objetivo_estrategico',
                'onchange' => 'javascript: alterarUrlCodObjetivoEstrategico(this.value);',
            ]) !!}
        </p>
    </div>

    <div class="flex flex-wrap md:flex-nowrap w-full pt-1 gap-2">

        <div class="w-full md:w-1/2 mt-2 pt-1 flex">

            <div class="bg-white rounded-lg overflow-hidden border-2 border-green-700 flex-1 flex flex-col">

                <div class="bg-green-700 text-white text-xl px-1 pt-1 pb-1 pl-3 pr-3">
                    <strong>Descrição</strong>
                </div>

                <div class="bg-green-50 text-justify pt-2 pb-3 pl-3 pr-3 flex-1">
                    {{ $this->objetivoEstrategico->dsc_objetivo_estrategico }}
                </div>

            </div>

        </div>

        <div class="w-full md:w-1/2 mt-2 pt-1 flex">

            <div class="bg-white rounded-lg overflow-hidden border-2 border-red-600 flex-1 flex flex-col">

                <div class="bg-red-500 text-white text-xl px-1 pt-1 pb-1 pl-3 pr-3">
                    <strong>Futuro Almejado</strong>
                </div>

                <div class="bg-red-50 text-justify pt-2 pb-3 pl-4 pr-3 flex-1">
                    <ul class="list-disc pl-3">
                        @foreach ($this->objetivoEstrategico->fututosAlmejados as $fututosAlmejado)
                            <li>{{ $fututosAlmejado->dsc_futuro_almejado }}</li>
                        @endforeach
                    </ul>
                </div>

            </div>

        </div>

    </div>

    @include('livewire.plano-de-acao.navbar-acao-iniciativa-projeto')

    <div class="mb-4 p-2">

        @if ($this->cod_origem != '3ac5e10e-8960-4b7c-a1cf-455597c875a7')
            <div>

                <p class="pb-2">Grau de satisfação dos Indicadores:</p>

            </div>

            <div
                class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-5 2xl:grid-cols-5 gap-2 mt-0">

                {!! $this->grau_satisfacao !!}

            </div>
        @else
        <div>

            <p class="pb-2">Grau de satisfação das Entregas:</p>

        </div>

        <div
            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 2xl:grid-cols-6 gap-2 mt-0">

            {!! getGrauSatisfacaoEntregas() !!}

        </div>
        @endif

    </div>

</div>
