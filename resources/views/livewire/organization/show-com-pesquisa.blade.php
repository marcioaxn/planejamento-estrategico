<div class="mx-auto max-w-34xl mx-auto px-1 sm:px-3 lg:px-4 pt-0">

    <form wire:submit.prevent="create" method="post">

        <div>

            <label>Nome da organização:</label>

            {!! Form::text('nom_organizacao', null, ['class' => 'block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline', 'style' => 'cursor: pointer; width: 100% !Important;', 'placeholder' => 'Selecione', 'autocomplete' => 'off', 'required' => 'required', 'wire:model' => 'nom_organizacao']) !!}
            
        </div>
        
    </form>
    
</div>

<div class="mx-auto max-w-34xl mx-auto px-1 sm:px-3 lg:px-4 pt-0">

    <form class="">

        <div class=" flex flex-wrap -mx-3 mb-6">

            <div class="w-full md:w-2/2 px-3 mb-3 md:mb-0 pt-2"><label
                class="block uppercase tracking-wide text-gray-700 text-lg font-bold mb-2" for="grid-first-name">Total de
                {{ $organization->count() }} Organização(ões)</label></div>

                <div class="w-full md:w-2/2">
                    <hr>
                </div>

                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0 pt-3">

                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                    for="grid-first-name">Procurar Número da Proposta</label>

                    <div class="inline-block relative w-64">

                        

                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">

                            <i class="fas fa-search"></i>

                        </div>

                    </div>

                </div>

            </div>

            <div class="container mx-auto p-10">
                <h1 class="text-4xl font-semibold text-center mt-4 mb-6">Áreas</h1>

                <table wire:loading.delay.class="opacity-50" class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 bg-gradient-to-r from-blue-500">Área</th>
                            <th class="px-4 py-2">Sigla</th>
                            <th class="px-4 py-2">Criada em</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        $cod_organizacao_impressos = [];

                        ?>

                        @foreach ($organization as $result)

                        @if(!in_array($result->cod_organizacao,$cod_organizacao_impressos))
                        <tr @if ($loop->last) id="last_record" @endif>
                            <td class="border px-4 py-2">{{ $result->nom_organizacao }}</td>
                            <td class="border px-4 py-2">{{ $result->sgl_organizacao }}</td>
                            <td class="border px-4 py-2">{{ $result->created_at }}</td>
                        </tr>

                        @endif

                        @foreach ($result->deshierarquia as $filho)

                        @if($nom_organizacao === '' && $result->cod_organizacao != $filho->cod_organizacao)
                        <?php array_push($cod_organizacao_impressos,$filho->cod_organizacao) ?>

                        <tr @if ($loop->last) id="last_record" @endif>
                            <td class="border px-4 py-2">{{ $filho->nom_organizacao }}</td>
                            <td class="border px-4 py-2">{{ $filho->sgl_organizacao }}</td>
                            <td class="border px-4 py-2">{{ $filho->created_at }}</td>
                        </tr>
                        @endif
                        @endforeach

                        @endforeach

                    </tbody>
                </table>

                <script>
                    const lastRecord = document.getElementById('last_record');
                    const options = {
                        root: null,
                        threshold: 1,
                        rootMargin: '0px'
                    }
                    const observer = new IntersectionObserver((entries, observer) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                @this.loadMore()
                            }
                        });
                    });
                    observer.observe(lastRecord);
                </script>
            </div>

        </form>
        
    </div>
