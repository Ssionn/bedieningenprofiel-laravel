<aside
    class="hidden md:block w-64 bg-secondary-full text-secondary-light dark:bg-primary-full dark:text-primary-shadWhite min-h-screen fixed border-r border-gray-200 dark:border-primary-light">
    <div class="relative p-2 h-screen">
        <h1 class="font-medium text-2xl text-center mt-2">Bedieningenprofiel</h1>

        <div class="mt-4">
            <ul class="space-y-2">
                <x-sidebar-tab href="{{ route('dashboard') }}" active="{{ request()->routeIs('dashboard') }}">
                    {{ __('navigation/sidebar.links.dashboard') }}
                </x-sidebar-tab>

                @can('view_current_team')
                    <x-sidebar-tab href="{{ route('teams.show', $currentTeam) }}"
                        active="{{ request()->routeIs('teams.show', $currentTeam) }}">
                        {{ __('navigation/sidebar.links.team') }}
                    </x-sidebar-tab>
                @endcan
            </ul>
        </div>

        <div class="mt-4 border-t p-2">
            <h2 class="font-medium">{{ __('navigation/sidebar.links.all_teams') }}</h2>

            @can('view_any_attached_team')
                <div class="mt-2">
                    @if ($userTeams->isEmpty())
                        <p class="text-sm text-gray-400">{{ __('navigation/sidebar.links.no_teams') }}</p>
                    @endif
                    <div class="mb-4 flex flex-col space-y-1">
                        @foreach ($userTeams as $team)
                            <form action="{{ route('teams.switch', $team->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="hover:bg-gray-200 rounded-sm w-full py-1.5 px-4 dark:bg-secondary-full dark:text-primary-full flex justify-between items-center">
                                    <span class="text-xm font-medium">{{ $team->name }}</span>
                                    @if (auth()->user()->current_team_id == $team->id)
                                        <span
                                            class="font-medium bg-emerald-400 dark:bg-emerald-500 rounded-full text-xs px-2 py-0.5 text-primary-shadWhite">
                                            {{ __('navigation/sidebar.links.tag.selected') }}
                                        </span>
                                    @endif
                                </button>
                            </form>
                        @endforeach
                    </div>

                    @can('create_teams')
                        <a href="{{ route('teams.create') }}"
                            class="inline-flex items-center w-full text-sm py-1.5 px-4 font-medium rounded-sm bg-primary-full text-primary-shadWhite dark:text-primary-full hover:bg-primary-light dark:hover:bg-gray-200 dark:bg-secondary-full">
                            <x-fas-plus class="w-4 h-4 mr-2" />
                            {{ __('navigation/sidebar.links.create_team') }}
                        </a>
                    @else
                        <a href=""
                            class="inline-flex items-center w-full text-xs py-1.5 px-4 font-medium rounded-sm bg-primary-full text-primary-shadWhite dark:text-primary-full hover:bg-primary-light dark:hover:bg-gray-200 dark:bg-secondary-full">
                            <x-fas-plus class="w-4 h-4 mr-2" />
                            {{ __('navigation/sidebar.links.upgrade_team') }}
                        </a>
                    @endcan
                </div>
            @endcan
        </div>

        <div x-data="{ dropdownOpen: false }">
            <div x-show="dropdownOpen" @click.away="dropdownOpen = false"
                class="w-60 bg-secondary-full dark:bg-primary-full rounded-sm border-[1px] border-gray-300 dark:border-primary-light absolute bottom-16">
                <ul class="">
                    <x-sidebar-tab href="{{ route('settings') }}" active="{{ request()->routeIs('settings') }}"
                        rounded="{{ $rounded = false }}">
                        {{ __('navigation/sidebar.user_dropdown.settings') }}
                    </x-sidebar-tab>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="block w-full px-4 py-1.5 font-medium hover:bg-gray-200 dark:hover:bg-primary-light text-start">
                                {{ __('navigation/sidebar.user_dropdown.logout') }}
                            </button>
                        </form>
                    </li>
                </ul>
            </div>

            <button @click="dropdownOpen = !dropdownOpen"
                class="absolute bottom-2 p-2 w-60 px-4 py-2 rounded-sm hover:bg-gray-200 dark:hover:bg-primary-light"
                type="button">
                <div class="flex flex-row items-center space-x-2">
                    <img src="{{ auth()->user()->defaultAvatar() }}"
                        class="w-8 h-8 rounded-full object-cover border" />

                    <div class="flex flex-col items-start">
                        <span class="font-medium">{{ Auth::user()->name }}</span>
                        <span class="text-xs text-gray-400">{{ Auth::user()->getShortenedEmailAttribute() }}</span>
                    </div>
                </div>
            </button>
        </div>
    </div>
</aside>

<nav class="block md:hidden">
    <div x-data="{ open: false }">
        <button @click="open = true"
            class="w-full flex justify-center items-center p-3 border-b dark:bg-primary-full border-t">
            <x-zondicon-menu class="w-4 h-4" />
        </button>

        <div x-show="open" x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-300 transform" x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-full"
            class="fixed inset-0 bg-secondary-full dark:bg-primary-full z-50 shadow-lg flex flex-col">
            <button @click="open = false" class="self-end m-4 text-gray-500 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <div class="flex items-center p-4 space-x-4 border-b">
                <img src="{{ auth()->user()->defaultAvatar() ?? auth()->user()->avatar }}"
                    class="w-12 h-12 rounded-md object-cover border" />
                <div>
                    <span class="block font-medium text-lg dark:text-primary-shadWhite">{{ Auth::user()->name }}</span>
                    <span class="block text-sm text-gray-400">{{ Auth::user()->email }}</span>
                </div>
            </div>

            <div class="flex-1 p-4 space-y-4">
                <ul class="space-y-2">
                    <x-sidebar-tab href="{{ route('dashboard') }}" active="{{ request()->routeIs('dashboard') }}">
                        {{ __('navigation/sidebar.links.dashboard') }}
                    </x-sidebar-tab>
                </ul>
            </div>

            <div class="p-4 space-y-2 border-t">
                <ul class="space-y-1">
                    <x-sidebar-tab href="{{ route('settings') }}" active="{{ request()->routeIs('settings') }}">
                        {{ __('navigation/sidebar.user_dropdown.settings') }}
                    </x-sidebar-tab>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="block w-full px-4 py-1.5 rounded-sm font-medium text-primary-shadWhite bg-red-500 hover:bg-red-700 text-start">
                                {{ __('navigation/sidebar.user_dropdown.logout') }}
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
