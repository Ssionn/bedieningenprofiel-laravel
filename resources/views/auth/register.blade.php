<x-guest-layout>
    <div class="min-h-screen flex flex-col items-center justify-center px-4 sm:px-6 lg:px-8 bg-secondary-full">
        <h1 class="text-center text-2xl font-bold">{{ __('auth/register.header') }}</h1>
        <form action="{{ route('createAccount') }}" method="POST" class="w-full max-w-md space-y-2">
            <div class="border border-gray-200 rounded-sm p-4 mt-4">
                @csrf

                <div>
                    <label for="username" class="text-gray-200 ml-1">{{ __('auth/register.form.username') }}</label>
                    <input type="text" name="username" id="username"
                        class="w-full px-2 py-1 mt-1 rounded-sm border border-gray-200 placeholder:text-gray-50 focus:border-gray-400 focus:ring-2 focus:ring-gray-200 focus:outline-none"
                        required autocomplete="username">
                </div>

                <div class="mt-2">
                    <label for="name" class="text-gray-200 ml-1">{{ __('auth/register.form.name') }}</label>
                    <input type="text" name="name" id="name"
                        class="w-full px-2 py-1 mt-1 rounded-sm border border-gray-200 placeholder:text-gray-50 focus:border-gray-400 focus:ring-2 focus:ring-gray-200 focus:outline-none"
                        required autocomplete="name">
                </div>

                <div class="mt-2">
                    <label for="email" class="text-gray-200 ml-1">{{ __('auth/register.form.email') }}</label>
                    <input type="email" name="email" id="email"
                        class="w-full px-2 py-1 mt-1 rounded-sm border border-gray-200 placeholder:text-gray-50 focus:border-gray-400 focus:ring-2 focus:ring-gray-200 focus:outline-none"
                        required autocomplete="email">
                </div>

                <div class="mt-2">
                    <label for="password" class="text-gray-200 ml-1">{{ __('auth/register.form.password') }}</label>
                    <input type="password" name="password" id="password"
                        class="w-full px-2 py-1 mt-1 rounded-sm border border-gray-200 placeholder:text-gray-50 focus:border-gray-400 focus:ring-2 focus:ring-gray-200 focus:outline-none"
                        required autocomplete="new-password">
                </div>

                <div class="mt-2">
                    <label for="password_confirmation"
                        class="text-gray-200 ml-1">{{ __('auth/register.form.password_confirmation') }}</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="w-full px-2 py-1 mt-1 rounded-sm border border-gray-200 placeholder:text-gray-50 focus:border-gray-400 focus:ring-2 focus:ring-gray-200 focus:outline-none"
                        required autocomplete="new-password">
                </div>
            </div>

            <div class="mt-2">
                <button type="submit"
                    class="w-full py-1.5 px-4 rounded-sm font-medium bg-primary-full text-secondary-full hover:bg-primary-light focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 transition duration-150">
                    {{ __('auth/register.form.submit') }}
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
