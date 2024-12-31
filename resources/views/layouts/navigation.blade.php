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
                <li>
                    <a href="#" class="block px-4 py-2 rounded-md font-medium hover:bg-gray-300">
                        {{ __('Settings') }}
                    </a>
                </li>
            </ul>
        </div>

        <button class="absolute bottom-2 p-2 w-60 px-4 py-2 bg-gray-200 rounded-md" data-dropdown-trigger="click"
            id="userDropdownButton" data-dropdown-toggle="userDropdown" data-dropdown-placement="top" type="button">
            <div class="flex flex-row items-center space-x-2">
                <x-heroicon-s-user class="w-7 h-7" />

                <div class="flex flex-col items-start">
                    <span class="font-medium">{{ Auth::user()->name ?? 'Guest' }}</span>
                    <span class="text-xs text-gray-400">{{ Auth::user()->email ?? 'just a guest.' }}</span>
                </div>
            </div>
        </button>
    </div>
</aside>
