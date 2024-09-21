<div class="flex flex-wrap w-full text-lg md:text-sm pt-1 pb-3 pl-3 pr-3 rounded-md border-1 border-gray-100"
    style="font-size: 0.91rem!Important;">

    {{-- Início do(s) Indicador(es) ligados ao Plano de Ação --}}
    @include('livewire.plano-de-acao.indicador.index')
    {{-- Fim do(s) Indicador(es) ligados ao Plano de Ação --}}

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
                <x-jet-button wire:loading.attr="disabled" wire:click.prevent="$toggle('showModalInformacao')">
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
