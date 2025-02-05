@props(['type' => 'button'])

<button type="{{ $type }}"
    class="mt-2 px-4 py-1.5 bg-secondary-light text-secondary-full dark:bg-primary-shadWhite dark:text-primary-full hover:bg-gray-800 dark:hover:bg-gray-200 rounded-sm">
    {{ $slot }}
</button>
