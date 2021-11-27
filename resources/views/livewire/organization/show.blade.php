<x-slot name="header">
    <h2 class="font-semibold text-xl text-blue-800 leading-tight">
        Administração das Unidades da Organização
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

            <div id="divForm" class="flex items-center px-4 py-6 bg-white rounded-md bg-indigo-50 bg-opacity-50 shadow-md" style="display: <?php print($this->abrirFecharForm) ?>;">

                <div class="flex flex-wrap w-full">

                    <div class="w-full md:w-1/1 mb-2">

                        <p><strong>Formulário de cadastro e edição</strong></p>

                    </div>

                    <div class="w-full md:w-2/3 px-3 mb-6 md:mb-0 pt-3">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="nom_organizacao" value="Nome da Unidade" />
                            {!! Form::text('nom_organizacao', null, ['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-1', 'style' => 'width: 100% !Important;', 'autocomplete' => 'off', 'required' => 'required', 'wire:model' => 'nom_organizacao']) !!}
                            <x-jet-input-error for="nom_organizacao" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0 pt-3">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="sgl_organizacao" value="Sigla da Unidade" />
                            {!! Form::text('sgl_organizacao', null, ['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-1', 'style' => 'width: 100% !Important;', 'autocomplete' => 'off', 'required' => 'required', 'wire:model' => 'sgl_organizacao']) !!}
                            <x-jet-input-error for="sgl_organizacao" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-2/3 px-3 mb-6 md:mb-0 pt-3">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="sgl_organizacao" value="Vinculada ou Subordinada a qual Unidade?" />
                            {!! Form::select('rel_cod_organizacao', $rel_cod_organizacao_lista, null, ['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-1', 'style' => 'height: 40px!Important; padding-left: 10px!Important; width: 100% !Important;', 'placeholder' => 'Selecione', 'autocomplete' => 'off', 'wire:model' => 'rel_cod_organizacao']) !!}
                            <div class="p-2 text-gray-500 text-xs md:list-disc">Caso a Unidade que esteja cadastrando seja a base da Organização, por exemplo a Presidência da República, não é necessário o preenchimento desse campo.</div>
                            <x-jet-input-error for="sgl_organizacao" class="mt-2" />
                        </div>

                    </div>

                    <div class="w-full md:w-1/3 px-3 mt-6 mb-6 md:mb-0 pt-3">

                        @if($this->editarForm == true)

                        <a class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring focus:ring-red-300 disabled:opacity-25 transition" href="javascript: void(0);" wire:click.prevent="cancelar()" >Cancelar</a>

                        <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" type="submit">Editar</button>

                        @else

                        <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" type="submit">Salvar</button>

                        @endif

                    </div>

                </div>

            </form>

        </div>

        <div class=" flex flex-wrap -mx-3 mb-6">

            <div class="w-full md:w-3/3 px-3 mb-6 md:mb-0 pt-3">

                <div class="border-b border-gray-200 shadow rounded-md">

                    <table class="divide-gray-300 min-w-full border-collapse block md:table ">
                        <thead class="hidden shadow-lg inset-x-0 top-16 block md:table-header-group">
                            <tr class="shadow-lg">
                                <th class="bg-gray-400 px-6 py-2 pl-3 text-xs text-white font-bold md:border md:border-gray-100 text-left block md:table-cell" style="text-align: left!Important;">Unidade</th>
                                <th class="bg-gray-400 px-6 py-2 text-xs text-white font-bold md:border md:border-gray-100 text-left block md:table-cell" style="text-align: left!Important;">Sigla</th>
                                <th class="bg-gray-400 px-6 py-2 text-xs text-white font-bold md:border md:border-gray-100 text-left block md:table-cell" style="text-align: left!Important;">Ação</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-300 block md:table-row-group">

                            @foreach ($organization as $result)

                            <tr class="border border-gray-500 md:border-none block md:table-row">
                                <td class="md:border md:border-gray-100 text-left block md:table-cell px-5 py-3 pl-3 text-sm text-gray-600">
                                    <strong>{{ $result->nom_organizacao }}</strong>
                                </td>
                                <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell px-5 py-3 text-sm text-gray-600">
                                    <strong>{{ $result->sgl_organizacao }}</strong>{!! $this->hierarquiaUnidade($result->cod_organizacao) !!}
                                </td>
                                <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell px-5 py-3 text-sm text-gray-600">
                                    <a href="javascript: void(0);" wire:click.prevent="editForm('{!! $result->cod_organizacao !!}')" onclick="javascript: document.documentElement.scrollTop = 0;"><i class="fas fa-edit text-green-600"></i></a>
                                    @if($result->deshierarquia()->count() <= 0)
                                    &nbsp;
                                    &nbsp;
                                    <button type="button" onclick="toggleModal('mymodaltop{!! $result->cod_organizacao !!}')"><i class="fas fa-trash-alt text-red-600"></i></button>

                                    <!-- Modal -->
                                    <div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="mymodaltop{!! $result->cod_organizacao !!}">
                                      <div class="mb-6 bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-sm sm:max-w-md sm:max-w-lg sm:max-w-xl sm:max-w-2xl">
                                        <!--content-->
                                        <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
                                            <!--header-->
                                            <div class="flex items-start justify-between p-2 pl-5 border-b border-solid border-gray-200 rounded-t ">
                                                <h3 class="text-2xl font-semibold text-gray-600">Excluir Unidade</h3>
                                                <button class="p-1 ml-auto bg-transparent border-0 text-gray-300 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('mymodaltop{!! $result->cod_organizacao !!}')">
                                                    <span class="bg-transparent h-6 w-6 text-2xl block outline-none focus:outline-none">
                                                        <i class="fas fa-times"></i>
                                                    </span>
                                                </button>
                                            </div>
                                            <!--body-->
                                            <div class="relative p-3 pl-6 flex-auto">

                                                <p class="my-2 text-gray-500 text-lg leading-relaxed">Unidade: <strong>{{ $result->nom_organizacao }}</strong></p>
                                                <p class="my-2 text-gray-500 text-lg leading-relaxed">Sigla: <strong>{{ $result->sgl_organizacao }}</strong></p>
                                                <p class="my-2 text-gray-500 text-lg font-semibold leading-relaxed text-red-600">Quer, realmente, excluir essa Unidade?</p>

                                            </div>
                                            <!--footer-->
                                            <div class="flex items-center justify-end p-3 border-t border-solid border-gray-200 rounded-b ">

                                                <a class="inline-flex items-center px-2 py-2 bg-gray-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition mr-2 pr-2" href="javascript: void(0);" onclick="toggleModal('mymodaltop{!! $result->cod_organizacao !!}')" >Cancelar</a>
                                                <button class="inline-flex items-center px-2 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" type="button" wire:click.prevent="delete('{!! $result->cod_organizacao !!}')" onclick="toggleModal('mymodaltop{!! $result->cod_organizacao !!}')">Sim, quero excluir</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="hidden opacity-70 fixed inset-0 z-40 bg-black" id="mymodaltop{!! $result->cod_organizacao !!}-backdrop"></div>
                                @else
                                &nbsp;
                                &nbsp;
                                <button type="button"><i class="fas fa-trash-alt text-gray-300"></i></button>
                                @endif

                            </td>
                        </tr>

                        @foreach($organizationChild as $resultChild1)

                        @if($result->cod_organizacao == $resultChild1->rel_cod_organizacao)

                        <tr class="border border-gray-500 md:border-none block md:table-row">
                            <td class="md:border md:border-gray-100 text-left block md:table-cell pl-5 text-sm text-gray-600">
                                {{ $resultChild1->nom_organizacao }}
                            </td>
                            <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell px-5 py-3 text-sm text-gray-600">
                                <strong>{{ $resultChild1->sgl_organizacao }}</strong>{!! $this->hierarquiaUnidade($resultChild1->cod_organizacao) !!}
                            </td>
                            <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell px-5 py-3 text-sm text-gray-600">
                                <a href="javascript: void(0);" wire:click.prevent="editForm('{!! $resultChild1->cod_organizacao !!}')" onclick="javascript: document.documentElement.scrollTop = 0;"><i class="fas fa-edit text-green-600"></i></a>

                                @if($resultChild1->deshierarquia()->count() <= 0)
                                &nbsp;
                                &nbsp;
                                <button type="button" onclick="toggleModal('mymodaltop{!! $resultChild1->cod_organizacao !!}')"><i class="fas fa-trash-alt text-red-600"></i></button>

                                <!-- Modal -->
                                <div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="mymodaltop{!! $resultChild1->cod_organizacao !!}">
                                  <div class="mb-6 bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-sm sm:max-w-md sm:max-w-lg sm:max-w-xl sm:max-w-2xl">
                                    <!--content-->
                                    <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
                                        <!--header-->
                                        <div class="flex items-start justify-between p-2 pl-5 border-b border-solid border-gray-200 rounded-t ">
                                            <h3 class="text-2xl font-semibold text-gray-600">Excluir Unidade</h3>
                                            <button class="p-1 ml-auto bg-transparent border-0 text-gray-300 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('mymodaltop{!! $resultChild1->cod_organizacao !!}')">
                                                <span class="bg-transparent h-6 w-6 text-2xl block outline-none focus:outline-none">
                                                    <i class="fas fa-times"></i>
                                                </span>
                                            </button>
                                        </div>
                                        <!--body-->
                                        <div class="relative p-3 pl-6 flex-auto">

                                            <p class="my-2 text-gray-500 text-lg leading-relaxed">Unidade: <strong>{{ $resultChild1->nom_organizacao }}</strong></p>
                                            <p class="my-2 text-gray-500 text-lg leading-relaxed">Sigla: <strong>{{ $resultChild1->sgl_organizacao }}</strong><span class="text-gray-400">/{{ $result->sgl_organizacao }}</span></p>
                                            <p class="my-2 text-gray-500 text-lg font-semibold leading-relaxed text-red-600">Quer, realmente, excluir essa Unidade?</p>

                                        </div>
                                        <!--footer-->
                                        <div class="flex items-center justify-end p-3 border-t border-solid border-gray-200 rounded-b ">

                                            <a class="inline-flex items-center px-2 py-2 bg-gray-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition mr-2 pr-2" href="javascript: void(0);" onclick="toggleModal('mymodaltop{!! $resultChild1->cod_organizacao !!}')" >Cancelar</a>
                                            <button class="inline-flex items-center px-2 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" type="button" wire:click.prevent="delete('{!! $resultChild1->cod_organizacao !!}')" onclick="toggleModal('mymodaltop{!! $resultChild1->cod_organizacao !!}')">Sim, quero excluir</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="hidden opacity-70 fixed inset-0 z-40 bg-black" id="mymodaltop{!! $resultChild1->cod_organizacao !!}-backdrop"></div>
                            @else
                            &nbsp;
                            &nbsp;
                            <button type="button"><i class="fas fa-trash-alt text-gray-300"></i></button>
                            @endif

                        </td>
                    </tr>

                    @foreach ($resultChild1->deshierarquia as $resultChild2)

                    @if($resultChild1->cod_organizacao == $resultChild2->rel_cod_organizacao)
                    <tr class="border border-gray-500 md:border-none block md:table-row">
                        <td class="md:border md:border-gray-100 text-left block md:table-cell px-5 py-3 pl-7 text-sm text-gray-600">
                            {{ $resultChild2->nom_organizacao }}
                        </td>
                        <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell px-5 py-3 text-sm text-gray-600">
                            <strong>{{ $resultChild2->sgl_organizacao }}</strong>{!! $this->hierarquiaUnidade($resultChild2->cod_organizacao) !!}
                        </td>
                        <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell px-5 py-3 text-sm text-gray-600">
                            <a href="javascript: void(0);" wire:click.prevent="editForm('{!! $resultChild2->cod_organizacao !!}')" onclick="javascript: document.documentElement.scrollTop = 0;"><i class="fas fa-edit text-green-600"></i></a>

                            @if($resultChild2->deshierarquia()->count() <= 0)
                            &nbsp;
                            &nbsp;
                            <button type="button" onclick="toggleModal('mymodaltop{!! $resultChild2->cod_organizacao !!}')"><i class="fas fa-trash-alt text-red-600"></i></button>

                            <!-- Modal -->
                            <div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="mymodaltop{!! $resultChild2->cod_organizacao !!}">
                              <div class="mb-6 bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-sm sm:max-w-md sm:max-w-lg sm:max-w-xl sm:max-w-2xl">
                                <!--content-->
                                <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
                                    <!--header-->
                                    <div class="flex items-start justify-between p-2 pl-5 border-b border-solid border-gray-200 rounded-t ">
                                        <h3 class="text-2xl font-semibold text-gray-600">Excluir Unidade</h3>
                                        <button class="p-1 ml-auto bg-transparent border-0 text-gray-300 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('mymodaltop{!! $resultChild2->cod_organizacao !!}')">
                                            <span class="bg-transparent h-6 w-6 text-2xl block outline-none focus:outline-none">
                                                <i class="fas fa-times"></i>
                                            </span>
                                        </button>
                                    </div>
                                    <!--body-->
                                    <div class="relative p-3 pl-6 flex-auto">

                                        <p class="my-2 text-gray-500 text-lg leading-relaxed">Unidade: <strong>{{ $resultChild2->nom_organizacao }}</strong></p>
                                        <p class="my-2 text-gray-500 text-lg leading-relaxed">Sigla: <strong>{{ $resultChild2->sgl_organizacao }}</strong><span class="text-gray-400">/{{ $resultChild1->sgl_organizacao }}/{{ $result->sgl_organizacao }}</span></p>
                                        <p class="my-2 text-gray-500 text-lg font-semibold leading-relaxed text-red-600">Quer, realmente, excluir essa Unidade?</p>
                                        <br>
                                        <p class="text-gray-300 text-right" style="font-size: 0.7rem!Important">ID Unidade: {!! $resultChild2->cod_organizacao !!}</p>

                                    </div>
                                    <!--footer-->
                                    <div class="flex items-center justify-end p-3 border-t border-solid border-gray-200 rounded-b ">

                                        <a class="inline-flex items-center px-2 py-2 bg-gray-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition mr-2 pr-2" href="javascript: void(0);" onclick="toggleModal('mymodaltop{!! $resultChild2->cod_organizacao !!}')" >Cancelar</a>
                                        <button class="inline-flex items-center px-2 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" type="button" wire:click.prevent="delete('{!! $resultChild2->cod_organizacao !!}')" onclick="toggleModal('mymodaltop{!! $resultChild2->cod_organizacao !!}')">Sim, quero excluir</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hidden opacity-70 fixed inset-0 z-40 bg-black" id="mymodaltop{!! $resultChild2->cod_organizacao !!}-backdrop"></div>
                        @else
                        &nbsp;
                        &nbsp;
                        <button type="button"><i class="fas fa-trash-alt text-gray-300"></i></button>
                        @endif

                    </td>
                </tr>

                @foreach ($resultChild2->deshierarquia as $resultChild3)

                @if($resultChild2->cod_organizacao == $resultChild3->rel_cod_organizacao)
                <tr class="border border-gray-500 md:border-none block md:table-row">
                    <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell px-5 py-3 pl-9 text-sm text-gray-600">
                        {{ $resultChild3->nom_organizacao }}
                    </td>
                    <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell px-5 py-3 text-sm text-gray-600">
                        <strong>{{ $resultChild3->sgl_organizacao }}</strong>{!! $this->hierarquiaUnidade($resultChild3->cod_organizacao) !!}
                    </td>
                    <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell px-5 py-3 text-sm text-gray-600">
                        <a href="javascript: void(0);" wire:click.prevent="editForm('{!! $resultChild3->cod_organizacao !!}')" onclick="javascript: document.documentElement.scrollTop = 0;"><i class="fas fa-edit text-green-600"></i></a>

                        @if($resultChild3->deshierarquia()->count() <= 0)
                        &nbsp;
                        &nbsp;
                        <button type="button" onclick="toggleModal('mymodaltop{!! $resultChild3->cod_organizacao !!}')"><i class="fas fa-trash-alt text-red-600"></i></button>

                        <!-- Modal -->
                        <div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="mymodaltop{!! $resultChild3->cod_organizacao !!}">
                          <div class="mb-6 bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-sm sm:max-w-md sm:max-w-lg sm:max-w-xl sm:max-w-2xl">
                            <!--content-->
                            <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
                                <!--header-->
                                <div class="flex items-start justify-between p-2 pl-5 border-b border-solid border-gray-200 rounded-t ">
                                    <h3 class="text-2xl font-semibold text-gray-600">Excluir Unidade</h3>
                                    <button class="p-1 ml-auto bg-transparent border-0 text-gray-300 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('mymodaltop{!! $resultChild3->cod_organizacao !!}')">
                                        <span class="bg-transparent h-6 w-6 text-2xl block outline-none focus:outline-none">
                                            <i class="fas fa-times"></i>
                                        </span>
                                    </button>
                                </div>
                                <!--body-->
                                <div class="relative p-3 pl-6 flex-auto">

                                    <p class="my-2 text-gray-500 text-lg leading-relaxed">Unidade: <strong>{{ $resultChild3->nom_organizacao }}</strong></p>
                                    <p class="my-2 text-gray-500 text-lg leading-relaxed">Sigla: <strong>{{ $resultChild3->sgl_organizacao }}</strong><span class="text-gray-400">/{{ $resultChild3->sgl_organizacao }}/{{ $resultChild1->sgl_organizacao }}/{{ $result->sgl_organizacao }}</span></p>
                                    <p class="my-2 text-gray-500 text-lg font-semibold leading-relaxed text-red-600">Quer, realmente, excluir essa Unidade?</p>

                                </div>
                                <!--footer-->
                                <div class="flex items-center justify-end p-3 border-t border-solid border-gray-200 rounded-b ">

                                    <a class="inline-flex items-center px-2 py-2 bg-gray-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition mr-2 pr-2" href="javascript: void(0);" onclick="toggleModal('mymodaltop{!! $resultChild3->cod_organizacao !!}')" >Cancelar</a>
                                    <button class="inline-flex items-center px-2 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" type="button" wire:click.prevent="delete('{!! $resultChild3->cod_organizacao !!}')" onclick="toggleModal('mymodaltop{!! $resultChild3->cod_organizacao !!}')">Sim, quero excluir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hidden opacity-70 fixed inset-0 z-40 bg-black" id="mymodaltop{!! $resultChild3->cod_organizacao !!}-backdrop"></div>
                    @else
                    &nbsp;
                    &nbsp;
                    <button type="button"><i class="fas fa-trash-alt text-gray-300"></i></button>
                    @endif

                </td>
            </tr>

            @foreach ($resultChild3->deshierarquia as $resultChild4)

            @if($resultChild3->cod_organizacao == $resultChild4->rel_cod_organizacao)
            <tr class="border border-gray-500 md:border-none block md:table-row">
                <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell px-5 py-3 pl-11 text-sm text-gray-600">
                    {{ $resultChild4->nom_organizacao }}
                </td>
                <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell px-5 py-3 text-sm text-gray-600">
                    <strong>{{ $resultChild4->sgl_organizacao }}</strong>{!! $this->hierarquiaUnidade($resultChild4->cod_organizacao) !!}
                </td>
                <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell px-5 py-3 text-sm text-gray-600">
                    <a href="javascript: void(0);" wire:click.prevent="editForm('{!! $resultChild4->cod_organizacao !!}')" onclick="javascript: document.documentElement.scrollTop = 0;"><i class="fas fa-edit text-green-600"></i></a>

                    @if($resultChild4->deshierarquia()->count() <= 0)
                    &nbsp;
                    &nbsp;
                    <button type="button" onclick="toggleModal('mymodaltop{!! $resultChild4->cod_organizacao !!}')"><i class="fas fa-trash-alt text-red-600"></i></button>

                    <!-- Modal -->
                    <div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="mymodaltop{!! $resultChild4->cod_organizacao !!}">
                      <div class="mb-6 bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-sm sm:max-w-md sm:max-w-lg sm:max-w-xl sm:max-w-2xl">
                        <!--content-->
                        <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
                            <!--header-->
                            <div class="flex items-start justify-between p-2 pl-5 border-b border-solid border-gray-200 rounded-t ">
                                <h3 class="text-2xl font-semibold text-gray-600">Excluir Unidade</h3>
                                <button class="p-1 ml-auto bg-transparent border-0 text-gray-300 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('mymodaltop{!! $resultChild4->cod_organizacao !!}')">
                                    <span class="bg-transparent h-6 w-6 text-2xl block outline-none focus:outline-none">
                                        <i class="fas fa-times"></i>
                                    </span>
                                </button>
                            </div>
                            <!--body-->
                            <div class="relative p-3 pl-6 flex-auto">

                                <p class="my-2 text-gray-500 text-lg leading-relaxed">Unidade: <strong>{{ $resultChild4->nom_organizacao }}</strong></p>
                                <p class="my-2 text-gray-500 text-lg leading-relaxed">Sigla: <strong>{{ $resultChild4->sgl_organizacao }}</strong><span class="text-gray-400">/{{ $resultChild3->sgl_organizacao }}/{{ $resultChild2->sgl_organizacao }}/{{ $resultChild1->sgl_organizacao }}/{{ $result->sgl_organizacao }}</span></p>
                                <p class="my-2 text-gray-500 text-lg font-semibold leading-relaxed text-red-600">Quer, realmente, excluir essa Unidade?</p>

                            </div>
                            <!--footer-->
                            <div class="flex items-center justify-end p-3 border-t border-solid border-gray-200 rounded-b ">

                                <a class="inline-flex items-center px-2 py-2 bg-gray-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition mr-2 pr-2" href="javascript: void(0);" onclick="toggleModal('mymodaltop{!! $resultChild4->cod_organizacao !!}')" >Cancelar</a>
                                <button class="inline-flex items-center px-2 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" type="button" wire:click.prevent="delete('{!! $resultChild4->cod_organizacao !!}')" onclick="toggleModal('mymodaltop{!! $resultChild4->cod_organizacao !!}')">Sim, quero excluir</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hidden opacity-70 fixed inset-0 z-40 bg-black" id="mymodaltop{!! $resultChild4->cod_organizacao !!}-backdrop"></div>
                @else
                &nbsp;
                &nbsp;
                <button type="button"><i class="fas fa-trash-alt text-gray-300"></i></button>
                @endif

            </td>
        </tr>

        @foreach ($resultChild4->deshierarquia as $resultChild5)

        @if($resultChild4->cod_organizacao == $resultChild5->rel_cod_organizacao)
        <tr class="border border-gray-500 md:border-none block md:table-row">
            <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell px-5 py-3 pl-14 text-sm text-gray-600">
                {{ $resultChild5->nom_organizacao }}
            </td>
            <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell px-5 py-3 text-sm text-gray-600">
                <strong>{{ $resultChild5->sgl_organizacao }}</strong>{!! $this->hierarquiaUnidade($resultChild5->cod_organizacao) !!}
            </td>
            <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell px-5 py-3 text-sm text-gray-600">
                <a href="javascript: void(0);" wire:click.prevent="editForm('{!! $resultChild5->cod_organizacao !!}')" onclick="javascript: document.documentElement.scrollTop = 0;"><i class="fas fa-edit text-green-600"></i></a>

                @if($resultChild5->deshierarquia()->count() <= 0)
                &nbsp;
                &nbsp;
                <button type="button" onclick="toggleModal('mymodaltop{!! $resultChild5->cod_organizacao !!}')"><i class="fas fa-trash-alt text-red-600"></i></button>

                <!-- Modal -->
                <div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="mymodaltop{!! $resultChild5->cod_organizacao !!}">
                  <div class="mb-6 bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-sm sm:max-w-md sm:max-w-lg sm:max-w-xl sm:max-w-2xl">
                    <!--content-->
                    <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
                        <!--header-->
                        <div class="flex items-start justify-between p-2 pl-5 border-b border-solid border-gray-200 rounded-t ">
                            <h3 class="text-2xl font-semibold text-gray-600">Excluir Unidade</h3>
                            <button class="p-1 ml-auto bg-transparent border-0 text-gray-300 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('mymodaltop{!! $resultChild5->cod_organizacao !!}')">
                                <span class="bg-transparent h-6 w-6 text-2xl block outline-none focus:outline-none">
                                    <i class="fas fa-times"></i>
                                </span>
                            </button>
                        </div>
                        <!--body-->
                        <div class="relative p-3 pl-6 flex-auto">

                            <p class="my-2 text-gray-500 text-lg leading-relaxed">Unidade: <strong>{{ $resultChild5->nom_organizacao }}</strong></p>
                            <p class="my-2 text-gray-500 text-lg leading-relaxed">Sigla: <strong>{{ $resultChild5->sgl_organizacao }}</strong><span class="text-gray-400">/{{ $resultChild4->sgl_organizacao }}/{{ $resultChild3->sgl_organizacao }}/{{ $resultChild2->sgl_organizacao }}/{{ $resultChild1->sgl_organizacao }}/{{ $result->sgl_organizacao }}</span></p>
                            <p class="my-2 text-gray-500 text-lg font-semibold leading-relaxed text-red-600">Quer, realmente, excluir essa Unidade?</p>

                        </div>
                        <!--footer-->
                        <div class="flex items-center justify-end p-3 border-t border-solid border-gray-200 rounded-b ">

                            <a class="inline-flex items-center px-2 py-2 bg-gray-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition mr-2 pr-2" href="javascript: void(0);" onclick="toggleModal('mymodaltop{!! $resultChild5->cod_organizacao !!}')" >Cancelar</a>
                            <button class="inline-flex items-center px-2 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" type="button" wire:click.prevent="delete('{!! $resultChild5->cod_organizacao !!}')" onclick="toggleModal('mymodaltop{!! $resultChild5->cod_organizacao !!}')">Sim, quero excluir</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hidden opacity-70 fixed inset-0 z-40 bg-black" id="mymodaltop{!! $resultChild5->cod_organizacao !!}-backdrop"></div>
            @else
            &nbsp;
            &nbsp;
            <button type="button"><i class="fas fa-trash-alt text-gray-300"></i></button>
            @endif

        </td>
    </tr>
    @endif

    @endforeach

    @endif

    @endforeach

    @endif

    @endforeach

    @endif

    @endforeach

    @endif

    @endforeach

    @endforeach

