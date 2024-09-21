@if (isset($this->valores) && !empty($this->valores))
    <div class="w-full md:w-1/1 mb-1 p-2">

        <div class="bg-white rounded-lg overflow-hidden border-2 border-red-600">

            <div class="bg-red-500 text-white text-lg px-1 pt-1 pb-1 pl-3 pr-3">
                <i class="far fa-gem"></i> <strong>Valores</strong>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-2 pt-2 pb-3 pl-2 pr-2">
                @foreach ($this->valores as $valor)
                    <div class="bg-red-50 border border-gray-200 shadow dark:bg-gray-800 dark:border-gray-700 rounded mb-1">
                        <h5 class="bg-red-500 font-bold tracking-tight text-white dark:text-white rounded-t-md pt-2 pb-3 pl-3 pr-3">
                            {{ $valor->nom_valor }}</h5>
                        <p class="font-normal text-gray-700 dark:text-gray-400 text-justify pt-2 pb-3 pl-3 pr-3">
                            {{ $valor->dsc_valor }}</p>
                    </div>
                @endforeach
            </div>

        </div>

    </div>
@endif
