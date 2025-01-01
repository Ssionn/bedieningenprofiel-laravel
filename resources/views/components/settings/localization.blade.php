@props(['locales' => []])

<div class="bg-gray-100 w-full md:w-2/3 rounded-md p-2">
    <h1 class="font-medium text-2xl">{{ __('settings/index.headers.localization.header') }}</h1>
    <p class="font-light text-xs text-gray-400">{{ __('settings/index.headers.localization.subheader') }}</p>

    <div class="mt-4">
        <form action="{{ route('settings.updateLocale') }}" method="POST" class="flex flex-col">
            @csrf
            <select name="locale" id="locale" class="w-1/2 p-2 rounded-md border border-gray-300 mb-1">
                @foreach ($locales as $locale)
                    <option value="{{ $locale->value }}" @if ($locale->value === app()->getLocale()) selected @endif>
                        {{ $locale->name }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="mt-2 px-4 py-2 bg-gray-300 hover:bg-gray-400 hover:text-white rounded-md">
                {{ __('settings/index.headers.localization.button') }}
            </button>
        </form>
    </div>
</div>