</tbody>
</table>

</div>

</div>

</div>

<script type="text/javascript">
  function toggleModal(modalID) {
    document.getElementById(modalID).classList.toggle("hidden");
    document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
    document.getElementById(modalID).classList.toggle("flex");
    document.getElementById(modalID + "-backdrop").classList.toggle("flex");
}
</script>

@if (Session::has('flash_message'))
<div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="modalFlashMessage">
  <div class="mb-6 bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-sm sm:max-w-md sm:max-w-lg sm:max-w-xl sm:max-w-2xl">
    <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
        <!--header-->
        <div class="flex items-start justify-between p-2 pl-5 border-b border-solid border-gray-200 rounded-t ">
            <h3 class="text-3xl font-semibold text-gray-600">Importante</h3>
            <button class="p-1 ml-auto bg-transparent border-0 text-gray-300 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="controlarModal('modalFlashMessage')">
                <span class="bg-transparent h-6 w-6 text-2xl block outline-none focus:outline-none">
                    <i class="fas fa-times"></i>
                </span>
            </button>
        </div>
        <div class="relative p-3 pl-6 flex-auto">

            <p class="my-2 text-gray-500 text-lg leading-relaxed">
                {!! Session::get('flash_message') !!}
            </p>

        </div>
        <div class="flex items-center justify-end p-3 border-t border-solid border-gray-200 rounded-b ">
            <a class="inline-flex items-center px-2 py-2 bg-gray-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition mr-2 pr-2" href="javascript: void(0);" onclick="controlarModal('modalFlashMessage')" >Fechar</a>
        </div>
    </div>
</div>
</div>
<div class="hidden opacity-70 fixed inset-0 z-40 bg-black" id="modalFlashMessage-backdrop"></div>
<?php if (Session::get('flash_message') != '') { ?>
    <script type="text/javascript">
        setTimeout(function() {
            controlarModal('modalFlashMessage');
        }, 333);
    </script>
<?php } Session::forget('flash_message') ?>
@endif

<script type="text/javascript">
  function controlarModal(modalID) {
    document.getElementById(modalID).classList.toggle("hidden");
    document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
    document.getElementById(modalID).classList.toggle("flex");
    document.getElementById(modalID + "-backdrop").classList.toggle("flex");
}
</script>

<!-- Modal -->
<x-jet-dialog-modal wire:model="showModalResultadoEdicao">
    <x-slot name="title">
        <strong>Importante</strong>
    </x-slot>

    <x-slot name="content">
        {!! $this->mensagemResultadoEdicao !!}
    </x-slot>

    <x-slot name="footer">
        <x-jet-button wire:click="$toggle('showModalResultadoEdicao')" wire:loading.attr="disabled">
            {{ __('Closer') }}
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>

</div>

