@if (isset($this->missaoVisaoValores) && !is_null($this->missaoVisaoValores) && $this->missaoVisaoValores != '')
    <div class="w-full md:w-1/2 md:px-1 md:pl-1 pt-1 md:mb-0 pt-2">

        <div class="bg-white rounded-lg overflow-hidden border-2 border-green-700 mb-2">

            <div class="bg-green-700 text-white text-lg px-1 pt-1 pb-1 pl-3 pr-3">
                <i class="fas fa-bullseye"></i> <strong>Missão</strong>
            </div>

            <div class="bg-green-50 pt-2 pb-3 pl-3 pr-3 sm:h-24">
                {{ $this->missaoVisaoValores->dsc_missao }}
            </div>

        </div>

    </div>

    <div class="w-full md:w-1/2 px-3 md:px-1 md:pl-1 pt-1 md:mb-0 pt-2">

        <div class="bg-white rounded-lg overflow-hidden border-2 border-yellow-400 mb-2">

            <div class="bg-yellow-400 text-stone-900 text-lg px-1 pt-1 pb-1 pl-3 pr-3">
                <i class="fas fa-eye"></i> <strong>Visão</strong>
            </div>

            <div class="bg-yellow-50 pt-2 pb-3 pl-3 pr-3 sm:h-24">
                {{ $this->missaoVisaoValores->dsc_visao }}
            </div>

        </div>

    </div>

    <div class="w-full md:w-1/1 px-3 md:px-1 md:pl-1 pt-1 md:mb-0 pt-2">

        <div class="bg-white rounded-lg overflow-hidden border-2 border-red-600 mb-2">

            <div class="bg-red-600 text-white text-lg px-1 pt-1 pb-1 pl-3 pr-3">
                <i class="far fa-gem"></i> <strong>Valores</strong>
            </div>

            <div class="bg-red-50 pt-2 pb-3 pl-3 pr-3 sm:h-24">
                {{ $this->missaoVisaoValores->dsc_valores }}
            </div>

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
