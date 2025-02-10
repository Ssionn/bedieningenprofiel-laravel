@props(['type' => 'button', 'rounded' => 'none'])

@php
    $classes =
        'mt-2 px-2 py-1.5 bg-secondary-light text-secondary-full dark:bg-primary-shadWhite dark:text-primary-full hover:bg-gray-800 dark:hover:bg-gray-200';
@endphp

{{-- Merge classes --}}
<button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</button>
