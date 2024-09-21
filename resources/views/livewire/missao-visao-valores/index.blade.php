@if (isset($this->MissaoVisao) && !is_null($this->MissaoVisao) && $this->MissaoVisao != '')
    <div class="w-full md:w-1/2 mb-1 p-2">

        <div class="bg-white rounded-lg overflow-hidden border-2 border-green-700">

            <div class="bg-green-700 text-white text-lg px-1 pt-1 pb-1 pl-3 pr-3">
                <i class="fas fa-bullseye"></i> <strong>Missão</strong>
            </div>

            <div class="bg-green-50 pt-2 pb-3 pl-3 pr-3 sm:h-24">
                {{ $this->MissaoVisao->dsc_missao }}
            </div>

        </div>

    </div>

    <div class="w-full md:w-1/2 mb-1 p-2">

        <div class="bg-white rounded-lg overflow-hidden border-2 border-yellow-400">

            <div class="bg-yellow-400 text-stone-900 text-lg px-1 pt-1 pb-1 pl-3 pr-3">
                <i class="fas fa-eye"></i> <strong>Visão</strong>
            </div>

            <div class="bg-yellow-50 pt-2 pb-3 pl-3 pr-3 sm:h-24">
                {{ $this->MissaoVisao->dsc_visao }}
            </div>

        </div>

    </div>

    @include('livewire.valores.index')
@else
    <div class="w-full md:w-1/2 mb-1 p-2">

        <div class="h-10 pt-2 pb-2 pl-3 pr-3 bg-white rounded-md text-gray-400 text-base shadow ">
            Missão: Sem informação
        </div>

    </div>

    <div class="w-full md:w-1/2 mb-1 p-2">

        <div class="h-10 pt-2 pb-2 pl-3 pr-3 bg-white rounded-md text-gray-400 text-base shadow ">
            Visão: Sem informação
        </div>

    </div>

    <div class="w-full md:w-1/1 mb-1 p-2">

        <div class="h-10 pt-2 pb-2 pl-3 pr-3 bg-white rounded-md text-gray-400 text-base shadow ">
            Valores: Sem informação
        </div>

    </div>
@endif
