<div class="bg-secondary-full dark:bg-primary-full border dark:border-primary-light w-full md:w-2/3 rounded-lg p-2">
    <h1 class="font-medium text-2xl dark:text-primary-shadWhite">{{ __('settings/index.headers.localization.header') }}
    </h1>
    <p class="font-light text-xs text-gray-400 italic">{{ __('settings/index.headers.localization.subheader') }}</p>

    <div class="mt-4">
        <form wire:submit.prevent="updateLocale" class="flex flex-col">
            <select wire:model="selectedLocale"
                class="w-full sm:w-1/2 py-1.5 px-2 rounded-lg border border-gray-300 mb-1">
                @foreach ($locales as $locale)
                    <option value="{{ $locale->locale }}" @if ($locale->locale === app()->getLocale()) selected @endif>
                        {{ $locale->language }}
                    </option>
                @endforeach
            </select>
            <x-button type="submit" class="rounded-sm">
                {{ __('settings/index.headers.localization.button') }}
            </x-button>
        </form>
    </div>
</div>
