<x-app-layout>
    <div class="sm:ml-64 p-2">
        <div class="flex flex-col items-center">
            @livewire('localization', ['locales' => $locales])
        </div>
    </div>
</x-app-layout>
