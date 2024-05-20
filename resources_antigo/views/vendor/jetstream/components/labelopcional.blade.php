@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700']) }}>
    {{ $value ?? $slot }}  <span class="text-blue-300" style="font-size: 0.7rem!Important;">(opcional )</span>
</label>
