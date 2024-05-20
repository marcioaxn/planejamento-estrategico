<x-slot name="header">
    <h2 class="font-semibold text-xl text-blue-800 leading-tight pl-3">
        Relatório de Gestores
    </h2>
</x-slot>
<div class="z-0" style="margin-top: 6px!Important; padding-top: 6px!Important;">

    <table id="" class="w-full text-sm text-left text-white dark:text-gray-400 border-separate z-0"
           style="font-size: 0.69rem!Important; width: 100%!Important;">
        <thead class="text-gray-700 uppercase bg-gray-500 dark:bg-gray-700 dark:text-gray-400">
        <tr class="bg-gray-500">
            <th style=""
                class="bg-gray-200 sticky top-0 px-3 py-0 text-gray-900 dark:text-gray-400">Objetivo Estratégico
            </th>
            <th style=""
                class="bg-gray-200 sticky top-0 px-3 py-0 text-gray-900 dark:text-gray-400">Plano de Ação
            </th>
            <th style=""
                class="bg-gray-200 sticky top-0 px-3 py-0 text-gray-900 dark:text-gray-400">Unidade
            </th>
            <th style=""
                class="bg-gray-200 sticky top-0 px-3 py-0 text-gray-900 dark:text-gray-400">Nome
            </th>
            <th style=""
                class="bg-gray-200 sticky top-0 px-3 py-0 text-gray-900 dark:text-gray-400">Função
            </th>
        </tr>
        </thead>

        <tbody>

        @foreach ($this->planoAcao as $result)

            <tr>

                <td class="px-6 py-4 text-gray-900 dark:text-gray-400 border "
                    style="min-width: 233px!Important; width: 233px!Important; max-width: 233px!Important; text-align: right !Important;">

                </td>

            </tr>

        @endforeach

        </tbody>

    </table>

</div>
