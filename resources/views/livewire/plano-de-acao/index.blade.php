<div class="mb-4 border-b border-gray-200 dark:border-gray-700">
    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab"
        data-tabs-toggle="#default-tab-content" role="tablist">
        <li class="me-2" role="presentation">
            <a href="" class="inline-block p-4 border-b-2 rounded-t-lg text-blue-600 hover:text-blue-600 dark:text-blue-500 dark:hover:text-blue-500 border-blue-600 dark:border-blue-500"
                id="profile-tab" >Iniciativas/Ações/Projetos</a>
        </li>
        <li class="me-2" role="presentation">
            <a href="" class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                id="dashboard-tab">Indicadores dos Objetivos Estratégicos</a>
        </li>
    </ul>
</div>
<div id="default-tab-content">

    <div class="p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="profile" role="tabpanel"
        aria-labelledby="profile-tab">

        @include('livewire.plano-de-acao.acao-iniciativa-projeto')

    </div>

</div>
