<div class="flex flex-wrap w-full text-base md:text-sm pt-0 pb-1 rounded-md border-1 border-gray-100"
    style="font-size: 0.91rem!Important;">

    <div class="w-full md:w-1/1 mt-2 pt-1 flex">

        <div class="bg-white rounded-lg overflow-hidden border-2 border-stone-200 flex-1 flex flex-col">

            <div
                class="bg-stone-50 text-stone-700 border-2  border-white border-b-stone-200 text-xl px-1 pt-1 pb-1 pl-3 pr-3">
                <strong>Entregas</strong>
            </div>

            <div class="bg-white text-justify pt-2 pb-3 pl-4 pr-3 flex-1">

                @php
                    $contEntrega = 1;
                @endphp

                @foreach ($this->entregas as $entrega)
                    <div class="w-full md:w-1/1 mb-1 md:mb-1 pt-2">

                        <div class="flex flex-wrap w-full text-base md:text-sm pt-3 pb-3 rounded-md border-1 border-gray-100"
                            style="font-size: 0.91rem!Important;">

                            <div class="w-full md:w-1/1 mb-1 md:mb-1 pt-2">

                                @php
                                    $grauSatisfacao = getGrauSatisfacaoEntrega($entrega->bln_status);
                                @endphp

                                <div
                                    class="bg-gradient-to-r rounded from-{{ $grauSatisfacao['cor'] }}-500 text-xl text-{{ $grauSatisfacao['font'] }} p-1 pl-2 ">
                                    {{ $this->perspectiva->num_nivel_hierarquico_apresentacao }}.{{ $this->objetivoEstrategico->num_nivel_hierarquico_apresentacao }}.{{ $this->collectionPlanoAcao->num_nivel_hierarquico_apresentacao }}.{{ $entrega->num_nivel_hierarquico_apresentacao }}
                                </div>

                            </div>

                            @foreach ($this->estruturaTableParaEditar as $table)
                                @php
                                    $column_name = $table->column_name;
                                @endphp

                                <div class="w-full md:w-1/3 px-3 mb-2 md:mb-1 pt-3">

                                    <div class="col-span-6 sm:col-span-4">
                                        <x-jet-label class="text-lg text-stone-500"
                                            value="{{ nomeCampoNormalizado($column_name) }}" />

                                        @if ($this->liberarAcessoParaAtualizar)
                                            @if ($column_name != 'bln_status')
                                            <p class="text-xl">
                                                {{ $entrega->$column_name }}
                                            </p>
                                            @else
                                                @php
                                                    /** Incluir a verificação se está no prazo de início e fim da iniciativa */
                                                @endphp

                                                @if (now()->between($this->collectionPlanoAcao->dte_inicio, $this->collectionPlanoAcao->dte_fim))
                                                    {!! Form::select('bln_status', $this->status, $entrega->$column_name, [
                                                        'class' =>
                                                            'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-0',
                                                        'style' => 'height: 40px !important; padding-left: 10px !important; width: 90% !important;',
                                                        'autocomplete' => 'off',
                                                        'required' => 'required',
                                                        'wire:change.prevent' => "setBlnStatus('{$entrega->cod_entrega}', \$event.target.value)",
                                                    ]) !!}
                                                    <p class="text-xs text-sky-600 pt-2">
                                                        Selecione o status atual e o sistema irá gravar automaticamente.
                                                    </p>
                                                @else
                                                    <p class="text-xl">
                                                        {{ $entrega->$column_name }}
                                                    </p>
                                                    <p class="text-xs text-red-600 pt-2">
                                                        Você tem privilégio de gestão nesta Entrega, mas ela está fora
                                                        do período válido definido no Plano de Ação.
                                                    </p>
                                                @endif
                                            @endif
                                        @else
                                            <p class="text-xl">
                                                {{ $entrega->$column_name }}
                                            </p>
                                        @endif

                                    </div>

                                </div>
                            @endforeach

                        </div>
                    </div>
                    @php
                        $contEntrega++;
                    @endphp
                @endforeach

            </div>

        </div>

    </div>

</div>
