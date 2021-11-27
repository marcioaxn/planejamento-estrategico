@props(['active'])

@php
$classes = ($active ?? false)
            ? 'bg-blue-800 block px-4 py-2 text-sm leading-5 text-white focus:outline-none focus:bg-gray-100 transition'
            : 'block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-indigo-100 focus:outline-none focus:bg-gray-100 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
