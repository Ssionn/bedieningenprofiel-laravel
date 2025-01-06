<x-guest-layout>
    <div class="flex flex-col justify-center items-center h-screen p-2">
        <form action="{{ route('createAccount') }}" method="POST"
            class="flex flex-col justify-center items-center w-full">
            <div class="bg-gray-300 p-2 w-full md:w-2/3 lg:w-1/3 rounded-md">
                <h1 class="text-2xl font-medium">{{ __('auth/register.header') }}</h1>

                <div class="mt-4">
                    @csrf

                    <div class="space-y-2">
                        <input type="text" name="username" id="username"
                            placeholder="{{ __('auth/register.form.username') }}"
                            class="w-full p-2 rounded-md border border-gray-300 focus:border-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400"
                            required>

                        <input type="text" name="name" id="name"
                            placeholder="{{ __('auth/register.form.name') }}"
                            class="w-full p-2 rounded-md border border-gray-300 focus:border-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400"
                            required>

                        <input type="email" name="email" id="email"
                            placeholder="{{ __('auth/register.form.email') }}"
                            class="w-full p-2 rounded-md border border-gray-300 focus:border-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400"
                            required>

                        <input type="password" name="password" id="password"
                            placeholder="{{ __('auth/register.form.password') }}"
                            class="w-full p-2 rounded-md border border-gray-300 focus:border-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400"
                            required>

                        <input type="password" name="password_confirmation" id="password_confirmation"
                            placeholder="{{ __('auth/register.form.password_confirmation') }}"
                            class="w-full p-2 rounded-md border border-gray-300 focus:border-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400"
                            required>
                    </div>
                </div>
            </div>

            <button type="submit"
                class="mt-4 p-2 w-full sm:w-2/4 lg:w-1/4 bg-gray-200 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-1 focus:ring-gray-400">
                {{ __('auth/register.form.submit') }}
            </button>
        </form>
    </div>
</x-guest-layout>
