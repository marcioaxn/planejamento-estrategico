<div class="mb-4 border-b border-gray-200 dark:border-gray-700">
    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab"
        data-tabs-toggle="#default-tab-content" role="tablist">
        
        <li class="me-2" role="presentation">
            <a href="{{ route('objetivo-estrategico', [
                $this->ano,
                'e37b40bf-4852-4fc7-8d0a-1cb6243ae9b6',
                $this->cod_organizacao,
                $this->cod_perspectiva,
                $this->cod_objetivo_estrategico,
            ]) }}"
                class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                id="dashboard-tab">Indicador(es) do Objetivo Estratégico</a>
        </li>

        <li class="me-2" role="presentation">
            <a href="{{ route('objetivo-estrategico', [
                $this->ano,
                '3ac5e10e-8960-4b7c-a1cf-455597c875a7',
                $this->cod_organizacao,
                $this->cod_perspectiva,
                $this->cod_objetivo_estrategico,
            ]) }}"
                class="inline-block p-4 border-b-2 rounded-t-lg text-blue-600 hover:text-blue-600 dark:text-blue-500 dark:hover:text-blue-500 border-blue-600 dark:border-blue-500"
                id="profile-tab">Iniciativas/Ações/Projetos</a>
        </li>
        
    </ul>
</div>
<div id="default-tab-content">

    <div class="p-4 rounded-lg" id="profile" role="tabpanel"
        aria-labelledby="profile-tab">

        @include('livewire.plano-de-acao.acao-iniciativa-projeto')

    </div>

</div>
