<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8">
            <form action="{{ route('authenticate') }}" method="POST" class="mt-8 space-y-6">
                @csrf
                <div class="bg-gray-100 p-6 sm:p-8 rounded-lg">
                    <h1 class="text-2xl font-bold text-gray-900 text-center mb-6">
                        {{ __('auth/login.header') }}
                    </h1>

                    <div class="space-y-4">
                        <div>
                            <input type="email" name="email" id="email"
                                placeholder="{{ __('auth/login.form.email') }}"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-gray-400 focus:ring-2 focus:ring-gray-200 focus:outline-none transition duration-150 text-base"
                                required autocomplete="email">
                        </div>

                        <div>
                            <input type="password" name="password" id="password"
                                placeholder="{{ __('auth/login.form.password') }}"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-gray-400 focus:ring-2 focus:ring-gray-200 focus:outline-none transition duration-150 text-base"
                                required autocomplete="current-password">
                        </div>
                    </div>

                    <button type="submit"
                        class="mt-6 w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-base font-medium text-gray-900 bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 transition duration-150">
                        {{ __('auth/login.form.submit') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
