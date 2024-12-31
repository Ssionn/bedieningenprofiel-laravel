<x-guest-layout>
    <div class="flex flex-col justify-center items-center h-screen p-2">
        <form action="{{ route('authenticate') }}" method="POST" class="flex flex-col justify-center items-center w-full">
            <div class="bg-gray-100 p-2 w-full md:w-2/3 lg:w-1/3 rounded-md">
                <h1 class="text-2xl font-medium">{{ __('auth/login.header') }}</h1>

                <div class="mt-4">
                    @csrf

                    <div class="space-y-2">
                        <input type="email" name="email" id="email"
                            placeholder="{{ __('auth/login.form.email') }}"
                            class="w-full p-2 rounded-md border border-gray-300 focus:border-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400"
                            required>

                        <input type="password" name="password" id="password"
                            placeholder="{{ __('auth/login.form.password') }}"
                            class="w-full p-2 rounded-md border border-gray-300 focus:border-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400"
                            required>
                    </div>
                </div>
            </div>

            <button type="submit"
                class="mt-4 p-2 w-full sm:w-2/4 lg:w-1/4 bg-gray-200 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-1 focus:ring-gray-400">
                {{ __('auth/login.form.submit') }}
            </button>
        </form>
    </div>
</x-guest-layout>
