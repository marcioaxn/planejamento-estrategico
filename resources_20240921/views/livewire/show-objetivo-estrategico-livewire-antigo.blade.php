<div class="pt-3 pb-3 pl-1 pr-1">

    <div class="flex flex-wrap w-full text-base md:text-sm pt-1 pb-3 pl-3 pr-3 rounded-md border-1 border-gray-100">

        <div class="w-full md:w-1/1">

            <div class="pt-0 pb-1 pl-3 pr-3 bg-white rounded-md border-2 border-gray-300 border-opacity-25 text-gray-600 text-lg items-center font-semibold text-lg "
                style="text-align: left!Important;">
                Plano de Ação
            </div>

        </div>

        <div class="w-full md:w-1/1 pt-0 pb-0">

            <div class="col-span-6 sm:col-span-4">
                {!! Form::select('cod_organizacao', $this->organization, null, [
                    'class' =>
                        'w-full pl-3 border-2 border-gray-300 border-opacity-25 font-semibold text-sm sm:text-base focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 text-blue-500 text-center pt-1 h-10',
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

    <div class="flex flex-wrap w-full text-base md:text-sm pt-1 pb-3 pl-3 pr-3 rounded-md border-1 border-gray-100"
        style="font-size: 0.91rem!Important;">

        <div class="w-full md:w-1/12 border-b-2 border-gray-100 pt-1 pb-2 pl-1">
            Perspectiva:
        </div>

        <div class="w-full md:w-11/12 border-b-2 border-gray-100 pt-1 pb-2 pl-1">
            <strong>{!! $this->perspectiva->num_nivel_hierarquico_apresentacao !!}. {!! $this->perspectiva->dsc_perspectiva !!}</strong>
        </div>

        <div class="w-full md:w-1/1 mb-1"
            style="background-color: #DCDCC9 !Important; font-size: 0.1rem!Important; height:0.079rem!Important;">

            &nbsp;

        </div>

        <div class="w-full md:w-1/12 border-b-2 border-gray-100 pt-1 pb-2 pl-1">
            Objetivo Estratégico:
        </div>

        <style type="text/css">
            select {
                text-align-last: left;
            }
        </style>

        <div class="w-full md:w-11/12 border-b-2 border-gray-100 text-left pl-0">
            {!! Form::select('cod_objetivo_estrategico', $this->objetivoEstragico, null, [
                'class' =>
                    'w-full text-left pl-1 border-0 border-white border-opacity-25 font-semibold text-sm sm:text-base focus:border-indigo-300 focus:ring focus:ring-gray-50 focus:ring-opacity-50 h-7 text-black rounded-md text-left cursor-pointer',
                'autocomplete' => 'off',
                'required' => 'required',
                'wire:model' => 'cod_objetivo_estrategico',
                'onchange' => 'javascript: alterarUrlCodObjetivoEstrategico(this.value);',
            ]) !!}
        </div>

        <script>
            function alterarUrlCodObjetivoEstrategico(cod_objetivo_estrategico) {

                var url_antiga = window.location.pathname;

                var cod_objetivo_estrategico_antigo = @this.cod_objetivo_estrategico;

                var nova_url = url_antiga.replace(cod_objetivo_estrategico_antigo, cod_objetivo_estrategico);

                var origin = window.location.origin;

                window.location = origin + nova_url;


            }
        </script>

        <div class="rounded border w-screen w-1/2 mx-auto mt-4">
            <!-- Tabs -->
            <ul id="tabs" class="inline-flex pt-2 px-1 w-full border-b">
                <li class="bg-white px-4 text-gray-800 font-semibold py-2 rounded-t border-t border-r border-l -mb-px">
                    <a id="default-tab" href="#first">
                        Indicador do Objetivo Estratégico
                    </a>
                </li>
                <li class="px-4 text-gray-800 font-semibold py-2 rounded-t">
                    <a href="#second">
                        Plano de Ação
                    </a>
                </li>
            </ul>

            <!-- Tab Contents -->
            <div id="tab-contents">
                <div id="first" class="p-4">
                    @include('livewire.plano-de-acao.indicador')
                </div>
                <div id="second" class="hidden p-4">
                    @include('livewire.plano-de-acao.acao-iniciativa-projeto')
                </div>
            </div>
        </div>

        <script>
            let tabsContainer = document.querySelector("#tabs");

            let tabTogglers = tabsContainer.querySelectorAll("#tabs a");

            console.log(tabTogglers);

            tabTogglers.forEach(function(toggler) {
                toggler.addEventListener("click", function(e) {
                    e.preventDefault();

                    let tabName = this.getAttribute("href");

                    let tabContents = document.querySelector("#tab-contents");

                    for (let i = 0; i < tabContents.children.length; i++) {

                        tabTogglers[i].parentElement.classList.remove("border-t", "border-r", "border-l",
                            "-mb-px", "bg-white");
                        tabContents.children[i].classList.remove("hidden");
                        if ("#" + tabContents.children[i].id === tabName) {
                            continue;
                        }
                        tabContents.children[i].classList.add("hidden");

                    }
                    e.target.parentElement.classList.add("border-t", "border-r", "border-l", "-mb-px",
                        "bg-white");
                });
            });
        </script>

    </div>

    <div class="px-3 py-2 pt-2 pl-2 pr-2">

        <div>

            <p class="mt-4 mb-1 pl-1">Legenda:</p>

        </div>

        <div
            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-5 2xl:grid-cols-5 gap-2 mt-0">

            {!! $this->grau_satisfacao !!}

        </div>

    </div>

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

</div>
