<x-app-layout>
    <div class="p-4">
        <div class="flex flex-col items-center">
            <div
                class="w-full md:w-2/3 rounded-sm p-2 border bg-secondary-full dark:bg-primary-full dark:border-primary-light">
                <h1 class="text-2xl font-medium dark:text-primary-shadWhite">{{ __('teams/create.title') }}</h1>
                <span class="text-xs text-gray-400 italic">{{ __('teams/create.description') }}</span>

                <div class="mt-4">
                    <form action="{{ route('teams.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="flex flex-col space-y-1">
                            <label for="name"
                                class="text-sm font-medium dark:text-secondary-full">{{ __('teams/create.fields.team_name') }}</label>
                            <input type="text" class="p-1 rounded-md border border-gray-300 w-full" name="name"
                                id="name" required>
                        </div>
                        <div class="flex flex-col space-y-1">
                            <label for="description"
                                class="text-sm font-medium dark:text-secondary-full">{{ __('teams/create.fields.description') }}</label>
                            <textarea name="description" class="p-1 rounded-md border border-gray-300 w-full" id="description" required></textarea>
                        </div>
                        <div class="flex flex-col space-y-2">
                            <x-button type="submit">
                                {{ __('teams/create.buttons.create') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
