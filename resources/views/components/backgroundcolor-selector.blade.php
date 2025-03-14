<div class="bg-secondary-full dark:bg-primary-full border dark:border-primary-light w-full md:w-2/3 rounded-lg p-2">
    <h1 class="font-medium text-2xl dark:text-primary-shadWhite">
        {{ __('settings/index.headers.background_color.header') }}
    </h1>
    <p class="font-light text-xs text-gray-400 italic">{{ __('settings/index.headers.background_color.subheader') }}</p>

    <div class="mt-4">
        <form id="background_selector">
            <div class="flex flex-col space-y-2">
                <div class="flex flex-row space-x-2 items-center">
                    <input type="radio" id="light" name="theme_color" value="light"
                        class="appearance-none webkit-appearance">
                    <label for="light"
                        class="text-sm font-medium dark:text-primary-shadWhite selected:bg-secondary-light">
                        {{ __('settings/index.headers.background_color.radio_group.light') }}
                    </label>
                    <div class="w-4 h-4 bg-secondary-full dark:bg-primary-shadWhite"></div>
                </div>
                <div class="flex flex-row space-x-2 items-center">
                    <input type="radio" id="dark" name="theme_color" value="dark"
                        class="appearance-none webkit-appearance">

                    <label for="dark"
                        class="text-sm font-medium dark:text-primary-shadWhite selected:bg-secondary-light">
                        {{ __('settings/index.headers.background_color.radio_group.dark') }}
                    </label>
                    <div class="w-4 h-4 bg-primary-full dark:bg-primary-full"></div>
                </div>

                <x-button type="submit" class="rounded-sm">
                    {{ __('settings/index.headers.background_color.button') }}
                </x-button>
            </div>
        </form>
    </div>
</div>

<script>
    window.translations = {
        theme: {
            notification: "{{ __('notification.settings.background_color') }}"
        }
    };
</script>
