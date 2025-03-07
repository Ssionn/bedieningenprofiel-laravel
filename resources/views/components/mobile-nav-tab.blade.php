@props(['href' => '#', 'icon' => '', 'active' => false])

@php
    $classes = $active
        ? 'inline-flex items-center w-full border-b-2 text-gray-700 border-b-gray-900 pb-2'
        : 'inline-flex items-center w-full text-gray-400 hover:text-gray-700';
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
    @if ($icon)
        <x-dynamic-component :component="$icon" class="w-4 h-4 mr-2" />
    @endif
    <span>{{ $slot }}</span>
</a>
