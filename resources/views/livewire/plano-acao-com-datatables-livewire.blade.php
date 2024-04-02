<x-slot name="header">
    <h2 class="font-semibold text-xl text-blue-800 leading-tight pl-3">
        Administração do Plano de Ação
    </h2>
</x-slot>
<div class="" style="margin-top: 6px!Important; padding-top: 6px!Important;">

    <form wire:submit.prevent="create" method="post">

        <div class="w-full px-2 sm:px-4 lg:px-3">

            <div class="flex flex-wrap w-full">

                <div class="w-full md:w-1/1 pr-3 mb-1 text-right">
                    <span class="text-gray-600 pr-1 text-sm">Incluir</span>
                    <div class="rounded-full h-6 w-6 flex items-center justify-center inline-flex items-center bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300 disabled:opacity-25 transition " style="cursor: pointer;" wire:click.prevent="abrirFecharForm()"><i id="iconAbrirFecharForm" class="<?php print($iconAbrirFechar) ?>"></i></div>
                </div>

            </div>

            <div id="divForm" class="flex items-center px-4 py-6 bg-white rounded-md bg-gray-100 bg-opacity-50 shadow-md" style="display: <?php print($this->abrirFecharForm) ?>;">

                <div class="flex flex-wrap w-full">

                    <div class="w-full md:w-1/1 mb-2">

                        <p><strong>Formulário de cadastro e edição</strong></p>

                    </div>

                    <div class="w-full md:w-2/3 px-3 mb-1 md:mb-0 pt-1">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="cod_pei" value="Planejamento Estratégico Integrado - PEI" />
                            {!! Form::select('cod_pei', $this->pei, null, ['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-0', 'style' => 'height: 40px!Important; padding-left: 10px!Important; width: 100% !Important;', 'placeholder' => 'Selecione', 'autocomplete' => 'off', 'required' => 'required', 'wire:model' => 'cod_pei']) !!}
                            <x-jet-input-error for="cod_pei" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-1/3 px-3 mb-1 md:mb-0 pt-1">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="cod_perspectiva" value="Perspectiva" />
                            {!! Form::select('cod_perspectiva', $this->perspectiva, null, ['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-0', 'style' => 'height: 40px!Important; padding-left: 10px!Important; width: 100% !Important;', 'placeholder' => 'Selecione', 'autocomplete' => 'off', 'required' => 'required', 'wire:model' => 'cod_perspectiva']) !!}
                            <div class="p-2 text-gray-500 text-xs md:list-disc">Os elementos desse campo só serão visíveis após a escolha do <strong>PEI</strong>.</div>
                            <x-jet-input-error for="cod_perspectiva" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-2/3 px-3 mb-1 md:mb-0 pt-1">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="cod_objetivo_estrategico" value="Objetivo Estratégico" />
                            {!! Form::select('cod_objetivo_estrategico', $this->objetivoEstragico, null, ['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-0', 'style' => 'height: 40px!Important; padding-left: 10px!Important; width: 100% !Important;', 'placeholder' => 'Selecione', 'autocomplete' => 'off', 'required' => 'required', 'wire:model' => 'cod_objetivo_estrategico']) !!}
                            <div class="p-2 text-gray-500 text-xs md:list-disc">Os elementos desse campo só serão visíveis após a escolha da <strong>Perspectiva</strong>.</div>
                            <x-jet-input-error for="cod_objetivo_estrategico" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-1/3 px-3 mb-1 md:mb-0 pt-1">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="cod_tipo_execucao" value="Tipo" />
                            {!! Form::select('cod_tipo_execucao', $this->tipoExecucao, null, ['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-0', 'style' => 'height: 40px!Important; padding-left: 10px!Important; width: 100% !Important;', 'placeholder' => 'Selecione', 'autocomplete' => 'off', 'required' => 'required', 'wire:model' => 'cod_tipo_execucao']) !!}
                            <x-jet-input-error for="cod_tipo_execucao" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-1/3 px-3 mb-1 md:mb-0 pt-1">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="num_nivel_hierarquico_apresentacao" value="Código" />
                            {!! Form::select('num_nivel_hierarquico_apresentacao', $this->niveis_hierarquico_apresentacao, null, ['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-0', 'style' => 'height: 40px!Important; padding-left: 10px!Important; width: 100% !Important;', 'placeholder' => 'Selecione', 'autocomplete' => 'off', 'required' => 'required', 'wire:model' => 'num_nivel_hierarquico_apresentacao']) !!}
                            <div class="p-2 text-gray-500 text-xs md:list-disc">Este campo será preenchido automaticamente após a escolha do objetivo estratégico, mas pode ser alterado se necessário.</div>
                            <x-jet-input-error for="num_nivel_hierarquico_apresentacao" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-2/3 px-3 mb-1 md:mb-0 pt-1">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="cod_organizacao" value="Unidade Responsável" />
                            {!! Form::select('cod_organizacao', $this->organization, null, ['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-0', 'style' => 'height: 40px!Important; padding-left: 10px!Important; width: 100% !Important;', 'placeholder' => 'Selecione', 'autocomplete' => 'off', 'required' => 'required', 'wire:model' => 'cod_organizacao']) !!}
                            <x-jet-input-error for="cod_organizacao" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-1/2 px-3 mb-1 md:mb-0 pt-1">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="dsc_plano_de_acao" value="Descrição" />
                            {!! Form::textarea('dsc_plano_de_acao',null,['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-2 pl-2','id' => 'dsc_plano_de_acao', 'placeholder' => 'Escreva a descrição do plano de ação', 'rows' => 2, 'required' => 'required', 'style' => 'width: 100%', 'wire:model' => 'dsc_plano_de_acao']) !!}
                            <x-jet-input-error for="dsc_plano_de_acao" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-1/2 px-3 mb-1 md:mb-0 pt-1">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="txt_principais_entregas" value="Principais entregas" />
                            {!! Form::textarea('txt_principais_entregas',null,['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-2 pl-2','id' => 'txt_principais_entregas', 'placeholder' => 'Escreva aqui a(s) principal(is) entrega(s)', 'rows' => 2, 'style' => 'width: 100%', 'wire:model' => 'txt_principais_entregas']) !!}
                            <x-jet-input-error for="txt_principais_entregas" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-1/4 px-3 mb-1 md:mb-0 pt-3">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="dte_inicio" value="Data de Início" />
                            {!! Form::date('dte_inicio',null,['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-2 pl-2 mr-0 pr-0 text-right','id' => 'dte_inicio', 'data-date-format' => 'DD MMMM YYYY', 'style' => 'width: 100%;', 'wire:model' => 'dte_inicio', 'autocomplete' => 'off', 'required' => 'required', 'min' => $this->primeiroAnoDoPeiSelecionado, 'max' => $this->ultimoAnoDoPeiSelecionado]) !!}
                            <x-jet-input-error for="dte_inicio" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-1/4 px-3 mb-1 md:mb-0 pt-3">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="dte_fim" value="Data de Conclusão" />
                            {!! Form::date('dte_fim',null,['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-2 pl-2 mr-0 pr-0 text-right','id' => 'dte_fim', 'data-date-format' => 'DD/MMM/YYYY', 'style' => 'width: 100%', 'wire:model' => 'dte_fim', 'autocomplete' => 'off', 'required' => 'required', 'min' => $this->primeiroAnoDoPeiSelecionado, 'max' => $this->ultimoAnoDoPeiSelecionado]) !!}
                            <x-jet-input-error for="dte_fim" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-1/4 px-3 mb-1 md:mb-0 pt-3">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="bln_status" value="Status" />
                            {!! Form::select('bln_status', ['Não iniciada' => 'Não iniciada','Em andamento' => 'Em andamento','Concluída' => 'Concluída'], $this->bln_status, ['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-0', 'style' => 'height: 40px!Important; padding-left: 10px!Important; width: 100% !Important;', 'autocomplete' => 'off', 'required' => 'required', 'wire:model' => 'bln_status']) !!}
                            <x-jet-input-error for="bln_status" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-1/4 px-3 mb-1 md:mb-0 pt-3">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="vlr_orcamento_previsto" value="Orçamento Previsto" />
                            {!! Form::text('vlr_orcamento_previsto',null,['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-2 pl-2 text-right','id' => 'vlr_orcamento_previsto', 'placeholder' => 'Digite aqui o valor previsto', 'style' => 'width: 100%', 'wire:model' => 'vlr_orcamento_previsto', 'autocomplete' => 'off']) !!}
                            <x-jet-input-error for="vlr_orcamento_previsto" class="mt-2" />
                        </div>

                        <script type="text/javascript">

                            $('#vlr_orcamento_previsto').mask('000.000.000.000.000,00', {reverse: true});

                        </script>

                    </div>

                    <div class="w-full md:w-1/2 px-3 mb-1 md:mb-0 pt-4">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="user_id_responsavel" value="Servidor(a) Responsável" />
                            {!! Form::select('user_id_responsavel', $this->usuariosResponsaveis, null, ['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-0', 'style' => 'height: 40px!Important; padding-left: 10px!Important; width: 100% !Important;', 'placeholder' => 'Selecione', 'autocomplete' => 'off', 'required' => 'required', 'wire:model' => 'user_id_responsavel']) !!}
                            <x-jet-input-error for="user_id_responsavel" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-1/2 px-3 mb-1 md:mb-0 pt-4">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="user_id_substituto" value="Servidor(a) Substituto(a)" />
                            {!! Form::select('user_id_substituto', $this->usuariosSubstitutos, null, ['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-0', 'style' => 'height: 40px!Important; padding-left: 10px!Important; width: 100% !Important;', 'placeholder' => 'Selecione', 'autocomplete' => 'off', 'wire:model' => 'user_id_substituto']) !!}
                            <x-jet-input-error for="user_id_substituto" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-1/1 px-3 mt-6 mb-3 md:mb-0 pt-1 text-right">

                        @if($this->editarForm == true)

                        <a class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring focus:ring-red-300 disabled:opacity-25 transition" href="javascript: void(0);" wire:click.prevent="cancelar()" >Cancelar</a>

                        <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" type="submit">Editar</button>

                        @else

                        <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" type="submit">Salvar</button>

                        @endif

                    </div>

                </div>

            </div>

        </form>

        <div class=" flex flex-wrap -mx-3 mb-6">

            <div class="w-full md:w-3/3 px-3 mb-6 md:mb-0 pt-3">

                <div class="border-b border-gray-200 shadow rounded-md">

                    <style type="text/css">

                        .dataTables_filter {
                            margin-top: 6px!Important;
                            padding-top: 6px!Important;

                            margin-bottom: 6px!Important;
                            padding-bottom: 6px!Important;
                        }

                        .dataTables_filter, input {
                            max-width: 275px!Important;
                        }

                    </style>

                    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.11.3/b-2.1.1/b-colvis-2.1.1/b-html5-2.1.1/b-print-2.1.1/fh-3.2.1/r-2.2.9/datatables.min.css"/>

                    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
                    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
                    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.11.3/b-2.1.1/b-colvis-2.1.1/b-html5-2.1.1/b-print-2.1.1/fh-3.2.1/r-2.2.9/datatables.min.js"></script>


                    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
                    <script type="text/javascript" charset="utf8"
                    src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>

                    <table id="dataTable" class="">
                        <thead class="bg-gray-50">

                            <tr class="shadow-lg">
                                <th class="p-8 text-xs text-gray-500" style="text-align: left!Important;">Descrição</th>
                                <th class="p-8 text-xs text-gray-500" style="text-align: left!Important;">Principais entregas</th>
                                <th class="p-8 text-xs text-gray-500" style="text-align: left!Important;">Unidade Responsável</th>
                                <th class="p-8 text-xs text-gray-500" style="text-align: left!Important;">Data de Início e de Conclusão</th>
                                <th class="p-8 text-xs text-gray-500" style="text-align: left!Important;">Status</th>
                                <th class="p-8 text-xs text-gray-500" style="text-align: right!Important;">Orçamento Previsto</th>
                                <th class="p-8 text-xs text-gray-500" style="text-align: left!Important;">Servidor(a) Responsável e Substituto(a)</th>
                                <th class="p-8 text-xs text-gray-500" style="text-align: left!Important;">Objetivo Estratégico</th>
                                <th class="p-8 text-xs text-gray-500" style="text-align: left!Important;">Ação</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">

                            @foreach ($this->planoAcao as $result)

                            <tr class="border border-gray-500">
                                <td class="p-2 px-5 py-3 text-sm text-gray-600 bg-blue-50 ">
                                    {{ $result->tipoExecucao->dsc_tipo_execucao }} {{ $result->num_nivel_hierarquico_apresentacao }}. {{ $result->dsc_plano_de_acao }}
                                </td>
                                <td class="p-2 px-5 py-3 text-sm text-gray-600">
                                    {{ $result->txt_principais_entregas }}
                                </td>
                                <td class="p-2 px-5 py-3 text-sm text-gray-600">
                                    {{ $result->unidade->sgl_organizacao }}<span class="text-gray-400">{!! $this->hierarquiaUnidade($result->unidade->cod_organizacao) !!}</span>
                                </td>
                                <td class="p-2 px-5 py-3 text-sm text-gray-600">
                                    <span class="text-gray-400">Início em</span> {{ converterData('EN','PTBR',$result->dte_inicio) }}<span class="text-gray-400"> - {{ formatarDataComCarbonForHumans($result->dte_inicio) }}</span> / <span class="text-gray-400">Conclusão em</span> {{ converterData('EN','PTBR',$result->dte_fim) }}<span class="text-gray-400"> - {{ formatarDataComCarbonForHumans($result->dte_fim) }}</span>
                                </td>
                                <td class="p-2 px-5 py-3 text-sm text-gray-600">
                                    {{ $result->bln_status }}
                                </td>
                                <td class="p-2 px-5 py-3 text-sm text-gray-600 text-right">
                                    {{ converteValor('MYSQL','PTBR',$result->vlr_orcamento_previsto) }}
                                </td>
                                <td class="p-2 px-5 py-3 text-sm text-gray-600">
                                    @foreach($result->servidorResponsavel as $responsavel)

                                    <span class="text-gray-400">Resp.:</span> {!! $responsavel->name !!}

                                    @endforeach
                                    /
                                    @foreach($result->servidorSubstituto as $subtituto)

                                    <span class="text-gray-400">Subs.:</span> {!! $subtituto->name !!}

                                    @endforeach
                                </td>
                                <td class="p-2 px-5 py-3 text-sm text-gray-600 w-1/5 ">
                                    {{ $result->objetivoEstrategico->num_nivel_hierarquico_apresentacao }}. {{ $result->objetivoEstrategico->dsc_objetivo_estrategico }}
                                </td>
                                <td class="p-2 px-5 py-3 text-sm text-gray-600 w-36 ">
                                    <a href="javascript: void(0);" wire:click.prevent="editForm('{!! $result->cod_plano_de_acao !!}')" onclick="javascript: document.documentElement.scrollTop = 0;"><i class="fas fa-edit text-green-600"></i></a>

                                    &nbsp;
                                    &nbsp;
                                    <button type="button" wire:click.prevent="deleteForm('{!! $result->cod_plano_de_acao !!}')"><i class="fas fa-trash-alt text-red-600"></i></button>

                                </td>
                            </tr>

                            @endforeach

                        </tbody>
                    </table>

                    <script type="text/javascript" charset="utf-8">

                      $(document).ready(function() {
                        var table = $('#dataTable').DataTable( {
                          "language": {
                            "url": "{{ asset('Portuguese-Brasil.json') }}",
                            "decimal": ",",
                            "thousands": "."
                        },
                        "order": [[0, "asc"]],
                        "lengthMenu": [[10,25,50, 100,-1], ["10 ","25 ","50 ", "100 ","Todos "]],
                        "paging": false,
                        "responsive": true,
                        "searching": true,
                        "autoWidth": true,
                        dom: 'Blfrtip',
                        buttons: [
                        {
                            extend: 'excelHtml5',
                            text: 'Excel',
                            visibility: true,
                            title: ''
                        },
                        {
                            extend: 'csv',
                            text: 'CSV',
                            charset: "UTF-8",
                            bom: true,
                            fieldSeparator: ';',
                            visibility: true,
                            title: ''
                        },
                        {
                            extend: 'colvis',
                            text: 'Colunas Visíveis',
                            visibility: true
                        }
                        ]
                    });

                    });

                </script>

            </div>

        </div>

    </div>

    <!-- Modal -->
    <x-jet-dialog-modal wire:model="showModalResultadoEdicao">
        <x-slot name="title">
            <strong>Importante</strong>
        </x-slot>

        <x-slot name="content">
            {!! $this->mensagemResultadoEdicao !!}
        </x-slot>

        <x-slot name="footer">
            <x-jet-button wire:click.prevent="$toggle('showModalResultadoEdicao')" wire:loading.attr="disabled">
                {{ __('Closer') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

    <!-- Modal -->
    <x-jet-dialog-modal wire:model="showModalDelete">
        <x-slot name="title">
            <strong>Excluir</strong>
        </x-slot>

        <x-slot name="content">
            {!! $this->mensagemDelete !!}
        </x-slot>

        <x-slot name="footer">
            <x-jet-button wire:click.prevent="$toggle('showModalDelete')" wire:loading.attr="disabled">
                {{ __('Closer') }}
            </x-jet-button>
            <x-jet-danger-button wire:click.prevent="$toggle('showModalDelete')" wire:loading.attr="disabled" wire:click.prevent="delete('{!! $this->cod_objetivo_estrategico !!}')">
                Sim, quero excluir
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>

</div>
