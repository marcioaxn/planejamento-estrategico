<div class="flex flex-wrap w-full text-lg md:text-sm pt-1 pb-3 pl-3 pr-3 rounded-md border-1 border-gray-100"
    style="font-size: 0.91rem!Important;">

    @if (!is_null($this->collectionPlanoAcao) && $this->collectionPlanosAcao->count() > 0)

        <div class="w-full md:w-12/12 border-b-2 border-gray-100 pt-2 pb-2 pl-1">

            <div
                class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-4 lg:grid-cols-2 xl:grid-cols-12 2xl:grid-cols-12 gap-2 mt-0">

                <?php $contPlanoAcao = 1;
                $somaPercentual = 0;
                $calculoGeralPlanoAno = 0; ?>

                @foreach ($this->collectionPlanosAcao as $resultPlanoAcao)
                    <?php $contIndicador = 0; ?>

                    <?php

                    $resultado = $this->calcularAcumuladoPlanoDeAcao($resultPlanoAcao->cod_plano_de_acao,$this->anoSelecionado);

                    if($resultPlanoAcao->indicadores->count() > 0) {

                    ?>

                    <a
                        href="{{ route('objetivo-estrategico', [
                            $this->ano,
                            '3ac5e10e-8960-4b7c-a1cf-455597c875a7',
                            $this->cod_organizacao,
                            $this->cod_perspectiva,
                            $this->cod_objetivo_estrategico,
                            $resultPlanoAcao->cod_plano_de_acao,
                        ]) }}">

                        <div class="text-lg text-center bg-{!! $resultado['grau_de_satisfacao'] !!}-500 text-white rounded-md border-2 border-{!! $resultado['grau_de_satisfacao'] !!}-50 border-opacity-25 shadow-md mb-2 cursor-pointer"
                            onclick="javascript: alterarPlanoAcao('<?php print $resultPlanoAcao->cod_plano_de_acao; ?>');">
                            <?php is_null($this->cod_plano_de_acao) && $contPlanoAcao == 1 ? print '<i class="fas fa-arrow-circle-right"></i> ' : print ''; ?><?php $resultPlanoAcao->cod_plano_de_acao == $this->cod_plano_de_acao ? print '<i class="fas fa-arrow-circle-right"></i> ' : print ''; ?>{!! $this->perspectiva->num_nivel_hierarquico_apresentacao !!}.{!! $this->objetivoEstrategico->num_nivel_hierarquico_apresentacao !!}.{!! $resultPlanoAcao->num_nivel_hierarquico_apresentacao !!}
                        </div>

                    </a>
                    <?php

                } else {

                    ?>

                    <a
                        href="{{ route('objetivo-estrategico', [
                            $this->ano,
                            $this->cod_organizacao,
                            $this->cod_perspectiva,
                            $this->cod_objetivo_estrategico,
                            $resultPlanoAcao->cod_plano_de_acao,
                        ]) }}">

                        <div class="text-lg text-center bg-gray-500 text-white rounded-md border-2 border-gray-50 border-opacity-25 shadow-md mb-1 cursor-pointer"
                            onclick="javascript: alterarPlanoAcao('<?php print $resultPlanoAcao->cod_plano_de_acao; ?>');">
                            <?php is_null($this->cod_plano_de_acao) && $contPlanoAcao == 1 ? print '<i class="fas fa-arrow-circle-right"></i> ' : print ''; ?><?php $resultPlanoAcao->cod_plano_de_acao == $this->cod_plano_de_acao ? print '<i class="fas fa-arrow-circle-right"></i> ' : print ''; ?>{!! $this->perspectiva->num_nivel_hierarquico_apresentacao !!}.{!! $this->objetivoEstrategico->num_nivel_hierarquico_apresentacao !!}.{!! $resultPlanoAcao->num_nivel_hierarquico_apresentacao !!}
                        </div>

                    </a>
                    <?php

                }

                $contPlanoAcao = $contPlanoAcao + 1;

                ?>
                @endforeach

            </div>

            <script>
                function alterarPlanoAcao(cod_plano_de_acao) {

                    @this.cod_plano_de_acao = cod_plano_de_acao;

                }
            </script>

        </div>

        <div class="w-full md:w-1/1 text-lg border-b-2 border-gray-100 pt-2 pb-2 pl-1">
            {!! $this->collectionPlanoAcao->tipoExecucao->dsc_tipo_execucao !!}:
            <strong>{!! $this->perspectiva->num_nivel_hierarquico_apresentacao !!}.{!! $this->objetivoEstrategico->num_nivel_hierarquico_apresentacao !!}.{!! $this->collectionPlanoAcao->num_nivel_hierarquico_apresentacao !!}.
                {!! $this->collectionPlanoAcao->dsc_plano_de_acao !!}</strong>
        </div>

        {{-- <div class="w-full md:w-1/1 text-lg border-b-2 border-gray-100 pt-2 pb-2 pl-1">
            Principais entregas: <strong>{{ $this->collectionPlanoAcao->txt_principais_entregas }}</strong>
        </div> --}}

        <div class="w-full md:w-3/6 text-lg border-b-2 border-gray-100 pt-2 pb-2 pl-1">Data de início em
            <strong>{{ converterData('EN', 'PTBR', $this->collectionPlanoAcao->dte_inicio) }}</strong><span
                class="text-gray-400">,
                {{ formatarDataComCarbonForHumans($this->collectionPlanoAcao->dte_inicio) }},</span> e a conclusão
            prevista para
            <strong>{{ converterData('EN', 'PTBR', $this->collectionPlanoAcao->dte_fim) }}</strong>
        </div>

        <div class="w-full md:w-1/6 text-lg border-b-2 border-gray-100 pt-2 pb-2 pl-1">
            Status: <strong>{{ $this->collectionPlanoAcao->bln_status }}</strong>
        </div>

        <div class="w-full md:w-2/6 text-lg border-b-2 border-gray-100 pt-2 pb-2 pl-1">
            Orçamento previsto: R$
            <strong>{{ converteValor('MYSQL', 'PTBR', $this->collectionPlanoAcao->vlr_orcamento_previsto) }}</strong>
        </div>

        <div class="w-full md:w-2/6 text-lg border-b-2 border-gray-100 pt-2 pb-2 pl-1">
            Unidade responsável: <strong>{{ $this->collectionPlanoAcao->unidade->sgl_organizacao }}</strong><span
                class="text-gray-400">{!! $this->hierarquiaUnidade($this->collectionPlanoAcao->unidade->cod_organizacao) !!}</span>
        </div>

        <div class="w-full md:w-2/6 text-lg border-b-2 border-gray-100 pt-2 pb-2 pl-1">
            Servidor(a) Responsável:
            <strong>
                @foreach ($this->collectionPlanoAcao->servidorResponsavel as $responsavel)
                    {!! $responsavel->name !!}

                    @auth

                        <?php

                        if (Auth::user()->id === $responsavel->id && Auth::user()->ativo == 1) {
                            $this->liberarAcessoParaAtualizar = true;
                        }

                        ?>

                    @endauth
                @endforeach
            </strong>
        </div>

        <div class="w-full md:w-2/6 text-lg border-b-2 border-gray-100 pt-2 pb-2 pl-1">
            Servidor(a) Substituto(a):
            <strong>
                @foreach ($this->collectionPlanoAcao->servidorSubstituto as $subtituto)
                    {!! $subtituto->name !!}

                    @auth

                        <?php

                        if (Auth::user()->id === $subtituto->id) {
                            $this->liberarAcessoParaAtualizar = true;
                        }

                        ?>

                    @endauth
                @endforeach
            </strong>
        </div>

        <div class="w-full md:w-1/1 mb-2"
            style="background-color: #DCDCC9 !Important; font-size: 0.071rem!Important; height: 0.061rem!Important;">

            &nbsp;

        </div>

        {{-- Início das Entregas ligadas ao Plano de Ação --}}
        @include('livewire.plano-de-acao.entregas.index')
        {{-- Fim das Entregas ligadas ao Plano de Ação --}}
    @else
        <div class="w-full md:w-1/1 text-red-700 border-b-2 border-red-300 pt-3 pb-3 pl-1">

            Não há registro de plano de ação e indicadores para esse objetivo estratégico

        </div>

    @endif

    <div class="px-3 py-2 pt-2 pl-2 pr-2">
        &nbsp;
    </div>

    <!-- Modal -->
    <x-jet-dialog-modal wire:model="showModalInformacao">
        <form wire:submit.prevent="create" method="post">
            <x-slot name="title">
                <strong>Importante</strong>
            </x-slot>

            <x-slot name="content">
                {!! $this->mensagemInformacao !!}
            </x-slot>

            <x-slot name="footer">
                <x-jet-button wire:loading.attr="disabled" wire:click.prevent="$toggle('showModalInformacao')"
                    onclick="javascript: location.reload();">
                    {{ __('Closer') }}
                </x-jet-button>
            </x-slot>
        </form>
    </x-jet-dialog-modal>

    <!-- Modal -->
    <x-jet-geral-modal wire:model="showModalIncluirPdf">
        <form method="POST" enctype="multipart/form-data" wire:submit.prevent="">
            <x-slot name="title">
                <strong>Incluir PDF</strong>
            </x-slot>

            <x-slot name="content">
                {!! $this->formIncluirPdf !!}

                <x-jet-input-error for="pdf" class="mt-2" />
                <x-jet-input-error for="txt_assunto" class="mt-2" />
                <div wire:loading wire:target="pdf">Uploading...</div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-button wire:click.prevent="$toggle('showModalIncluirPdf')" wire:loading.attr="disabled">
                    {{ __('Closer') }}
                </x-jet-button>
                <x-jet-danger-button wire:click.prevent="$toggle('showModalIncluirPdf')" wire:loading.attr="disabled"
                    wire:click.prevent="savePdf()">
                    Salvar
                </x-jet-danger-button>
            </x-slot>
        </form>
    </x-jet-geral-modal>

    <!-- Modal -->
    <x-jet-geral-modal wire:model="showModalResultadoEdicao">
        <form wire:submit.prevent="create" method="post">
            <x-slot name="title">
                <strong>Editar</strong>
            </x-slot>

            <x-slot name="content">
                {!! $this->mensagemResultadoEdicao !!}
                <x-jet-input-error for="vlr_realizado" class="mt-2" />
            </x-slot>

            <x-slot name="footer">
                <x-jet-button wire:click.prevent="$toggle('showModalResultadoEdicao')" wire:loading.attr="disabled">
                    {{ __('Closer') }}
                </x-jet-button>
                <x-jet-danger-button wire:click.prevent="$toggle('showModalResultadoEdicao')"
                    wire:loading.attr="disabled" wire:click.prevent="create()">
                    Salvar
                </x-jet-danger-button>
            </x-slot>
        </form>
    </x-jet-geral-modal>

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
