@props([
    'active' => false,
    'href' => '#',
])

@php
    $classes = $active ? 'bg-gray-300' : 'hover:bg-gray-300';
@endphp

<li>
    <a href="{{ $href }}"
        {{ $attributes->merge(['class' => 'block py-2 px-4 rounded-md font-medium ' . $classes]) }}>
        {{ $slot }}
    </a>
</li>
