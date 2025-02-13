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
                    <div class="rounded-full h-6 w-6 flex items-center justify-center inline-flex items-center bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300 disabled:opacity-25 transition "
                        style="cursor: pointer;" wire:click.prevent="abrirFecharForm()"><i id="iconAbrirFecharForm"
                            class="<?php print $iconAbrirFechar; ?>"></i></div>
                </div>

            </div>

            <div id="divForm"
                class="flex items-center px-4 py-6 bg-white rounded-md bg-gray-100 bg-opacity-50 shadow-md"
                style="display: <?php print $this->abrirFecharForm; ?>;">

                <div class="flex flex-wrap w-full">

                    <div class="w-full md:w-1/1 mb-2">

                        <p><strong>Formulário de cadastro e edição</strong></p>

                    </div>

                    <div class="w-full md:w-2/3 px-3 mb-1 md:mb-0 pt-1">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="cod_pei" value="Planejamento Estratégico Integrado - PEI:" />
                            {!! Form::select('cod_pei', $this->pei, null, [
                                'class' =>
                                    'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-0',
                                'style' => 'height: 40px!Important; padding-left: 10px!Important; width: 100% !Important;',
                                'placeholder' => 'Selecione',
                                'autocomplete' => 'off',
                                'required' => 'required',
                                'wire:model' => 'cod_pei',
                            ]) !!}
                            <x-jet-input-error for="cod_pei" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-1/3 px-3 mb-1 md:mb-0 pt-1">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="cod_perspectiva" value="Perspectiva:" />
                            {!! Form::select('cod_perspectiva', $this->perspectiva, null, [
                                'class' =>
                                    'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-0',
                                'style' => 'height: 40px!Important; padding-left: 10px!Important; width: 100% !Important;',
                                'placeholder' => 'Selecione',
                                'autocomplete' => 'off',
                                'required' => 'required',
                                'wire:model' => 'cod_perspectiva',
                            ]) !!}
                            <div class="p-2 text-gray-500 text-xs md:list-disc">Os elementos desse campo só serão
                                visíveis após a escolha do PEI.</div>
                            <x-jet-input-error for="cod_perspectiva" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-2/3 px-3 mb-1 md:mb-0 pt-1">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="cod_objetivo_estrategico" value="Objetivo Estratégico" />
                            {!! Form::select('cod_objetivo_estrategico', $this->objetivoEstragico, null, [
                                'class' =>
                                    'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-0',
                                'style' => 'height: 40px!Important; padding-left: 10px!Important; width: 100% !Important;',
                                'placeholder' => 'Selecione',
                                'autocomplete' => 'off',
                                'required' => 'required',
                                'wire:model' => 'cod_objetivo_estrategico',
                            ]) !!}
                            <div class="p-2 text-gray-500 text-xs md:list-disc">Os elementos desse campo só serão
                                visíveis após a escolha da <strong>Perspectiva</strong>.</div>
                            <x-jet-input-error for="cod_objetivo_estrategico" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-1/3 px-3 mb-1 md:mb-0 pt-1">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="cod_tipo_execucao" value="Tipo" />
                            {!! Form::select('cod_tipo_execucao', $this->tipoExecucao, null, [
                                'class' =>
                                    'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-0',
                                'style' => 'height: 40px!Important; padding-left: 10px!Important; width: 100% !Important;',
                                'placeholder' => 'Selecione',
                                'autocomplete' => 'off',
                                'required' => 'required',
                                'wire:model' => 'cod_tipo_execucao',
                            ]) !!}
                            <x-jet-input-error for="cod_tipo_execucao" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-1/3 px-3 mb-1 md:mb-0 pt-1">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="num_nivel_hierarquico_apresentacao" value="Código" />
                            {!! Form::select('num_nivel_hierarquico_apresentacao', $this->niveis_hierarquico_apresentacao, null, [
                                'class' =>
                                    'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-0',
                                'style' => 'height: 40px!Important; padding-left: 10px!Important; width: 100% !Important;',
                                'placeholder' => 'Selecione',
                                'autocomplete' => 'off',
                                'required' => 'required',
                                'wire:model' => 'num_nivel_hierarquico_apresentacao',
                            ]) !!}
                            <div class="p-2 text-gray-500 text-xs md:list-disc">Este campo será preenchido
                                automaticamente após a escolha do objetivo estratégico, mas pode ser alterado se
                                necessário.</div>
                            <x-jet-input-error for="num_nivel_hierarquico_apresentacao" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-2/3 px-3 mb-1 md:mb-0 pt-1">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="cod_organizacao" value="Unidade Responsável" />
                            {!! Form::select('cod_organizacao', $this->organization, null, [
                                'class' =>
                                    'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-0',
                                'style' => 'height: 40px!Important; padding-left: 10px!Important; width: 100% !Important;',
                                'placeholder' => 'Selecione',
                                'autocomplete' => 'off',
                                'required' => 'required',
                                'wire:model' => 'cod_organizacao',
                            ]) !!}
                            <x-jet-input-error for="cod_organizacao" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-2/2 px-3 mb-1 md:mb-0 pt-1">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="dsc_plano_de_acao" value="Descrição" />
                            {!! Form::textarea('dsc_plano_de_acao', null, [
                                'class' =>
                                    'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-2 pl-2',
                                'id' => 'dsc_plano_de_acao',
                                'placeholder' => 'Escreva a descrição do plano de ação',
                                'rows' => 2,
                                'required' => 'required',
                                'style' => 'width: 100%',
                                'wire:model' => 'dsc_plano_de_acao',
                            ]) !!}
                            <x-jet-input-error for="dsc_plano_de_acao" class="mt-2" />
                        </div>

                    </div>

                    {{-- <div class="w-full md:w-1/2 px-3 mb-1 md:mb-0 pt-1">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="txt_principais_entregas" value="Principais entregas" />
                            {!! Form::textarea('txt_principais_entregas',null,['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-2 pl-2','id' => 'txt_principais_entregas', 'placeholder' => 'Escreva aqui a(s) principal(is) entrega(s)', 'rows' => 2, 'style' => 'width: 100%', 'wire:model' => 'txt_principais_entregas']) !!}
                            <x-jet-input-error for="txt_principais_entregas" class="mt-2" />
                        </div>

                    </div> --}}

                    <div class="w-full md:w-1/4 px-3 mb-1 md:mb-0 pt-3">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="dte_inicio" value="Data de Início" />
                            {!! Form::date('dte_inicio', null, [
                                'class' =>
                                    'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-2 pl-2 mr-0 pr-0 text-right',
                                'id' => 'dte_inicio',
                                'data-date-format' => 'DD MMMM YYYY',
                                'style' => 'width: 100%;',
                                'wire:model' => 'dte_inicio',
                                'autocomplete' => 'off',
                                'required' => 'required',
                                'min' => '2020-01-01',
                                'max' => $this->ultimoAnoDoPeiSelecionado,
                            ]) !!}
                            <x-jet-input-error for="dte_inicio" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-1/4 px-3 mb-1 md:mb-0 pt-3">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="dte_fim" value="Data de Conclusão" />
                            {!! Form::date('dte_fim', null, [
                                'class' =>
                                    'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-2 pl-2 mr-0 pr-0 text-right',
                                'id' => 'dte_fim',
                                'data-date-format' => 'DD/MMM/YYYY',
                                'style' => 'width: 100%',
                                'wire:model' => 'dte_fim',
                                'autocomplete' => 'off',
                                'required' => 'required',
                                'min' => $this->primeiroAnoDoPeiSelecionado,
                                'max' => $this->ultimoAnoDoPeiSelecionado,
                            ]) !!}
                            <x-jet-input-error for="dte_fim" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-1/4 px-3 mb-1 md:mb-0 pt-3">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="bln_status" value="Status" />
                            {!! Form::select(
                                'bln_status',
                                [
                                    'Cancelado' => 'Cancelado',
                                    'Concluído' => 'Concluído',
                                    'Em andamento' => 'Em andamento',
                                    'Não iniciado' => 'Não iniciado',
                                    'Suspenso' => 'Suspenso',
                                ],
                                null,
                                [
                                    'class' =>
                                        'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-0',
                                    'style' => 'height: 40px!Important; padding-left: 10px!Important; width: 100% !Important;',
                                    'autocomplete' => 'off',
                                    'required' => 'required',
                                    'wire:model' => 'bln_status',
                                ],
                            ) !!}
                            <x-jet-input-error for="bln_status" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-1/4 px-3 mb-1 md:mb-0 pt-3">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="vlr_orcamento_previsto" value="Orçamento Previsto" />
                            {!! Form::text('vlr_orcamento_previsto', null, [
                                'class' =>
                                    'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-2 pl-2 text-right',
                                'id' => 'vlr_orcamento_previsto',
                                'placeholder' => 'Digite aqui o valor previsto',
                                'style' => 'width: 100%',
                                'wire:model' => 'vlr_orcamento_previsto',
                                'autocomplete' => 'off',
                            ]) !!}
                            <x-jet-input-error for="vlr_orcamento_previsto" class="mt-2" />
                        </div>

                        <script type="text/javascript">
                            $('#vlr_orcamento_previsto').mask('000.000.000.000.000,00', {
                                reverse: true
                            });
                        </script>

                    </div>

                    <div class="w-full md:w-1/2 px-3 mb-1 md:mb-0 pt-4">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="user_id_responsavel" value="Servidor(a) Responsável" />
                            {!! Form::select('user_id_responsavel', $this->usuariosResponsaveis, null, [
                                'class' =>
                                    'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-0',
                                'style' => 'height: 40px!Important; padding-left: 10px!Important; width: 100% !Important;',
                                'placeholder' => 'Selecione',
                                'autocomplete' => 'off',
                                'required' => 'required',
                                'wire:model' => 'user_id_responsavel',
                            ]) !!}
                            <x-jet-input-error for="user_id_responsavel" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-1/2 px-3 mb-1 md:mb-0 pt-4">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="user_id_substituto" value="Servidor(a) Substituto(a)" />
                            {!! Form::select('user_id_substituto', $this->usuariosSubstitutos, null, [
                                'class' =>
                                    'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-0',
                                'style' => 'height: 40px!Important; padding-left: 10px!Important; width: 100% !Important;',
                                'placeholder' => 'Selecione',
                                'autocomplete' => 'off',
                                'wire:model' => 'user_id_substituto',
                            ]) !!}
                            <x-jet-input-error for="user_id_substituto" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-1/1 px-3 mt-6 mb-3 md:mb-0 pt-1 text-right">

                        @if ($this->editarForm == true)
                            <a class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring focus:ring-red-300 disabled:opacity-25 transition"
                                href="javascript: void(0);" wire:click.prevent="cancelar()">Cancelar</a>

                            <button
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
                                type="submit">Editar</button>
                        @else
                            <button
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
                                type="submit">Salvar</button>
                        @endif

                    </div>

                </div>

            </div>

    </form>

    <div class=" flex flex-wrap -mx-3 mb-6">

        <div class="w-full md:w-3/3 px-3 mb-6 md:mb-0 pt-3">

            <div class="border-b border-gray-200 shadow rounded-md">

                <table class="divide-gray-300 min-w-full border-collapse block md:table ">
                    <thead class="hidden shadow-lg inset-x-0 top-16 block md:table-header-group">
                        <tr class="shadow-lg">
                            <th class="bg-gray-400 px-1 py-2 text-xs text-white font-bold md:border md:border-gray-100 text-left block md:table-cell"
                                style="text-align: left!Important;">Descrição</th>
                            {{-- <th class="bg-gray-400 px-1 py-2 text-xs text-white font-bold md:border md:border-gray-100 text-left block md:table-cell" style="text-align: left!Important;">Principais entregas</th> --}}
                            <th class="bg-gray-400 px-1 py-2 text-xs text-white font-bold md:border md:border-gray-100 text-left block md:table-cell"
                                style="text-align: left!Important;">Unidade Responsável</th>
                            <th class="bg-gray-400 px-1 py-2 text-xs text-white font-bold md:border md:border-gray-100 text-left block md:table-cell"
                                style="text-align: left!Important;">Data de Início e de Conclusão</th>
                            <th class="bg-gray-400 px-1 py-2 text-xs text-white font-bold md:border md:border-gray-100 text-left block md:table-cell"
                                style="text-align: left!Important;">Status</th>
                            <th class="bg-gray-400 px-1 py-2 text-xs text-white font-bold md:border md:border-gray-100 text-right block md:table-cell"
                                style="text-align: right!Important;">Orçamento Previsto</th>
                            <th class="bg-gray-400 px-1 py-2 text-xs text-white font-bold md:border md:border-gray-100 text-left block md:table-cell"
                                style="text-align: left!Important;">Servidor(a) Responsável e Substituto(a)</th>
                            <th class="bg-gray-400 px-1 py-2 text-xs text-white font-bold md:border md:border-gray-100 text-left block md:table-cell"
                                style="text-align: left!Important;">Objetivo Estratégico</th>
                            <th class="bg-gray-400 px-1 py-2 text-xs text-white font-bold md:border md:border-gray-100 text-left block md:table-cell"
                                style="text-align: left!Important;">Ação</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-300 block md:table-row-group">

                        @foreach ($this->planoAcao as $result)
                            <tr class="border border-gray-500 md:border-none block md:table-row">
                                <td
                                    class="p-2 md:border md:border-gray-100 text-left block md:table-cell py-3 text-sm text-gray-600 bg-blue-50 ">
                                    {{ $result->tipoExecucao->dsc_tipo_execucao }}
                                    {{ $result->num_nivel_hierarquico_apresentacao }}. {{ $result->dsc_plano_de_acao }}
                                </td>
                                {{-- <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell py-3 text-sm text-gray-600">
                                    {{ $result->txt_principais_entregas }}
                                </td> --}}
                                <td
                                    class="p-2 md:border md:border-gray-100 text-left block md:table-cell py-3 text-sm text-gray-600">
                                    {{ $result->unidade->sgl_organizacao }}<span
                                        class="text-gray-400">{!! $this->hierarquiaUnidade($result->unidade->cod_organizacao) !!}</span>
                                </td>
                                <td
                                    class="p-2 md:border md:border-gray-100 text-left block md:table-cell py-3 text-sm text-gray-600">
                                    <span class="text-gray-400">Início em</span>
                                    {{ converterData('EN', 'PTBR', $result->dte_inicio) }}<span class="text-gray-400"> -
                                        {{ formatarDataComCarbonForHumans($result->dte_inicio) }}</span> / <span
                                        class="text-gray-400">Conclusão em</span>
                                    {{ converterData('EN', 'PTBR', $result->dte_fim) }}
                                </td>
                                <td
                                    class="p-2 md:border md:border-gray-100 text-left block md:table-cell py-3 text-sm text-gray-600">
                                    {{ $result->bln_status }}
                                </td>
                                <td
                                    class="p-2 md:border md:border-gray-100 text-left block md:table-cell py-3 text-sm text-gray-600 text-right">
                                    {{ converteValor('MYSQL', 'PTBR', $result->vlr_orcamento_previsto) }}
                                </td>
                                <td
                                    class="p-2 md:border md:border-gray-100 text-left block md:table-cell py-3 text-sm text-gray-600">
                                    @foreach ($result->servidorResponsavel as $responsavel)
                                        <span class="text-gray-400">Resp.:</span> {!! $responsavel->name !!}
                                    @endforeach

                                    @foreach ($result->servidorSubstituto as $subtituto)
                                        / <span class="text-gray-400">Subs.:</span> {!! $subtituto->name !!}
                                    @endforeach
                                </td>
                                <td
                                    class="p-2 md:border md:border-gray-100 text-left block md:table-cell py-3 text-sm text-gray-600 ">
                                    {{ $result->objetivoEstrategico->num_nivel_hierarquico_apresentacao }}.
                                    {{ $result->objetivoEstrategico->dsc_objetivo_estrategico }}
                                </td>
                                <td
                                    class="p-2 md:border md:border-gray-100 text-left block md:table-cell py-3 text-sm text-gray-600 w-36 ">

                                    @if ($result->acoesRealizadas->count() > 0)
                                        <?php

                                        $corpoModalAudit = '';

                                        $corpoModalAudit .= '<p class="text-gray-500 pl-2">Em: <strong>' . $result->tipoExecucao->dsc_tipo_execucao . ' ' . $result->num_nivel_hierarquico_apresentacao . '. ' . $result->dsc_plano_de_acao . '</strong></p><br><table class="divide-gray-300 min-w-full border-collapse" style="font-size: 0.8rem!Important;"><thead><tr class=""><td class="px-2 py-2 border border-gray-200">#</td><td class="px-2 py-2 border border-gray-200">Ação</td><td class="px-2 py-2 border border-gray-200">Quem?</td><td class="px-2 py-2 border border-gray-200">Quando?</td></tr></thead><tbody>';

                                        $contAcao = 1;

                                        foreach ($result->acoesRealizadas as $resultadoAcao) {
                                            $corpoModalAudit .= '<tr><td class="px-2 py-2 border border-gray-200">' . $contAcao . '</td><td class="px-2 py-2 border border-gray-200">' . $resultadoAcao->acao . '</td><td class="px-2 py-2 border border-gray-200">' . $resultadoAcao->usuario->name . '</td><td class="px-2 py-2 border border-gray-200">' . formatarDataComCarbonForHumans($resultadoAcao->created_at) . ' em ' . formatarTimeStampComCarbonParaBR($resultadoAcao->created_at) . '</td></tr>';

                                            $contAcao = $contAcao + 1;
                                        }

                                        $corpoModalAudit .= '</tbody></table>';

                                        ?>

                                        <button type="button"
                                            wire:click.prevent="audit('{!! $result->cod_plano_de_acao !!}')"><i
                                                class="fas fa-eye text-gray-600"></i></button>
                                        &nbsp;
                                        &nbsp;
                                    @endif

                                    <a href="javascript: void(0);"
                                        wire:click.prevent="editForm('{!! $result->cod_plano_de_acao !!}')"
                                        onclick="javascript: document.documentElement.scrollTop = 0;"><i
                                            class="fas fa-edit text-green-600"></i></a>

                                    &nbsp;
                                    &nbsp;
                                    <button type="button"
                                        wire:click.prevent="deleteForm('{!! $result->cod_plano_de_acao !!}')"><i
                                            class="fas fa-trash-alt text-red-600"></i></button>

                                </td>
                            </tr>
                        @endforeach

                    </tbody>

                </table>

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
            <x-jet-danger-button wire:click.prevent="$toggle('showModalDelete')" wire:loading.attr="disabled"
                wire:click.prevent="delete('{!! $this->cod_plano_de_acao !!}')">
                Sim, quero excluir
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>

    <!-- Modal -->
    <x-jet-geral-modal wire:model="showModalAudit">
        <x-slot name="title">
            <strong>Ações Realizadas</strong>
        </x-slot>

        <x-slot name="content">
            {!! $this->mensagemDelete !!}
        </x-slot>

        <x-slot name="footer">
            <x-jet-button wire:click.prevent="$toggle('showModalAudit')" wire:loading.attr="disabled">
                {{ __('Closer') }}
            </x-jet-button>
        </x-slot>
    </x-jet-geral-modal>

</div>
