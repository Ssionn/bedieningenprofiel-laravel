<aside class="hidden md:block w-64 bg-gray-100 min-h-screen fixed">
    <div class="relative p-2 h-screen">
        <h1 class="font-medium text-2xl text-center mt-2">Bedieningenprofiel</h1>

        <div class="mt-4">
            <ul class="space-y-2">
                <x-sidebar-tab href="{{ route('dashboard') }}" active="{{ request()->routeIs('dashboard') }}">
                    {{ __('navigation/sidebar.links.dashboard') }}
                </x-sidebar-tab>
            </ul>
        </div>

        <div id="userDropdown" aria-labelledby="userDropdownButton" class="p-1 w-60 bg-gray-200 rounded-md">
            <ul class="space-y-1">
                <x-sidebar-tab href="{{ route('settings') }}" active="{{ request()->routeIs('settings') }}">
                    {{ __('navigation/sidebar.user_dropdown.settings') }}
                </x-sidebar-tab>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="block w-full px-4 py-2 rounded-md font-medium hover:bg-gray-300 text-start">
                            {{ __('navigation/sidebar.user_dropdown.logout') }}
                        </button>
                    </form>
                </li>
            </ul>
        </div>

        <button class="absolute bottom-2 p-2 w-60 px-4 py-2 bg-gray-200 rounded-md" data-dropdown-trigger="click"
            id="userDropdownButton" data-dropdown-toggle="userDropdown" data-dropdown-placement="top" type="button">
            <div class="flex flex-row items-center space-x-2">
                <img src="{{ auth()->user()->defaultAvatar() ?? auth()->user()->avatar }}"
                    class="w-7 h-7 rounded-full object-cover" />

                <div class="flex flex-col items-start">
                    <span class="font-medium">{{ Auth::user()->name }}</span>
                    <span class="text-xs text-gray-400">{{ Auth::user()->getShortenedEmailAttribute() }}</span>
                </div>
            </div>
        </button>
    </div>
</aside>

<nav class="block md:hidden">
    <div x-data="{ open: false }">
        <button @click="open = true"
            class="w-full flex justify-center items-center p-4 bg-gray-200 border-t border-gray-300">
            <x-zondicon-menu class="w-4 h-4" />
        </button>

        <div x-show="open" x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-300 transform" x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-full" class="fixed inset-0 bg-gray-100 z-50 shadow-lg flex flex-col">
            <button @click="open = false" class="self-end m-4 text-gray-500 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <div class="flex items-center p-4 space-x-4 border-b border-gray-300">
                <img src="{{ auth()->user()->defaultAvatar() ?? auth()->user()->avatar }}"
                    class="w-12 h-12 rounded-full object-cover" />
                <div>
                    <span class="block font-medium text-lg">{{ Auth::user()->name }}</span>
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

            <div class="p-4 space-y-2 border-t border-gray-300">
                <ul class="space-y-1">
                    <x-sidebar-tab href="{{ route('settings') }}" active="{{ request()->routeIs('settings') }}">
                        {{ __('navigation/sidebar.user_dropdown.settings') }}
                    </x-sidebar-tab>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="block w-full px-4 py-2 rounded-md font-medium text-white bg-red-500 hover:bg-red-700 text-start">
                                {{ __('navigation/sidebar.user_dropdown.logout') }}
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
