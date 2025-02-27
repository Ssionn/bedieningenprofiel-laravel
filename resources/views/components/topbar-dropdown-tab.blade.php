@props(['href' => '#', 'icon' => ''])

<a href="{{ $href }}" class="inline-flex items-center rounded-md hover:bg-gray-200 w-full py-1.5 px-2">
    @if ($icon)
        <x-dynamic-component :component="$icon" class="w-4 h-4 mr-2" />
    @endif
    <span class="text-sm">{{ $slot }}</span>
</a>
