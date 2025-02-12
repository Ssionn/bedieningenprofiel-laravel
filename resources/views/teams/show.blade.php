<x-app-layout>
    <div class="sm:ml-64 p-2">
        <div class="flex flex-col items-center space-y-4">
            <div class="w-full rounded-lg p-4 border bg-secondary-full dark:bg-primary-full dark:border-primary-light">
                <div class="flex justify-between items-center">
                    <div class="flex flex-col">
                        <h1 class="inline-flex items-center text-lg font-medium dark:text-primary-shadWhite">
                            <i data-lucide="users" class="mr-2 w-5 h-5"></i>
                            {{ $currentTeam->name }}
                        </h1>
                        <span class="text-xs text-gray-500">{{ $currentTeam->description }}</span>
                    </div>

                    @can('edit_team', $currentTeam)
                        <a href="#"
                            class="p-2 text-primary-full hover:text-primary-light dark:text-secondary-full dark:hover:text-primary-light">
                            <i data-lucide="pencil" class="w-5 h-5"></i>
                        </a>
                    @endcan
                </div>

                <div class="flex flex-col mt-4 space-y-2">
                    <span
                        class="inline-flex items-center text-sm @if (!$currentTeam->state) text-gray-400 @endif">
                        <i data-lucide="building2"
                            class="mr-2 w-5 h-5 text-primary-full dark:text-primary-shadWhite"></i>
                        {{ $currentTeam->state ?? 'N/A' }}
                    </span>
                    <span
                        class="inline-flex items-center text-sm @if (!$currentTeam->email) text-gray-400 @endif">
                        <i data-lucide="mail" class="mr-2 w-5 h-5 text-primary-full dark:text-primary-shadWhite"></i>
                        {{ $currentTeam->email ?? 'N/A' }}
                    </span>
                    <span
                        class="inline-flex items-center text-sm @if (!$currentTeam->phone) text-gray-400 @endif">
                        <i data-lucide="phone" class="mr-2 w-5 h-5 text-primary-full dark:text-primary-shadWhite"></i>
                        {{ $currentTeam->phone ?? 'N/A' }}
                    </span>
                </div>
            </div>

            <div class="w-full rounded-lg p-4 border bg-secondary-full dark:bg-primary-full dark:border-primary-light">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-lg font-medium dark:text-primary-shadWhite">
                            {{ __('teams/show.table.users') }}
                        </h1>
                        <span class="text-xs text-gray-500">{{ __('teams/show.table.users_description') }}</span>
                    </div>

                    @can('add_team_member', $currentTeam)
                        <x-button type="button" class="flex items-center text-xs rounded-md">
                            <a href="" class="inline-flex items-center">
                                <i data-lucide="plus" class="mr-1 w-4 h-4 dark:text-primary-full"></i>
                                {{ __('teams/show.table.users_add') }}
                            </a>
                        </x-button>
                    @endcan
                </div>

                <div class="mt-4">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="text-left text-sm font-medium text-gray-500 dark:text-primary-shadWhite p-2">
                                    <span class="inline-flex items-center">
                                        <i data-lucide="user" class="mr-1 w-6 h-6"></i>
                                        {{ __('teams/show.table.users_name') }}
                                    </span>
                                </th>
                                <th class="text-left text-sm font-medium text-gray-500 dark:text-primary-shadWhite p-2">
                                    <span class="inline-flex items-center">
                                        <i data-lucide="braces" class="mr-1 w-6 h-6"></i>
                                        {{ __('teams/show.table.users_role') }}
                                    </span>
                                </th>
                                <th class="text-left text-sm font-medium text-gray-500 dark:text-primary-shadWhite p-2">
                                    <span class="inline-flex items-center">
                                        <i data-lucide="mail" class="mr-1 w-6 h-6"></i>
                                        {{ __('teams/show.table.users_email') }}
                                    </span>
                                </th>
                                <th class="text-left text-sm font-medium text-gray-500 dark:text-primary-shadWhite p-2">
                                    <span class="inline-flex items-center">
                                        <i data-lucide="clock9" class="mr-1 w-6 h-6"></i>
                                        {{ __('teams/show.table.users_joined_at') }}
                                    </span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($currentTeam->members as $user)
                                <tr onclick="window.location='#'"
                                    class="border-b border-gray-200 hover:bg-gray-50 dark:hover:bg-primary-light cursor-pointer">
                                    <td class="p-4 text-sm dark:text-primary-shadWhite font-medium">
                                        {{ $user->name }}
                                    </td>
                                    <td class="p-4 text-sm dark:text-primary-shadWhite">
                                        {{ $user->pivot->role->prettierRole() }}
                                    </td>
                                    <td class="p-4 text-sm dark:text-primary-shadWhite">
                                        {{ $user->email }}
                                    </td>
                                    <td class="p-4 text-sm dark:text-primary-shadWhite">
                                        {{ $user->created_at->format('d M Y') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
