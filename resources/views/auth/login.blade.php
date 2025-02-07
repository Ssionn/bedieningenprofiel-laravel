<x-guest-layout>
    <div class="min-h-screen flex flex-col items-center justify-center px-4 sm:px-6 lg:px-8 bg-secondary-full">
        <h1 class="text-center text-2xl font-bold">{{ __('auth/login.header') }}</h1>
        <h2 class="text-lg font-semibold mt-2">{{ __('auth/login.form.header') }}</h2>
        <div>
            <span class="text-sm text-gray-200">{{ __('auth/login.no_account') }}</span>
            <a href="{{ route('register') }}"
                class="inline-flex items-center text-indigo-600 hover:text-indigo-800 text-sm underline focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 transition ease-in-out hover:scale-105 duration-150">
                {{ __('auth/login.register') }}
                <x-heroicon-o-arrow-long-right class="ml-1 w-5 h-5" />
            </a>
        </div>
        <form action="{{ route('authenticate') }}" method="POST" class="w-full max-w-md space-y-2">
            <div class="border border-gray-200 rounded-sm p-4 mt-4">
                @csrf

                <div>
                    <label for="email" class="text-gray-200 ml-1">{{ __('auth/login.form.label.email') }}</label>
                    <input type="email" name="email" id="email"
                        class="w-full px-2 py-1 mt-1 rounded-sm border border-gray-200 placeholder:text-gray-50 focus:border-gray-400 focus:ring-2 focus:ring-gray-200 focus:outline-none"
                        required autocomplete="email">
                </div>

                <div class="mt-2">
                    <label for="password" class="text-gray-200 ml-1">{{ __('auth/login.form.label.password') }}</label>
                    <input type="password" name="password" id="password"
                        class="w-full px-2 py-1 mt-1 rounded-sm border border-gray-200 placeholder:text-gray-50 focus:border-gray-400 focus:ring-2 focus:ring-gray-200 focus:outline-none"
                        required autocomplete="password">
                </div>
            </div>

            <div class="mt-2">
                <button type="submit"
                    class="w-full py-1.5 px-4 rounded-sm font-medium bg-primary-full text-secondary-full hover:bg-primary-light focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 transition duration-150">
                    {{ __('auth/login.form.submit') }}
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
