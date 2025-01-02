<x-app-layout>
    <div class="sm:ml-64 p-2">
        <div class="flex flex-col items-center space-y-4">
            @livewire('account-information')
            @livewire('localization', ['locales' => $locales])
        </div>
    </div>
</x-app-layout>
