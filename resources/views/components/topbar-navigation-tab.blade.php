@props(['href' => '#', 'active' => false])

@php
    $classes = $active
        ? 'border-b-2 border-gray-900 bg-primary pb-4 text-gray-700'
        : 'pb-4 text-gray-400 hover:text-gray-700';
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
    <span class="text-sm">{{ $slot }}</span>
</a>
