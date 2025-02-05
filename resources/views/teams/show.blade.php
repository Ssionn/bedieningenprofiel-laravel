<x-app-layout>
    <div class="sm:ml-64 p-2">
        <div class="flex flex-col items-center space-y-4">
            <div
                class="w-full md:w-2/3 rounded-sm p-2 border bg-secondary-full dark:bg-primary-full dark:border-primary-light">
                <h1 class="text-2xl font-medium dark:text-primary-shadWhite">{{ $team->name }}</h1>
                <span class="text-xs text-gray-400 italic">{{ $team->description }}</span>
            </div>
        </div>
</x-app-layout>
