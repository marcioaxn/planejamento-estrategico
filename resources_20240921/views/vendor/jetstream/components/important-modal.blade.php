@props(['id' => null, 'maxWidth' => null])

<x-jet-modal :id="$id" maxWidth="2xl" {{ $attributes }}>
    <div class="px-6 py-4">
        <div class="text-lg">
            {{ $title }}
        </div>

        <div class="text-red-600 mt-4">
            {{ $content }}
        </div>
    </div>

    <div class="px-6 py-4 bg-gray-100 text-right">
        {{ $footer }}
    </div>
</x-jet-modal>
