<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Profile') }}
    </h2>
</x-slot>

<div>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

        <x-jet-form-section submit="create">
            <x-slot name="title">
                Unidades da Organização
            </x-slot>

            <x-slot name="description">
                Caso a Unidade não seja vinculada a uma outra não é necessário o preenchimento
            </x-slot>

            <x-slot name="form">
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="nom_organizacao" value="Nome da Unidade" />
                    {!! Form::text('nom_organizacao', null, ['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm', 'style' => 'width: 100% !Important;', 'autocomplete' => 'off', 'required' => 'required', 'wire:model' => 'nom_organizacao']) !!}
                    <x-jet-input-error for="nom_organizacao" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="sgl_organizacao" value="Sigla da Unidade" />
                    {!! Form::text('sgl_organizacao', null, ['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm', 'style' => 'width: 100% !Important;', 'autocomplete' => 'off', 'required' => 'required', 'wire:model' => 'sgl_organizacao']) !!}
                    <x-jet-input-error for="sgl_organizacao" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="sgl_organizacao" value="Esta é Vinculada a qual Unidade?" />
                    {!! Form::select('rel_cod_organizacao', $rel_cod_organizacao_lista, null, ['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm', 'style' => 'height: 43px!Important; padding-left: 10px!Important; width: 100% !Important;', 'placeholder' => 'Selecione', 'autocomplete' => 'off', 'wire:model' => 'rel_cod_organizacao']) !!}
                    <x-jet-input-error for="sgl_organizacao" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="actions">
                <x-jet-action-message class="mr-3" on="saved">
                    {{ __('Saved.') }}
                </x-jet-action-message>

                <x-jet-button>
                    {{ __('Save') }}
                </x-jet-button>
            </x-slot>
        </x-jet-form-section>


        <x-jet-section-border />

    </div>
</div>
