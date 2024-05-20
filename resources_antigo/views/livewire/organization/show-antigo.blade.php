<div class="" style="margin-top: 6px!Important; padding-top: 6px!Important;">

    <div class="max-w-34xl mx-auto px-2 sm:px-4 lg:px-3">

        <form wire:submit.prevent="create" method="post">

            <div class="flex items-center px-4 py-6 bg-white rounded-md shadow-md">

                <div class="">

                    <div class="flex flex-wrap -mx-3 mb-6">

                        <div class="w-full md:w-2/3 px-3 mb-6 md:mb-0 pt-3">

                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="nom_organizacao" value="Nome da Unidade" />
                                {!! Form::text('nom_organizacao', null, ['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm', 'style' => 'width: 100% !Important;', 'autocomplete' => 'off', 'required' => 'required', 'wire:model' => 'nom_organizacao']) !!}
                                <x-jet-input-error for="nom_organizacao" class="mt-2" />
                            </div>

                        </div>

                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0 pt-3">

                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="sgl_organizacao" value="Sigla da Unidade" />
                                {!! Form::text('sgl_organizacao', null, ['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm', 'style' => 'width: 100% !Important;', 'autocomplete' => 'off', 'required' => 'required', 'wire:model' => 'sgl_organizacao']) !!}
                                <x-jet-input-error for="sgl_organizacao" class="mt-2" />
                            </div>

                        </div>

                        <div class="w-full md:w-2/3 px-3 mb-6 md:mb-0 pt-3">

                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="sgl_organizacao" value="Esta é Vinculada ou Subordinada a qual Unidade?" />
                                {!! Form::select('rel_cod_organizacao', $rel_cod_organizacao_lista, null, ['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm', 'style' => 'height: 43px!Important; padding-left: 10px!Important; width: 100% !Important;', 'placeholder' => 'Selecione', 'autocomplete' => 'off', 'wire:model' => 'rel_cod_organizacao']) !!}
                                <x-jet-input-error for="sgl_organizacao" class="mt-2" />
                            </div>

                        </div>

                        <div class="w-full md:w-1/3 px-3 mt-6 mb-6 md:mb-0 pt-3">

                            @if($this->editarForm == true)
                            <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" type="submit">Editar</button>

                            <a class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring focus:ring-red-300 disabled:opacity-25 transition" href="javascript: void(0);" wire:click.prevent="cancelar()" >Cancelar</a>
                            @else
                            <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" type="submit">Salvar</button>
                            @endif

                        </div>

                    </div>

                </div>

            </form>

        </div>

        <div class=" flex flex-wrap -mx-3 mb-6">

            <div class="w-full md:w-3/3 px-3 mb-6 md:mb-0 pt-3">

                <div class="border-b border-gray-200 shadow rounded-md">

                    <table class="divide-gray-300 min-w-full border-collapse block md:table ">
                        <thead class="sticky inset-x-0 top-16 block md:table-header-group">
                            <tr class="block shadow-lg md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative z-50 ">
                                <th class="bg-gray-400 px-6 py-2 text-xs text-white font-bold md:border md:border-gray-100 text-left block md:table-cell" style="text-align: left!Important;">Unidade</th>
                                <th class="bg-gray-400 px-6 py-2 text-xs text-white font-bold md:border md:border-gray-100 text-left block md:table-cell" style="text-align: left!Important;">Sigla</th>
                                <th class="bg-gray-400 px-6 py-2 text-xs text-white font-bold md:border md:border-gray-100 text-left block md:table-cell" style="text-align: left!Important;">Ação</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-300 block md:table-row-group">

                            <?php

                            $cod_organizacao_impressos = [];

                            ?>

                            @foreach ($organization as $result)

                            <tr class="border border-gray-500 md:border-none block md:table-row">
                                <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell px-6 py-4 text-sm text-gray-600">
                                    <strong>{{ $result->nom_organizacao }}</strong>
                                </td>
                                <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell px-6 py-4 text-sm text-gray-600">
                                    <strong>{{ $result->sgl_organizacao }}</strong>
                                </td>
                                <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell px-6 py-4 text-sm text-gray-600">
                                    <a href="javascript: void(0);" wire:click.prevent="editForm('{!! $result->cod_organizacao !!}')" onclick="javascript: document.documentElement.scrollTop = 0;"><i class="fas fa-edit text-green-600"></i></a>
                                    &nbsp;
                                    &nbsp;
                                    <a href="javascript: void(0);" wire:click.prevent="delete('{!! $result->cod_organizacao !!}')"><i class="fas fa-trash-alt text-yellow-700"></i></a>
                                </td>
                            </tr>

                            @foreach($organizationChild as $resultChild1)

                            @if($result->cod_organizacao == $resultChild1->rel_cod_organizacao)

                            <tr class="border border-gray-500 md:border-none block md:table-row">
                                <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell px-6 py-4 text-sm text-gray-600">
                                    {{ $resultChild1->nom_organizacao }}
                                </td>
                                <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell px-6 py-4 text-sm text-gray-600">
                                    <strong>{{ $resultChild1->sgl_organizacao }}</strong><span class="text-gray-400">/{{ $result->sgl_organizacao }}</span>
                                </td>
                                <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell px-6 py-4 text-sm text-gray-600">
                                    <a href="javascript: void(0);" wire:click.prevent="editForm('{!! $resultChild1->cod_organizacao !!}')" onclick="javascript: document.documentElement.scrollTop = 0;"><i class="fas fa-edit text-green-600"></i></a>
                                    &nbsp;
                                    &nbsp;
                                    <a href="javascript: void(0);" wire:click.prevent="delete('{!! $resultChild1->cod_organizacao !!}')"><i class="fas fa-trash-alt text-yellow-700"></i></a>
                                </td>
                            </tr>

                            @foreach ($resultChild1->deshierarquia as $resultChild2)

                            @if($resultChild1->cod_organizacao == $resultChild2->rel_cod_organizacao)
                            <tr class="border border-gray-500 md:border-none block md:table-row">
                                <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell px-6 py-4 text-sm text-gray-600">
                                    {{ $resultChild2->nom_organizacao }}
                                </td>
                                <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell px-6 py-4 text-sm text-gray-600">
                                    <strong>{{ $resultChild2->sgl_organizacao }}</strong><span class="text-gray-400">/{{ $resultChild1->sgl_organizacao }}/{{ $result->sgl_organizacao }}</span>
                                </td>
                                <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell px-6 py-4 text-sm text-gray-600">
                                    <a href="javascript: void(0);" wire:click.prevent="editForm('{!! $resultChild2->cod_organizacao !!}')" onclick="javascript: document.documentElement.scrollTop = 0;"><i class="fas fa-edit text-green-600"></i></a>
                                    &nbsp;
                                    &nbsp;
                                    <a href="javascript: void(0);" wire:click.prevent="delete('{!! $resultChild2->cod_organizacao !!}')"><i class="fas fa-trash-alt text-yellow-700"></i></a>
                                </td>
                            </tr>

                            @foreach ($resultChild2->deshierarquia as $resultChild3)

                            @if($resultChild2->cod_organizacao == $resultChild3->rel_cod_organizacao)
                            <tr class="border border-gray-500 md:border-none block md:table-row">
                                <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell px-6 py-4 text-sm text-gray-600">
                                    {{ $resultChild3->nom_organizacao }}
                                </td>
                                <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell px-6 py-4 text-sm text-gray-600">
                                    <strong>{{ $resultChild3->sgl_organizacao }}</strong><span class="text-gray-400">/{{ $resultChild2->sgl_organizacao }}/{{ $resultChild1->sgl_organizacao }}/{{ $result->sgl_organizacao }}</span>
                                </td>
                                <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell px-6 py-4 text-sm text-gray-600">
                                    <a href="javascript: void(0);" wire:click.prevent="editForm('{!! $resultChild3->cod_organizacao !!}')" onclick="javascript: document.documentElement.scrollTop = 0;"><i class="fas fa-edit text-green-600"></i></a>
                                    &nbsp;
                                    &nbsp;
                                    <a href="javascript: void(0);" wire:click.prevent="delete('{!! $resultChild3->cod_organizacao !!}')"><i class="fas fa-trash-alt text-yellow-700"></i></a>
                                </td>
                            </tr>

                            @foreach ($resultChild3->deshierarquia as $resultChild4)

                            @if($resultChild3->cod_organizacao == $resultChild4->rel_cod_organizacao)
                            <tr class="border border-gray-500 md:border-none block md:table-row">
                                <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell px-6 py-4 text-sm text-gray-600">
                                    {{ $resultChild4->nom_organizacao }}
                                </td>
                                <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell px-6 py-4 text-sm text-gray-600">
                                    <strong>{{ $resultChild4->sgl_organizacao }}</strong><span class="text-gray-400">/{{ $resultChild3->sgl_organizacao }}/{{ $resultChild2->sgl_organizacao }}/{{ $resultChild1->sgl_organizacao }}/{{ $result->sgl_organizacao }}</span>
                                </td>
                                <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell px-6 py-4 text-sm text-gray-600">
                                    <a href="javascript: void(0);" wire:click.prevent="editForm('{!! $resultChild4->cod_organizacao !!}')" onclick="javascript: document.documentElement.scrollTop = 0;"><i class="fas fa-edit text-green-600"></i></a>
                                    &nbsp;
                                    &nbsp;
                                    <button type="button" onclick="openModal('mymodaltop{!! $resultChild4->cod_organizacao !!}')"><i class="fas fa-trash-alt text-yellow-700"></i></button>

                                    <dialog id="mymodaltop{!! $resultChild4->cod_organizacao !!}" class="bg-transparent z-0 relative w-screen h-screen">
                                        <div class="pt-7 flex justify-center items-start overflow-x-hidden overflow-y-auto fixed left-0 top-0 w-full h-full bg-gray-900 bg-opacity-50 z-50 transition-opacity duration-300 opacity-0">
                                            <div class="bg-white flex rounded-lg w-11/12 md:w-1/2 relative">
                                                <div class="flex flex-col items-start w-full">
                                                    <div class="p-7 flex items-center w-full">
                                                        <div class="text-gray-900 font-bold text-lg text-red-600" style="font-size: 1rem!Important">Excluir Unidade</div>
                                                        <svg onclick="modalClose('mymodaltop{!! $resultChild4->cod_organizacao !!}')" class="ml-auto fill-current text-gray-700 w-5 h-5 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                                                            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z" />
                                                        </svg>
                                                    </div>

                                                    <div class="px-7">
                                                        <p>Unidade: <strong>{{ $resultChild4->nom_organizacao }}</strong></p>
                                                        <br>
                                                        <p>Sigla: <strong>{{ $resultChild4->sgl_organizacao }}</strong><span class="text-gray-400">/{{ $resultChild3->sgl_organizacao }}/{{ $resultChild2->sgl_organizacao }}/{{ $resultChild1->sgl_organizacao }}/{{ $result->sgl_organizacao }}</span></p>
                                                        <br>
                                                        <p>ID Unidade: <span class="text-gray-400">{!! $resultChild4->cod_organizacao !!}</span></p>
                                                        <br>
                                                        <p class="text-gray-900 font-bold text-red-600" style="font-size: 1rem!Important">Quer, realmente, excluir essa Unidade?</p>
                                                    </div>

                                                    <div class="px-7 w-full"><br><hr><br></div>

                                                    <div class="p-1 mr-6 pr-6 mb-2 pb-2 flex justify-end items-center w-full">

                                                        <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition mr-2 pr-2" type="button" wire:click.prevent="delete('{!! $resultChild4->cod_organizacao !!}')" onclick="modalClose('mymodaltop{!! $resultChild4->cod_organizacao !!}')">Sim, quero excluir</button>

                                                        <a class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring focus:ring-red-300 disabled:opacity-25 transition" href="javascript: void(0);" onclick="modalClose('mymodaltop{!! $resultChild4->cod_organizacao !!}')" >Cancelar</a>

                                                    </div>



                                                </div>
                                            </div>
                                        </div>
                                    </dialog>


                                </td>
                            </tr>

                            @foreach ($resultChild4->deshierarquia as $resultChild5)

                            @if($resultChild4->cod_organizacao == $resultChild5->rel_cod_organizacao)
                            <tr class="border border-gray-500 md:border-none block md:table-row">
                                <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell px-6 py-4 text-sm text-gray-600">
                                    {{ $resultChild5->nom_organizacao }}
                                </td>
                                <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell px-6 py-4 text-sm text-gray-600">
                                    <strong>{{ $resultChild5->sgl_organizacao }}</strong><span class="text-gray-400">/{{ $resultChild4->sgl_organizacao }}/{{ $resultChild3->sgl_organizacao }}/{{ $resultChild2->sgl_organizacao }}/{{ $resultChild1->sgl_organizacao }}/{{ $result->sgl_organizacao }}</span>
                                </td>
                                <td class="p-2 md:border md:border-gray-100 text-left block md:table-cell px-6 py-4 text-sm text-gray-600">
                                    <a href="javascript: void(0);" wire:click.prevent="editForm('{!! $resultChild5->cod_organizacao !!}')" onclick="javascript: document.documentElement.scrollTop = 0;"><i class="fas fa-edit text-green-600"></i></a>
                                    &nbsp;
                                    &nbsp;
                                    <a href="javascript: void(0);" wire:click.prevent="delete('{!! $resultChild5->cod_organizacao !!}')"><i class="fas fa-trash-alt text-yellow-700"></i></a>
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

        <script>
            function openModal(key) {
                document.getElementById(key).showModal(); 
                document.getElementById(key).children[0].scrollTop = 0; 
                document.getElementById(key).children[0].classList.remove('opacity-0'); 
                document.getElementById(key).children[0].classList.add('opacity-100')
            }

            function modalClose(key) {
                document.getElementById(key).children[0].classList.remove('opacity-100');
                document.getElementById(key).children[0].classList.add('opacity-0');
                setTimeout(function () {
                    document.getElementById(key).close();
                    document.body.removeAttribute('style');
                }, 100);
            }
        </script>

    </div>

    