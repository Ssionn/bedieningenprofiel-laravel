@props([
    'active' => false,
    'rounded' => true,
    'href' => '#',
])

@php
    $classes = $active
        ? 'bg-gray-200 text-secondary-light dark:bg-primary-light dark:text-primary-shadWhite'
        : 'hover:bg-gray-200 dark:hover:bg-primary-light';

    $rounded = $rounded ? 'rounded-sm ' : '';
@endphp

<li>
    <a href="{{ $href }}" {{ $attributes->merge(['class' => 'block py-1.5 px-4 ' . $rounded . $classes]) }}>
        {{ $slot }}
    </a>
</li>
